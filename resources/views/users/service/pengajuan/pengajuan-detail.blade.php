@extends('layouts.service')

@section('title', 'Detail Surat Pengantar')

@section('judul', 'Detail Pengajuan Surat Pengantar')

@section('content')

    <div class="p-5">

        <h3 class="font-weight-bold">Data yang Anda Ajukan sudah Masuk ke dalam Sistem Kami</h3>
        <p class="mb-4">Periksa Notifikasi anda secara berkala untuk meninjau status berkas yang anda ajukan</p>

        <div class="form-group">
            <label for="nik" class="mb-3">NIK</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nik" name="nik" value="{{ $pengajuan->user->nik }}" placeholder="Masukkan NIK anda" readonly>
        </div>

        <div class="form-group">
            <label for="nama" class="mb-3">Nama Lengkap</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nama" name="nama" value="{{ $pengajuan->user->name }}" placeholder="Masukkan nama lengkap anda" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal" class="mb-3">Tanggal Pengajuan</label>
            <input type="date" class="form-control form-control-lg rounded-pill text-md" id="tanggal" name="tanggal" value="{{ $pengajuan->created_at->format('Y-m-d') }}" readonly>
        </div>

        <div class="form-group">
            <label for="layanan" class="mb-3">Jenis Layanan</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="layanan" name="layanan" value="{{ $pengajuan->jenisPelayanan->nama_pelayanan }}" readonly>
        </div>

        <div class="form-group">
    <label for="jenis_berkas" class="mb-3">Persyaratan Dokumen</label>
    <textarea class="form-control" rows="4" readonly>{{ $pengajuan->jenis_berkas }}</textarea>
</div>

        <div class="form-group">
    <label class="mb-3">Berkas yang Diunggah</label>

    <div class="row">

        @foreach(json_decode($pengajuan->file_berkas, true) as $index => $file)

            @php
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            @endphp

            <div class="col-md-3 mb-3">

                @if(in_array($ext,['jpg','jpeg','png']))

                    <a href="{{ asset('storage/'.$file) }}" target="_blank">

                        <img
                            src="{{ asset('storage/'.$file) }}"
                            class="img-fluid border rounded"
                            style="height:180px;width:100%;object-fit:cover;">

                    </a>

                @elseif($ext=='pdf')

                    <div class="border rounded p-3 text-center">

                        <i class="fas fa-file-pdf fa-3x text-danger"></i>

                        <br><br>

                        <a href="{{ asset('storage/'.$file) }}"
                           target="_blank"
                           class="btn btn-danger btn-sm">

                            Lihat PDF

                        </a>

                    </div>

                @endif

            </div>

        @endforeach

    </div>

</div>

        <div class="form-group">
            <label for="status" class="mb-3">Status Pengajuan</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="status" name="status"
                value="@if ($pengajuan->status_pengajuan == 1) Menunggu Verifikasi @elseif($pengajuan->status_pengajuan == 2) Verifikasi Berhasil @elseif($pengajuan->status_pengajuan == 3) Verifikasi Gagal @else Selesai @endif" readonly>
        </div>

        <div class="d-flex w-100 justify-content-end mt-5">
            <a href="{{ route('dashboard.user') }}" class="btn btn-outline-secondary px-5 py-2 rounded-pill mr-3">Dashboard</a>
            <a href="{{ route('notifikasi') }}" class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill">Notifikasi</a>
        </div>

    </div>

    <div class="modal" tabindex="-1" id="imagemodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="imagepreview" class="mx-auto" style="max-width: 800px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .btn-green-pastel {
            background-color: #51839C !important;
            border-color: #51839C !important;
        }

        .btn-green-pastel:hover {
            background-color: #3B6E85 !important;
            border-color: #3B6E85 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $("#pop").on("click", function() {
            $('#imagepreview').attr('src', $('#imageresource').attr('src'));
            $('#imagemodal').modal('show');
        });
    </script>
@endpush
