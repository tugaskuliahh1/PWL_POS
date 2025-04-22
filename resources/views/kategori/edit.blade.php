@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        @if(empty($kategori))
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        @else
            <form method="POST" action="{{ url('/kategori/' . $kategori->kategori_id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kategori_nama">Nama Kategori</label>
                    <input type="text" name="kategori_nama" id="kategori_nama" class="form-control"
                           value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
                    @error('kategori_nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                <a href="{{ url('/kategori') }}" class="btn btn-sm btn-secondary ml-1">Kembali</a>
            </form>
        @endif
    </div>
</div>
@endsection
