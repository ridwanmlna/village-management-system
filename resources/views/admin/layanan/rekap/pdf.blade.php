<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pembuatan Surat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        .keterangan { margin-top: 20px; }
    </style>
</head>
<body>

<h2>REKAP PEMBUATAN SURAT DESA MARGALAKSANA TAHUN {{ \Carbon\Carbon::now()->year }}</h2>

<h4>Daftar Semua Surat</h4>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Surat</th>
            <th>Nomor Surat</th>
            <th>Nama Pemohon Surat</th>
            <th>Tanggal Pembuatan Surat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($surat as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->prefix_surat }}</td>
                <td>{{ $item->nomor_surat }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="keterangan">
    <h4>Keterangan Jumlah Pembuatan Surat per Jenis</h4>
    @foreach ($rekapPerTahun as $prefix => $total)
        <p>Surat {{ $prefix }} : {{ $total }} surat</p>
    @endforeach
</div>

</body>
</html>
