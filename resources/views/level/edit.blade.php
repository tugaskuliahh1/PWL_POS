@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumb->list as $item)
                <li class="breadcrumb-item">{{ $item }}</li>
            @endforeach
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
        </ol>
    </nav>

    <!-- Error Validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit -->
    <form action="{{ url('/level/' . $level->level_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="level_nama" class="form-label">Nama Level</label>
            <input type="text" name="level_nama" id="level_nama" class="form-control" value="{{ old('level_nama', $level->level_nama) }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url('/level') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
