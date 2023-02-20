<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index() {
        $siswa = User::all();

        return view('content/siswa/index', [
            'siswa'     => $siswa,
            'title'     => 'data siswa',
            'tgl'       => date('l, d F Y'),
        ]);
    }
    public function search(Request $request){
        $keyword = $request->search;

        $siswa = User::where('name', 'like', "%" . $keyword . "%")->first();

        return view('content/siswa/index', [
            'siswa'     => $siswa,
            'title'     => 'data siswa',
            'tgl'       => date('l, d F Y'),
            // 'foto'      => auth()->user()->foto,
        ]);
    }
}
