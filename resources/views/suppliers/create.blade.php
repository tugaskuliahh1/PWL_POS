@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Supplier</h1>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier:</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier') }}" required>
        </div>

        <div class="form-group">
            <label for="alamat_supplier">Alamat Supplier:</label>
            <textarea class="form-control" id="alamat_supplier" name="alamat_supplier">{{ old('alamat_supplier') }}</textarea>
        </div>

        <div class="form-group">
            <label for="telepon_supplier">Telepon Supplier:</label>
            <input type="text" class="form-control" id="telepon_supplier" name="telepon_supplier" value="{{ old('telepon_supplier') }}">
        </div>

        <div class="form-group">
            <label for="email_supplier">Email Supplier:</label>
            <input type="email" class="form-control" id="email_supplier" name="email_supplier" value="{{ old('email_supplier') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Supplier</button>
    </form>

    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Back to Supplier List</a>
</div>
@endsection
