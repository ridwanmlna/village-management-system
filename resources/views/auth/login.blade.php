@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="row vh-100 align-items-center justify-content-between">
        <div class="col-7">
            <div class="container">
                <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                    <a href="{{ route('wellcome') }}" class="pointer-event">
                        <img src="{{ asset('img/Picture1.png') }}" alt="Logo" class="img-md">
                    </a>
                    <h1>Login <br> Layanan Desa Margalaksana</h1>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.user') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nik" class="mb-4">NIK</label>
                        <input type="text" class="form-control rounded-pill py-4 px-3 @if ($errors->has('nik')) is-invalid @endif" id="nik" name="nik" value="{{ old('nik') }}" autofocus
                            placeholder="" data-inputmask='"mask": ""' data-mask>
                        @if ($errors->has('nik'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nik') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group position-relative">
                        <label for="password" class="mb-4">Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control rounded-pill py-4 px-3 @if ($errors->has('password')) is-invalid @endif" id="password" name="password"
                                placeholder="">
                            <div class="position-absolute right-midlle">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="d-flex w-100 justify-content-center mt-3">
    <a href="{{ route('wellcome') }}" class="btn btn-outline-secondary px-5 py-2 rounded-pill mr-3">
        Halaman Utama
    </a>

    <button type="submit" class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill">
        Login
    </button>
</div>

<div class="text-center mt-3">
    <small>
        Lupa Password?
        <a href="https://wa.me/6282319207271" target="_blank">
            Hubungi Admin
        </a>
    </small>
</div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <img src="{{ asset('img/banner-login.webp') }}" alt="logo" class="img-fluid">
        </div>
    </div>
    
    <div class="text-center mt-4 mb-3 text-muted">
    © {{ date('Y') }} Desa Margalaksana. All Rights Reserved.
</div>
@endsection

@push('styles')
    <style>
        .right-midlle {
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 9999;
        }

        .btn-green-pastel {
            background-color: #51839C;
            border-color: #51839C;
            color: #fff;
        }

        .btn-green-pastel:hover {
            background-color: #3B6C81;
            border-color: #3B6C81;
            color: #fff;
        }
        
        h1 {
    text-align: center;
    font-size: 36px;
    font-weight: 700;
    line-height: 1.3;
    width: 100%;
}

.img-md {
    width: 200px;
    height: auto;
}

.text-muted {
    font-size: 14px;
    color: #6c757d !important;
}

.row.vh-100 {
    margin: 0;
    padding-top: 10px;
    padding-bottom: 10px;
}

.container {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

.form-group {
    margin-bottom: 1rem;
}

.row.vh-100 {
    height: 100vh;
    margin: 0;
}

.container {
    transform: scale(0.92);
    transform-origin: top center;
}

html,
body {
    margin: 0;
    padding: 0;
    overflow-y: hidden;
}

        
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>
@endpush
