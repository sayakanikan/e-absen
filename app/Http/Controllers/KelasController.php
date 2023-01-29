<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(){
        return view('content/kelas/index', [
            'title' => 'Ruang Kelas',
        ]);
    }
}
