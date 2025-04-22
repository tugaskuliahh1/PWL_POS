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

    <!-- Detail Card -->
    <div class="card">
        <div class="card-header">
            Informasi Level
        </div>
        <div class="card-body">
            <p><strong>ID Level:</strong> {{ $level->level_id }}</p>
            <p><strong>Nama Level:</strong> {{ $level->level_nama }}</p>
        </div>
    </div>

    <a href="{{ url('/level') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
