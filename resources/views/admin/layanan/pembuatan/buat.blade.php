@extends('layouts.app')

@section('title', 'Pembuatan Surat | Desa Margalaksana')
@section('page-title', 'Pembuatan Surat')
@section('location', 'Layanan')
@section('location-title', 'Pembuatan Surat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">

            {{-- Data Warga --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Data Warga Ditemukan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
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
                                <td>{{ $warga->name }}</td>
                                <td>{{ $warga->nik }}</td>
                                <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $warga->tempat_tanggal_lahir ?? '-' }}</td>
                                <td>{{ $warga->status_kawin ?? '-' }}</td>
                                <td>{{ $warga->warga_negara ?? '-' }}</td>
                                <td>{{ $warga->agama ?? '-' }}</td>
                                <td>{{ $warga->pekerjaan ?? '-' }}</td>
                                <td>{{ $warga->alamat ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Form Pilih Jenis Surat --}}
            <div class="card">
                <div class="card-header">
                    <h5>Pilih Jenis Surat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pembuatan-surat.proses') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nik" value="{{ $warga->nik }}">

                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select name="jenis" id="jenis_surat" class="form-select" required>
                                <option value="" selected disabled>Pilih Jenis Surat</option>
                                <option value="surat-keterangan-domisili">Surat Keterangan Domisili</option>
                                <option value="surat-pengantar-skck">Surat Pengantar SKCK</option>
                                <option value="surat-keterangan-tidak-sekolah">Surat Keterangan Tidak Mampu (SKTM) Sekolah</option>
                                <option value="surat-keterangan-tidak-mampu-umum">Surat Keterangan Tidak Mampu (SKTM) Umum</option>
                                <option value="surat-keterangan-usaha">Surat Keterangan Usaha</option>
                                <option value="surat-keterangan-belum-menikah">Surat Keterangan Belum Menikah</option>
                                <option value="surat-keterangan-kelahiran">Surat Keterangan Kelahiran</option>
                                <option value="surat-keterangan-kematian">Surat Keterangan Kematian</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- Form tambahan untuk Surat Keterangan Usaha --}}
                        <div id="usaha_form" style="display:none;">
                            <div class="mb-3">
                                <label for="nama_usaha" class="form-label">Nama Usaha</label>
                                <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Masukkan nama usaha">
                            </div>
                            <div class="mb-3">
                                <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                                <textarea name="alamat_usaha" id="alamat_usaha" class="form-control" placeholder="Masukkan alamat usaha"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script untuk menampilkan form usaha --}}
<script>
    document.getElementById('jenis_surat').addEventListener('change', function() {
        if(this.value === 'surat-keterangan-usaha') {
            document.getElementById('usaha_form').style.display = 'block';
        } else {
            document.getElementById('usaha_form').style.display = 'none';
        }
    });
</script>

@endsection
