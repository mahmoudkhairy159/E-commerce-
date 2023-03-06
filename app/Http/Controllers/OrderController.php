<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //checkout (make a purchase)
    public function confirmOrder(Request $req)
    {
        $user = Auth::guard('web')->user();
        $order = $user->orders->where('status', 'pending')->first();
        $deliveryDate=Carbon::now()->addDays(3)->toDateString();
        if ($req->paymentMethod == '0') {
            $order->update([
                'status' => '1',
                'deliveryDate'=>$deliveryDate,
                //paymentmethods and other attributes of order
                'paymentMethod' => $req->paymentMethod,
                'paymentStatus' => '0',
            ]);
            session()->flash('success', 'Products is ordered successfully paymentMethod is cash!');
            return redirect()->route('indexUser');
        }

        if (request('id') && request('resourcePath')) {
            $paymentStatus = $this->getPaymentStatus( request('resourcePath'));
            if (isset($paymentStatus['id'])) {
                $order->update([
                    'status' => '1',
                    'deliveryDate'=>$deliveryDate,
                    //paymentmethods and other attributes of order
                    'paymentMethod' => '1',
                    'paymentStatus' => '1',
                    'transactionId' =>$paymentStatus['id'],
                ]);
                session()->flash('success', 'Products is ordered successfully paymentMethod is VISA!');
                return redirect()->route('indexUser');

            } else {
                session()->flash('error', 'Products is failed to order because paymentMethod (VISA) is INVALID !');
                return redirect()->route('indexUser');
            }
        }
    }

    public function showOrders()
    {
        $user = Auth::guard('web')->user();
        $orders = $user->orders()->where('status', '<>', '0')->orderBy('created_at', 'desc')->paginate(paginationCount);
        if ($orders->count() == 0) {
            return redirect()->route('indexUser')->with('error', 'You Does Not Make Any Orders Yet!');
        }
        $productsQuantities = array();
        foreach ($orders as $order) {
            $products = $order->products;
            foreach ($products as $product) {
                $productQuantity = DB::table('order_product')->select('quantity')->where('product_id', $product->id)->where('order_id', $order->id)->value('quantity');
                array_push($productsQuantities, $productsQuantities[$order->id . $product->id] = $productQuantity);
            }
        }
        return view('orders.myOrders')->with('orders', $orders)->with('productsQuantities', $productsQuantities);
    }

    private function getPaymentStatus($resourcePath)
    {
        $url = "https://eu-test.oppwa.com" ;
        $url .= $resourcePath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData,true);
    }


}
