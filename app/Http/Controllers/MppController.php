<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MppController extends Controller
{
    public function index(){
        return view('mpp.dashboard');
    }
}
