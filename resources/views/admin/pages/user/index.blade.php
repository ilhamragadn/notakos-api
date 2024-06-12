@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">Daftar Pengguna</h3>

    <table class="table table-striped">
        <thead>
            <tr class="table-info text-center">
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Email Ortu</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataUser as $user)
                <tr>
                    <th scope="row" class="text-center align-middle">{{ $user->id }}</th>
                    <td class="align-middle text-center">{{ $user->name }}</td>
                    <td class="align-middle text-center">{{ $user->email }}</td>
                    <td class="align-middle text-center">{{ $user->parent_email ?? 'Email orang tua kosong' }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                            <a href="{{ route('admin-user.show', $user->id) }}"
                                class="btn btn-sm btn-primary my-1">Detail</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger my-1">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger">
                    Data User belum tersedia.
                </div>
            @endforelse
        </tbody>
    </table>

    {{ $dataUser->links() }}
@endsection
