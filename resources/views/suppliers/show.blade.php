@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Supplier Details</h1>

    <div class="form-group">
        <strong>Nama Supplier:</strong> {{ $supplier->nama_supplier }}
    </div>

    <div class="form-group">
        <strong>Alamat:</strong> {{ $supplier->alamat_supplier }}
    </div>

    <div class="form-group">
        <strong>Telepon:</strong> {{ $supplier->telepon_supplier }}
    </div>

    <div class="form-group">
        <strong>Email:</strong> {{ $supplier->email_supplier }}
    </div>

    <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-warning">Edit Supplier</a>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to Supplier List</a>
</div>
@endsection
