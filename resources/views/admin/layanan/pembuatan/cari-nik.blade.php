@extends('layouts.app')

@section('title', 'Pembuatan Surat | Desa Margalaksana')
@section('page-title', 'Cari Data Warga')
@section('location', 'Pembuatan Surat')
@section('location-title', 'Cari NIK')

@section('content')
<div class="container-fluid">

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Cari Data Warga Berdasarkan NIK</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pembuatan-surat.cari-nik') }}" method="POST">
                @csrf

                <label>NIK:</label>
                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK 16 digit" required>

                <button class="btn btn-primary mt-3">Cari Warga</button>
            </form>
        </div>
    </div>

</div>
@endsection
