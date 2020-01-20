<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Share;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    use Share;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
           $this->admin_share();
            view()->share(['active_menu'=>'Dashboard']);
            return $next($request);

        });
    }

    public function index(){
        return view('admin.dashboard.index');
    }
    public function table(){
        return view('admin.demo.tables');
    }
    public function login(){
        return view('admin.auth.login');
    }
}
