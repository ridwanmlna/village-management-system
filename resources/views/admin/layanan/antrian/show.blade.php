@extends('layouts.app')

@section('title', 'Detail Antrian | Desa Margalaksana')

@section('page-title', 'Antrian')

@section('location', 'Admin')

@section('location-title', 'Antrian')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Antrian</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>No. Antrian</label>
                        <input type="text" class="form-control" value="{{ $antrian->no_antrian }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ $antrian->user->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" value="{{ $antrian->user->nik }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control"
                               value="{{ $antrian->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                               readonly>
                    </div>

                    <div class="form-group">
    <label>Tempat, Tanggal Lahir</label>
    <input type="text" class="form-control"
           value="{{ $antrian->user->tempat_tanggal_lahir ?? '-' }}"
           readonly>
</div>

                    <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control" value="{{ $antrian->user->agama }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" value="{{ $antrian->user->pekerjaan }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" readonly>{{ $antrian->user->alamat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Jenis Pelayanan</label>
                        <input type="text" class="form-control"
                               value="{{ $antrian->jenisPelayanan->nama_pelayanan }}" readonly>
                    </div>
                    
                    <div class="form-group">
    <label>Tanggal Pengajuan</label>
    <input type="text" class="form-control"
           value="{{ $antrian->created_at->format('d-m-Y H:i') }}"
           readonly>
</div>

                    <div class="form-group">
                        <label>Status Antrian</label>
                        <div>
                            {!! $antrian->status !!}
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('admin.antrian.index') }}"
                           class="btn btn-secondary rounded-pill mr-2">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection