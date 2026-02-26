<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PeminjamanExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    protected $status;
    protected $bulan;
    private $no = 1;

    public function __construct($status = null, $bulan = null)
    {
        $this->status = $status;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $query = Peminjaman::with(['siswa','buku']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->bulan) {
            $bulan = explode('-', $this->bulan);

            $query->whereYear('tanggal_pinjam', $bulan[0])
                  ->whereMonth('tanggal_pinjam', $bulan[1]);
        }

        return $query->get();
    }

    // Judul kolom
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

    // Isi baris
    public function map($peminjaman): array
    {
        return [
            $this->no++,
            $peminjaman->siswa->nama ?? '-',
            $peminjaman->buku->judul ?? '-',
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali ?? '-',
            $peminjaman->status,
        ];
    }

    // Judul Sheet
    public function title(): string
    {
        return 'Data Peminjaman';
    }

    // Styling (judul + border estetik)
    public function styles(Worksheet $sheet)
    {
        // Tambah Judul Besar
        $sheet->insertNewRowBefore(1, 2);
        $sheet->setCellValue('A1', 'LAPORAN DATA PEMINJAMAN');
        $sheet->mergeCells('A1:F1');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Bold Heading
        $sheet->getStyle('A3:F3')->getFont()->setBold(true);

        // Border Semua Data
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A3:F'.$highestRow)
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(
                  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
              );
    }
}