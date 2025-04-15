@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body"> @empty($kategori)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $kategori->kategori_id }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Nama</th>
                        <td>{{ $kategori->kategori_nama }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Kode</th>
                        <td>{{ $kategori->kategori_kode }}</td>
                    </tr>

                </table>
            @endempty
            <a href="{{ url('kategori') }}" class="btn btn-danger btn-sm">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
