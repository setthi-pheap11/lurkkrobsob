<?php 
$categories = DB::table('categories')->where('active', 1)->get();
?>
<nav class="d-none navbar navbar-expand-lg navbar-light bg-primary text-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img width="100px" src="data:image/png;base64,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" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse space-between d-flex" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link rounded text-white {{!request()->id ? 'bg-warning' : ''}}" aria-current="page" href="{{route('home')}}">{{__('lb.Home')}}</a>
        </li>
        @foreach($categories as $menu)
        <li class="nav-item">
          <a class="nav-link text-white rounded {{request()->id == $menu->id ? 'bg-warning' : ''}} " href="{{route('article_by_category', [$menu->name, $menu->id])}}">{{translate($menu->name, $menu->name_kh??null)}}</a>
        </li>
        @endforeach
        <li class="nav-item">
          @if(session()->has('locale'))
            @if(session()->get('locale') == 'kh')
            <a class="nav-link" href="{{route('switch_lang', 'en')}}">Change to English</a>
            @else            
            <a class="nav-link" href="{{route('switch_lang', 'kh')}}">Change to Khmer</a>
            @endif
          @else
          <a class="nav-link" href="{{route('switch_lang', 'en')}}">Change to English</a>
          @endif
        </li>
      </ul>
      <form action="{{route('home')}}" class="d-flex">
        <input name="keyword" value="{{request()->keyword ? request()->keyword : ''}}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
      {{translate('Hello', 'សួស្ដី', )}}


    </div>
  </div>
</nav>

<div id="normal-nav" class="">
  <div class="navbar navbar-top navbar-dark" id="">
    <div class="container">
      <div class="header d-flex w-100">
        <div class="cont-left w-50">
          <div class="d-flex justify-content-start gap-2 align-items-center">
            <i class="fa-solid fa-square-phone fs-6 c-A96AE6"></i>
            <span>Call 24/7: 040 3824 668</span>
            <line></line>
            <i class="fa-solid fa-circle-info fs-6 c-A96AE6"></i>
            <a href="#"><span>About Us</span></a>
          </div>
        </div>
        <div class="cont-rigth top-info w-50">
          <div class="d-flex justify-content-end align-items-center gap-2 w-100">
            <a id="sellerinstruction" href="{{route('dashboard')}}"
              class="menu-item d-flex gap-2">
              <i class="fa-solid fa-id-card fs-5 c-A96AE6"></i>
              <span>Seller Account</span>
            </a>
            <line></line>
            <div onclick="showContainer('myAcount-container')" id="myAcount" class="menu-item d-flex gap-2"
              data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa-solid fa-user fs-6 c-A96AE6"></i>
              <span>My Account</span>
              <line></line>
            </div>
            <div class="top-language has-child">
              <a href="#" class="language-selected d-flex gap-2 align-items-center">
                <i class="fa-solid fa-earth-americas fs-6 c-A96AE6"></i>
                <span id="_lang_used">{{translate('English', 'ខ្មែរ', )}}</span>
                <i class="fa-solid fa-chevron-down"></i>
              </a>
              <ul class="sub-menu-top">
                <li onclick="translateToEnglish()" class="t-en bg-A96AE6 c-A96AE6">
                  <a class="nav-link" href="{{route('switch_lang', 'en')}}">
                    <span class="text-nowrap"><img src="{{asset('assets/images/home/flag-usa.png')}}" alt="" />English</span>
                  </a>
                </li>
                <li onclick="translateToKhmer()" class="t-km c-A96AE6">
                  <a class="nav-link" href="{{route('switch_lang', 'kh')}}">
                    <span><img src="{{asset('assets/images/home/Khmer-flag.png')}}" alt="" />Khmer</span>
                  </a>
                </li>
              </ul>

            </div>

            <line></line>

            <div class="top-currency has-child">
              <a href="#" class="currency-selected d-flex gap-2 align-items-center">
                <i class="fa fa-usd fs-6 c-A96AE6"></i>
                <span>USD</span>
                <i class="fa-solid fa-chevron-down"></i>
              </a>
              <ul class="sub-menu-top">
                <li class="bg-A96AE6 text-white">
                  <a href="#"><span class="fs-6">$</span>USD</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark my-2 mx-1 p-0 rounded-4" id="navbar">
    <div class="container">
      <div class="menu d-flex w-100">
        <div class="cont-left w-50">
          <div class="d-flex">
            <div class="home_logo">
              <a href="#" onclick="showContainer('home-container')"
                class="d-flex justify-content-start align-items-end">
                <img class="mb-2" src="{{asset('assets/images/home/main_logo.png')}}" alt="" />
                <img class="mb-1" src="{{asset('assets/images/home/លក់គ្រប់សព្វ.png')}}" alt="" style="width: 40%;margin-left: -10px;">
                <!-- <span class="fs-6 text-white text-norap" style="margin-left: -20px">លក់គ្រប់សព្វ</span> -->
              </a>
            </div>
          </div>
        </div>
        <div class="cont-rigth d-flex w-50 ps-5">
          <div class="contain-menu d-flex justify-content-between align-items-center w-100 ps-5">
            <div>
              <div id="home" class="menu-item {{!request()->id ? 'active' : ''}}" aria-current="page" href="{{route('home')}}">
                <span class="">{{__('lb.Home')}}</span>
              </div>
            </div>
            @foreach($categories as $menu)
            <div>
              <a class="menu-item {{request()->id == $menu->id ? 'bg-warning' : ''}} " href="{{route('article_by_category', [$menu->name, $menu->id])}}">
                <span class="menu-item">{{translate($menu->name, $menu->name_kh??null)}}</span>
              </a>
            </div>
            @endforeach

            <!-- <div>
              <div onclick="showContainer('fashion-container')" id="fashion" class="menu-item">
                <span class="menu-item">Fashion</span>
              </div>
            </div>
            <div>
              <div onclick="showContainer('electronis-container')" id="electronis" class="menu-item">
                <span class="menu-item">Phone</span>
              </div>
            </div>
            <div>
              <div onclick="showContainer('sports-container')" id="sports" class="menu-item">
                <span class="menu-item">Sports</span>
              </div>
            </div>
            <div>
              <div onclick="showContainer('food-container')" id="food" class="menu-item">
                <span class="menu-item">Food</span>
              </div>
            </div> -->
            <div class="d-none">
              <div onclick="showContainer('software-container')" id="software" class="menu-item">
                <span class="menu-item">Software</span>
              </div>
            </div>
            <div>
              <div class="d-flex justify-content-center align-items-center" style="position: relative;">
                <!-- <input onchange="showContainer('product-container')" id="_el_search" type="search"
                  class=" form-control rounded-5 fade data-input" data-field="search_value"
                  placeholder="Search Product" />
                <span onclick="toggleSlide()" id="_btn_search" class="menu-item ">
                  <i class="fa-solid fa-magnifying-glass" style="cursor: pointer;"></i>
                </span> -->
                <span onclick="showContainer('product-container')" id="product" class="menu-item ">
                  <i class="fa-solid fa-magnifying-glass" style="cursor: pointer;"></i>
                </span>
              </div>
            </div>
            <div>
              <div onclick="showContainer('shopping-container')" id="shopping" class="menu-item">
                <span class="">
                  <i class="fa-solid fa-cart-shopping"></i>
                </span>
                <div class="veiw-order-summary box-shadow-dark rounded-5 ">
                  <div class="title w-50 mx-auto mt-0">
                    <span
                      class="d-block fs-5 text-nowrap bg-dark rounded-bottom-4 text-white lh-1 text-center p-2">Order
                      Summary</span>
                  </div>
                  <div class="order-items d-block py-2 overflow-hover-auto">

                    <div class="d-block border"></div>
                    <div class="item d-flex justify-content-between align-items-center ">
                      <div class="item-image d-flex justify-content-center w-25 m-2 ">
                        <div class="order-number">
                          <span class="order-item-number"> 1 </span>
                        </div>
                        <img src="{{asset('assets/images/home/img 1.png')}}" alt="item-image" class="w-100 p-3 border rounded-2"
                          style="max-height: 80px; max-width: 80px;">
                      </div>
                      <div class="items-text w-65 me-4 d-flex justify-content-between align-items-center ">
                        <div class="left align-middle text-center w-50">
                          <span class="d-black my-2 fs-6">Gaming Headset</span>
                          <span class="d-block my-2 fs-6">Color Blue</span>
                        </div>
                        <div class="right align-middle text-end w-50">
                          <span class="fs-6 c-A96AE6">17.00$</span>
                        </div>
                      </div>
                    </div>
                    <div class="d-block border"></div>
                    <div class="item d-flex justify-content-between align-items-center ">

                      <div class="item-image d-flex justify-content-center w-25 m-2">
                        <div class="order-number">
                          <span class="order-item-number"> 1 </span>
                        </div>
                        <img src="{{asset('assets/images/home/img1 1.png')}}" alt="item-image" class="w-100 p-3 border rounded-2"
                          style="max-height: 80px; max-width: 80px;">
                      </div>
                      <div class="items-text w-65 me-4 d-flex justify-content-between align-items-center ">
                        <div class="left align-middle text-center w-50">
                          <span class="d-black my-2 fs-6">Watch</span>
                          <span class="d-block my-2 fs-6">Titanium Silver</span>
                        </div>
                        <div class="right align-middle text-end w-50">
                          <span class="fs-6 c-A96AE6">17.00$</span>

                        </div>
                      </div>
                    </div>
                    <div class="d-block border"></div>
                    <div class="item d-flex justify-content-between align-items-center ">
                      <div class="item-image d-flex justify-content-center w-25 m-2 ">
                        <div class="order-number">
                          <span class="order-item-number"> 1 </span>
                        </div>
                        <img src="{{asset('assets/images/photos/fashion/5.png')}}" alt="item-image" class="w-100 border rounded-2"
                          style="max-height: 80px; max-width: 80px;">
                      </div>
                      <div class="items-text w-65 me-4 d-flex justify-content-between align-items-center ">
                        <div class="left align-middle text-center w-50">
                          <span class="d-black my-2 fs-6">Gaming Headset</span>
                          <span class="d-block my-2 fs-6">Color Blue</span>
                        </div>
                        <div class="right align-middle text-end w-50">
                          <span class="fs-6 c-A96AE6">17.00$</span>
                        </div>
                      </div>
                    </div>
                    <div class="d-block border"></div>

                  </div>
                  <div class="d-block payment-datail mx-3 mt-2 px-3 py-2 rounded-4 bg-border">
                    <span class="d-block fs-6 fw-bold">Payment Details</span>
                    <div class="d-flex justify-content-between align-items-center">
                      <spant class="fs-6">Sub Total</spant>
                      <spant class="fs-6">534.00 $</spant>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <spant class="fs-6">Delivery Fee</spant>
                      <spant class="fs-6">2.00 $</spant>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <spant class="fs-6">Descount</spant>
                      <spant class="fs-6 rounded-5 bg-A96AE6 text-white px-2">0.00 $</spant>
                    </div>
                    <div class="d-block border my-1 border-white"></div>
                    <div class="d-flex justify-content-between align-items-center">
                      <spant class="fs-6">Total</spant>
                      <spant class="fs-6">534.00 $</spant>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mt-2">
                    <button
                      class="btn border-A96AE6 border-4 c-A96AE6 rounded-4 mx-3 p-1 w-100 d-block fs-5 fw-bold text-center">Pay
                      Now</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>