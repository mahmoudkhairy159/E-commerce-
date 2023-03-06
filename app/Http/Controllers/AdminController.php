<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin Does not Exist');

        }
        return view('admins.admin-profile')->with('admin', $admin);
    }


    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin Does not Exist');
        }
        $admin->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect()->route('admins.show',$id)->with('success', 'Profile is updated successfully');
    }

    public function changePassword(Request $request,$id)
    {
       $admin=Admin::find($id);

        if (! Hash::check($request->currentPassword,$admin->password) ) {
            return redirect()->back()->with('error', 'current password is wrong');
        }
        if($request->newPassword !==$request->renewPassword){
            return redirect()->back()->with('error', 'Re-enter New Password Correctly');

        }
        $admin->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }


}
