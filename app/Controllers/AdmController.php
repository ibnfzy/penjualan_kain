<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdmController extends BaseController
{
    public function index()
    {
        return view('admin/home');
    }
}