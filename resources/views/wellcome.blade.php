@extends('layouts.guest')

@section('content')
    @include('layouts.navbar')

    <div class="w-screen h-screen my-5" 
     style="background-image: url('{{ asset('img/background1.png') }}'); 
            background-size: cover; 
            background-position: center;">
    <div class="container">
        <div class="row m-0">
            <div class="col-7 d-flex">
                <div class="row align-self-center">
                    <h1 class="text-bold" style="font-size: 50px; color: white;">SELAMAT DATANG DI LAYANAN <br /> DESA MARGALAKSANA</h1>
<p style="color: white;">
    Buat urusan Administrasi dan Pelayanan Desa lebih simpel dengan interaksi digital Pelayanan Desa dengan warga.
</p>

                </div>
            </div>
            <div class="col-5">
                <img src="{{ asset('img/banner.webp') }}" alt="Banner Desa" class="w-100">
            </div>
        </div>
    </div>
</div>


    <div class="w-screen py-5" style="background-color: #F6F6F6" id="profile">
        <h3 class="px-5 text-bold">Visi & Misi</h3>
        <div class="container my-5 px-5">
            <div class="visi d-flex flex-column align-items-center justify-content-center">
                <h3 class="d-inline-block text-center text-bold border-bottom-green">VISI</h3>
                <p class="text-lg text-center my-4">“Terwujudnya Desa Margalaksana sebagai Desa Populis yang Agamis, Harmonis, Sejahtera Dan Inovatif (AHSIN) dalam Menunjang Visi Kabupaten Tasikmalaya”</p>
            </div>
            <div class="misi d-flex flex-column align-items-center justify-content-center">
                <h3 class="d-inline-block text-center text-bold border-bottom-green mt-4">MISI</h3>
                <ol class="text-lg my-4">
                    <li>Mewujudkan kualitas Manajemen Pemerintahan Desa yang semakin maju.</li>
                    <li>Mewujudkan kualitas SDM masyarakat yang unggul dan berakhlak mulia   dijiwai keimanan dan ketaqwaan Kepada Tuhan Yang Maha Esa.</li>
                    <li>Mewujudkan perekonomian Desa yang tangguh yang bertumpu pada potensi Sumber Daya Desa secara berkelanjutan.</li>
                    <li>Mewujudkan Tata Kelola lingkungan yang semakin baik.</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="w-screen py-5 bg-green-pastel text-white" id="kontak">
        <h3 class="px-5 text-bold">Kontak</h3>
        <div class="w-50 d-flex flex-column justify-content-center align-items-center mx-auto text-md">
            <p class="text-center my-3">Untuk informasi lebih lanjut terkait pelayanan Desa Margalaksana <br> dapat menghubungi kontak dibawah ini :</p>
            <p><i class="fa fa-phone-alt"></i> : 082319207271</p>
            <p><i class="fa fa-envelope"></i> : margalaksanasukaraja@gmail.com</p>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-green-pastel {
            background-color: #51839C;
        }
    </style>
@endpush
