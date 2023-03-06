<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user= Auth::guard('web')->user();
        $order=$user->orders->where('status' ,'pending')->first();
        $product=Product::find($request->productId);
        if (!$order){

            $order=Order::create([
                'user_id'=>$user->id,
                'address'=>$user->address,
                'phone'=>$user->phone,
                'totalPrice'=>(!is_null($product->salePrice) && $product->salePrice>0)?$product->salePrice:$product->price,
            ]);

            DB::table('order_product')->insert([
                'order_id' => $order->id,
                'product_id' =>  $request->productId,
                'quantity'=> 1,
           ] );

            $data=[

                'productId'=>$product->id,
                'productName'=>$product->name,
            ];
            event(new NewNotification($data));
            return redirect()->back()->with('success', 'Product is added to cart successfully!');
        }
        $productQuantity =  DB::table('order_product')->select('quantity')->where('product_id',$request->productId)->first();
       if(!$productQuantity){
           DB::table('order_product')->insert([
               'order_id' => $order->id,
               'product_id' =>  $request->productId,
           ] );
       }
        $productQuantity =  DB::table('order_product')->select('quantity')->where('product_id',$request->productId)->first();
        $totalPrice = $order->totalPrice;
        if(!is_null($product->salePrice) && $product->salePrice>0){
            $totalPrice+=$product->salePrice;
        }else{
            $totalPrice+=$product->price;
        }

        $order->update([
            'totalPrice' =>$totalPrice,
        ]);
        DB::table('order_product')->where( 'product_id',$product->id)->update([
            'quantity' => $productQuantity->quantity +1  ,
        ] );
        $data=[
            'productId'=>$product->id,
            'productName'=>$product->name,
        ];
        event(new NewNotification($data));
        return redirect()->back()->with('success', 'Product is added to cart successfully!');
    }

    public function showCartList()
    {
        $user= Auth::guard('web')->user();
        $order=$user->orders->where('status' ,'pending')->first();
        if(!$order){
            return redirect()->route('indexUser')->with(['success'=> 'Cart List Is Now Empty!']);
        }
        $products=$order->products;
        $productsQuantities=[];
        $totalPriceBeforeSale=0;
        foreach($products as $product){
            $productQuantity = DB::table('order_product')->select('quantity')->where('product_id', $product->id)->where('order_id',$order->id)->value('quantity');
            array_push($productsQuantities, $productsQuantities[$order->id.$product->id] = $productQuantity);
            $totalPriceBeforeSale+=$productQuantity*$product->price;
        }
        return view('cart.cartList')->with('order', $order)->with('totalPrice', $order->totalPrice)->with('productsQuantities',$productsQuantities)->with('totalPriceBeforeSale',$totalPriceBeforeSale);
    }

    public function removeProductfromCartList($productId)
    {
        $user= Auth::guard('web')->user();
        $order=$user->orders->where('status' ,'pending')->first();
        $removedProductPrice=Product::find($productId)->price;
        $removedProductQuantity =  DB::table('order_product')->where('order_id',$order->id)->where('product_id',$productId)->value('quantity');
        $removedProductTotalPrice=$removedProductQuantity*$removedProductPrice;
        $order->products()->detach($productId);
        $order->update([
            'totalPrice'=>$order->totalPrice- $removedProductTotalPrice,
        ]);
        if($order->products()->count()==0){
            $order->delete();
            return redirect()->route('indexUser')->with(['success'=> 'Cart List Is Now Empty!']);
        }
        return redirect()->back()->with(['success'=> 'Product is removed from cart successfully!'])->with('totalPrice',$order->totalPrice);
    }

    /*
     Edit A PRODUCT QUANTITY IN CARTLIST
     */
    public function editProductQuantity(Request $request)
    {
        $product = Product::find($request->productId);
        if(!is_null($product->salePrice) && $product->salePrice>0){
            $productPrice=$product->salePrice;
        }else{
            $productPrice=$product->price;
        }
        $oldQuantity = DB::table('order_product')->where( 'order_id',$request->orderId)->where( 'product_id',$request->productId)->value('quantity');
        $oldPrice= $productPrice * $oldQuantity;
        $order=Order::where( 'id',$request->orderId)->first();
        $order->update([
            'totalPrice'=>$order->totalPrice-$oldPrice,
        ]);
        DB::table('order_product')->where( 'order_id',$request->orderId)->where( 'product_id',$request->productId)->update([
            'quantity' => $request->productQuantity  ,
        ] );
        $newPrice= $productPrice * $request->productQuantity;
        $order->update([
            'totalPrice'=>$order->totalPrice+ $newPrice,
        ]);

        return redirect()->route('showCartList')->with(['success'=> 'Product Quantity is updated successfully!']);
    }





}
