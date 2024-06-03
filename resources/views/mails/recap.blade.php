<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rekap Keuangan Bulanan NOTAKOS</title>
    </head>

    <body>
        <h3>{{ $mailToParent['title'] }}</h3>
        <p>Dengan hormat, <br>
            {{ $mailToParent['body'] }}
        </p>
        <p style="font-weight: bold">Berikut adalah laporan catatan keuangan selama Bulan
            {{ $mailToParent['bulanSekarang'] }}.</p>
        <p>Total pemasukan Rp {{ $mailToParent['totalPemasukan'] }}.
            <br>
            Total pengeluaran Rp {{ $mailToParent['totalPengeluaran'] }}.
        </p>
        <p style="font-weight: bold">Untuk detail alokasi keuangan yang telah dibuat beserta total pengeluaran
            berdasarkan alokasi adalah sebagai berikut:</p>
        {{-- <p>jenis kebutuhan {{ $mailToParent['jenisKebutuhan'] }}</p> --}}
        <ul>
            @foreach ($mailToParent['variabelTiapAlokasi'] as $index => $variabel)
                @if ($variabel !== 'Semua Alokasi')
                    <li>{{ $variabel }}: {{ $mailToParent['persentaseTiapAlokasi'][$index] }}%
                        <br>
                        Rp {{ $mailToParent['totalPengeluaranTiapAlokasi'][$index] }}.
                        <br>
                        Jenis kebutuhan: {{ $mailToParent['jenisKebutuhan'][$index] }}
                    </li>
                @endif
            @endforeach
        </ul>
        <p>Terima kasih atas perhatian Anda. Semoga informasi ini bermanfaat.</p>
        <p>Salam hormat,</p>
        <h4>Admin NOTAKOS</h4>
    </body>

</html>
