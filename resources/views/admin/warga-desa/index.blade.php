@extends('layouts.app')

@section('title', 'Warga Desa | Desa Margalaksana')
@section('page-title', 'Warga Desa')
@section('location', 'Admin')
@section('location-title', 'Warga Desa')

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

            <div class="card card-primary collapsed-card w-100">
                <div class="card-header">
                    <h3 class="card-title">Tambah Warga Desa</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('warga.desa.store') }}">
    @csrf

    <input type="hidden" name="user_type" value="2">

    <!-- 1. NAMA LENGKAP -->
    <div class="form-group">
        <label for="name" class="mb-3">Nama Lengkap</label>
        <input type="text" class="form-control rounded-lg @error('name') is-invalid @enderror"
            id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- 2. NIK -->
    <div class="form-group">
        <label for="nik" class="mb-3">NIK</label>
        <input type="text" class="form-control rounded-lg @error('nik') is-invalid @enderror"
            id="nik" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK"
            data-inputmask='"mask": "9999999999999999"' data-mask>
        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- 3. JENIS KELAMIN -->
    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select class="form-control select2 rounded-lg @error('jenis_kelamin') is-invalid @enderror"
            id="jenis_kelamin" name="jenis_kelamin">
            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <!-- 4. TEMPAT & TANGGAL LAHIR -->
    <div class="form-group">
        <label for="tempat_tanggal_lahir" class="mb-3">Tempat & Tanggal Lahir</label>
        <input type="text" class="form-control rounded-lg @error('tempat_tanggal_lahir') is-invalid @enderror"
            id="tempat_tanggal_lahir" name="tempat_tanggal_lahir"
            value="{{ old('tempat_tanggal_lahir') }}"
            placeholder="Contoh: Bandung, 12 Maret 2002">
        @error('tempat_tanggal_lahir')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- 4b. TANGGAL LAHIR (UNTUK PASSWORD) -->
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir (untuk password login)</label>
        <input type="date" class="form-control rounded-lg @error('tanggal_lahir') is-invalid @enderror"
            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- 5. STATUS PERKAWINAN -->
    <div class="form-group">
        <label for="status_perkawinan" class="mb-3">Status Perkawinan</label>
        <select class="form-control rounded-lg @error('status_perkawinan') is-invalid @enderror"
            id="status_perkawinan" name="status_perkawinan">
            <option selected disabled>-- Pilih Status Perkawinan --</option>
            <option value="Belum Kawin">Belum Kawin</option>
            <option value="Kawin">Kawin</option>
            <option value="Cerai">Cerai Hidup</option>
            <option value="Cerai">Cerai Mati</option>
        </select>
        @error('status_perkawinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- 6. WARGA NEGARA -->
    <div class="form-group">
        <label for="warga_negara" class="mb-3">Warga Negara</label>
        <input type="text" class="form-control rounded-lg @error('warga_negara') is-invalid @enderror"
            id="warga_negara" name="warga_negara" value="{{ old('warga_negara') }}"
            placeholder="Contoh: Indonesia">
        @error('warga_negara') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- 7. AGAMA -->
    <div class="form-group">
        <label for="agama" class="mb-3">Agama</label>
        <select class="form-control rounded-lg @error('agama') is-invalid @enderror" name="agama" id="agama">
            <option selected disabled>-- Pilih Agama --</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
        </select>
    </div>

    <!-- 8. PEKERJAAN -->
    <div class="form-group">
        <label for="pekerjaan" class="mb-3">Pekerjaan</label>
        <input type="text" class="form-control rounded-lg @error('pekerjaan') is-invalid @enderror"
            name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
            placeholder="Masukkan Pekerjaan">
    </div>

    <!-- 9. ALAMAT -->
    <div class="form-group">
        <label for="alamat" class="mb-3">Alamat</label>
        <textarea class="form-control rounded-lg @error('alamat') is-invalid @enderror"
            id="alamat" name="alamat" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
    </div>

    <div class="d-flex w-100 justify-content-end mt-5">
        <button type="submit" class="btn btn-primary btn-green-pastel px-5 py-2">Tambah</button>
    </div>

</form>

                </div>
            </div>

            <!-- LIST WARGA DESA -->
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
    <h3 class="card-title">List Warga Desa</h3>

    <form method="GET" action="{{ route('warga.desa.index') }}" class="d-flex">
        <input type="text" 
            name="search" 
            class="form-control me-2" 
            placeholder="Cari Nama / NIK..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

                <div class="card-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warga_desa as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>
                                        <a href="{{ route('warga.desa.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('warga.desa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('warga.desa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $warga_desa->links() }}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
