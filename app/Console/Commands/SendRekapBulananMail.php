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
        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');
        $bulanSekarang = Carbon::now()->translatedFormat('F Y');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ambil data catatan untuk bulan ini
        $catatanDataList = Catatan::with(['catatanPemasukan', 'catatanPengeluaran', 'alokasis', 'users'])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get(['user_id', 'total_uang_masuk', 'total_uang_keluar', 'created_at']);

        // Ambil semua data alokasi
        $alokasiDataList = Alokasi::with('users')
            ->get(['user_id', 'variabel_alokasi', 'persentase_alokasi']);

        if ($alokasiDataList->isNotEmpty()) {
            $groupedAlokasiData = $alokasiDataList->groupBy('user_id');
            $groupedCatatanData = $catatanDataList->groupBy('user_id');

            foreach ($groupedAlokasiData as $userId => $alokasiData) {
                $user = User::find($userId);

                if ($user && $user->parent_email) {
                    // Default nilai total pemasukan dan pengeluaran
                    $totalPemasukan = 0;
                    $totalPengeluaran = 0;
                    $totalPengeluaranTiapAlokasi = [];
                    $jenisKebutuhan = [];

                    // Jika ada data catatan untuk user ini
                    if ($groupedCatatanData->has($userId)) {
                        $catatanData = $groupedCatatanData->get($userId);

                        if ($catatanData) {
                            $totalPemasukan = $catatanData->sum('total_uang_masuk');
                            $totalPengeluaran = $catatanData->sum('total_uang_keluar');

                            // Inisialisasi total pengeluaran dan jenis kebutuhan untuk setiap alokasi
                            foreach ($alokasiData as $alokasi) {
                                $alokasiVariabel = strtolower($alokasi->variabel_alokasi);
                                if ($alokasiVariabel != 'semua alokasi') {
                                    $totalPengeluaranTiapAlokasi[$alokasiVariabel] = 0;
                                    $jenisKebutuhan[$alokasiVariabel] = [];
                                }
                            }

                            // Hitung total pengeluaran untuk setiap alokasi
                            foreach ($catatanData as $catatan) {
                                foreach ($catatan->catatanPengeluaran as $pengeluaran) {
                                    $jenisKebutuhanPengeluaran = strtolower($pengeluaran->jenis_kebutuhan);
                                    if (isset($totalPengeluaranTiapAlokasi[$jenisKebutuhanPengeluaran])) {
                                        $totalPengeluaranTiapAlokasi[$jenisKebutuhanPengeluaran] += $pengeluaran->nominal_uang_keluar;
                                        $jenisKebutuhan[$jenisKebutuhanPengeluaran][] = $pengeluaran->nama_barang;
                                    }
                                }
                            }
                        }
                    }

                    // Filter data dan siapkan untuk pengiriman email
                    $filteredVariabel = [];
                    $filteredPersentase = [];
                    $filteredPengeluaranTiapAlokasi = [];
                    $filteredJenisKebutuhan = [];

                    foreach ($alokasiData as $alokasi) {
                        $alokasiVariabel = strtolower($alokasi->variabel_alokasi);
                        if ($alokasiVariabel != 'semua alokasi') {
                            $filteredVariabel[] = ucwords($alokasiVariabel);
                            $filteredPersentase[] = $alokasi->persentase_alokasi;
                            $filteredPengeluaranTiapAlokasi[] = isset($totalPengeluaranTiapAlokasi[$alokasiVariabel]) ? number_format($totalPengeluaranTiapAlokasi[$alokasiVariabel], 0, ',', '.') : 'Rp 0';
                            $filteredJenisKebutuhan[] = !empty($jenisKebutuhan[$alokasiVariabel]) ? implode(', ', array_unique($jenisKebutuhan[$alokasiVariabel])) : 'Tidak ada';
                        }
                    }

                    $mailToParent = [
                        'title' => 'Pemberitahuan dari Admin NOTAKOS',
                        'body' => 'Kami sampaikan hasil rekap bulanan catatan keuangan putra/putri Anda untuk Bulan ' . $bulanSekarang . ':',
                        'bulanSekarang' => $bulanSekarang,
                        'totalPemasukan' => number_format($totalPemasukan, 0, ',', '.'),
                        'totalPengeluaran' => number_format($totalPengeluaran, 0, ',', '.'),
                        'variabelTiapAlokasi' => $filteredVariabel,
                        'persentaseTiapAlokasi' => $filteredPersentase,
                        'jenisKebutuhan' => $filteredJenisKebutuhan,
                        'totalPengeluaranTiapAlokasi' => $filteredPengeluaranTiapAlokasi,
                    ];

                    Mail::to($user->parent_email)->send(new RekapBulananMail($mailToParent));
                } else {
                    $this->info("Tidak ada email orang tua untuk user ID: " . $userId);
                }
            }

            $this->info('Email rekapan bulanan berhasil dikirim');
        } else {
            $this->info('Tidak ada data alokasi yang ditemukan');
        }
    }
}
