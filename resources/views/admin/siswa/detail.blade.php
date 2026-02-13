@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold text-primary">Detail Siswa</h3>

    {{-- Data Siswa --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            Informasi Siswa
        </div>

        <div class="card-body">
            <p class="mb-2"><strong>Nama :</strong> {{ $siswa->nama }}</p>
            <p class="mb-0"><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
        </div>
    </div>

    {{-- Riwayat Peminjaman --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Riwayat Peminjaman Buku
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <tr class="table-light text-center">
                    <th width="60">No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th width="150">Status</th>
                </tr>

                @forelse ($siswa->peminjaman as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td class="text-center">
                        <span class="badge {{ $p->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle me-1"></i>
                        Belum pernah meminjam buku
                    </td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="/siswa" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

</div>
@endsection
