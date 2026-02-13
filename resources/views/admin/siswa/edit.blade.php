@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold text-primary">Edit Siswa</h3>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Form Edit Siswa
        </div>

        <div class="card-body">
            <form action="/siswa/{{ $siswa->id }}/update" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}">
                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Update
                </button>

                <a href="/siswa" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
