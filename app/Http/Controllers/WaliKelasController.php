<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index(){
        return view('content/walikelas/index', [
            'title' => 'Wali Kelas',
        ]);
    }
}
