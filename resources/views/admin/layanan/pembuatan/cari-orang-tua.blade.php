@extends('layouts.app')

@section('title', 'Cari NIK Orang Tua')

@section('content')
<div class="container">

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Cari Data Orang Tua</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.surat.sktm.cari-nik-orang-tua') }}" method="POST">
                @csrf

                <input type="hidden" name="nik_anak" value="{{ $nik_anak }}">

                <label>NIK Orang Tua:</label>
                <input type="text" name="nik_ortu" class="form-control" maxlength="16" required>

                <button class="btn btn-success mt-3">Cari Orang Tua</button>
            </form>
        </div>
    </div>

</div>
@endsection
