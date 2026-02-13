@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-primary fw-bold">Dashboard Admin</h3>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-stat text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Buku</h6>
                    <h2 class="text-primary fw-bold">{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Siswa</h6>
                    <h2 class="text-primary fw-bold">{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Peminjaman Aktif</h6>
                    <h2 class="text-primary fw-bold">{{ $peminjamanAktif }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="list-group shadow-sm">
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
