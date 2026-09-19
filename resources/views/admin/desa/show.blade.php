@extends('layouts.app')

@section('title', 'Detail Admin Desa | Desa Margalaksana')
@section('page-title', 'Admin Desa')
@section('location', 'Admin')
@section('location-title', 'Admin Desa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Admin Desa</h3>
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
                                value="{{ $admin_desa->name }}" readonly>
                        </div>

                        <!-- 2. NIK -->
                        <div class="form-group">
                            <label class="mb-3">NIK</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->nik }}" readonly>
                        </div>

                        <!-- 3. Jenis Kelamin -->
                        <div class="form-group">
                            <label class="mb-3">Jenis Kelamin</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" readonly>
                        </div>

                        <!-- 4. Tempat & Tanggal Lahir -->
                        <div class="form-group">
                            <label class="mb-3">Tempat & Tanggal Lahir</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->tempat_tanggal_lahir ?? '-' }}" readonly>
                        </div>

                        <!-- 5. Tanggal Lahir -->
                        <div class="form-group">
                            <label class="mb-3">Tanggal Lahir</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->tanggal_lahir ?? '-' }}" readonly>
                        </div>

                        <!-- 6. Status Perkawinan -->
                        <div class="form-group">
                            <label class="mb-3">Status Perkawinan</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->status_perkawinan ?? '-' }}" readonly>
                        </div>

                        <!-- 7. Warga Negara -->
                        <div class="form-group">
                            <label class="mb-3">Warga Negara</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->warga_negara ?? '-' }}" readonly>
                        </div>

                        <!-- 8. Agama -->
                        <div class="form-group">
                            <label class="mb-3">Agama</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->agama ?? '-' }}" readonly>
                        </div>

                        <!-- 9. Pekerjaan -->
                        <div class="form-group">
                            <label class="mb-3">Pekerjaan</label>
                            <input type="text" class="form-control rounded-lg"
                                value="{{ $admin_desa->pekerjaan ?? '-' }}" readonly>
                        </div>

                        <!-- 10. Alamat -->
                        <div class="form-group">
                            <label class="mb-3">Alamat</label>
                            <textarea class="form-control rounded-lg" readonly>{{ $admin_desa->alamat ?? '-' }}</textarea>
                        </div>

                        <div class="d-flex w-100 justify-content-end mt-4">
                            <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary rounded-pill">
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
