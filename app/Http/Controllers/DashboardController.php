<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('content/dashboard', [
            'title' =>  'Dashboard',
        ]);
    }

    // Edit Profile
    public function edit()
    {
        return view('content/akun', [
            'title' => 'Akun Anda',
            'akun'  => auth()->user(),
            'foto'  => auth()->user()->foto,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'nip'       => 'required',
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

        return back()->with('success', 'Data anda berhasil diubah');
    }
}
