@extends('layouts.app')

@section('title', 'Pengaduan Masyarakat | Desa Margalaksana')

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
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengaduan as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="limit">{{ $item->isi_pengaduan }}</td>
                                            <td>
    {!! $item->status !!}
</td>
                                            <td>
                                                <form action="{{ route('admin.pengaduan.update', $item->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('PUT')

    <form action="{{ route('admin.pengaduan.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="status_pengaduan"
            class="form-control form-control-sm mb-2"
            onchange="konfirmasiStatusPengaduan(this)">

        <option value="1" {{ $item->status_pengaduan == 1 ? 'selected' : '' }}>
            Menunggu Tinjauan
        </option>

        <option value="2" {{ $item->status_pengaduan == 2 ? 'selected' : '' }}>
            Ditinjau
        </option>

        <option value="3" {{ $item->status_pengaduan == 3 ? 'selected' : '' }}>
            Ditindaklanjuti
        </option>

        <option value="4" {{ $item->status_pengaduan == 4 ? 'selected' : '' }}>
            Selesai
        </option>

        <option value="5" {{ $item->status_pengaduan == 5 ? 'selected' : '' }}>
            Ditolak
        </option>

    </select>
</form>

<a href="{{ route('admin.pengaduan.show',$item->id) }}"
class="btn btn-info btn-sm">Detail</a>

<form action="{{ route('admin.pengaduan.destroy',$item->id) }}" method="POST" style="display:inline-block">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data pengaduan ini? Tindakan ini tidak dapat dibatalkan.')">
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
$(function () {

    $(".limit").each(function () {
        let len = $(this).text().length;

        if (len > 80) {
            $(this).text($(this).text().substr(0,80)+"...");
        }

    });

});

function konfirmasiStatusPengaduan(select){

    let pesan="";

    switch(select.value){

        case "2":
            pesan="Pastikan pengaduan telah diperiksa. Apakah Anda yakin ingin mengubah status menjadi Ditinjau?";
        break;

        case "3":
            pesan="Pastikan pengaduan telah diverifikasi dan siap ditindaklanjuti. Apakah Anda yakin ingin mengubah status menjadi Ditindaklanjuti?";
        break;

        case "4":
            pesan="Pastikan seluruh proses penanganan pengaduan telah selesai. Apakah Anda yakin ingin mengubah status menjadi Selesai?";
        break;

        case "5":
            pesan="Apakah Anda yakin ingin menolak pengaduan ini? Pengguna akan menerima pemberitahuan bahwa pengaduannya ditolak.";
        break;

        default:
            pesan="Apakah Anda yakin ingin mengubah status pengaduan?";
    }

    if(confirm(pesan)){
        select.form.submit();
    }else{
        location.reload();
    }

}
    </script>
@endpush
