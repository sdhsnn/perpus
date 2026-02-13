<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    private $no = 1;

    public function collection()
    {
        return Peminjaman::with(['siswa','buku'])->get();
    }

    // Judul kolom di Excel
    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }

    // Isi tiap baris
    public function map($peminjaman): array
    {
        return [
            $this->no++,
            $peminjaman->siswa->nama,
            $peminjaman->buku->judul,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali ?? '-',
            $peminjaman->status,
        ];
    }
}
