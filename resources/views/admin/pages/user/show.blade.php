@extends('admin.layouts.app')

@section('content')
    <div class="card mt-4" style="border-color: #0284C7;">
        <div class="card-header text-white d-flex align-items-center justify-content-between"
            style="background-color: #0284C7;">
            <h3>Detail Data Pengguna ID {{ $dataUser->id }}</h3>
            <a href="{{ route('admin-user.index') }}" class="btn btn-light">Batal</a>
        </div>
        <div class="card-body">
            <h4 class="card-title fs-3 text-center">{{ ucwords($dataUser->name) }}</h4>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card mb-4">
                        <div class="row">
                            <div
                                class="d-flex mx-auto justify-content-center align-items-center col-3 my-3 rounded-3 bg-primary">
                                <span class="d-inline-block text-white fs-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#ffffff" style="width: 36px; height: 36px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="card-wrap col">
                                <div class="card-body">
                                    <div>
                                        <p class="fw-semibold mb-1">Jumlah Seluruh Catatan Pengguna</p>
                                        <h3 class="card-title mb-2">{{ $jumlahCatatan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card mb-4">
                        <div class="row">
                            <div
                                class="d-flex mx-auto justify-content-center align-items-center col-3 my-3 rounded-3 bg-success">
                                <span class="d-inline-block text-white fs-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#ffffff" style="width: 36px; height: 36px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="card-wrap col">
                                <div class="card-body">
                                    <div>
                                        <p class="fw-semibold mb-1">Jumlah Catatan Pemasukan</p>
                                        <h3 class="card-title mb-2">{{ $jumlahCatatanPemasukan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card mb-4">
                        <div class="row">
                            <div
                                class="d-flex mx-auto justify-content-center align-items-center col-3 my-3 rounded-3 bg-danger">
                                <span class="d-inline-block text-white fs-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="#ffffff" style="width: 36px; height: 36px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="card-wrap col">
                                <div class="card-body">
                                    <div>
                                        <p class="fw-semibold mb-1">Jumlah Catatan Pengeluaran</p>
                                        <h3 class="card-title mb-2">{{ $jumlahCatatanPengeluaran }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title fw-semibold text-center">Daftar Alokasi Pengguna</h6>
                    <div class="list-group">
                        @foreach ($dataUser->alokasis as $dataAlokasi)
                            @if ($dataAlokasi->variabel_alokasi != 'Semua Alokasi')
                                <div class="list-group-item">
                                    <strong>{{ $dataAlokasi->variabel_alokasi }}:</strong>
                                    {{ $dataAlokasi->persentase_alokasi }}%
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
