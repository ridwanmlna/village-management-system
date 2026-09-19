@extends('layouts.app')

@section('title', 'Edit Admin Desa | Desa Margalaksana')
@section('page-title', 'Admin Desa')
@section('location', 'Admin')
@section('location-title', 'Admin Desa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-primary w-100">
                <div class="card-header">
                    <h3 class="card-title">Edit Admin Desa</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.desa.update', $admin_desa->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="user_type" value="{{ old('user_type', $admin_desa->user_type) }}">

                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="name" class="mb-3">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-lg @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $admin_desa->name) }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- NIK -->
                        <div class="form-group">
                            <label for="nik" class="mb-3">NIK</label>
                            <input type="text" class="form-control rounded-lg @error('nik') is-invalid @enderror"
                                id="nik" name="nik" value="{{ old('nik', $admin_desa->nik) }}"
                                data-inputmask='"mask": "9999999999999999"' data-mask>
                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control select2 rounded-lg @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" disabled {{ empty(old('jenis_kelamin', $admin_desa->jenis_kelamin)) ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin', $admin_desa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $admin_desa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Tempat & Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tempat_tanggal_lahir" class="mb-3">Tempat & Tanggal Lahir</label>
                            <input type="text" class="form-control rounded-lg @error('tempat_tanggal_lahir') is-invalid @enderror"
                                id="tempat_tanggal_lahir" name="tempat_tanggal_lahir"
                                value="{{ old('tempat_tanggal_lahir', $admin_desa->tempat_tanggal_lahir) }}"
                                placeholder="Contoh: Bandung, 12 Maret 2002">
                            @error('tempat_tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Tanggal Lahir (untuk password) -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir (untuk password login)</label>
                            <input type="date" class="form-control rounded-lg @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $admin_desa->tanggal_lahir) }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Status Perkawinan -->
                        <div class="form-group">
                            <label for="status_perkawinan" class="mb-3">Status Perkawinan</label>
                            <select class="form-control rounded-lg @error('status_perkawinan') is-invalid @enderror"
                                id="status_perkawinan" name="status_perkawinan">
                                <option value="" disabled {{ empty(old('status_perkawinan', $admin_desa->status_perkawinan)) ? 'selected' : '' }}>-- Pilih Status Perkawinan --</option>
                                @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                                    <option value="{{ $status }}" {{ old('status_perkawinan', $admin_desa->status_perkawinan) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_perkawinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Warga Negara -->
                        <div class="form-group">
                            <label for="warga_negara" class="mb-3">Warga Negara</label>
                            <input type="text" class="form-control rounded-lg @error('warga_negara') is-invalid @enderror"
                                id="warga_negara" name="warga_negara"
                                value="{{ old('warga_negara', $admin_desa->warga_negara) }}"
                                placeholder="Contoh: Indonesia">
                            @error('warga_negara') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Agama -->
                        <div class="form-group">
                            <label for="agama" class="mb-3">Agama</label>
                            <select class="form-control rounded-lg @error('agama') is-invalid @enderror" name="agama" id="agama">
                                <option value="" disabled {{ empty(old('agama', $admin_desa->agama)) ? 'selected' : '' }}>-- Pilih Agama --</option>
                                @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $admin_desa->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                            @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div class="form-group">
                            <label for="pekerjaan" class="mb-3">Pekerjaan</label>
                            <input type="text" class="form-control rounded-lg @error('pekerjaan') is-invalid @enderror"
                                name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $admin_desa->pekerjaan) }}">
                            @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat" class="mb-3">Alamat</label>
                            <textarea class="form-control rounded-lg @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat">{{ old('alamat', $admin_desa->alamat) }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex w-100 justify-content-end mt-5">
                            <button type="submit" class="btn btn-primary btn-green-pastel px-5 py-2">Edit</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
