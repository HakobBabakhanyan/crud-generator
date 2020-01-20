<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use  Share;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin_share();
            return $next($request);
        });
    }

    public function profile(){
        return view('admin.profile.edit');
    }
    public function profile_update(Request $request,Admin $admin)
    {

        if(!Hash::check($request['old_password'],$admin->password)){
            return redirect()->back()->withErrors(['old_password'=>'old password not match']);
        };
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|min:3|unique:admins,email,'.$admin->id,
            'password' => 'nullable|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:8'
        ]);


        Admin::_save($request->all(),$admin);

        return redirect()->back();
//        return view('admin.profile.edit');
    }
}
