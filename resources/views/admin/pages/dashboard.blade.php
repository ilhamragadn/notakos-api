@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">Dashboard</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title text-center">Buat Literatur</h5>
                    <p class="card-text text-center">Silahkan buat literatur untuk pengguna aplikasi NOTAKOS.</p>
                    <a class="btn btn-success" href="{{ route('admin-literature.create') }}">Buat</a>
                </div>
            </div>

        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
@endsection
