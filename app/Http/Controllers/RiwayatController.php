<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(){
        return view('content/riwayat/index', [
            'title' => 'Riwayat Absensi',
            'kelas' => User::with('kelas')->first(),
            'absen' => Absen::where('user_id', auth()->user()->id)->latest()->paginate(10),
        ]);
    }
}
