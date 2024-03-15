<?php

namespace App\Admin\Http\Controllers\Home;

use App\Admin\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    //
    public function index(){
        return redirect()->route('admin.dashboard');
    }
}
