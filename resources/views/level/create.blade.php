@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('/level') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="level_nama">Nama Level</label>
                <input type="text" name="level_nama" id="level_nama" class="form-control" required value="{{ old('level_nama') }}">
                @error('level_nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ url('/level') }}" class="btn btn-secondary btn-sm ml-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
