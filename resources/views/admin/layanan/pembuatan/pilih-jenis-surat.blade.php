@extends('layouts.app')

@section('title', 'Pembuatan Surat | Desa Margalaksana')
@section('page-title', 'Pembuatan Surat')
@section('location', 'Layanan')
@section('location-title', 'Pembuatan Surat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Data Warga Ditemukan -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Warga Ditemukan</h5>
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
                                    <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
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

            <!-- Pilih Jenis Surat -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Pilih Jenis Surat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pembuatan-surat.tampil') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nik" value="{{ $warga->nik }}">

                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select name="jenis_surat" id="jenis_surat" class="form-select" required>
                                <option value="" selected disabled>Pilih Jenis Surat</option>
                                <option value="surat-keterangan-domisili">Surat Keterangan Domisili</option>
                                <option value="surat-pengantar-skck">Surat Pengantar SKCK</option>
                                <option value="surat-keterangan-tidak-mampu-sekolah">Surat Keterangan Tidak Mampu (SKTM) Sekolah</option>
                                <option value="surat-keterangan-tidak-mampu-umum">Surat Keterangan Tidak Mampu (SKTM) Umum</option>
                                <option value="surat-keterangan-usaha">Surat Keterangan Usaha</option>
                                <option value="surat-keterangan-belum-menikah">Surat Keterangan Belum Menikah</option>
                                <option value="surat-keterangan-kelahiran">Surat Keterangan Kelahiran</option>
                                <option value="surat-keterangan-kematian">Surat Keterangan Kematian</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Input Nama & Alamat Usaha (hanya muncul saat SKU) -->
                        <div id="usaha_fields" style="display: none;">
                            <div class="mb-3">
                                <label for="nama_usaha" class="form-label">Nama Usaha</label>
                                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" placeholder="Masukkan Nama Usaha">
                            </div>
                            <div class="mb-3">
                                <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                                <textarea class="form-control" id="alamat_usaha" name="alamat_usaha" placeholder="Masukkan Alamat Usaha"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script untuk menampilkan input usaha saat SKU dipilih -->
<script>
document.getElementById('jenis_surat').addEventListener('change', function() {
    const usahaFields = document.getElementById('usaha_fields');
    if(this.value === 'surat-keterangan-usaha') {
        usahaFields.style.display = 'block';
        document.getElementById('nama_usaha').required = true;
        document.getElementById('alamat_usaha').required = true;
    } else {
        usahaFields.style.display = 'none';
        document.getElementById('nama_usaha').required = false;
        document.getElementById('alamat_usaha').required = false;
    }
});
</script>

@endsection
