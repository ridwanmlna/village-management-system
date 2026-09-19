@extends('layouts.app')

@section('title', 'SKTM | Cari NIK Anak')
@section('page-title', 'SKTM - Cari NIK Anak')
@section('location', 'Pembuatan Surat')
@section('location-title', 'SKTM - Cari Anak')

@section('content')
<div class="container-fluid">

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Cari Data Anak Berdasarkan NIK</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.surat.sktm.cari-anak') }}" method="POST">
                @csrf

                <label>NIK Anak:</label>
                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK Anak (16 digit)" required maxlength="16">

                <button class="btn btn-primary mt-3">Cari Anak</button>
            </form>
        </div>
    </div>

</div>
@endsection
