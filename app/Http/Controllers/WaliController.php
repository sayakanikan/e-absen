<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
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
            'title' => 'Wali Murid',
        ]);
    }

    public function search(Request $request){
        $nis = $request->nis;
        $tanggal = $request->tanggal;
        
        $murid = User::with('kelas')->where('nis', $nis)->where('lahir_ayah', $tanggal)->first() ? User::where('nis', $nis)->where('lahir_ayah', $tanggal)->first() : User::where('nis', $nis)->where('lahir_ibu', $tanggal)->first();

        if ($murid == null) {
            return back()->with('error', 'NIS atau tanggal lahir salah!, Murid tidak ditemukan.');
        }
        $guru = Admin::where('kelas_id', $murid->kelas_id)->first();

        return view('wali/search', [
            'title' => 'Cari Murid',
            'murid' => $murid,
            'guru' => $guru,
        ]);
    }
}
