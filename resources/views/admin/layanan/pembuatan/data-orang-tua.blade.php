@extends('layouts.app')

@section('title', 'SKTM | Data Orang Tua')
@section('page-title', 'SKTM - Data Orang Tua & Anak')
@section('location', 'Pembuatan Surat')
@section('location-title', 'SKTM - Data Orang Tua & Anak')

@section('content')
<div class="container-fluid">

    {{-- Jika ada error --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- =======================
        TABEL DATA ORANG TUA
    ======================== --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Orang Tua Ditemukan</h5>
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
                            <td>{{ $ortu->name ?? '-' }}</td>
                            <td>{{ $ortu->nik ?? '-' }}</td>
                            <td>{{ ($ortu->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $ortu->tempat_tanggal_lahir ?? '-' }}</td>
                            <td>{{ $ortu->status_perkawinan ?? '-' }}</td>
                            <td>{{ $ortu->warga_negara ?? '-' }}</td>
                            <td>{{ $ortu->agama ?? '-' }}</td>
                            <td>{{ $ortu->pekerjaan ?? '-' }}</td>
                            <td>{{ $ortu->alamat ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- =======================
        TABEL DATA ANAK
    ======================== --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Data Anak</h5>
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
                            <td>{{ $anak->name ?? '-' }}</td>
                            <td>{{ $anak->nik ?? '-' }}</td>
                            <td>{{ ($anak->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $anak->tempat_tanggal_lahir ?? '-' }}</td>
                            <td>{{ $anak->status_perkawinan ?? '-' }}</td>
                            <td>{{ $anak->warga_negara ?? '-' }}</td>
                            <td>{{ $anak->agama ?? '-' }}</td>
                            <td>{{ $anak->pekerjaan ?? '-' }}</td>
                            <td>{{ $anak->alamat ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- =======================
        FORM CETAK SKTM
    ======================== --}}
    <div class="card shadow-sm">
        <div class="card-body text-center">

            <form action="{{ route('admin.surat.sktm.cetak') }}" method="POST">
                @csrf

                {{-- ini WAJIB! dikirim ke controller --}}
                <input type="hidden" name="anak" value="{{ $anak->nik }}">
                <input type="hidden" name="ortu" value="{{ $ortu->nik }}">

                <button type="submit" class="btn btn-primary btn-lg mt-3">
                    Cetak Surat SKTM
                </button>
            </form>

        </div>
    </div>

</div>
@endsection
