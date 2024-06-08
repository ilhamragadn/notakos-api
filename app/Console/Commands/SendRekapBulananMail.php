<?php

namespace App\Console\Commands;

use App\Mail\RekapBulananMail;
use App\Models\Alokasi;
use App\Models\Catatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRekapBulananMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-rekap-bulanan-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim Notifikasi Email Tiap Bulan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Carbon::setLocale('id');
        $bulanSekarang = Carbon::now()->translatedFormat('F Y');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ambil data catatan untuk bulan ini
        $catatanDataList = Catatan::with(['catatanPemasukan', 'catatanPengeluaran', 'alokasis', 'users'])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        if ($catatanDataList->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data catatan untuk bulan ini.'], 404);
        }

        // Ambil semua data alokasi
        $alokasiDataList = Alokasi::with('users')
            ->get(['user_id', 'variabel_alokasi', 'persentase_alokasi']);

        if ($alokasiDataList->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data alokasi.'], 404);
        }

        $groupedAlokasiData = $alokasiDataList->groupBy('user_id');
        $groupedCatatanData = $catatanDataList->groupBy('user_id');

        foreach ($groupedAlokasiData as $userId => $alokasiData) {
            $user = User::find($userId);

            if ($user && $user->parent_email) {
                // Default nilai total pemasukan dan pengeluaran
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
                $variabelAlokasi = [];
                $persentaseAlokasi = [];
                $totalPengeluaranTiapAlokasi = [];

                // Jika ada data catatan untuk user ini
                if ($groupedCatatanData->has($userId)) {
                    $catatanData = $groupedCatatanData->get($userId);
                    // dd($catatanData);

                    if ($catatanData) {
                        $totalPemasukan = $catatanData->sum('total_uang_masuk');
                        $totalPengeluaran = $catatanData->sum('total_uang_keluar');

                        // Inisialisasi total pengeluaran dan jenis kebutuhan untuk setiap alokasi
                        foreach ($alokasiData as $alokasi) {
                            $alokasiVariabel = $alokasi->variabel_alokasi;
                            $alokasiPersentase = $alokasi->persentase_alokasi;
                            if ($alokasiVariabel != 'Semua Alokasi') {
                                $variabelAlokasi[] = $alokasiVariabel;
                                $persentaseAlokasi[] = $alokasiPersentase;
                                $totalPengeluaranTiapAlokasi[$alokasiVariabel] = 0;
                            }
                        }

                        // Hitung total pengeluaran untuk setiap alokasi
                        foreach ($catatanData as $catatan) {
                            foreach ($catatan->catatanPengeluaran as $pengeluaran) {
                                $index = $pengeluaran->jenis_kebutuhan;

                                if (!isset($totalPengeluaranTiapAlokasi[$index])) {
                                    $totalPengeluaranTiapAlokasi[$index] = 0;
                                }

                                $totalPengeluaranTiapAlokasi[$index] += $pengeluaran->nominal_uang_keluar;
                            }
                        }
                    }
                }

                $mailToParent = [
                    'title' => 'Pemberitahuan dari Admin NOTAKOS',
                    'body' => 'Kami sampaikan hasil rekap bulanan catatan keuangan putra/putri Anda untuk Bulan ' . $bulanSekarang . ':',
                    'bulanSekarang' => $bulanSekarang,
                    'totalPemasukan' => number_format($totalPemasukan, 0, ',', '.'),
                    'totalPengeluaran' => number_format($totalPengeluaran, 0, ',', '.'),
                    'variabelTiapAlokasi' => $variabelAlokasi,
                    'persentaseTiapAlokasi' => $persentaseAlokasi,
                    'totalPengeluaranTiapAlokasi' => $totalPengeluaranTiapAlokasi,
                ];

                Mail::to($user->parent_email)->send(new RekapBulananMail($mailToParent));

                return response()->json(['message' => 'Email telah dikirim']);
            } else {
                return response()->json(['message' => "Tidak ada email orang tua untuk user ID: " . $userId]);
            }
        }
    }
}
