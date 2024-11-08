<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="FoodPark" class="w-50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">หน้าแรก</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">ติดต่อเรา</a>
                </li> --}}
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                {{-- <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form>
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . .">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li> --}}
                {{-- <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i> <span>5</span></a>
                </li>
                <li>
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                </li> --}}
                {{-- <li>
                    <a class="common_btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">reservation</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (05)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('frontend/images/menu8.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani </a>
                    <p class="size">small</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('frontend/images/menu4.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Chicken Masalas</a>
                    <p class="size">medium</p>
                    <span class="extra">7up</span>
                    <p class="price">$70.00</p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('frontend/images/menu5.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Competently Supply Customized Initiatives</a>
                    <p class="size">large</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$120.00 <del>$150.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('frontend/images/menu6.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani</a>
                    <p class="size">small</p>
                    <span class="extra">7up</span>
                    <p class="price">$59.00</p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
            <li>
                <div class="menu_cart_img">
                    <img src="{{ asset('frontend/images/menu1.png') }}" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Competently Supply</a>
                    <p class="size">medium</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li>
        </ul>
        <p class="subtotal">sub total <span>$1220.00</span></p>
        <a class="cart_view" href="cart_view.html"> view cart</a>
        <a class="checkout" href="check_out.html">checkout</a>
    </div>
</div>

<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form">
                        <input class="reservation_input" type="text" placeholder="Name">
                        <input class="reservation_input" type="text" placeholder="Phone">
                        <input class="reservation_input" type="date">
                        <select class="reservation_input" id="select_js">
                            <option value="">select time</option>
                            <option value="">08.00 am to 09.00 am</option>
                            <option value="">10.00 am to 11.00 am</option>
                            <option value="">12.00 pm to 01.00 pm</option>
                            <option value="">02.00 pm to 03.00 pm</option>
                            <option value="">04.00 pm to 05.00 pm</option>
                        </select>
                        <select class="reservation_input" id="select_js2">
                            <option value="">select person</option>
                            <option value="">1 person</option>
                            <option value="">2 person</option>
                            <option value="">3 person</option>
                            <option value="">4 person</option>
                            <option value="">5 person</option>
                        </select>
                        <button type="submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
