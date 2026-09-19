@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat | Desa Margalaksana')

@section('page-title', 'Pengajuan Surat')

@section('location', 'Admin')

@section('location-title', 'Pengajuan Surat')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pengajuan Surat</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.desa.update', $pengajuan->id) }}">

                            <div class="form-group">
                                <label for="nik" class="mb-3">NIK</label>
                                <input type="text" class="form-control rounded-lg" id="nik" name="nik" value="{{ $pengajuan->user->nik }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name" class="mb-3">Nama</label>
                                <input type="text" class="form-control rounded-lg" id="name" name="name" value="{{ $pengajuan->user->name }}" readonly>
                            </div>
                            
                            <div class="form-group">
    <label for="jenis_kelamin" class="mb-3">Jenis Kelamin</label>
    <input type="text" class="form-control rounded-lg"
           value="{{ $pengajuan->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
           readonly>
</div>

<div class="form-group">
    <label for="ttl" class="mb-3">Tempat, Tanggal Lahir</label>
    <input type="text" class="form-control rounded-lg"
           value="{{ $pengajuan->user->tempat_tanggal_lahir ?? '-' }}"
           readonly>
</div>

<div class="form-group">
    <label for="agama" class="mb-3">Agama</label>
    <input type="text" class="form-control rounded-lg"
           value="{{ $pengajuan->user->agama }}"
           readonly>
</div>

<div class="form-group">
    <label for="pekerjaan" class="mb-3">Pekerjaan</label>
    <input type="text" class="form-control rounded-lg"
           value="{{ $pengajuan->user->pekerjaan }}"
           readonly>
</div>

<div class="form-group">
    <label for="alamat" class="mb-3">Alamat</label>
    <textarea class="form-control rounded-lg" rows="3" readonly>{{ $pengajuan->user->alamat }}</textarea>
</div>

                            <div class="form-group">
    <label>Tanggal Pengajuan</label>
    <input type="text" class="form-control"
           value="{{ $pengajuan->created_at->format('d-m-Y H:i') }}"
           readonly>
</div>

                            <div class="form-group">
                                <label for="layanan" class="mb-3">Jenis Layanan</label>
                                <input type="text" class="form-control form-control-lg rounded-pill text-md" id="layanan" name="layanan" value="{{ $pengajuan->jenisPelayanan->nama_pelayanan }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="jenis_berkas" class="mb-3">Persyaratan Dokumen</label>
                                <input type="text"
    class="form-control form-control-lg rounded-pill text-md"
    value="{{ $pengajuan->jenis_berkas }}"
    readonly>
                            </div>

                            <div class="form-group">
                                <label for="file_berkas" class="mb-3">Berkas yang Diunggah</label>
                                @php
    $files = json_decode($pengajuan->file_berkas, true);
@endphp

<div class="w-100 px-4 py-3"
    style="background:#e9ecef;border:1px solid #ced4da;border-radius:15px;">

    @foreach($files as $file)

        @php
            $ext = pathinfo($file, PATHINFO_EXTENSION);
        @endphp

        @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
            <div class="mb-3">
                <img src="{{ asset('storage/'.$file) }}"
                    class="img-fluid rounded"
                    style="max-height:200px;">
            </div>
        @else
            <div class="mb-2">
                <a href="{{ asset('storage/'.$file) }}"
                    target="_blank"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i>
                    Lihat PDF
                </a>
            </div>
        @endif

    @endforeach

</div>
                            </div>

                            <div class="form-group">
                        <label>Status Pengajuan</label>
                        <div>
                            {!! $pengajuan->status !!}
                        </div>
                    </div>
                    
                    @if($pengajuan->status_pengajuan == \App\Models\SuratPengantar::STATUS_DITOLAK && !empty($pengajuan->alasan_penolakan))
<div class="form-group mt-3">
    <label>Alasan Penolakan</label>

    <textarea class="form-control" rows="4" readonly>{{ $pengajuan->alasan_penolakan }}</textarea>
</div>
@endif

                            <div class="d-flex w-100 justify-content-end mt-4">
                                <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary rounded-pill mr-2">Kembali</a>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
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

@push('scripts')
    <script>
        $("#pop").on("click", function() {
            $('#imagepreview').attr('src', $('#imageresource').attr('src'));
            $('#imagemodal').modal('show');
        });
    </script>
@endpush
