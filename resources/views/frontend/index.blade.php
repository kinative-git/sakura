@extends('frontend.layouts.app')

@section('content')
    {{-- Categories , Sliders . Today's deal --}}

        <div class="container-fluid" style="background-color: #eeeef0" >
            <div class="d-none d-lg-block">
                <div class="row d-flex justify-content-between pt-2">
                    @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                    {{-- <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}"> --}}
                        <div class="col mx-md-1  main-bnr d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[0]) }})">
                            <h5 class="text text-white text-uppercase opacity-100 pt-md-2 fs-18" style="letter-spacing:5px;">your lifestyle choice</h5>
                            <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}" class="btn btn-lg text-uppercase btn-black my-2 ">find your style</a>
                        </div>
                    {{-- </a> --}}
                    {{-- <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}"> --}}
                        <div class="col mx-md-1 mr-md-3 main-bnr d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[1]) }})">
                            <h5 class="text text-white text-uppercase opacity-100 pt-md-2 " style="letter-spacing:5px;">your lifestyle choice</h5>
                            <a href="{{ json_decode(get_setting('home_slider_links'), true)[1] }}" class="btn btn-lg text-uppercase  btn-black  my-2 ">find your style</a>
                        </div>
                    {{-- </a> --}}
                </div>
            </div>
            <div class="row pt-1 d-lg-none">
                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                {{-- @foreach ($slider_images as $key => $value)
                    <div class="carousel-box">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}" class="text-reset d-block">

                        </a>
                    </div>
                @endforeach --}}
               <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[0])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                    <h5 class="text text-white text-uppercase opacity-100 pt-md-2 fs-18 text-center" style="letter-spacing:5px;">your lifestyle choice</h5>
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}" class="btn btn-lg text-uppercase btn-black my-2 ">find your style</a>
               </div>
               <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[1])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                    <h5 class="text text-white text-uppercase opacity-100 pt-md-2 text-center" style="letter-spacing:5px;">your lifestyle choice</h5>
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[1] }}" class="btn btn-lg text-uppercase  btn-black  my-2 ">find your style</a>
                </div>
            </div>

        </div>

        <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center my-3">
            <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                 <div class="py-4 d-flex align-items-center justify-content-center" style=" background-image: url({{ static_asset('assets/img/backicon.png') }});
                 background-repeat: no-repeat;background-position: center;">
                     <h5 class="text text-uppercase opacity-80 pt-md-2 text-cetner fs-19 fw-700" style="letter-spacing:4px;">featured products</h5>
                 </div>
            </div>
        </div>

        <section>
            <div class="aiz-carousel half-outside-arrow dot-small-black" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2"  data-items="2" data-infinite='true' data-autoplay="false" data-dots="false">
                @foreach (\App\Product::where('featured','1')->get() as $key => $product)
                    @if ($product != null && $product->published != 0)
                        <div class="carousel-box ">
                            @include('frontend.partials.product_box_1',['product'=>$product])
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
        {{-- style=" background: url({{ static_asset('assets/img/video.jpg')}}); background-repeat: no-repeat;background-size: contain;height:350px;" --}}
        {{-- -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);
                -moz-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75); --}}
        <section class="my-5 d-none d-sm-block">
            <div class="row mb-5 ">
                <div class="col-md-2"></div>
                <div class="col d-flex"  data-toggle="modal" data-target="#video_modal">
                    <img src="{{ static_asset('assets/img/videol.png') }}" alt="">
                        <div style="position:relative;">
                            <img src="{{ static_asset('assets/img/video.jpg')}}" style="
                            box-shadow: 2px -10px 10px rgba(75, 75, 75, 0.26);"  alt="">
                            <div class="d-flex align-items-center" style="position: absolute;
                            bottom: 8px;
                            right: 16px;">
                                <span class="fs-14 roboto text-white text-uppercase mx-2">watch eid promo</span>
                                <img src="{{ static_asset('assets/img/p.png') }}" alt="">
                            </div>
                        </div>
                    <img src="{{ static_asset('assets/img/videor.png') }}" alt="">
                </div>

            </div>
        </section>
        <section class="my-5 d-lg-none">
            <div class="row mb-5 ">
                <div class="col d-flex">
                        <div style="position:relative;">
                            <img src="{{ static_asset('assets/img/video.jpg')}}" class="img-fit" style="
                            box-shadow: 2px -10px 10px rgba(75, 75, 75, 0.26);"  alt="">
                            <div class="d-flex align-items-center" style="position: absolute;
                            bottom: 8px;
                            right: 16px;">
                                <span class="fs-14 roboto text-white text-uppercase mx-2">{{ get_setting('promo_text') }}</span>
                                <img src="{{ static_asset('assets/img/p.png') }}" alt="">
                            </div>
                        </div>
                </div>

            </div>
        </section>

   {{-- banner under section  --}}
   {{-- <div class="container mt-1 mb-2">
        @if (get_setting('banner_under_cat') !=null)

            <div class="aiz-carousel gutters-5 outside-arrow dot-small-black" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="4" data-sm-items="2" data-xs-items="2" data-infinite='true' data-autoplay="true" data-dots="true" data-arrows="true">
                @php
                $featured_categories = \App\Category::whereIn('id', json_decode(get_setting('banner_under_cat')))->get();

                @endphp
                @foreach ($featured_categories as $key => $category)
                @php

                    $cat_name=$category->name
                @endphp
                            <div class="carousel-box">
                                <div class="bg-white shadow-sm p-4 mb-2">
                                    <a href="{{ route('products.category', $category->slug) }}" class="text-reset text-center">
                                        <div class="d-flex align-items-center justify-content-center caraimg" >
                                            <img
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $cat_name }}"
                                            class="lazyload   mw-100 "


                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                        </div>
                                    </a>
                                        <span class="text-truncate text-center fs-13  fw-600 d-block">{{ $cat_name }}</span>

                                </div>

                            </div>
                    @endforeach
            </div>

        @endif

    </div> --}}
    {{-- end banner under section  --}}



    {{-- flash deals  --}}
    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();

    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)

    @if(\App\Product::where('published', 1)->where('todays_deal','1')->count()>0)
        <section class="mb-3">
            <div class="container ">
                <div class="bg-white shadow-sm">
                    <div class=" d-flex flex-wrap mb-3 align-items-center border-bottom py-md-4 px-md-4 px-2 py-2">
                        {{-- for mobile  --}}
                        <h6 class="fw-600 h6  fs-14 py-1 text-center text-dark text-uppercase d-lg-none" style="margin-left: 35%;" > <img src="{{ static_asset('assets/img/flash_sale_icon.png') }}" alt="" class="mr-2"> Flash sale</h6>
                        {{-- for pc  --}}
                        <div class="d-felx align-items-center justify-content-center mr-2 d-none d-lg-block">
                            <img src="{{ static_asset('assets/img/flash_sale_icon.png') }}" alt="">
                        </div>
                        <div class="h6 fw-600 h6 mb-0  fs-14 py-1 text-center d-none d-lg-block " >
                            <span class="d-inline-block text-dark text-uppercase  ">Flash sale</span>
                        </div>
                        <div></div>
                        <div class="d-flex align-items-center ">
                            <span class="text-dark pl-3 pr-1 ml-3 opacity-70"> Offer Valid till:</span>

                            <div class="aiz-count-down  align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}">
                            </div>
                        </div>
                        <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 mt-2 mt-md-0 btn btn-sm border-primary px-5 py-3 w-100 w-md-auto text-uppercase fs-13 fw-600">View All</a>
                    </div>

                    <div class="aiz-carousel gutters-5 half-outside-arrow dot-small-black px-2" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2" data-infinite='true' data-autoplay="true" data-dots="false">
                        @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                                @php
                                    $product=App\Product::where('id',$flash_deal_product->product_id)->with('stocks')->first();
                                @endphp
                            @if ($product != null && $product->published != 0)
                                <div class="carousel-box">
                                    @include('frontend.partials.product_box_1',['product'=>$product])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </section>

    @endif
    @endif









{{-- static bottom icon banner --}}
<section class="mt-3" style="background-color: #eeeef0">
    @if(get_setting('authentic_images') != null)
    <div class="my-5">
        <div class="container ">
                <div class="row no-gutters row-cols-lg-4 row-cols-1">
                    @foreach (json_decode(get_setting('authentic_images'), true) as $key => $value)
                        <div class="col  text-center py-3 brd-stat" >
                            <img src="{{ uploaded_asset($value) }}" class= "mx-auto h-80px">
                            <span class="text-uppercase text-center fs-12  d-block fw-600">{{ json_decode(get_setting('authetic_names'), true)[$key] }}</span>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
    @endif
</section>










    {{-- Banner Section  --}}
    @if (get_setting('home_banner2_images') != null)
    <div class="mb-4">
        <div class="container-fluid" >
            <div class="row ">
                 @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp

                @foreach ($banner_2_imags as $key=>$val )

                    <div class="col-md-4 col-sm-12 tbr d-flex justify-content-center align-items-center"  style=" background: url({{ uploaded_asset($banner_2_imags[$key]) }});background-repeat: no-repeat;background-size: cover;">
                        <h5 class="text text-uppercase text-white pt-md-2 text-cetner fs-19 fw-700" style="letter-spacing:4px;">{{  json_decode(get_setting('home_banner2_text'), true)[$key]  }}</h5>
                    </div>

                @endforeach

                {{-- @foreach ($banner_2_imags as $key => $value)  --}}
                    {{-- <div class="col-xl col-md-6 @if($key==0) pr-md-1 @elseif($key==1) pl-md-1 @endif">
                        <div class="py-1">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fit lazyload w-100">
                            </a>
                        </div>
                    </div> --}}

                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    @endif

{{-- shop by cattegory --}}
<section class="mb-5">
    <div class="container">
        <div class="row my-3 d-flex flex-column">
            <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                <div class="py-4 d-flex align-items-center justify-content-center" style=" background-image: url({{ static_asset('assets/img/backicon.png') }});
                background-repeat: no-repeat;background-position: center;">
                    <h5 class="text text-uppercase opacity-80 pt-md-2 text-cetner fs-19 fw-700" style="letter-spacing:4px;">shop by category</h5>
                </div>
           </div>
           <div class="col">
               <img src="{{ static_asset('assets/img/line.PNG') }}" class="img-fit" alt="">
           </div>
        </div>
      @if(get_setting('banner_under_cat'))
      <div class="row no-gutters row-cols-lg-5 row-cols-2">
        {{-- banner_under_cat --}}
        @php
            $scats=json_decode(get_setting('banner_under_cat'));

        @endphp
        @foreach(\App\Category::whereIn('id',$scats)->get() as $cat)
            <div class="col d-flex justify-content-center align-items-center">
                <a href="{{ route('products.category',$cat->slug) }}">
                    <div class="p-0">
                        <div class="" style="position: relative">
                            <img src="{{ uploaded_asset($cat->banner) }}" class="img-fit"  alt="">
                        <div style="position: absolute;
                            bottom: 0px;
                            width:100%
                        "> <div class="py-3 bl2" ><div class="d-flex justify-content-center align-items-center roboto text-white" ><span class="fs-15 " style="letter-spacing:2px;">{{ $cat->name }}</span></div></div></div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('search') }}">
                <div class="p-0">
                    <div class="" style="position: relative">
                        <img src="{{ static_asset('assets/img/allproducts.png')}}" class="img-fit"  alt="">
                    <div style="position: absolute;
                        bottom: 0px;
                        width:100%
                    "> <div class="py-3 bl2" ><div class="d-flex justify-content-center align-items-center roboto text-white" ><span class="">All Products</span></div></div></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
      @endif
    </div>
</section>
{{-- shop by cattegory end --}}
    <div class="container-fluid my-5" >
        <div class="d-none d-lg-block">
            <div class="row d-flex justify-content-between pt-2">
                @php $slider_images = json_decode(get_setting('home_banner1_images'), true);  @endphp
                {{-- <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}"> --}}
                    <div class="col mx-md-1  main-bnr d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[0]) }});background-repeat: no-repeat;height:360px;background-size: 360px;background-size: cover;">
                        <h5 class="text text-white text-uppercase opacity-100 pt-md-2 fs-18" style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[0]  }}</h5>

                    </div>
                {{-- </a> --}}
                {{-- <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}"> --}}
                    <div class="col mx-md-1 mr-md-3 main-bnr d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[1]) }}); background-repeat: no-repeat;height:360px;background-size: 360px;background-size: cover;">
                        <h5 class="text text-white text-uppercase opacity-100 pt-md-2 " style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[1]  }}</h5>

                    </div>
                {{-- </a> --}}
            </div>
        </div>
        <div class="row pt-1 d-lg-none">
            @php $slider_images = json_decode(get_setting('home_banner1_images'), true);  @endphp
            {{-- @foreach ($slider_images as $key => $value)
                <div class="carousel-box">
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}" class="text-reset d-block">

                    </a>
                </div>
            @endforeach --}}
           <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[0])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                <h5 class="text text-white text-uppercase opacity-100 pt-md-2 fs-18 text-center" style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[0]  }}</h5>
           </div>
           <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[1])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                <h5 class="text text-white text-uppercase opacity-100 pt-md-2 text-center" style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[1]  }}</h5>
            </div>
        </div>

    </div>

<section>
 {{-- home category section  --}}
 <div id="section_home_categories"></div>

</section>


@endsection


@section('modal')
<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="video_modalLabel" aria-hidden="true" style="margin-top: 20vh;">
    <div class="modal-dialog" role="document">
          <div class="modal-content" style="background-color: #eeeef000;border:none;outline:none;">
                @if( get_setting('promo_video'))
                <div style="height: 400px;width:560px;">
                    {!!  get_setting('promo_video') !!}
                    </div>
                @else
                <h5 class="text text-orange text-center"> No Video Given..!!</h5>
                @endif
          </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });


        });
    </script>
@endsection
