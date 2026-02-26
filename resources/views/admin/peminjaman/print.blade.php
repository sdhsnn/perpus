<!DOCTYPE html>
<html>
<head>
    <title>Cetak Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <h3>{{ $judul }}</h3>

    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()">Cetak</button>
        <button onclick="window.history.back()">Kembali</button>
    </div>

    <table>
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

</body>
</html>