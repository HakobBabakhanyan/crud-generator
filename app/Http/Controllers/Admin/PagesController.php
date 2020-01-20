<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResourceController;
use App\Traits\Share;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    use ResourceController,Share;
    private $config_name = 'Pages';

}
