<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index() {
        return view('content/siswa/index', [
            'title' => 'Data Siswa',
        ]);
    }
}