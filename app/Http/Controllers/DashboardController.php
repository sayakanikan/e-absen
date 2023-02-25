<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\Kelas;
use App\Models\Qr;
use App\Models\User;
use App\Models\AdminLogin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->guard('admin')->check()){
            $admin_id = auth()->guard('admin')->user()->admin_id;
            $query = Absen::where('admin_id','=',$admin_id)->latest()->take(5)->get();
            $tittle = 'Dashboard admin';
            $jmlmurid = User::all()->count();
            $jmlkelas = Kelas::all()->count();
            $jmlwalikelas = Admin::all()->count();
            $jmlbarcode = Qr::all()->count();
            $kelas = Admin::select('kelas')
            ->groupBy('kelas')
            ->leftJoin('kelas', function($join){
                $join->on('kelas.id', '=', 'admins.kelas_id');
            })->pluck('kelas')->first();
        }elseif(auth()->guard('web')->check()){
            $user_id = auth()->guard('web')->user()->user_id;
            $query = Absen::where('user_id','=',$user_id)->latest()->take(5)->get();
            $tittle = 'Dashboard';
            $jmlmurid = User::all()->count();
            $jmlkelas = Kelas::all()->count();
            $jmlwalikelas = Admin::all()->count();
            $jmlbarcode = Qr::all()->count();
            $kelas = User::distinct()->select('kelas')
            ->groupBy('kelas')
            ->leftJoin('kelas', function($join){
                $join->on('kelas.id', '=', 'users.kelas_id');
            })->pluck('kelas')->first();
        }elseif(auth()->guard('superadmin')->check()){
            $superadmin_id = auth()->guard('superadmin')->user()->superadmin_id;
            $query = Absen::all();
            $tittle = 'Dashboard superadmin';
            $jmlmurid = User::all()->count();
            $jmlkelas = Kelas::all()->count();
            $jmlwalikelas = Admin::all()->count();
            $jmlbarcode = Qr::all()->count();
            $kelas = 'Superadmin';
            // SuperAdmin::select('kelas')
            // ->groupBy('kelas')
            // ->leftJoin('kelas', function($join){
            //     $join->on('kelas.id', '=', 'superadmins.kelas_id');
            // })->pluck('kelas')->first();
        }

        if (date('n') >= 1 && date('n') <= 6) {
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        } else {
            $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        }
        return view('content/dashboard', [
            'title'         => $tittle,
            'jmlMurid'      => $jmlmurid,
            'jmlKelas'      => $jmlkelas,
            'jmlWalikelas'  => $jmlwalikelas,
            'jmlBarcode'    => $jmlbarcode,
            'kelas'         => $kelas,
            'absen'         => $query,
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
