<?php

namespace App\Http\Controllers\Site;


class IndexController extends SiteController
{
    public function index()
    {
        return view('site.home.index');
    }

}
