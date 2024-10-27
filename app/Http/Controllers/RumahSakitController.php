<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakit;
use Illuminate\Support\Facades\Validator;

class RumahSakitController extends Controller
{
    public function index()
    {
        $data = [];
        $data['rumah_sakit'] = RumahSakit::all();
        return view('rumahsakit.index', $data);
    }

    public function create()
    {
        return view('rumahsakit.create');
    }

    public function edit($id)
    {
        $data = [];
        $data['rumahsakit'] = RumahSakit::findOrFail($id);
        return view('rumahsakit.edit', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        RumahSakit::create([
            "nama_rumah_sakit" => $request->nama_rumah_sakit,
            "email" => $request->email,
            "telepon" => $request->telepon,
            "alamat" => $request->alamat
        ]);

        return redirect()->route('rumah-sakit.index')->with('success', 'Rumah sakit berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $rumahsakit = RumahSakit::findOrFail($id);
        $rumahsakit->update([
            "nama_rumah_sakit" => $request->nama_rumah_sakit,
            "email" => $request->email,
            "telepon" => $request->telepon,
            "alamat" => $request->alamat
        ]);

        return redirect()->route('rumah-sakit.index')->with('success', 'Rumah sakit berhasil diupdate');
    }

    public function destroy($id)
    {
        $rumahsakit = RumahSakit::findOrFail($id);
        $rumahsakit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rumah sakit berhasil dihapus'
        ]);
    }
}
