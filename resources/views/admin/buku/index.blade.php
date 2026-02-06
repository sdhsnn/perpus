@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Data Buku</h3>

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


        <form action="/buku" method="POST" class="row mb-4">
            @csrf
            <div class="col-md-6">
                <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
            </div>
            <div class="col-md-3">
                <input type="number" name="stok" class="form-control" placeholder="Stok">
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100">Simpan</button>
            </div>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            @foreach ($buku as $item)
                <tr>
                    <td>{{ $buku->firstItem() + $loop->index }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="/buku/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="/buku/{{ $item->id }}/hapus" class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus buku?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $buku->links() }}
        </div>
    </div>
@endsection
