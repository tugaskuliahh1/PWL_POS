{{-- resources/views/stok/index.blade.php --}}
@extends('layouts.app') {{-- Sesuaikan dengan layout yang kamu pakai --}}

@section('content')
<div class="container">
    <h1>Daftar Stok Barang</h1>

    {{-- Cek jika ada pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah stok --}}
    <a href="{{ route('stok.create') }}" class="btn btn-primary mb-3">+ Tambah Stok</a>

    {{-- Tabel stok --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stokList as $stok)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $stok->nama_barang }}</td>
                    <td>{{ $stok->kategori->nama }}</td>
                    <td>{{ $stok->jumlah }}</td>
                    <td>{{ $stok->supplier->nama }}</td>
                    <td>
                        <a href="{{ route('stok.edit', $stok->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('stok.destroy', $stok->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data stok belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
