@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ url('barang') }}">
            @csrf
            <div class="form-group"><label>Kode</label>
                <input type="text" name="barang_kode" class="form-control" required>
            </div>
            <div class="form-group"><label>Nama</label>
                <input type="text" name="barang_nama" class="form-control" required>
            </div>
            <div class="form-group"><label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">- Pilih Kategori -</option>
                    @foreach($kategori as $item)
                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">- Pilih Supplier -</option>
                    @foreach($supplier as $item)
                    <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" required>
            </div>
            <div class="form-group"><label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>
            <div class="form-group"><label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
