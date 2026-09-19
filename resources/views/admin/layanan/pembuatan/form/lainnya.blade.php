<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Lainnya {{ $data->nomor_surat }}</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
            font-size: 12pt;
            line-height: 1.6;
        }
        .kop-container { text-align: center; }
        .kop-logo { float: left; width: 90px; height: auto; }
        .kop-text { text-align: center; font-size: 14pt; line-height: 1.3; }
        .kop-text b { display: block; }
        .kop-text .kop-alamat { font-size: 10pt; }
        .clear { clear: both; }
        .garis-tebal { border-top: 3px solid #000; margin-top: 5px; }
        .garis-tipis { border-top: 1px solid #000; margin-top: 1px; }
        .judul-surat { text-align: center; font-weight: bold; margin-top: 20px; text-transform: uppercase; text-decoration: underline; font-size: 14pt; }
        .nomor-surat { text-align: center; margin-top: 5px; }
        .isi { margin-top: 30px; text-align: justify; font-size: 12pt; }
        .indent { text-indent: 30px; }
        table.data-diri td { padding: 2px 0; font-size: 12pt; }
        .ttd { margin-top: 50px; width: 100%; text-align: right; }
        .isi-ttd { display: inline-block; text-align: center; margin-right: 30px; font-size: 12pt; }
        .nip { margin-top: 5px; text-align: left; margin-left: 60%; font-size: 12pt; }
    </style>
</head>
<body>

<!-- KOP SURAT -->
<div class="kop-container">
    <img src="{{ public_path('img/Picture1.png') }}" class="kop-logo">
    <div class="kop-text">
        <b>PEMERINTAH KABUPATEN TASIKMALAYA</b>
        <b>KECAMATAN SUKARAJA</b>
        <b>DESA MARGALAKSANA</b>
        <span class="kop-alamat">Jln. Kp. Tambakbaya RT 016 RW 005 Desa Margalaksana Kec. Sukaraja Kab. Tasikmalaya</span>
    </div>
    <div class="clear"></div>
    <div class="garis-tebal"></div>
    <div class="garis-tipis"></div>
</div>

<!-- JUDUL SURAT -->
<h3 class="judul-surat">SURAT KETERANGAN LAINNYA</h3>
<div class="nomor-surat">
    Nomor: {{ $data->nomor_surat }}/{{ $data->prefix_surat }}/{{ date('Y') }}
</div>

<!-- ISI SURAT -->
<div class="isi">
    <p class="indent">
        Yang bertanda tangan di bawah ini menerangkan bahwa:
    </p>

    <table class="data-diri">
        <tr>
            <td width="180">Nama Lengkap</td>
            <td>: {{ $data->user->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->user->nik }}</td>
        </tr>
        <tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->user->tempat_tanggal_lahir ? explode(' ', $data->user->tempat_tanggal_lahir)[0] : '-' }}, {{ $data->user->tanggal_lahir ? \Carbon\Carbon::parse($data->user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td></tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $data->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $data->user->agama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $data->user->pekerjaan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->user->alamat ?? '-' }}</td>
        </tr>
    </table>



    <p class="indent">
        Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>
</div>

<!-- TANDA TANGAN -->
<div class="ttd">
    <div class="isi-ttd">
        Margalaksana, {{ now()->translatedFormat('d F Y') }}<br>
        Kepala Desa Margalaksana<br><br><br><br>
        ___________________________
    </div>
</div>

<div class="nip">NIP:</div>

</body>
</html>
