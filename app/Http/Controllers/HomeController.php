<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd();

        $emails = [
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',
            'myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com',

        ];

        $i = 0;
        foreach ($emails as $email){
            ++$i;
            Mail::send('test', [], function($message) use ($email,$i)
            {
                $message->to($email.$i)->subject('This is test e-mail');
            });
            sleep(5);
        }
        var_dump( Mail:: failures());
        dd();
        return view('home');
    }
}
