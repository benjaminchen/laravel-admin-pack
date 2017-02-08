<?php

namespace BenjaminChen\Admin\Controllers;

use Illuminate\Routing\Controller;
use View;
use Auth;
use BHelper;

class BaseController extends Controller
{
    public function __construct()
    {
        View::share('sideMenu', array_keys(config("admin.classMap", [])));
    }
}