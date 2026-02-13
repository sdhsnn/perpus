@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold text-primary">Edit Buku</h3>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Form Edit Buku
        </div>

        <div class="card-body">
            <form action="/buku/{{ $buku->id }}/update" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}">
                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Update
                </button>

                <a href="/buku" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
