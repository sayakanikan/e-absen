<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(){
        // dd($name = auth()->guard('web')->user()->name);
        if(auth()->guard('admin')->check()){
            $id = auth()->guard('admin')->user()->admin_id;
            $query = Absen::latest()->paginate(10);
        }elseif(auth()->guard('web')->check()){
            $id = auth()->guard('web')->user()->user_id;
            $query = Absen::where('user_id','=',$id)->latest()->paginate(10);
        }

        return view('content/riwayat/index', [
            'title' => 'Riwayat Absensi',
            'kelas' => User::with('kelas')->first(),
            'absen' => $query,
        ]);
    }
}
