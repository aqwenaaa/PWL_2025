@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Manage Kategori</div>
        <div class="card-body">
            <!-- Tombol Add Kategori -->
            <a href="{{ url('/kategori/create') }}" class="btn btn-primary mb-3">
                Add Kategori
            </a>

            <!-- Tabel DataTables -->
            <table class="table table-bordered" id="kategori-table">
                <thead>
                    <tr>
                        <th>Kategori Id</th>
                        <th>Kategori Kode</th>
                        <th>Kategori Nama</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{$dataTable->scripts()}}

<script>
$(document).ready(function() {
    $('#kategori-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('kategori.index') }}", // Pastikan route ini benar
        columns: [
            { data: 'id', name: 'id' },
            { data: 'kategori_kode', name: 'kategori_kode' },
            { data: 'kategori_nama', name: 'kategori_nama' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            } // Pastikan kolom Action ada di sini
        ]
    });
});
</script>
@endpush
