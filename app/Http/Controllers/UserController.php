<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users=User::select('id', 'name','email','address','phone')->paginate(paginationCount);
        return view('adminDashboard.allUsersTable')->with('users', $users);
    }

    public function show($id)
    {
        $user= User::find($id);
        if(!$user){
            return redirect()->back()->with('error','User Does not Exist');

        }
        return view('users.user-profile')->with('user',$user);
    }

    public function showUserForAdmin($id)
    {
        $user= User::select('id', 'name','email','address','phone')->where('id',$id)->first();
        if(!$user){
            return redirect()->back()->with('error','User Does not Exist');
        }
        //showUserOrdersForAdmin
        $orders = $user->orders()->where('status','<>','0')->get();
        $productsQuantities =array();
        foreach ($orders as $order) {
            $products = $order->products;
            foreach ($products as $product) {
                $productQuantity = DB::table('order_product')->where('order_id', $order->id)->where('product_id', $product->id)->value('quantity');
                array_push (  $productsQuantities , $productsQuantities[$order->id.$product->id]= $productQuantity );
            }
        }

        //showUsercartlistForAdmin
        $pendingOrder=$user->orders()->where('status' ,'0')->first();
        if($pendingOrder){
            $pendingProducts=$pendingOrder->products;
            $pendingProductsQuantities=[];
            $totalPrice = 0;
            foreach($pendingProducts as $pendingProduct){
                $productQuantity = DB::table('order_product')->where('order_id', $pendingOrder->id)->where('product_id', $pendingProduct->id)->value('quantity');
                array_push (  $pendingProductsQuantities , $pendingProductsQuantities[$pendingOrder->id]= $productQuantity );
            }
            return view('users.showUserForAdmin')->with('user',$user)->with('orders',$orders)->with('productsQuantities',$productsQuantities)->with('pendingOrder',$pendingOrder)->with('pendingProductsQuantities',$pendingProductsQuantities );;
        }
        return view('users.showUserForAdmin')->with('user',$user)->with('orders',$orders)->with('productsQuantities',$productsQuantities);;




    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User Does not Exist');
        }
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect()->route('users.show',$id)->with('success', 'Profile is updated successfully');
    }



    public function changePassword(Request $request,$id)
    {
        $user=User::find($id);

        if (! Hash::check($request->currentPassword, $user->password) ) {
            return redirect()->back()->with('error', 'current password is wrong');
        }
        if($request->newPassword !==$request->renewPassword){
            return redirect()->back()->with('error', 'Re-enter New Password Correctly');

        }
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $orders=$user->orders;
        foreach($orders as $order){
            foreach ($order->products  as $product){
                $product->orders()->detach($order->id);
            }
            $order->delete();
        }
        $user->delete();
        return redirect()->route('users.index');


    }
}
