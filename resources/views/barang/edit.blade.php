@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ url('barang/' . $barang->barang_id) }}">
            @csrf
            @method('PUT')
            <div class="form-group"><label>Kode</label>
                <input type="text" name="barang_kode" class="form-control" value="{{ $barang->barang_kode }}" required>
            </div>
            <div class="form-group"><label>Nama</label>
                <input type="text" name="barang_nama" class="form-control" value="{{ $barang->barang_nama }}" required>
            </div>
            <div class="form-group"><label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach($kategori as $item)
                    <option value="{{ $item->kategori_id }}" {{ $barang->kategori_id == $item->kategori_id ? 'selected' : '' }}>
                        {{ $item->kategori_nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    @foreach($supplier as $item)
                    <option value="{{ $item->supplier_id }}" {{ $barang->supplier_id == $item->supplier_id ? 'selected' : '' }}>
                        {{ $item->supplier_nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
            </div>
            <div class="form-group"><label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
            </div>
            <div class="form-group"><label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
