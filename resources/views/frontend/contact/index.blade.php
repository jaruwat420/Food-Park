@extends('frontend.layouts.master')

@section('title', 'แจ้งปัญหา')

@section('css')
    <style>

    </style>
@endsection

@section('content')
        <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>ติดต่อเรา</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                        <li><a href="{{ route('contact.index') }}">ติดต่อเรา</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->

    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <div class="fp__contact_info">
                    <span><i class="fal fa-phone-alt" aria-hidden="true"></i></span>
                    <div class="text">
                        <h3>โทรศัพท์</h3>
                        <p>02-9045223-5</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <div class="fp__contact_info">
                    <span><i class="fal fa-envelope" aria-hidden="true"></i></span>
                    <div class="text">
                        <h3>อีเมลล์</h3>
                        <p>it@chaixi.co.th</p>
                        <p>marketing@chaixi.co.th</p>
                        <p>info@chaixi.co.th</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <div class="fp__contact_info">
                    <span><i class="fas fa-street-view" aria-hidden="true"></i></span>
                    <div class="text">
                        <h3>ที่อยู่</h3>
                        <p>บริษัท ชายสี่ คอร์ปอเรชั่น จำกัด (สำนักงานใหญ่) 7/7 หมู่ที่ 8 ต.คลองหก อ.คลองหลวง จ.ปทุมธานี 12120 Tel: 02-9045223-5</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="fp__contact_form_area mt_100 xs_mt_70">
            <div class="row">
                <div class="col-xl-12 wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">

                    <form class="fp__contact_form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <h3>ผู้ติดต่อ</h3>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="fp__contact_form_input">
                                    <span><i class="fal fa-user-alt" aria-hidden="true"></i></span>
                                    <input type="text" name="name" placeholder="ชื่อ">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="fp__contact_form_input">
                                    <span><i class="fal fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" name="email" placeholder="อีเมลล์">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="fp__contact_form_input">
                                    <span><i class="fal fa-phone-alt" aria-hidden="true"></i></span>
                                    <input type="text" name="telephone" placeholder="หมายเลขโทรศัพท์">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="fp__contact_form_input textarea">
                                    <span><i class="fal fa-book" aria-hidden="true"></i></span>
                                    <textarea rows="8" name="description" placeholder="ข้อความ"></textarea>
                                </div>
                                <button type="submit">ส่งข้อความ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
