@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">Detail Data Literatur</h3>

    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Literatur</label>
                <input type="text" class="form-control" id="judul" name="judul"
                    value="{{ old('judul', $dataLiteratur->judul) }}" readonly>

            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="link" class="form-label">Link Literatur</label>
                <input type="text" class="form-control" id="link" name="link"
                    value="{{ old('link', $dataLiteratur->link) }}" readonly>

            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi Literatur</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" maxlength="255" readonly>{{ old('deskripsi', $dataLiteratur->deskripsi) }}</textarea>

    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('admin-literature.index') }}" class="btn btn-outline-secondary me-md-2">Batal</a>
        <a class="btn btn-success" href="{{ route('admin-literature.edit', $dataLiteratur->id) }}">Edit</a>
    </div>
@endsection
