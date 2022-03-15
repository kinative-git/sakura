@if(get_setting('topbar_banner') != null)
{{-- <div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div> --}}
@endif
<!-- Top Bar -->
<div class=" bg-primary  z-1  ">
    <div class="container">
        <div class="row align-items-center py-10px text-white fs-12 fw-300">
            <div class="col-6 col-lg-3  ">
               <span class="roboto">Hotline: {{ get_setting('topbar_call_number') }}</span>
            </div>
            <div class="col-12 col-lg-6 text-center d-none d-lg-block ml-auto">
                <div class="text-center fs-12  fw-300">
                    {{ get_setting('topbar_left') }}

                </div>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-end">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center roboto">
                    <li  class="list-inline-item  "> <a href="{{ get_setting('topbar_about_us') }}" class="text-white ">Support</a> </li>
                    <li class="mr-1">|</li>
                    <li  class="list-inline-item "><a href="{{get_setting('store_location') }}" class="text-white">FAQ</a></li>
                    <li class="mr-1 d-none d-lg-block">|</li>
                    <li class="list-inline-item ">
                        <div class=" d-none d-lg-block">
                            @auth
                                @if(isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="text-reset fs-12 d-inline-block">{{ translate('My Panel')}}</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="text-reset fs-12 d-inline-block">{{ translate('My Panel')}}</a>
                                @endif
                                    / <a href="{{ route('logout') }}" class="text-reset fs-12 d-inline-block">{{ translate('Logout')}}</a>
                            @else
                                <a href="{{ route('user.login') }}" class="text-reset fs-12 d-inline-block">{{ translate('Login')}}</a>
                                / <a href="{{ route('user.registration') }}" class="text-reset fs-12 d-inline-block">{{ translate('Sign Up')}}</a>
                            @endauth
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->

<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif bg-black shadow-md" >
    <div class="position-relative logo-bar-area z-1">
        <div class=" text-white pt-0 mt-0">
            <div class="container">

               <div class="row d-felx align-items-center" >
                    <div class="col-md-2 d-flex align-items-center d-flex justify-content-between">
                        <a class="d-block py-5px " href="{{ route('home') }}">
                            @php
                                $header_logo = get_setting('header_logo');
                            @endphp
                            @if($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 my-2 h-md-auto h-40px" >
                            @else
                                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-15px" height="15">
                            @endif
                        </a>
                        <div class=" h-100 d-lg-none ml-1  mt-md-2 ml-md-2 social" id="wishlist">
                            {{-- <a class="p-1 d-lg-none  text-primary   mt-2 mr-2" href="javascript:void(0);" > --}}
                                <a href="javascript:void(0);" class="btn btn-icon btn-circle btn-primary text-alter-2 fw-800 src-btn left-half-circle  right-half-circle text-center" style="height: 2.45rem;width:2.45rem;"  data-toggle="class-toggle" data-target=".topbar-search">
                                    <i class="la la-search la-flip-horizontal fs-23 fw-700"></i>
                                </a>
                                {{-- <img  src="{{ static_asset('assets/img/magni.png') }}" alt="" > --}}
                            {{-- </a> --}}

                        </div>
                    </div>
                    <div class="col-md-3 d-none d-lg-block">
                        <div class="flex-grow-1 front-header-search d-flex align-items-center mr-2 " style="background-color: black;width:340px;margin-left:-1rem;" >
                            <div class="position-relative flex-grow-1   src-bar ">
                                <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                            <button class="btn px-0 mx-0 text-white" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                        </div>
                                        <div class="d-none d-lg-block  d-flex flex-grow-1 rounded-pill border border-primary overflow-hidden" style="height: 2.45rem;">
                                            <input type="text" id="search" name="q" class="form-control left-half-circle  right-half-circle p-3 " placeholder="{{ translate('Search Item...') }}" name="email" required style="outline: none!important;border:0px!important;background-color:rgba(255, 255, 255, 0.014);color:rgb(209, 209, 209);">
                                        </div>
                                        <div class=" " style="margin-left: -2.3rem;">
                                            <button class="btn btn-icon btn-circle btn-primary text-alter-2 fw-800 src-btn left-half-circle  right-half-circle" style="height: 2.45rem;width:2.45rem;" type="submit">
                                                <i class="la la-search la-flip-horizontal fs-23 fw-700"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 100px">
                                    <div class="search-preloader absolute-top-center">
                                        <div class="dot-loader"><div></div><div></div><div></div></div>
                                    </div>
                                    <div class="search-nothing d-none p-3 text-center fs-16">

                                    </div>
                                    <div id="search-content" class="text-left">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @if ( get_setting('header_menu_labels') !=  null )
                        <div class="col-md-7 d-none d-lg-block  pl-md-0">
                            @php
                                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                                    $current_route = "https://";
                                else
                                    $current_route = "http://";
                                 $current_route.=$_SERVER['HTTP_HOST'];
                                 $current_route.=$_SERVER['REQUEST_URI'];
                                //  dd($current_route);
                            @endphp
                                <ul class="list-inline mb-0 pl-0  pt-1 mobile-hor-swipe text-center d-flex justify-content-end align-items-center">
                                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                    <li class="list-inline-item mr-0 ml-0 @if($key==count(json_decode( get_setting('header_menu_labels'), true))-1) border-right border-primary @endif">

                                            <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-13  px-md-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase @if($current_route== json_decode( get_setting('header_menu_links'), true)[$key]) active @endif">
                                                {{ $value }}
                                            </a>
                                    </li>
                                    @endforeach
                                    <div class="px-1 pl-3 h-100  d-none d-lg-block">
                                        <div class="d-flex align-items-center text-orange h-100 cart-toggler cart-trigger bg-base-1 rounded-left text-center z-1021 social"  type="button" data-toggle="class-toggle" data-target=".cart-sidebar"  data-toggle="dropdown" data-display="static" style="margin-top: -2px;">
                                            <div class="position-relative">
                                              {{-- <img src="{{ static_asset('assets/img/cart.png') }}" class="mt-md-2" alt="" > --}}
                                              <a class="p-1 d-block border-gray-700 text-white fs-24" href="javascript:void(0);">
                                                <i class="las la-shopping-cart "></i>
                                            </a>

                                                <span class="absolute-top-right" style="top: 3px;right: -5px;">
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
                                                    @php
                                                        $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                                                    @endphp

                                                    @if($count>0)
                                                        <span class="badge badge-inline badge-pill text-white cart-count shadow-md " style="width: 16px;height: 16px;font-size: 8px;background-color:var(--primary);">{{ $count}}</span>
                                                    @else
                                                        <span class="badge badge-inline badge-pill text-white cart-count shadow-md " style="width: 16px;height: 16px;font-size: 8px;background-color:var(--primary);">0</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        @endif



                        {{-- <div class="d-lg-none ml-auto mr-0">
                            <a class="p-1 d-block border-gray-700 text-white border rounded mt-2" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                                <i class="las la-search la-flip-horizontal la-2x"></i>
                            </a>
                        </div> --}}




                </div>
            </div>
        </div>
    </div>

</header>

<!--white nav bar-->

<style>
    /* Dropdown Button */
.dropbtn {

}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {

  display: none;
  position: absolute;
  background-color: white;
  border: 1px white!important;
  border-radius: 3px;
  min-width: 200px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1030!important;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #123798;color: white;}
.dropdown-content a:hover .dropdown-content{display: block;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */

</style>

