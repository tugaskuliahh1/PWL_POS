@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        @if(empty($kategori))
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        @else
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $kategori->kategori_id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $kategori->kategori_nama }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('/kategori') }}" class="btn btn-sm btn-default mt-3">Kembali</a>
    </div>
</div>
@endsection
