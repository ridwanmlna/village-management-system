@extends('layouts.app')

@section('title', 'Antrian Pelayanan | Desa Margalaksana')

@section('page-title', 'Antrian')

@section('location', 'Layanan')

@section('location-title', 'Antrian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifikasi berhasil --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifikasi gagal --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">List Antrian Hari Ini</h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>No Antrian</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat & Tanggal Lahir</th>
                                        <th>Status Perkawinan</th>
                                        <th>Warga Negara</th>
                                        <th>Agama</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>Status Antrian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($antrian as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->no_antrian }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->nik }}</td>
                                            <td>{{ $item->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $item->user->tempat_tanggal_lahir ?? '-' }}</td>
                                            <td>{{ $item->user->status_perkawinan ?? '-' }}</td>
                                            <td>{{ $item->user->warga_negara ?? '-' }}</td>
                                            <td>{{ $item->user->agama }}</td>
                                            <td>{{ $item->user->pekerjaan }}</td>
                                            <td>{{ $item->user->alamat }}</td>

                                            {{-- Status --}}
                                            <td>{!! $item->status !!}</td>

                                            {{-- Aksi --}}
                                            <td>

                                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                                        type="button" 
                                                        data-toggle="dropdown">
                                                    Status
                                                </button>

                                                <div class="dropdown-menu">

                                                        <form action="{{ route('admin.antrian.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="status_antrian" value="1">

                                                            <button class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status antrian menjadi Menunggu? Pastikan pemohon belum dipanggil untuk mendapatkan pelayanan.')">
                                                                Menunggu
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.antrian.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="status_antrian" value="2">

                                                            <button class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda yakin ingin memanggil pemohon? Pastikan nomor antrian yang dipilih sudah benar sebelum mengubah status menjadi Dipanggil.')">
                                                                Dipanggil
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.antrian.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="status_antrian" value="3">

                                                            <button class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda yakin pelayanan untuk pemohon ini telah selesai? Pastikan seluruh proses pelayanan telah diberikan sebelum mengubah status menjadi Selesai.')">
                                                                Selesai
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="{{ route('admin.antrian.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="status_antrian" value="4">

    <button class="dropdown-item text-danger"
            onclick="return confirm('Apakah Anda yakin ingin mengubah status antrian menjadi Ditolak? Pastikan terdapat alasan yang jelas, seperti persyaratan yang tidak lengkap atau data yang tidak sesuai.')">
        Ditolak
    </button>
</form>

                                        

                                                </div>
<a href="{{ route('admin.antrian.show', $item->id) }}"
   class="btn btn-info btn-sm">
   Detail
</a>
                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('admin.antrian.destroy', $item->id) }}" 
                                                      method="POST" 
                                                      style="display:inline-block; margin-top:5px;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data antrian ini? Tindakan ini tidak dapat dibatalkan. Pastikan data yang dipilih sudah benar.')">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{ $antrian->links() }}

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection