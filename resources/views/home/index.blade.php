@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Katalog Buku Perpustakaan</h3>

    {{-- Card Pencarian --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="/search" method="GET">
                <div class="row g-2">
                    <div class="col-md-9">
                        <input 
                            type="text" 
                            name="keyword" 
                            class="form-control" 
                            placeholder="Cari judul buku"
                            value="{{ request('keyword') }}"
                        >
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Card Tabel Buku --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Judul Buku</th>
                            <th width="100">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buku as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->judul }}</td>
                                <td>{{ $item->stok }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Data buku tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
