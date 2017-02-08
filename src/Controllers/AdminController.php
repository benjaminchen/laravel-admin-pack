<?php

namespace BenjaminChen\Admin\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        return view('adminPack::index');
    }
}