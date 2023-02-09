<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Admin;
use App\Models\Kelas;
use App\Models\Qr;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if (date('n') >= 1 && date('n') <= 6) {
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        } else {
            $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        }
        return view('content/dashboard', [
            'title'         => 'Dashboard',
            'jmlMurid'      => User::all()->count(),
            'jmlKelas'      => Kelas::all()->count(),
            'jmlWalikelas'  => Admin::all()->count(),
            'jmlBarcode'    => Qr::all()->count(),
            'kelas'         => User::with('kelas')->first(),
            'absen'         => Absen::where('user_id', auth()->user()->id)->latest()->take(5)->get(),
            'bulan'         => $bulan,
        ]);
    }

    // Edit Profile
    public function edit()
    {
        return view('content/akun', [
            'title' => 'Akun Anda',
            'akun'  => auth()->user(),
            'foto'  => auth()->user()->foto,
            'ruang' => Kelas::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($this->authorize('user')) {
            $validatedData = $request->validate([
                'name'      => 'required',
                'nis'       => 'required',
                'gender'    => 'required',
                'alamat'    => 'required',
                'telepon'   => 'required',
                'email'     => 'required',
                'foto'      => 'image|file|max:2160',
            ]);
    
            if (!$request->foto) {
                $validatedData['foto'] = $request->oldFoto;
            }
    
            if($request->file('foto')){
                $validatedData['foto'] = $request->file('foto')->store('');
            }
    
            if (!$request->password) {
                $validatedData['password'] = $request->oldPassword;
            }
    
            $validatedData['role_id'] = auth()->user()->role_id;
    
            User::where('id', $id)->update($validatedData);
        }
        

        return back()->with('success', 'Data anda berhasil diubah');
    }
}
