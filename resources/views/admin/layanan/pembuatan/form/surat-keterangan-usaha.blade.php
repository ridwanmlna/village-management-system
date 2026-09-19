<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Usaha {{ $data->nomor_surat }}</title>
    <style>
        body {
            font-family: "Arial", serif;
            margin: 20px 30px; /* dikurangi margin supaya muat 1 halaman */
            font-size: 11pt; /* dikurangi font sedikit */
            line-height: 1.4; /* rapatkan spasi */
        }
        .kop-container { text-align: center; }
        .kop-logo { float: left; width: 70px; height: auto; }
        .kop-text { text-align: center; font-size: 13pt; line-height: 1.2; }
        .kop-text b { display: block; }
        .kop-text .kop-alamat { font-size: 9pt; font-style: italic; }
        .clear { clear: both; }
        .garis-tebal { border-top: 3px solid #000; margin-top: 3px; }
        .garis-tipis { border-top: 1px solid #000; margin-top: 1px; }
        .judul-surat {
            text-align: center;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 13pt;
        }
        .nomor-surat { text-align: center; margin: 2px 0; }
        .isi { margin-top: 15px; text-align: justify; font-size: 11pt; }
        .indent { text-indent: 25px; }
        table.data-diri td { padding: 1px 5px; font-size: 11pt; vertical-align: top; }
        .ttd { margin-top: 30px; width: 100%; text-align: right; }
        .isi-ttd { display: inline-block; text-align: center; margin-right: 20px; font-size: 11pt; }
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
        <span class="kop-alamat">Jln. Tambakbaya RT 016 RW 005 Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya</span>
    </div>
    <div class="clear"></div>
    <div class="garis-tebal"></div>
    <div class="garis-tipis"></div>
</div>

<h3 class="judul-surat">Surat Keterangan Usaha</h3>
<div class="nomor-surat">
    Nomor: {{ $data->nomor_surat_format }}
</div>

<div class="isi">
    <p class="indent">
        Yang bertanda tangan di bawah ini Kepala Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya menerangkan dengan sebenarnya, bahwa:
    </p>

    <table class="data-diri" style="margin-left:20px;">
        <tr>
            <td width="150"><b>Nama Lengkap</b></td>
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

    <p>
    Bahwa nama tersebut adalah benar warga Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya yang berdomisili sebagaimana yang diterangkan di atas. Berdasarkan sepengetahuan kami yang bersangkutan memiliki usaha:
</p>

<table class="data-diri" style="margin-left: 20px;">
    <tr>
        <td width="120">Jenis Usaha</td>
        <td>: {{ $data->nama_usaha ?? '' }}</td>
    </tr>
    <tr>
        <td>Alamat Usaha</td>
        <td>: {{ $data->alamat_usaha ?? '' }}</td>
    </tr>
</table>

<p>
    Surat keterangan ini diberikan untuk <b>SYARAT ADMINISTRASI.</b>
</p>


    <p class="indent">
        Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.
    </p>
</div>

<div class="ttd">
    <div class="isi-ttd">
        Margalaksana, {{ now()->translatedFormat('d F Y') }}<br>
        Kepala Desa Margalaksana<br><br><br><br><br>
        <b><u>JAJA HIDAYAT S.Pd.I</u></b>
    </div>
</div>

</body>
</html>
