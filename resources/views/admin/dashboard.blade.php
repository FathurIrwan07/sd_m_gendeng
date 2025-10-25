@extends('admin.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Selamat datang, {{ Auth::user()->nama_lengkap }}!</h5>
            <p>Anda login sebagai: <strong>{{ Auth::user()->role->nama_role }}</strong></p>
            <hr>
        </div>
    </div>
@endsection