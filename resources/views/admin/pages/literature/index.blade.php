@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h3 class="mb-4">Daftar Literatur</h3>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end me-3">
                <a class="btn btn-success" href="{{ route('admin-literature.create') }}">Buat Literatur</a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr class="table-info text-center">
                <th scope="col">ID</th>
                <th scope="col">Judul</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Link</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataLiteratur as $literatur)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $literatur->id }}</th>
                    <td class="align-middle">{{ $literatur->judul }}</td>
                    <td class="align-middle">{{ $literatur->deskripsi }}</td>
                    <td class="text-center align-middle"><a href="{{ $literatur->link }}"
                            class="btn btn-outline-primary">Kunjungi</a>
                    </td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('admin-literature.destroy', $literatur->id) }}" method="POST">
                            <a href="{{ route('admin-literature.show', $literatur->id) }}"
                                class="btn btn-sm btn-warning my-1">Detail</a>
                            <a href="{{ route('admin-literature.edit', $literatur->id) }}"
                                class="btn btn-sm btn-success my-1">Perbarui</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger my-1">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger">
                    Data Literatur belum tersedia.
                </div>
            @endforelse
        </tbody>
    </table>

    {{ $dataLiteratur->links() }}
@endsection
