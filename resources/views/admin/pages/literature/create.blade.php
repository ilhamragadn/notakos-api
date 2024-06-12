@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">Tambah Data Literatur</h3>

    <form action="{{ route('admin-literature.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Literatur</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" required>

                    @error('judul')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="link" class="form-label">Link Literatur</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                        name="link" required>

                    @error('link')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Literatur</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                maxlength="255"></textarea>

            @error('deskripsi')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('admin-literature.index') }}" class="btn btn-outline-secondary me-md-2">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
@endsection
