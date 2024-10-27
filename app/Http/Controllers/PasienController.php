<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index()
    {
        $data = [];
        $data['rumahsakit'] = RumahSakit::all();
        $data['pasiens'] = Pasien::join('rumah_sakits', 'pasiens.rs_id', '=', 'rumah_sakits.id')->select('pasiens.*', 'rumah_sakits.nama_rumah_sakit')->get();
        return view('pasien.index', $data);
    }

    public function create()
    {
        $data = [];
        $data['rumahsakit'] = RumahSakit::all();
        return view('pasien.create', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['rumahsakit'] = RumahSakit::all();
        $data['pasien'] = Pasien::findOrFail($id);
        return view('pasien.edit', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'rs_id' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Pasien::create([
            "nama_pasien" => $request->nama_pasien,
            "rs_id" => $request->rs_id,
            "telepon" => $request->telepon,
            "alamat" => $request->alamat
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'rs_id' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pasien = Pasien::findOrFail($id);
        $pasien->update([
            "nama_pasien" => $request->nama_pasien,
            "rs_id" => $request->rs_id,
            "telepon" => $request->telepon,
            "alamat" => $request->alamat
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dihapus'
        ]);
    }
}
