@extends('layouts.app')
@section('title','Pasien')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Pasien</h1>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
        </div>

         <!-- Dropdown Filter -->
         <div class="mb-3">
            <select id="filterDropdown" class="form-select" onchange="filterItems()">
                <option value="">-- Pilih Rumah Sakit --</option>
                @foreach ($rumahsakit as $rs)
                    <option value="{{ strtolower($rs->nama_rumah_sakit) }}">{{ $rs->nama_rumah_sakit }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tabel Data -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Rumah Sakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="itemTable">
                <!-- Contoh data statis -->
                @foreach($pasiens as $ps)
                    <tr id="pasien-{{ $ps->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $ps->nama_pasien }}</td>
                        {{-- <td>{{ $ps->email }}</td> --}}
                        <td>{{ $ps->telepon }}</td>
                        <td>{{ $ps->alamat }}</td>
                        <td class="rs-name">{{ $ps->nama_rumah_sakit }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $ps->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="deletePs('{{$ps->id}}')">Hapus</button>
                        </td>
                    </tr>
                @endforeach
                @if(count($pasiens) == 0)
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

        function filterItems() {
            const filterValue = document.getElementById('filterDropdown').value.toLowerCase();
            const rows = document.querySelectorAll('#itemTable tr');

            rows.forEach(row => {
                const itemName = row.querySelector('.rs-name').textContent.toLowerCase();
                row.style.display = itemName === filterValue || filterValue === "" ? "" : "none";
            });
        }

        function deletePs(id){
            console.log(id);
            if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')){
                $.ajax({
                url: '/pasien/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                        if (response.success) {
                            $('#pasien-' + id).remove();
                            alert(response.message);
                        } else {
                            alert('Gagal menghapus pasien.');
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