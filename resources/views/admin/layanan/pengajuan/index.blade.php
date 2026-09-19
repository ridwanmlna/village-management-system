@extends('layouts.app')

@section('title', 'Pengajuan Surat | Desa Margalaksana')

@section('page-title', 'Pengajuan Surat')

@section('location', 'Layanan')

@section('location-title', 'Pengajuan Surat')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifikasi berhasil dihapus --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Notifikasi gagal dihapus --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">List Pengajuan Surat</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Jenis Pelayanan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengajuan as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->nik }}</td>
                                            <td>{{ $item->jenisPelayanan->nama_pelayanan }}</td>
                                            <td>{!! $item->status !!}</td>
                                            <td>
    <a href="{{ route('admin.pengajuan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Status</button>
    <div class="dropdown-menu">
            <form action="{{ route('admin.pengajuan.update', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="status_pengajuan" value="2">
                <button class="dropdown-item" onclick="return confirm('Pastikan seluruh data dan persyaratan pengajuan telah lengkap serta sesuai. Apakah Anda yakin ingin mengubah status pengajuan menjadi Diterima?')">Diterima</button>
            </form>
            
            <form action="{{ route('admin.pengajuan.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="status_pengajuan" value="3">
        <button class="dropdown-item"
            onclick="return confirm('Pastikan pengajuan telah diverifikasi dan siap untuk diproses. Apakah Anda yakin ingin mengubah status pengajuan menjadi Diproses?')">
            Diproses
        </button>
    </form>
            
            <form action="{{ route('admin.pengajuan.update', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="status_pengajuan" value="4">
                <button class="dropdown-item" onclick="return confirm('Pastikan seluruh proses pengajuan telah selesai. Apakah Anda yakin ingin mengubah status menjadi Selesai?')">Selesai</button>
            </form>
            
            <button
    type="button"
    class="dropdown-item btn-tolak"
    data-id="{{ $item->id }}">
    Ditolak
</button>


</div>

    {{-- Tombol Hapus --}}
    <form action="{{ route('admin.pengajuan.destroy', $item->id) }}" method="POST" style="display:inline-block; margin-top:5px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini? Tindakan ini tidak dapat dibatalkan. Pastikan data yang dipilih sudah benar.')">
            Hapus
        </button>
    </form>
</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
</table>

<!-- Form Penolakan -->
<div id="formPenolakan" class="card card-danger mt-3" style="display:none;">
    <div class="card-header">
        <h3 class="card-title">Alasan Penolakan Pengajuan</h3>
    </div>

    <form id="tolakForm" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="status_pengajuan" value="5">

        <div class="card-body">

            <div class="form-group">
                <label>Alasan Penolakan</label>

                <textarea
                    name="alasan_penolakan"
                    class="form-control"
                    rows="5"
                    placeholder="Contoh: Berkas KK belum dilampirkan."
                    required></textarea>

            </div>

        </div>

        <div class="card-footer text-right">

            <button
                type="button"
                id="batalTolak"
                class="btn btn-secondary">
                Batal
            </button>

            <button
                type="submit"
                class="btn btn-danger">
                Simpan
            </button>

        </div>

    </form>
</div>

{{ $pengajuan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    @push('scripts')
<script>
$(document).ready(function () {

    $('.btn-tolak').click(function () {

        // Ambil ID pengajuan
        let id = $(this).data('id');

        // Tampilkan form
        $('#formPenolakan').slideDown();

        // Scroll ke form
        $('html, body').animate({
            scrollTop: $('#formPenolakan').offset().top - 80
        }, 500);

        // Ganti action form sesuai ID
        $('#tolakForm').attr(
            'action',
            "{{ url('admin/pengajuan') }}/" + id
        );

    });

    // Tombol batal
    $('#batalTolak').click(function () {

        $('#formPenolakan').slideUp();

        $('#tolakForm')[0].reset();

    });

});
</script>
@endpush
@endsection
