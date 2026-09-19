@extends('layouts.app')

@section('title', 'Pembuatan Surat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pembuatan Surat</h6>
                </div>
                <div class="card-body">

                    <p>Pilih jenis surat yang ingin dibuat:</p>

                    <div class="list-group">

    <a href="{{ route('admin.layanan.pembuatan-surat.buat', 'surat-keterangan-domisili') }}"
        class="list-group-item list-group-item-action">
        Surat Keterangan Domisili
    </a>

    <a href="{{ route('admin.layanan.pembuatan-surat.buat', 'surat-pengantar-skck') }}"
        class="list-group-item list-group-item-action">
        Surat Pengantar SKCK
    </a>

    <a href="{{ route('admin.layanan.pembuatan-surat.buat', 'surat-keterangan-tidak-mampu') }}"
        class="list-group-item list-group-item-action">
        Surat Keterangan Tidak Mampu (SKTM) Sekolah
    </a>

    <a href="{{ route('admin.layanan.pembuatan-surat.buat', 'surat-keterangan-belum-menikah-duda-janda') }}"
        class="list-group-item list-group-item-action">
        Surat Keterangan Tidak Mampu (SKTM) Umum
    </a>

    <a href="{{ route('admin.layanan.pembuatan-surat.buat', 'surat-keterangan-usaha') }}"
        class="list-group-item list-group-item-action">
        Surat Keterangan Usaha
    </a>

</div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
