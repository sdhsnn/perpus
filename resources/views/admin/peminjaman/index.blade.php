@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Peminjaman Buku</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif


        <form action="/peminjaman" method="POST" class="row mb-4">
            @csrf
            <div class="col-md-4">
                <select name="siswa_id" class="form-control">
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select name="buku_id" class="form-control">
                    <option value="">Pilih Buku</option>
                    @foreach ($buku as $b)
                        <option value="{{ $b->id }}">
                            {{ $b->judul }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary w-100">Pinjam</button>
            </div>
        </form>

        <form method="GET" action="/peminjaman" class="row mb-3">
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>

        <div class="mb-3">
        <a href="/peminjaman/export-excel" class="btn btn-success">Export Excel</a>
        <a href="/peminjaman/export-pdf" class="btn btn-danger">Export PDF</a>
        </div>


        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach ($data as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->siswa->nama }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>
                @if ($p->tanggal_kembali)
                    {{ $p->tanggal_kembali }}
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>{{ $p->status }}</td>
            <td>
                @if ($p->status == 'dipinjam')
                    <a href="/peminjaman/{{ $p->id }}/kembali"
                    class="btn btn-success btn-sm"
                    onclick="return confirm('Kembalikan buku ini?')">
                    Kembalikan
                    </a>
                @else
                    <span class="text-muted">Selesai</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    </div>
@endsection
