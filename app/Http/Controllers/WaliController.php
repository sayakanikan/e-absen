<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function index(){
        return view('wali/index', [
            'title' => 'Beranda'
        ]);
    }

    public function wali(){
        return view('wali/wali', [
            'title' => 'Wali Murid'
        ]);
    }
}
