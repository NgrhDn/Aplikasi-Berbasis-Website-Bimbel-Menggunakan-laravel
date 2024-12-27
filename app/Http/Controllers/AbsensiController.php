<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi; // Pastikan Anda memiliki model Absensi
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Tambahkan impor untuk facade DB
use Dompdf\Dompdf;
use Dompdf\Options;


class AbsensiController extends Controller
{
    // Fungsi untuk menampilkan halaman absensi
    public function index(Request $request)
    {
        $kelas = [10, 11, 12];
        $selectedKelas = $request->input('kelas');
        $siswa = collect();

        if ($selectedKelas) {
            $siswa = User::where('role_id', 3)
                         ->where('kelas', $selectedKelas)
                         ->orderBy('name', 'asc')
                         ->get();
        }

        return view('absensi.index', compact('kelas', 'siswa', 'selectedKelas'));
    }

    // Fungsi untuk menyimpan absensi
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|in:10,11,12',
            'tanggal' => 'required|date',
            'absensi' => 'required|array',
        ]);

        $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');

        foreach ($request->absensi as $siswaId => $status) {
            if (!in_array($status, ['hadir', 'sakit', 'tanpa_keterangan'])) {
                continue;
            }

            Absensi::updateOrCreate(
                [
                    'user_id' => $siswaId,
                    'tanggal' => $tanggal,
                    'kelas' => $request->kelas,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }

    public function rekap(Request $request)
    {
        $kelas = [10, 11, 12];
        $dataAbsensi = [];
        $selectedKelas = $request->input('kelas');
        $selectedTanggal = $request->input('tanggal');

        if ($selectedKelas && $selectedTanggal) {
            $tanggal = Carbon::parse($selectedTanggal)->format('Y-m-d');
            $dataAbsensi = Absensi::where('kelas', $selectedKelas)
                                ->where('tanggal', $tanggal)
                                ->with('user')
                                ->orderBy('user_id', 'asc')
                                ->get();
        }

        return view('absensi.rekap', compact('kelas', 'dataAbsensi', 'selectedKelas', 'selectedTanggal'));
    }

    public function rekapSiswa(Request $request)
    {
        $userId = auth()->id(); // Mendapatkan ID user yang sedang login
        $bulan = $request->input('bulan', now()->format('Y-m')); // Ambil bulan dari input atau gunakan bulan saat ini
    
        // Ambil data absensi berdasarkan bulan
        $rekapAbsensi = DB::table('absensis')
            ->where('user_id', $userId)
            ->whereYear('tanggal', '=', substr($bulan, 0, 4)) // Filter berdasarkan tahun
            ->whereMonth('tanggal', '=', substr($bulan, 5, 2)) // Filter berdasarkan bulan
            ->select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as total_hadir'),
                DB::raw('SUM(CASE WHEN status = "sakit" THEN 1 ELSE 0 END) as total_sakit'),
                DB::raw('SUM(CASE WHEN status = "tanpa_keterangan" THEN 1 ELSE 0 END) as total_tanpa_keterangan')
            )
            ->groupBy(DB::raw('MONTH(tanggal)')) // Grouping data per bulan
            ->first(); // Ambil hanya satu hasil karena hanya satu bulan yang dipilih
    
        // Jika data tidak ada, inisialisasi nilai default
        $rekapAbsensi = $rekapAbsensi ?? (object) [
            'bulan' => substr($bulan, 5, 2),
            'total_hadir' => 0,
            'total_sakit' => 0,
            'total_tanpa_keterangan' => 0,
        ];
    
        return view('absensi.rekap-siswa', compact('rekapAbsensi', 'bulan'));
    }

        // Fungsi untuk mengekspor rekap absensi ke PDF
        public function exportPDF(Request $request)
        {
            // Mengambil data berdasarkan filter
            $kelas = $request->kelas;
            $tanggal = $request->tanggal;
    
            // Ambil data absensi berdasarkan kelas dan tanggal
            $dataAbsensi = Absensi::where('kelas', $kelas)
                ->where('tanggal', $tanggal)
                ->with('user')
                ->orderBy('user_id', 'asc')
                ->get();
    
            // Memasukkan data ke dalam view yang akan diubah menjadi PDF
            $html = view('absensi.rekap_pdf', compact('dataAbsensi', 'kelas', 'tanggal'))->render();
    
            // Mengatur opsi DomPDF
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
    
            // Membuat instance Dompdf
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait'); // Atur ukuran kertas PDF
            $dompdf->render(); // Render PDF
    
            // Menampilkan PDF atau mengunduhnya
            return $dompdf->stream('rekap-absensi.pdf'); // Menampilkan PDF di browser
            // return $dompdf->download('rekap-absensi.pdf'); // Untuk mendownload PDF
        }
    
    
    
}
