@extends('layouts.app')

@section('title', 'Rekap Surat | Desa Margalaksana')
@section('location', 'Dashboard')
@section('location-title', 'Rekap Surat')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Rekap Pembuatan Surat</h3>

        <a href="{{ route('admin.rekap.pdf') }}" class="btn btn-danger">
            <i class="fa fa-file-pdf"></i> Download PDF
        </a>
    </div>

    <!-- TABEL SURAT -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0">Daftar Semua Surat</h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Nomor Surat</th>
                            <th>Nama Pemohon Surat</th>
                            <th>Tanggal Pembuatan Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($surat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->prefix_surat }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                <td>
    <a href="{{ route('admin.rekap.printUlang', $item->id) }}" 
       class="btn btn-sm btn-primary" 
       target="_blank">
        Print Ulang
    </a>
    <!-- Hapus -->
    <form action="{{ route('admin.rekap.destroy', $item->id) }}" 
          method="POST" 
          style="display:inline-block;"
          onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
    </form>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tidak ada data surat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- REKAP JUMLAH SURAT -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h6 class="m-0">Keterangan Jumlah Pembuatan Surat per Jenis</h6>
        </div>

        <ul class="list-group list-group-flush">
            @forelse ($rekapJenis as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>Surat {{ $item->prefix_surat }}</span>
                    <span><strong>{{ $item->total }} surat</strong></span>
                </li>
            @empty
                <li class="list-group-item text-muted text-center">
                    Tidak ada data rekap.
                </li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
