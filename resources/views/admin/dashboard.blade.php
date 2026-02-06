@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Dashboard Admin</h3>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Buku</h6>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Siswa</h6>
                    <h2>{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Peminjaman Aktif</h6>
                    <h2>{{ $peminjamanAktif }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="list-group">
        <a href="/buku" class="list-group-item list-group-item-action">
            Kelola Buku
        </a>
        <a href="/siswa" class="list-group-item list-group-item-action">
            Kelola Siswa
        </a>
        <a href="/peminjaman" class="list-group-item list-group-item-action">
            Peminjaman Buku
        </a>
    </div>
</div>
@endsection
        