<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu (SKTM) Sekolah {{ $data->nomor_surat_format }}</title>
    <style>
        body {
            font-family: "Arial", serif;
            margin: 20px;
            font-size: 11pt;
            line-height: 1.35;
        }
        .kop-container { text-align: center; }
        .kop-logo { float: left; width: 80px; }
        .kop-text { font-size: 13pt; line-height: 1.2; }
        .kop-text b { display: block; }
        .kop-text .kop-alamat { font-size: 9pt; font-style: italic;}
        .clear { clear: both; }
        .garis-tebal { border-top: 3px solid #000; margin-top: 3px; }
        .garis-tipis { border-top: 1px solid #000; margin-top: 0px; }

        .judul-surat {
            text-align: center;
            font-weight: bold;
            margin-top: 0px;
            margin-bottom: 0px;
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 13pt;
        }
        .nomor-surat { text-align: center; margin-top: -2px; }
        .isi { margin-top: 10px; text-align: justify; font-size: 11pt; }
        .indent { text-indent: 25px; margin-bottom:5px; }
        table.data-diri td { padding: 1px 0; font-size: 11pt; vertical-align: top; }
        .ttd { margin-top: 30px; width: 100%; text-align: right; }
        .isi-ttd { display: inline-block; text-align: center; margin-right: 30px; font-size: 11pt; }
        .data-anak { margin-top: 25px; } /* jarak antara orang tua dan anak */
        .pembuka { margin-top: 20px; margin-bottom: 15px; } /* jarak paragraf pembuka dan tabel */
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
<h3 class="judul-surat">Surat Keterangan Tidak Mampu</h3>
<div class="nomor-surat">
    Nomor: {{ $data->nomor_surat_format }}
</div>

<!-- ISI SURAT -->
<div class="isi">
    <p class="indent pembuka">
        Yang bertanda tangan di bawah ini Kepala Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya menerangkan dengan sebenarnya, bahwa:
    </p>

    <!-- Data Orang Tua -->
    <table class="data-diri" style="margin-left:30px; margin-bottom:20px;">
        <tr><td width="160"><b>Nama Orang Tua</b></td><td>: <b>{{ $data->ortu->name ?? '-' }}</b></td></tr>
        <tr><td>NIK</td><td>: {{ $data->ortu->nik ?? '-' }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->ortu->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $data->ortu->tempat_tanggal_lahir ? explode(' ', $data->ortu->tempat_tanggal_lahir)[0] : '-' }}, {{ $data->ortu->tanggal_lahir ? \Carbon\Carbon::parse($data->ortu->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
        </tr>
        <tr><td>Status Perkawinan</td><td>: {{ $data->ortu->status_perkawinan ?? '-' }}</td></tr>
        <tr><td>Warga Negara</td><td>: {{ $data->ortu->warga_negara ?? '-' }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->ortu->agama ?? '-' }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->ortu->pekerjaan ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->ortu->alamat ?? '-' }}</td></tr>
    </table>

    <!-- Data Anak dengan jarak lebih besar -->
    <table class="data-diri data-anak" style="margin-left:30px;">
        <tr><td width="160"><b>Nama Anak/Siswa</b></td><td>: <b>{{ $data->anak->name ?? '-' }}</b></td></tr>
        <tr><td>NIK</td><td>: {{ $data->anak->nik ?? '-' }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $data->anak->tempat_tanggal_lahir ? explode(' ', $data->anak->tempat_tanggal_lahir)[0] : '-' }}, {{ $data->anak->tanggal_lahir ? \Carbon\Carbon::parse($data->anak->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
        </tr>
        <tr><td>Status Perkawinan</td><td>: {{ $data->anak->status_perkawinan ?? '-' }}</td></tr>
        <tr><td>Warga Negara</td><td>: {{ $data->anak->warga_negara ?? '-' }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->anak->agama ?? '-' }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->anak->pekerjaan ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->anak->alamat ?? '-' }}</td></tr>
    </table>

    <br><p class="indent" style="margin-top:8px;">
        Adalah benar warga kami, warga Desa Margalaksana Kecamatan Sukaraja Kabupaten Tasikmalaya, dari Catatan Kependudukan yang ada data orang tersebut diatas termasuk <b><u><i>Kategori Keluarga Tidak Mampu.</i></u></b>
    </p>

    <p class="indent">
        Demikian Surat Keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.
    </p>
</div>

<!-- TANDA TANGAN -->
<div class="ttd">
    <div class="isi-ttd">
        Margalaksana, {{ now()->translatedFormat('d F Y') }}<br>
        Kepala Desa Margalaksana<br><br><br><br><br>
        <b><u>JAJA HIDAYAT S.Pd.I</u></b>
    </div>
</div>

</body>
</html>
