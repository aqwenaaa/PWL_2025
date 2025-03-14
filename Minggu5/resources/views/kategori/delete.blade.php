@extends('adminlte::page')

@section('title', 'Hapus Kategori')

@section('content_header')
    <h1>Konfirmasi Hapus Kategori</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p>Apakah kamu yakin ingin menghapus kategori <b>{{ $kategori->kategori_nama }}</b>?</p>
            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
