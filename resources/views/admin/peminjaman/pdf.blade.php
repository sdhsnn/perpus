<h3>Data Peminjaman Buku</h3>

<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    @foreach ($data as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->siswa->nama }}</td>
        <td>{{ $p->buku->judul }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>
