@extends('layouts.app')

@section('title', 'Detail Warga Desa | Desa Margalaksana')
@section('page-title', 'Warga Desa')
@section('location', 'Admin')
@section('location-title', 'Warga Desa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Warga Desa</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form>

                        <!-- 1. Nama -->
                        <div class="form-group">
                            <label class="mb-3">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->name }}" readonly>
                        </div>

                        <!-- 2. NIK -->
                        <div class="form-group">
                            <label class="mb-3">NIK</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->nik }}" readonly>
                        </div>

                        <!-- 3. Jenis Kelamin -->
                        <div class="form-group">
                            <label class="mb-3">Jenis Kelamin</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" readonly>
                        </div>

                        <!-- 4. Tempat & Tanggal Lahir -->
                        <div class="form-group">
                            <label class="mb-3">Tempat & Tanggal Lahir</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->tempat_tanggal_lahir ?? '-' }}" readonly>
                        </div>

                        <!-- 5. Status Perkawinan -->
                        <div class="form-group">
                            <label class="mb-3">Status Perkawinan</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->status_perkawinan ?? '-' }}" readonly>
                        </div>

                        <!-- 6. Warga Negara -->
                        <div class="form-group">
                            <label class="mb-3">Warga Negara</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->warga_negara ?? '-' }}" readonly>
                        </div>

                        <!-- 7. Agama -->
                        <div class="form-group">
                            <label class="mb-3">Agama</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->agama }}" readonly>
                        </div>

                        <!-- 8. Pekerjaan -->
                        <div class="form-group">
                            <label class="mb-3">Pekerjaan</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $warga_desa->pekerjaan }}" readonly>
                        </div>

                        <!-- 9. Alamat -->
                        <div class="form-group">
                            <label class="mb-3">Alamat</label>
                            <textarea class="form-control rounded-lg" readonly>{{ $warga_desa->alamat }}</textarea>
                        </div>

                        <div class="d-flex w-100 justify-content-end mt-4">
                            <a href="{{ route('warga.desa.index') }}" class="btn btn-secondary rounded-pill">
                                Kembali
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
