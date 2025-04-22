@extends('layouts.template')

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('/kategori/create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <table id="table_kategori" class="table table-bordered table-striped">
            <thead>
                <tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(function () {
    $('#table_kategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("/kategori/list") }}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kategori_nama' },
            { data: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
