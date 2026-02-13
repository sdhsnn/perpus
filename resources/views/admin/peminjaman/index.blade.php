@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold text-primary">Peminjaman Buku</h3>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning shadow-sm">{{ session('warning') }}</div>
    @endif

    @if (session('info'))
        <div class="alert alert-info shadow-sm">{{ session('info') }}</div>
    @endif


    {{-- Form Pinjam --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Form Peminjaman
        </div>

        <div class="card-body">
            <form action="/peminjaman" method="POST" class="row g-3">
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
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Filter --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form method="GET" action="/peminjaman" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Filter Status</label>
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
                    <button class="btn btn-secondary w-100">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Export --}}
    <div class="mb-3">
        <a href="/peminjaman/export-excel" class="btn btn-success me-2">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>

        <a href="/peminjaman/export-pdf" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
        </a>
    </div>


    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Data Peminjaman
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <tr class="table-light text-center">
                    <th width="60">No</th>
                    <th>Nama Siswa</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>

                @foreach ($data as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
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

                    <td class="text-center">
                        @if ($p->status == 'dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if ($p->status == 'dipinjam')
                            <a href="/peminjaman/{{ $p->id }}/kembali"
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Kembalikan buku ini?')">
                                <i class="bi bi-check-circle"></i>
                            </a>
                        @else
                            <span class="text-muted">Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>

</div>
@endsection
