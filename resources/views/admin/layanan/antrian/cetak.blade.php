<!DOCTYPE html>
<html>
<head>
    <title>Surat Antrian {{ $antrian->no_antrian }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Surat Antrian Desa Margalaksana</h2>

    <p>No Antrian: <strong>{{ $antrian->no_antrian }}</strong></p>
    <p>Nama: {{ $antrian->user->name }}</p>
    <p>NIK: {{ $antrian->user->nik }}</p>

    <p>Jenis Kelamin: 
        {{ $antrian->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
    </p>

    <p>Tempat & Tanggal Lahir: 
        {{ $antrian->user->tempat_lahir ?? '-' }}, 
        {{ $antrian->user->tanggal_lahir ?? '-' }}
    </p>

    <p>Status Perkawinan: 
        {{ $antrian->user->status_perkawinan ?? '-' }}
    </p>

    <p>Warga Negara: 
        {{ $antrian->user->warga_negara ?? '-' }}
    </p>

    <p>Agama: {{ $antrian->user->agama }}</p>
    <p>Pekerjaan: {{ $antrian->user->pekerjaan }}</p>
    <p>Alamat: {{ $antrian->user->alamat }}</p>

    <p>Jenis Pelayanan: {{ $antrian->jenisPelayanan->nama_pelayanan }}</p>

    <p>Tipe Layanan: 
        {{ $antrian->jenisPelayanan->tipe_layanan ? $antrian->jenisPelayanan->tipe_layanan : 'Tidak Diisi' }}
    </p>

</body>
</html>
