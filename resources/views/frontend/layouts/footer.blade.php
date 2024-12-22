<footer>
    <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-sm-8 col-md-6">
                    <div class="fp__footer_content">
                        <a class="footer_logo" href="index.html">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="FoodPark" class="img-fluid w-100">
                        </a>
                        {{-- <span>There are many variations of Lorem Ipsum available, but the majority have
                            suffered.</span> --}}
                        <p class="info"><i class="far fa-map-marker-alt"></i> บริษัท ชายสี่ คอร์ปอเรชั่น จำกัด (สำนักงานใหญ่) 7/7 หมู่ที่ 8 ต.คลองหก อ.คลองหลวง จ.ปทุมธานี 12120</p>
                        <a class="info" href="callto:090-908-6909"><i class="fas fa-phone-alt"></i>
                            090-908-6909</a>
                        <a class="info" href="mailto:it@chaixi.co.th"><i class="fas fa-envelope"></i>
                            it@chaixi.co.th</a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="fp__footer_content">
                        <h3>ทางลัด</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                            <li><a href="#">แจ้งปัญหา</a></li>
                            <li><a href="#">ติดตามปัญหา</a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-2 col-sm-4 col-md-6 order-sm-4 order-lg-3">
                    <div class="fp__footer_content">
                        <h3>Help Link</h3>
                        <ul>
                            <li><a href="#">Terms And Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 col-sm-8 col-md-6 order-lg-4">
                    <div class="fp__footer_content">
                        <h3>subscribe</h3>
                        <form>
                            <input type="text" placeholder="Subscribe">
                            <button>Subscribe</button>
                        </form>
                        <div class="fp__footer_social_link">
                            <h5>follow us:</h5>
                            <ul class="d-flex flex-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="fp__footer_bottom d-flex flex-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fp__footer_bottom_text d-flex flex-wrap justify-content-between">
                        <p>Copyright 2024 <b>CHAIXI</b> All Rights Reserved.</p>
                        <ul class="d-flex flex-wrap">
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">payment</a></li>
                            <li><a href="#">settings</a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
