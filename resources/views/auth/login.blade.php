{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('frontend.layouts.master')

@section('title', 'เข้าสู่ระบบ')

@section('css')
<style>

</style>
@endsection

@section('content')
<!--=============================
        BREADCRUMB START
    ==============================-->

    <section class="fp__breadcrumb" style="background: url('{{ asset('frontend/images/counter_bg.jpg') }}');">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>เข้าสู่ระบบ</h1>
                <ul>
                    <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                    <li><a href="#">เข้าสู่ระบบ</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--=============================
        BREADCRUMB END
    ==============================-->

<!--=========================
        SIGNIN START
    ==========================-->
<section class="fp__signin" style="background: url(images/login_bg.jpg);">
    <div class="fp__signin_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="fp__login_area">
                        <h2 class="mb-5 text-center">เข้าสู่ระบบ</h2>
                        {{-- <p>เข้าสู่ระบบ</p> --}}
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="fp__login_imput">
                                        <label>อีเมล</label>
                                        <input type="email" id="email" name="email" placeholder="อีเมล" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__login_imput">
                                        <label>รหัสผ่าน</label>
                                        <input type="password" placeholder="รหัสผ่าน" name="password" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__login_imput fp__login_check_area">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="remember"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                จดจำรหัสผ่าน
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}">ลืมรหัสผ่าน ?</a>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__login_imput">
                                        <button type="submit" class="common_btn">เข้าสู่ระบบ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="or"><span>or</span></p>
                        {{-- <ul class="d-flex">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul> --}}
                        <p class="create_account">หากยังไม่มีบัญชี ? <a href="{{ route('register') }}">สร้างบัญชี</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========================
        SIGNIN END
    ==========================-->
@endsection


