@extends('layouts.app')
@section('title','Rumah Sakit')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Rumah Sakit</h1>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="{{ route('rumah-sakit.create') }}" class="btn btn-primary">Tambah Rumah Sakit</a>
        </div>

        <!-- Tabel Data -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rumah Sakit</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data statis -->
                @foreach($rumah_sakit as $rs)
                    <tr id="rumahsakit-{{ $rs->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $rs->nama_rumah_sakit }}</td>
                        <td>{{ $rs->email }}</td>
                        <td>{{ $rs->telepon }}</td>
                        <td>{{ $rs->alamat }}</td>
                        <td>
                            <a href="{{ route('rumah-sakit.edit', $rs->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="deleteRs('{{$rs->id}}')">Hapus</button>
                        </td>
                    </tr>
                @endforeach
                @if(count($rumah_sakit) == 0)
                    <tr>
                        <td colspan="5" style="text-align: center">Data Belum Tersedia</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function deleteRs(id){
            console.log(id);
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')){
                $.ajax({
                url: '/rumah-sakit/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                        if (response.success) {
                            $('#rumahsakit-' + id).remove();
                            alert(response.message);
                        } else {
                            alert('Gagal menghapus rumah sakit.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }
    </script>
@endsection