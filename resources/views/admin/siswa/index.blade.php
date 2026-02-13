@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold text-primary">Data Siswa</h3>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM TAMBAH --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            Tambah Siswa
        </div>

        <div class="card-body">
            <form action="/siswa" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Siswa">
                </div>

                <div class="col-md-3">
                    <input type="text" name="kelas" class="form-control" placeholder="Kelas">
                </div>

                <div class="col-md-3">
                    <button class="btn btn-success w-100">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">
            Daftar Siswa
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <tr class="table-light text-center">
                    <th width="60">No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th width="200">Aksi</th>
                </tr>

                @foreach ($siswa as $item)
                <tr>
                    <td class="text-center">{{ $siswa->firstItem() + $loop->index }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td class="text-center">

                        <a href="/siswa/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="/siswa/{{ $item->id }}/hapus"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus siswa?')">
                            <i class="bi bi-trash"></i>
                        </a>

                        <a href="/siswa/{{ $item->id }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $siswa->links() }}
    </div>

</div>
@endsection
