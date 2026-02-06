@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Data Siswa</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="/siswa" method="POST" class="row mb-4">
            @csrf
            <div class="col-md-6">
                <input type="text" name="nama" class="form-control" placeholder="Nama Siswa">
            </div>
            <div class="col-md-3">
                <input type="text" name="kelas" class="form-control" placeholder="Kelas">
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100">Simpan</button>
            </div>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $siswa->firstItem() + $loop->index }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>
                        <a href="/siswa/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="/siswa/{{ $item->id }}/hapus" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus siswa?')">
                            Hapus
                        </a>
                        <a href="/siswa/{{ $item->id }}" class="btn btn-info btn-sm">
                            Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $siswa->links() }}
        </div>
    </div>
@endsection
