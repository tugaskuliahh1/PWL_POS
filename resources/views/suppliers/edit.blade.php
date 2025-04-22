@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier:</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
        </div>

        <div class="form-group">
            <label for="alamat_supplier">Alamat Supplier:</label>
            <textarea class="form-control" id="alamat_supplier" name="alamat_supplier">{{ old('alamat_supplier', $supplier->alamat_supplier) }}</textarea>
        </div>

        <div class="form-group">
            <label for="telepon_supplier">Telepon Supplier:</label>
            <input type="text" class="form-control" id="telepon_supplier" name="telepon_supplier" value="{{ old('telepon_supplier', $supplier->telepon_supplier) }}">
        </div>

        <div class="form-group">
            <label for="email_supplier">Email Supplier:</label>
            <input type="email" class="form-control" id="email_supplier" name="email_supplier" value="{{ old('email_supplier', $supplier->email_supplier) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Supplier</button>
    </form>

    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Back to Supplier List</a>
</div>
@endsection
