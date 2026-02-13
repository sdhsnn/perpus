<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    /* ======================
       DASHBOARD
       ====================== */
    public function dashboard()
    {
        $totalBuku = Buku::count();
        $totalSiswa = Siswa::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalSiswa',
            'peminjamanAktif'
        ));
    }

    /* ======================
       CRUD BUKU
       ====================== */

    // Tampilkan data buku
    public function buku()
    {
        $buku = Buku::latest()->paginate(5);

        return view('admin.buku.index', compact('buku'));
    }

    // Simpan buku baru
    public function storeBuku(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create($request->all());

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
        
    }

    // edit buku
    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.buku.edit', compact('buku'));
    }

    // Proses update buku
    public function updateBuku(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect('/buku');
    }

    // Hapus buku
    public function deleteBuku($id)
    {
        Buku::findOrFail($id)->delete();

        return redirect()->back();
    }

    /* ======================
       PEMINJAMAN BUKU
       ====================== */

    // Tampilkan form & data peminjaman
    public function peminjaman(Request $request)
    {
        $siswa = Siswa::all();
        $buku  = Buku::all();

        $query = Peminjaman::with(['siswa', 'buku']);

        if ($request->status) {
            $query->where('status', $request->status);
            session()->flash(
                'info',
                'Menampilkan data peminjaman dengan status: ' . $request->status
            );
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        if ($data->isEmpty()) {
            session()->flash('warning', 'Data peminjaman tidak ditemukan');
        }

        return view('admin.peminjaman.index', compact('siswa', 'buku', 'data'));
    }

    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'buku_id' => 'required',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'siswa_id' => $request->siswa_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
    }

    // Proses pengembalian buku
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return redirect()->back()->with('warning', 'Buku sudah dikembalikan');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        $peminjaman->buku->increment('stok');
   
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }

    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }

    public function exportPdf()
    {
        $data = Peminjaman::with(['siswa','buku'])->get();

        $pdf = Pdf::loadView('admin.peminjaman.pdf', compact('data'));

        return $pdf->download('peminjaman.pdf');
    }


    /* ======================
       CRUD Siswa
       ====================== */

    // Tampilkan data siswa
    public function siswa()
    {
        $siswa = Siswa::latest()->paginate(5);

        return view('admin.siswa.index', compact('siswa'));
    }

    // Simpan siswa baru
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        Siswa::create($request->all());

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan');
    }

    // edit siswa
    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
    }

    // Proses update siswa
    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect('/siswa');
    }

    // Hapus siswa
    public function deleteSiswa($id)
    {
        Siswa::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function detailSiswa($id)
    {
        $siswa = Siswa::with('peminjaman.buku')->findOrFail($id);

        return view('admin.siswa.detail', compact('siswa'));
    }

}


