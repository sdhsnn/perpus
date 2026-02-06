@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Siswa</h3>

    {{-- Data Siswa --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nama :</strong> {{ $siswa->nama }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
        </div>
    </div>

    {{-- Riwayat Peminjaman --}}
    <h5>Riwayat Peminjaman Buku</h5>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
        </tr>

        @forelse ($siswa->peminjaman as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>
                <span class="badge 
                    {{ $p->status == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">
                    {{ $p->status }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                Belum pernah meminjam buku
            </td>
        </tr>
        @endforelse
    </table>

    <a href="/siswa" class="btn btn-secondary">Kembali</a>
</div>
@endsection
