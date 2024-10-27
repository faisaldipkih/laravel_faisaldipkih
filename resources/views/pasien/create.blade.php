@extends('layouts.app')
@section('title','Form Pasien')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Tambah Pasien</h1>
        <form method="POST" action="{{ route('pasien.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
            </div>
            <div class="mb-3">
                <label for="rs_id" class="form-label">Rumah Sakit</label>
                <select name="rs_id" id="rs_id" class="form-control">
                    <option value="">Pilih Rumah Sakit</option>
                    @foreach($rumahsakit as $rs)
                        <option value="{{$rs->id}}">{{$rs->nama_rumah_sakit}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection