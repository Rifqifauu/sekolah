<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\People;
use App\Models\Peminjaman;
use Inertia\Inertia;

class PerpustakaanController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $data_buku = DataBuku::paginate(10); // 10 buku per halaman

        return Inertia::render('Perpustakaan/Index', [
            'data_buku' => $data_buku,
        ]);
    }

    // Mencari buku berdasarkan judul atau pengarang
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('perpustakaan.index');
        }

        $data_buku = DataBuku::where('judul_buku', 'like', "%{$query}%")
            ->orWhere('pengarang', 'like', "%{$query}%")
            ->paginate(10);

        return Inertia::render('Perpustakaan/SearchResult', [
            'data_buku' => $data_buku,
            'query' => $query,
        ]);
    }

    // Proses peminjaman buku
    public function pinjam(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:data_buku,id',
            'nomor_nfc' => 'required|exists:people,nomor_nfc',
        ]);

        $buku = DataBuku::findOrFail($request->id_buku);
        $anggota = People::where('nomor_nfc', $request->nomor_nfc)->firstOrFail();

        // Cek stok buku
        if ($buku->jumlah <= $buku->dipinjam) {
            return back()->withErrors(['buku' => 'Stok buku habis.']);
        }

        // Cek apakah anggota sudah meminjam buku ini dan belum mengembalikan
        $existing = Peminjaman::where('id_buku', $buku->id)
            ->where('id_anggota', $anggota->id)
            ->whereNull('tanggal_kembali')
            ->first();

        if ($existing) {
            return back()->withErrors(['buku' => 'Anggota ini masih meminjam buku yang sama.']);
        }

        // Simpan peminjaman
        Peminjaman::create([
            'id_buku' => $buku->id,
            'id_anggota' => $anggota->id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
        ]);

        // Update status buku
        $buku->dipinjam += 1;
        $buku->status = ($buku->jumlah <= $buku->dipinjam) ? 'kosong' : 'tersedia';
        $buku->save();

        return back()->with('success', '📚 Buku berhasil dipinjam.');
    }

    // Proses pengembalian buku
    public function kembali(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:data_buku,id',
            'nomor_nfc' => 'required|exists:people,nomor_nfc',
        ]);

        $buku = DataBuku::findOrFail($request->id_buku);
        $anggota = People::where('nomor_nfc', $request->nomor_nfc)->firstOrFail();

        $peminjaman = Peminjaman::where('id_buku', $buku->id)
            ->where('id_anggota', $anggota->id)
            ->whereNull('tanggal_kembali')
            ->first();

        if (!$peminjaman) {
            return back()->withErrors(['peminjaman' => 'Data peminjaman tidak ditemukan atau sudah dikembalikan.']);
        }

        // Update data peminjaman
        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan',
        ]);

        // Update status buku
        $buku->dipinjam = max(0, $buku->dipinjam - 1);
        $buku->status = ($buku->dipinjam < $buku->jumlah) ? 'tersedia' : 'kosong';
        $buku->save();

        return back()->with('success', '📚 Buku berhasil dikembalikan.');
    }
}
