<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampilkan daftar materi
    public function index()
    {
        $user = auth()->user();

        if ($user->role->name === 'pengajar') {
            // Kelompokkan materi berdasarkan kelas
            $materis = Materi::with('user')->get()->groupBy('kelas');

            return view('materi.index', [
                'materis' => $materis,
                'role' => 'pengajar'
            ]);
        } elseif ($user->role->name === 'siswa') {
            // Ambil materi sesuai kelas siswa
            $materis = Materi::where('kelas', $user->kelas)->get();

            return view('materi.index', [
                'materis' => $materis,
                'role' => 'siswa'
            ]);
        }

        return redirect('/home')->with('error', 'Akses ditolak.');
    }

    // Tampilkan form upload materi
    public function create()
    {
        if (auth()->user()->role->name !== 'pengajar') {
            return redirect('/home')->with('error', 'Akses ditolak.');
        }

        // Ambil daftar kelas unik dari tabel users
        $classes = \App\Models\User::whereNotNull('kelas')->distinct()->pluck('kelas');

        return view('materi.create', compact('classes'));
    }

    // Simpan materi yang diunggah
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'pengajar') {
            return redirect('/home')->with('error', 'Akses ditolak.');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf',
        ]);

        // Simpan file materi
        $path = $request->file('file')->store('materi');

        // Simpan data materi
        Materi::create([
            'pengajar_id' => auth()->id(),
            'judul' => $request->judul,
            'kelas' => $request->kelas, // Simpan input kelas dari form
            'file' => $path,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diunggah!');
    }

    // Download file materi
    public function download(Materi $materi)
    {
        if (auth()->user()->role->name !== 'siswa') {
            return redirect('/home')->with('error', 'Akses ditolak.');
        }

        return Storage::download($materi->file);
    }

    // Hapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        // Hanya pengajar yang mengunggah materi dapat menghapusnya
        if (auth()->user()->role->name !== 'pengajar' || $materi->pengajar_id !== auth()->id()) {
            return redirect()->route('materi.index')->with('error', 'Anda tidak memiliki akses untuk menghapus materi ini.');
        }

        // Hapus file materi dari storage
        if (Storage::exists($materi->file)) {
            Storage::delete($materi->file);
        }

        // Hapus data materi dari database
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
