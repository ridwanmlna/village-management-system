@extends('layouts.app')

@section('title', 'SKTM | Data Anak')
@section('page-title', 'SKTM - Data Anak')
@section('location', 'Pembuatan Surat')
@section('location-title', 'SKTM - Data Anak')

@section('content')
<div class="container-fluid">

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Data Anak Ditemukan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>Status Kawin</th>
                            <th>Warga Negara</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $warga->name ?? '-' }}</td>
                            <td>{{ $warga->nik ?? '-' }}</td>
                            <td>{{ ($warga->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $warga->tempat_tanggal_lahir ?? '-' }}</td>
                            <td>{{ $warga->status_perkawinan ?? '-' }}</td>
                            <td>{{ $warga->warga_negara ?? '-' }}</td>
                            <td>{{ $warga->agama ?? '-' }}</td>
                            <td>{{ $warga->pekerjaan ?? '-' }}</td>
                            <td>{{ $warga->alamat ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.surat.sktm.cari-nik-orang-tua.form', $warga->nik) }}" class="btn btn-warning">
        Cari NIK Orang Tua
    </a>

</div>
@endsection
