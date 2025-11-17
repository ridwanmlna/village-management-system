@extends('layouts.app')

@section('title', 'Pengaduan | Desa Sukamaju')

@section('page-title', 'Pengaduan')

@section('location', 'Layanan')

@section('location-title', 'Pengaduan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                {{-- Pesan sukses/gagal --}}
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
                            <h3 class="card-title">List Pengaduan</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Isi Aduan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengaduan as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="limit">{{ $item->isi_pengaduan }}</td>
                                            <td>
                                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
    <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">
            Hapus
        </button>
    </form>
</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $pengaduan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(".limit").each(function(i) {
                len = $(this).text().length;
                if (len > 80) {
                    $(this).text($(this).text().substr(0, 80) + '...');
                }
            });
        });
    </script>
@endpush
