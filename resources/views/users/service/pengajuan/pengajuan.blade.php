@extends('layouts.service')

@section('title', 'Daftar Surat Pengantar')

@section('judul', 'Pengajuan Surat Pengantar')

@section('content')

    <div class="p-5">

        <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-group">
                <label for="nik" class="mb-3">NIK</label>
                <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nik" name="nik" value="{{ auth()->user()->nik }}" placeholder="Masukkan NIK anda" readonly>
            </div>

            <div class="form-group">
                <label for="nama" class="mb-3">Nama Lengkap</label>
                <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nama" name="nama" value="{{ auth()->user()->name }}" placeholder="Masukkan nama lengkap anda" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal" class="mb-3">Tanggal Pengajuan</label>
                <input type="date" class="form-control form-control-lg rounded-pill text-md" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" readonly>
            </div>

            <div class="form-group">
                <label for="jenis_pelayanan_id" class="mb-3">Jenis Layanan</label>
                <select class="form-control select2 form-control-lg rounded-pill text-md @if ($errors->has('jenis_pelayanan_id')) is-invalid @endif" id="jenis_pelayanan_id" name="jenis_pelayanan_id">
                    <option value="" selected disabled>Pilih Layanan</option>
                    @foreach ($pelayanan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_pelayanan }}</option>
                    @endforeach
                </select>
                @if ($errors->has('jenis_pelayanan_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_pelayanan_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
    <label class="mb-3">Berkas Yang Harus Dikirimkan</label>

    <div id="pilihanBerkas"></div>

    @if ($errors->has('jenis_berkas'))
        <div class="text-danger mt-2">
            {{ $errors->first('jenis_berkas') }}
        </div>
    @endif
</div>

            <div class="form-group">
    <label for="file_berkas" class="mb-3">Upload File Berkas</label>

    <input
        type="file"
        class="form-control form-control-lg rounded-pill text-md @error('file_berkas') is-invalid @enderror"
        id="file_berkas"
        name="file_berkas[]"
        multiple
        accept="image/*,application/pdf">

    @error('file_berkas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
            
            {{-- Informasi Persyaratan dan Prosedur --}}
<div id="infoLayanan" class="card shadow-sm border-0 mt-4 mb-4" style="display:none;">
    <div class="card-header text-white" style="background-color:#51839C;">
        <h5 class="mb-0">
            <i class="fas fa-info-circle"></i> Informasi Layanan
        </h5>
    </div>

    <div class="card-body">
        <h6 class="font-weight-bold text-primary">Jenis Surat</h6>
        <p id="namaSurat"></p>

        <hr>

        <h6 class="font-weight-bold text-success">Persyaratan Berkas</h6>
        <ul id="syaratSurat"></ul>

        <hr>

        <h6 class="font-weight-bold text-danger">Prosedur Pengajuan</h6>
        <ol id="prosedurSurat"></ol>
    </div>
</div>

            <div class="d-flex w-100 justify-content-end mt-5">
                <a href="{{ route('dashboard.user') }}" class="btn btn-outline-secondary px-5 py-2 rounded-pill mr-3">Kembali</a>
                <button type="submit" class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill"
                    onclick="return confirm('Apakah anda yakin ingin mengajukan surat ini?\nPastikan data yang anda masukkan sudah benar\nAnda tidak dapat mengubah data setelah mengajukan surat ini.')">Selanjutnya</button>
            </div>
        </form>
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

const prosedurDefault = [
    "Pilih jenis layanan yang akan diajukan.",
    "Siapkan berkas pendukung sesuai persyaratan kemudian upload berkas.",
    "Klik tombol Selanjutnya.",
    "Periksa kembali detail pengajuan surat.",
    "Admin desa melakukan proses verifikasi data.",
    "Surat diproses oleh perangkat desa.",
    "Warga akan menerima pemberitahuan melalui menu Notifikasi apabila surat telah selesai.",
    "Ambil surat di Kantor Desa Margalaksana."
];

const layanan = {

    "1": {
        nama: "Surat Keterangan Domisili",
        syarat: [
            "Fotokopi KTP.",
            "Fotokopi Kartu Keluarga (KK).",
            "Surat Pengantar RT/RW setempat."
        ],
        prosedur: prosedurDefault
    },

    "2": {
        nama: "Surat Pengantar SKCK",
        syarat: [
            "Fotokopi KTP.",
            "Fotokopi Kartu Keluarga (KK).",
            "Fotokopi Akta Kelahiran.",
            "Fotokopi Ijazah Terakhir.",
            "Foto Ukuran 4x6 sebanyak 6 lembar dengan latar belakang merah, berpakaian sopan dan berkerah."
        ],
        prosedur: prosedurDefault
    },

    "3": {
        nama: "SKTM Sekolah",
        syarat: [
            "Fotokopi KTP Orang Tua.",
            "Fotokopi Kartu Keluarga (KK).",
            "Surat Keterangan dari Sekolah (jika ada)."
        ],
        prosedur: prosedurDefault
    },

    "4": {
        nama: "SKTM Umum",
        syarat: [
            "Fotokopi KTP.",
            "Fotokopi Kartu Keluarga (KK).",
            "Surat Pengantar dari Ketua RT yang diketahui oleh Ketua RW."
        ],
        prosedur: prosedurDefault
    },

    "5": {
        nama: "Surat Keterangan Usaha",
        syarat: [
            "Fotokopi KTP.",
            "Fotokopi Kartu Keluarga (KK).",
            "Surat pengantar dari RT dan RW setempat.",
            "Bukti Pajak, Fotokopi Tanda Lunas Pajak Bumi dan Bangunan (PBB) terbaru.",
            "Nomor Pokok Wajib Pajak(NPWP) (jika ada).",
            "Foto Tempat Usaha (jika diperlukan)."
        ],
        prosedur: prosedurDefault
    },

    "7": {
        nama: "Surat Keterangan Belum Menikah",
        syarat: [
            "Fotokopi KTP.",
            "Fotokopi Kartu Keluarga (KK).",
            "Surat Pengantar RT dan RW."
        ],
        prosedur: prosedurDefault
    },

    "8": {
        nama: "Surat Keterangan Kelahiran",
        syarat: [
            "Fotokopi KTP Orang Tua.",
            "Fotokopi Kartu Keluarga (KK).",
            "Fotokopi Buku Nikah / Akta Perkawinan",
            "Surat Keterangan Lahir, Asli dari dokter, bidan, atau penolong kelahiran."
        ],
        prosedur: prosedurDefault
    },

    "9": {
        nama: "Surat Keterangan Kematian",
        syarat: [
            "Fotokopi KTP Almarhum.",
            "Fotokopi Kartu Keluarga (KK)."
        ],
        prosedur: prosedurDefault
    }

};

const daftarBerkas = {
    "Fotokopi KTP.": "Fotokopi KTP",
    "Fotokopi Kartu Keluarga (KK).": "Fotokopi Kartu Keluarga (KK)",
    "Surat Pengantar RT/RW setempat.": "Surat Pengantar RT/RW setempat",
    "Fotokopi Akta Kelahiran.": "Fotokopi Akta Kelahiran",
    "Fotokopi Ijazah Terakhir.": "Fotokopi Ijazah Terakhir",
    "Foto Ukuran 4x6 sebanyak 6 lembar dengan latar belakang merah, berpakaian sopan dan berkerah.": "Pas Foto",
    "Fotokopi KTP Orang Tua.": "Fotokopi KTP Orang Tua",
    "Surat Keterangan dari Sekolah (jika ada).": "Surat Keterangan dari Sekolah",
    "Bukti Pajak, Fotokopi Tanda Lunas Pajak Bumi dan Bangunan (PBB) terbaru.": "Bukti Pajak",
    "Nomor Pokok Wajib Pajak(NPWP) (jika ada).": "NPWP",
    "Foto Tempat Usaha (jika diperlukan).": "Foto Tempat Usaha",
    "Fotokopi Buku Nikah / Akta Perkawinan": "Fotokopi Buku Nikah / Akta Perkawinan",
    "Surat Keterangan Lahir, Asli dari dokter, bidan, atau penolong kelahiran.": "Surat Keterangan Lahir",
    "Fotokopi KTP Almarhum.": "Fotokopi KTP Almarhum"
};

$('#jenis_pelayanan_id').on('change', function () {

    let id = $(this).val();

    let data = layanan[id];
    
    $('#pilihanBerkas').empty();

    if (!data) {
        $('#infoLayanan').hide();
        return;
    }

    $('#namaSurat').text(data.nama);

    $('#syaratSurat').empty();
    $('#prosedurSurat').empty();
    
    $('#pilihanBerkas').empty();

$.each(data.syarat, function(i, item){

    $('#syaratSurat').append('<li>'+item+'</li>');

    let value = daftarBerkas[item] ?? item;

    $('#pilihanBerkas').append(`
        <div class="form-check mb-2">
            <input class="form-check-input"
                type="checkbox"
                name="jenis_berkas[]"
                value="${value}"
                id="berkas${i}">
            <label class="form-check-label" for="berkas${i}">
                ${value}
            </label>
        </div>
    `);
});

$.each(data.prosedur, function(i, item){
    $('#prosedurSurat').append('<li>'+item+'</li>');
});

$('#infoLayanan').slideDown();

});
</script>
@endpush
