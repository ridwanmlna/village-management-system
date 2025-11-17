@extends('layouts.app')

@section('title', 'Antrian | Desa Sukamaju')

@section('page-title', 'Antrian')

@section('location', 'Layanan')

@section('location-title', 'Antrian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Nomor Handphone</th>
                                        <th>Jenis Pelayanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($antrian as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->no_antrian }}</td>
                                            <td>{{ $item->user->nik }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->phone_number }}</td>
                                            <td>{{ $item->jenisPelayanan->nama_pelayanan }}</td>
                                            <td>
    <form action="{{ route('admin.antrian.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data antrian ini?')">
            Hapus
        </button>
    </form>
</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
