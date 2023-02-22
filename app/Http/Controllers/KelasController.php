<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(){
        return view('content/kelas/index', [
            'title' => 'Ruang Kelas',
            'tgl'   => date('l, d F Y'),
            'ruang' => Kelas::latest()->paginate(5),
            // 'foto'  => auth()->user()->foto,
        ]);
    }

    public function create(){
        return view('content/kelas/create', [
            'title' => 'Tambah Kelas',
            // 'foto'  => auth()->user()->foto,
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'kelas'     => 'required|min:1',
            'jml_siswa' => 'required|min:1|numeric',
        ]);

        Kelas::create($validatedData);

        return redirect('/ruang')->with('success', 'Ruang Kelas baru berhasil ditambahkan');
    }

    public function show($id){
        $kelas = Kelas::where('id', $id)->first();
        $murid = User::where('kelas_id', $id)->latest()->paginate(5);
        $guru = Admin::where('kelas_id', $id)->first();
        // dd($murid, $murid[0] == null);
        return view('content/kelas/detail', [
            'title' => 'Detail Kelas',
            'kelas' => $kelas,
            'murid' => $murid,
            'guru'  => $guru,
        ]);
    }

    public function edit($id){
        $kelas = Kelas::where('id', $id)->first();
        return view('content/kelas/edit', [
            'title' => 'Update Ruang Kelas',
            'kelas' => $kelas,
            // 'foto'  => auth()->user()->foto,
        ]);
    }

    public function update($id, Request $request){
        $validatedData = $request->validate([
            'kelas'     => 'required|min:1',
            'jml_siswa' => 'required|min:1|numeric',
        ]);

        Kelas::where('id', $id)->update($validatedData);

        return redirect('/ruang')->with('success', 'Ruang Kelas berhasil diupdate');
    }

    public function destroy($id){
        Kelas::destroy($id);

        return redirect('/ruang')->with('deleted', 'Kelas berhasil dihapus');
    }

    public function search(Request $request){
        $keyword = $request->search;

        $kelas = Kelas::where('kelas', 'like', "%" . $keyword . "%")->orWhere('jml_siswa', 'like', "%" . $keyword . "%")->latest()->paginate(5);

        return view('content/kelas/index', [
            'ruang'     => $kelas,
            'title'     => 'Ruang Kelas',
            'tgl'       => date('l, d F Y'),
            // 'foto'      => auth()->user()->foto,
        ]);
    }
}
