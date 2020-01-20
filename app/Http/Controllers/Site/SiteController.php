<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Languages;


class SiteController extends Controller
{
    protected static $shared = [];

    public function __construct()
    {

        $this->middleware(function ($request,$next){
            $this->site_share();
            return $next($request);
        });

    }

    public function site_share(){

        if (count(self::$shared)) return false;

        view()->share(self::$shared);
        return true;
    }
}
