@extends('layouts.app')
@section('title','Form Rumah Sakit')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Edit Rumah Sakit</h1>
        <form method="POST" action="{{ route('rumah-sakit.update', $rumahsakit['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_rumah_sakit" class="form-label">Nama Rumah Sakit</label>
                <input type="text" class="form-control" id="nama_rumah_sakit" name="nama_rumah_sakit" value="{{$rumahsakit['nama_rumah_sakit']}}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$rumahsakit['email']}}" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{$rumahsakit['telepon']}}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control">{{$rumahsakit['alamat']}}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection