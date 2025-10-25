@extends('user.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Dashboard Pengaduan</h1>

        <div class="card shadow-sm p-3">
            <h5>Halo, {{ Auth::user()->nama_lengkap }} 👋</h5>
            <p>Selamat datang di dashboard pengguna</p>
            <hr>
        </div>
    </div>
@endsection