<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili {{ $data->nomor_surat }}</title>
    <style>
        body {
            font-family: "Arial", serif;
            margin: 40px;
            font-size: 12pt;
            line-height: 1.6;
        }
        .kop-container { text-align: center; }
        .kop-logo { float: left; width: 90px; height: auto; }
        .kop-text { text-align: center; font-size: 14pt; line-height: 1.3; }
        .kop-text b { display: block; }
        .kop-text .kop-alamat { font-size: 10pt; font-style: italic;}
        .clear { clear: both; }
        .garis-tebal { border-top: 3px solid #000; margin-top: 5px; }
        .garis-tipis { border-top: 1px solid #000; margin-top: 1px; }
        .judul-surat {
    text-align: center;
    font-weight: bold;
    margin-top: 5px !important;
    margin-bottom: 0px !important; /* WAJIB agar nomor surat bisa naik */
    text-transform: uppercase;
    text-decoration: underline;
    font-size: 14pt;
}

.nomor-surat {
    text-align: center;
    margin-top: -2px !important; /* bisa diperbesar jika perlu */
}
        .isi { margin-top: 30px; text-align: justify; font-size: 12pt; }
        .isi p:first-of-type {
    margin-top: -15px !important; /* naik 1 baris */
}
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
        <b>PEMERINTAH DAERAH KABUPATEN TASIKMALAYA</b>
        <b>KECAMATAN SUKARAJA</b>
        <b>KEPALA DESA MARGALAKSANA</b>
        <span class="kop-alamat">Kantor: Jln. Tambakbaya RT 016 RW 005 Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya</span>
    </div>
    <div class="clear"></div>
    <div class="garis-tebal"></div>
    <div class="garis-tipis"></div>
</div>

<!-- JUDUL SURAT -->
<h3 class="judul-surat">Surat Keterangan Domisili</h3>
<div class="nomor-surat">
    Nomor: {{ $data->nomor_surat_format }}
</div>

<!-- ISI SURAT -->
<div class="isi">
    <p class="indent">
        Yang bertanda tangan di bawah ini Kepala Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya menerangkan dengan sebenarnya, bahwa:
    </p>

    <table class="data-diri" style="margin-left:30px;">
        <tr>
            <td width="180"><b>Nama Lengkap</b></td>
            <td>: <b>{{ $data->user->name }}</b></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->user->nik }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $data->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $data->user->tempat_tanggal_lahir ? explode(' ', $data->user->tempat_tanggal_lahir)[0] : '-' }}, {{ $data->user->tanggal_lahir ? \Carbon\Carbon::parse($data->user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td>Status Perkawinan</td>
            <td>: {{ $data->user->status_perkawinan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Warga Negara</td>
            <td>: {{ $data->user->warga_negara ?? '-' }}</td>
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

    <br><p class="indent" style="margin-top:10px;"> Adalah benar warga kami, warga Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya dan berdomisili di wilayah tersebut. Surat keterangan ini dibuat untuk keperluan sebagaimana mestinya. </p>

    <p class="indent">
        Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat di pergunakan sebagaimana mestinya.
    </p>
</div>

<!-- TANDA TANGAN -->
<div class="ttd">
    <div class="isi-ttd">
        Margalaksana, {{ now()->translatedFormat('d F Y') }}<br>
        Kepala Desa Margalaksana<br><br><br><br>

        <b><u>JAJA HIDAYAT S.Pd.I</u></b>
    </div>
</div>


</body>
</html>