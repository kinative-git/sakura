<section class="mb-n7 position-relative z-2" >
    <div class="container  ">
        <div class="bg-white p-3 p-md-5 border border-gray">
            <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center">
               <div class="col-md-8 text-center text-cetner mb-3 mb-md-0 my-2 " >
                    <div class="py-4 d-flex align-items-center justify-content-between" style=" background-image: url({{ static_asset('assets/img/backicon.png') }});
                    background-repeat: no-repeat;background-position: center;">
                        <img src="{{ static_asset('assets/img/q1.png') }}" alt="">
                        <h5 class="text text-uppercase opacity-80 pt-md-2" style="letter-spacing:3px;">join our newsletter to get offers</h5>
                        <img src="{{ static_asset('assets/img/q2.png') }}" alt="">
                    </div>
               </div>
                <div class="col-md-6 col-xl-6 mt-2">
                    <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                        @csrf
                        <div class="input-group flex-grow-1 border border-gray-500 p-1">
                            <input type="email" class="form-control w-lg-270px" placeholder="{{ translate('Write your email') }}" name="email" required style="outline: none!important;border:0px!important;">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary px-5 text-uppercase fs-13" style="letter-spacing: 2px">{{ translate('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="bg-black text-light bg-no-repeat bg-center mt-4 pt-3" style=" background-image:url({{ static_asset('assets/img/footerbg.jpg') }});background-repeat: no-repeat; background-size: cover;" >
    <div class="container pt-3">
            <div class="row py-3">
                <div class="col-lg-5 col-xl-5 text-center text-md-left mt-4 ">
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="d-block mb-4">
                            @if(get_setting('footer_logo') != null)
                                <img  src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" class="lazyload mw-100 h-50px " data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" >
                            @else
                                <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"  data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                            @endif
                        </a>
                        <div class="my-1 ">
                            <div class= "opacity-100 text-alter-2 fw-400 fs-17 roboto">
                                {!! get_setting('about_us_description',null,null) !!}
                            </div>

                        </div>
                        <br>

                        <div class="w-300px mw-100 mx-auto mx-md-0">
                            @if(get_setting('play_store_link') != null)
                                <a href="{{ get_setting('play_store_link') }}" target="_blank" class="d-inline-block mr-3 ml-0">
                                    <img src="{{ static_asset('assets/img/play.png') }}" class="mx-100 h-40px">
                                </a>
                            @endif
                            @if(get_setting('app_store_link') != null)
                                <a href="{{ get_setting('app_store_link') }}" target="_blank" class="d-inline-block">
                                    <img src="{{ static_asset('assets/img/app.png') }}" class="mx-100 h-40px">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="">
                        <ul class="list-inline my-1 my-md-0 social colored">
                            @if ( get_setting('facebook_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('twitter_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('instagram_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('youtube_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('linkedin_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3  col-md-2 mt-4">
                    <div class="text-center text-md-left mt-4">
                        <h5 class="text text-uppercase text-alter fw-600 fs-18 my-2" style="letter-spacing:4px;">Important links</h5>
                        <ul class="list-unstyled my-4 d-none d-lg-block"  style=" list-style-type: none;" >
                            @if ( get_setting('widget_one_labels',null,null) !=  null )
                                @foreach (json_decode( get_setting('widget_one_labels',null,null), true) as $key => $value)
                                <li class="mb-2 fs-13 my-2 d-flex align-items-center " >
                                    <img src="{{ static_asset('assets/img/circle.png') }}" alt="" class="mr-2">
                                    <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}" class= "opacity-100 hov-opacity-100 text-reset text-alter-2 fw-400 fs-17 roboto ">
                                        {{ $value }}
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="list-unstyled my-4 d-lg-none"  style=" list-style-type: none;" >
                            @if ( get_setting('widget_one_labels',null,null) !=  null )
                                @foreach (json_decode( get_setting('widget_one_labels',null,null), true) as $key => $value)
                                <li class="mb-2 fs-13 my-2 d-flex align-items-center justify-content-center" >
                                    <img src="{{ static_asset('assets/img/circle.png') }}" alt="" class="mr-2">
                                    <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}" class= "opacity-100 hov-opacity-100 text-reset text-alter-2 fw-400 fs-17 roboto ">
                                        {{ $value }}
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mt-4 ">
                    <div class="text-center text-md-left mt-4">
                        <h5 class="text text-uppercase text-alter fw-600 fs-18 my-2" style="letter-spacing:4px;">Contact us</h5>
                        <ul class="list-unstyled fs-12 mt-4">
                            <li class="mb-2 text-alter-2 fw-400 fs-17 roboto">
                                Address: <br>
                                <span class="d-block  opacity-100 mb-2">{{ get_setting('contact_address',null,null) }}</span>
                             </li>
                                <li class="mb-1 text-alter-2 fw-400 fs-17 roboto my-3">

                                    Phone: <br><span>{{ get_setting('contact_phone') }}</span>
                                </li>
                                <li class="text-alter-2 fw-400 fs-17 roboto">
                                    Email:<br><span>
                                    {{ get_setting('contact_email') }}</span>
                                </li>
                        </ul>


                        {{-- <ul class="list-unstyled mb-3 mt-2">
                            <h4 class="fs-13 text-white text-uppercase fw-600 mb-3">
                                Address
                            </h4>

                        </ul> --}}




                    </div>
                    @if (get_setting('vendor_system_activation') == 1)
                        {{-- <div class="text-center text-md-left mt-4">
                            <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                                {{ translate('Be a Seller') }}
                            </h4>
                            <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                                {{ translate('Apply Now') }}
                            </a>
                        </div> --}}
                    @endif
                </div>
            </div>
            {{-- <hr style="border-width: 1px;opacity:40%;padding-bottom:0px;margin-bottom:0px;"> --}}



        <div class="row align-items-center"  style="min-height: 4rem;">

            <div class="col">
                <div class="text-center text-xl-center">
                    <ul class="list-inline my-4">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <li class="list-inline-item">
                                    <img src="{{ uploaded_asset($value) }}" height="27" class="mw-100">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FOOTER -->
<footer class="pt-3 pb-7 pb-xl-4  bg-black">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="text-center text-alter text-md-center fs-18 fw-300 opacity-80 roboto "  current-verison="{{get_setting("current_version")}}" style="letter-spacing:2px;">
                    {!! get_setting('frontend_copyright_text',null,App::getLocale()) !!}
                </div>
            </div>

        </div>
    </div>
</footer>


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3"  data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">Categories</span>
            </a>
        </div>

      <div class="col-auto">
        @php
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $cart = \App\Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = Session()->get('temp_user_id');
            if($temp_user_id) {
                $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
            }
        }
        @endphp
        <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 cart-toggler cart-trigger" data-toggle="class-toggle" data-target=".cart-sidebar"  data-toggle="dropdown" data-display="static">
            <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                <i class="las la-shopping-cart la-2x text-white"></i>
            </span>
                    @if(isset($cart) && count($cart) > 0)
                      <div class="d-flex text-white d-block fs-11 fw-600  opacity-100 justify-content-center">
                        <span class="d-block fs-10 fw-600  opacity-100 text-dark">Cart </span>(<span class="cart-count text-dark">{{ count($cart) }}</span>)
                      </div>
                    @else
                   <div class="d-flex text-dark d-block fs-11 fw-600  opacity-100 justify-content-center">
                    <span class="d-block fs-10 fw-600  opacity-100 text-dark">Cart </span>(<span class="cart-count text-dark">0</span>)
                   </div>
                    @endif
        </a>
        </div>
        <div class="col">
            <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>
                    @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                    @endif
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">Notifications</span>
            </a>
        </div>
        <div class="col">
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">Account</span>
                </a>
            @else
                <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">Account</span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">Account</span>
            </a>
        @endif
        </div>
    </div>
</div>
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif


<div class="mobile-category-sidebar collapse-sidebar-wrap sidebar-all z-1035">
    <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-target=".mobile-category-sidebar" data-same=".mobile-category-trigger"></div>
    <div class="collapse-sidebar bg-white overflow-hidden">
        <div class="position-relative z-1 shadow-sm">
            <div class="sticky-top z-1 p-3 border-bottom">
                <a class="d-block mr-3 ml-0" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px" height="30">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px" height="30">
                    @endif
                </a>
                <div class="absolute-top-right mt-2">
                    <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-target=".mobile-category-sidebar" data-same=".mobile-category-trigger">
                        <i class="las la-times la-2x"></i>
                    </button>
                </div>
            </div>
            <div id="sid-men">

            </div>

        </div>
    </div>
</div>
<div class="sidebar-cart">
    @php
        $total = 0;
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $cart = \App\Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = Session()->get('temp_user_id');
            if($temp_user_id) {
                $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
            }
        }
        if(isset($cart) && count($cart) > 0){
            foreach($cart as $key => $cartItem){
                $product = \App\Product::find($cartItem['product_id']);
                $total = $total + $cartItem['price'] * $cartItem['quantity'];
            }
        }
    @endphp
    {{-- <button class="cart-toggler cart-trigger bg-base-1 rounded-left text-center px-3 z-1021" type="button" data-toggle="class-toggle" data-target=".cart-sidebar" style="min-width: 72px">
        <span class="d-inline-block position-relative">
            <i class="la la-shopping-cart la-2x text-white pr-1"></i>
            <span class="absolute-top-right badge bg-white badge-inline badge-pill text-dark fw-700 mr-n1 shadow-md cart-count">
                @if(isset($cart) && count($cart) > 0)
                    {{ count($cart)}}
                @else
                    0
                @endif
            </span>
        </span>
        <span class="d-block fs-10 border-top lh-1 pt-1 border-top border-gray-500 opacity-50">{{ translate('Total') }}</span>
        <span class="d-block strong-700 c-base-1">
            <span class="total-price">{{ single_price($total) }}</span>
        </span>
    </button> --}}
    <div class="collapse-sidebar-wrap sidebar-all sidebar-right z-1035 cart-sidebar">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".cart-sidebar" data-same=".cart-trigger"></div>
        <div class="bg-white d-flex flex-column shadow-lg cart-sidebar collapse-sidebar c-scrollbar-light" id="sidebar-cart">
            @include('frontend.partials.sidebar_cart')
        </div>
    </div>
</div>
<div class="">
    <div class="collapse-sidebar-wrap sidebar-all sidebar-top z-1035 topbar-search">
        <div class="overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static"></div>
        <div class="bg-white d-flex flex-column shadow-lg   c-scrollbar-light py-4">
            <div class="container">
                <div class="position-relative">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                        <div class="d-flex position-relative align-items-center">
                            <div class="input-group">
                                <input type="text" class="border-0 form-control form-control-lg" id="search_two" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-icon" type="button" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                                        <i class="la la-times fs-20"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container container position-relative z-1020" style="top: 5px;">
            <div class="position-relative">
                <div class="typed-search-box-two stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                    <div class="search-preloader absolute-top-center">
                        <div class="dot-loader"><div></div><div></div><div></div></div>
                    </div>
                    <div class="search-nothing d-none p-3 text-center fs-16">

                    </div>
                    <div id="search-content-two" class="text-left">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

