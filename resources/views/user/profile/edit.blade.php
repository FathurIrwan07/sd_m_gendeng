@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>

        <div class="card shadow">
            <div class="card-body">

                @if(session('status') === 'profile-updated')
                    <div class="alert alert-success">
                        Profil berhasil diperbarui.
                    </div>
                @endif

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            required>
                    </div>

                    <button class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>

            </div>
        </div>

    </div>
@endsection