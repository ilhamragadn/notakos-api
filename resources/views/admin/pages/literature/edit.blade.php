@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">Perbarui Data Literatur</h3>

    <form action="{{ route('admin-literature.update', $dataLiteratur->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Literatur</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ old('judul', $dataLiteratur->judul) }}" required>

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
                        name="link" value="{{ old('link', $dataLiteratur->link) }}" required>

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
                maxlength="255">{{ old('deskripsi', $dataLiteratur->deskripsi) }}</textarea>

            @error('deskripsi')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('admin-literature.index') }}" class="btn btn-outline-secondary me-md-2">Batal</a>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </div>
    </form>
@endsection
