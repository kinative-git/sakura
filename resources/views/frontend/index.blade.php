@extends('frontend.layouts.app')

@section('content')
    {{-- Categories , Sliders . Today's deal --}}

    <div class="home-banner-area text-white pt-0px">
        <div class="container-fluid" style="padding-left:0px!important;padding-right:0px!important; ">
            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-white" data-dots="true" data-autoplay="true" data-arrows="false">
                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                @foreach ($slider_images as $key => $value)
                    <div class="carousel-box">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}" class="text-reset d-block">
                            <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- featured cats start --}}

    <section class="mt-5">
        <div class="container my-3">

            <div class="aiz-carousel half-outside-arrow dot-small-black gutters-5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2"  data-items="2" data-infinite='true' data-autoplay="false" data-dots="false">
                @foreach (\App\Category::where('featured','1')->get() as $key => $cat)

                        <div class="carousel-box ">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                               <div class="h-140">
                                <img src="{{ uploaded_asset($cat->icon) }}"  class="img-fit" alt="">
                               </div>
                                <span class="fs-14 fw-600 mx-3">{{ $cat->name }}</span>
                            </div>
                        </div>

                @endforeach
            </div>
        </div>
    </section>

    {{-- featured cats end  --}}

    {{-- featured products start --}}
        <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center my-3">
            <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                 <div class="py-4 d-flex flex-column align-items-center justify-content-center" >
                     <div class="d-flex align-items-center text-primary"><div class="line"></div><span class="fs-14 fw-500 mx-3">Picked for You</span><div class="line"></div></div>
                     <h5 class="text text-uppercase opacity-100 pt-md-2 text-cetner fs-22 fw-700" >featured products</h5>
                 </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="aiz-carousel half-outside-arrow dot-small-black gutters-5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2"  data-items="2" data-infinite='true' data-autoplay="false" data-dots="true">
                    @foreach (\App\Product::where('featured','1')->get() as $key => $product)
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box ">
                                @include('frontend.partials.product_box_1',['product'=>$product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

    {{-- featured products end  --}}

    {{-- about product start --}}
    <section class="py-lg-5 py-4 my-5 position-relative bg-white">
        <div class="container">
            <div class="row py-lg-5 d-flex align-items-center">
                <div class="col-lg-6 my-4">
                    <img src="{{ uploaded_asset(get_setting('home_about_image')) }}" class="img-fluid w-100" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="d-flex align-items-center text-primary"><span class="fs-14 fw-500 mx-3">ValueProposition</span><div class="line"></div></div>
                    <h5 class="text text-uppercase opacity-100 pt-md-2 text-cetner fs-22 fw-700" >{{ get_setting('home_about_title', null, App::getLocale()) }}</h5>
                    <h2 class="text-uppercase text-alter-6 fs-18 fw-700 my-2"></h2>
                    <div class="lh-1-9 my-4 mr-1 text-justify ">{{ get_setting('home_about', null, App::getLocale()) }}</div>

                    <a href="{{ get_setting('home_about_link',null, App::getLocale()) }}" class="btn btn-md btn-primary text-white text-uppercase fw-400 fs-12 " > {{ translate('visit shop') }} </a>
                </div>
            </div>
        </div>
        <div class="container mb-5" >
            <div class="d-none d-lg-block">
                <div class="row d-flex justify-content-between pt-2">
                    @php $slider_images = json_decode(get_setting('home_banner1_images'), true);  @endphp
                    <div class="col-md-6">
                         <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}">
                                <img src="{{ uploaded_asset($slider_images[0]) }}" class="img-fit" alt="">

                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[0] }}">
                            <img src="{{ uploaded_asset($slider_images[1]) }}" class="img-fit" alt="">

                        </a>
                   </div>

                </div>
            </div>
            <div class="row pt-1 d-lg-none">
                @php $slider_images = json_decode(get_setting('home_banner1_images'), true);  @endphp

               <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[0])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                    <h5 class="text text-white text-uppercase opacity-100 pt-md-2 fs-18 text-center" style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[0]  }}</h5>
               </div>
               <div class="col-12 d-flex flex-column justify-content-center align-items-center" style=" background: url({{ uploaded_asset($slider_images[1])}}); background-repeat: no-repeat;background-size: contain;width:100vw;height:245px;background-size: cover;">
                    <h5 class="text text-white text-uppercase opacity-100 pt-md-2 text-center" style="letter-spacing:5px;">{{ json_decode(get_setting('home_banner1_text'), true)[1]  }}</h5>
                </div>
            </div>

        </div>
    </section>

    {{-- about product end  --}}





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











<section>
 {{-- home category section  --}}
 <div id="section_home_categories"></div>

</section>

{{-- static bottom icon banner --}}
<section class="mt-3 py-4" style="background-color: #ffffff">
    @if(get_setting('authentic_images') != null)
    <div class="my-5">
        <div class="container  bg-white shadow-lg my-4">
                <div class="row no-gutters row-cols-lg-4 row-cols-1">
                    @foreach (json_decode(get_setting('authentic_images'), true) as $key => $value)
                        <div class="col  text-left py-3 px-3 d-flex flex-column  justify-content-left" >
                            <div class="h-80px">  <img src="{{ uploaded_asset($value) }}"  ></div>
                            <span  class="text-reset text-dark fw-600 fs-11  text-truncate-2" >{{ json_decode(get_setting('authetic_names'), true)[$key] }}</span>
                            <span class="text-reset text-dark fw-400 fs-11 mt-1 opacity-60  text-truncate-2">{{ json_decode(get_setting('authetic_desc'), true)[$key] }} </span>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
    @endif
</section>

{{-- big banner  --}}
<section>
    <div class="row">
        <div class="col">
            <img src="{{ uploaded_asset(json_decode(get_setting('bottom_banner'), true)) }}" class="img-fit" alt="">
        </div>
    </div>
</section>

{{-- big banner end  --}}


{{-- customer reviews begin --}}
<div class="">
    <div class="container">
        <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center my-3">
            <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                 <div class="py-4 d-flex flex-column align-items-center justify-content-center" >
                     <div class="d-flex align-items-center text-primary"><div class="line"></div><span class="fs-14 fw-500 mx-3">Satisfied Clients</span><div class="line"></div></div>
                     <h5 class="text text-uppercase opacity-100 pt-md-2 text-cetner fs-22 fw-700" >review of clients</h5>
                 </div>
            </div>
        </div>
        <div class="aiz-carousel  dot-small-black pb-5 pt-2" data-items="2" data-xl-items="2" data-lg-items="2"  data-md-items="2" data-sm-items="1" data-xs-items="1" data-dots='true' data-infinite='true'>
            @if (get_setting('customer_reviews_image') != null)
                @foreach (json_decode(get_setting('customer_reviews_image'), true) as $key => $value)
                    <div class="carousel-box p-3">
                        <div class="p-4  px-5 text-center bg-white shadow-lg">
                            <img src="{{ static_asset('assets/img/quote_icon.png') }}" class=" mb-3 mx-auto">

                            <div class="lh-1-7 font-italic mb-3 opacity-100 fs-14 fw-500"  style="color:#868686;">{{ json_decode(get_setting('customer_reviews_details'), true)[$key] }}</div>

                            <div class="mb-3 fw-700 d-flex justify-content-center align-items-center">
                                <img src="{{ uploaded_asset($value) }}" class="size-60px rounded-circle img-fit mb-3 mx-2">
                                <div class="d-flex flex-column justify-content-start text-left">
                                    <span class="">{{ json_decode(get_setting('customer_reviews_name'), true)[$key] }}</span>
                                    <span class="" style="color:#868686;" >{{ json_decode(get_setting('customer_reviews_title'), true)[$key] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


{{-- customer review end  --}}

{{-- inside our dactory  --}}


<section>
    <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center my-3">
        <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
             <div class="py-4 d-flex flex-column align-items-center justify-content-center" >
                 <div class="d-flex align-items-center text-primary"><div class="line"></div><span class="fs-14 fw-500 mx-3">Where Magic Happens</span><div class="line"></div></div>
                 <h5 class="text text-uppercase opacity-100 pt-md-2 text-cetner fs-22 fw-700" >Inside Our Factory</h5>
             </div>
        </div>
    </div>
    <div class="row d-flex  align-items-center">
        @if(get_setting('home_banner2_images') != null)
        <div class="aiz-carousel half-outside-arrow dot-small-black " data-xl-items="6" data-lg-items="6"  data-md-items="6" data-sm-items="2" data-xs-items="2"  data-items="2" data-infinite='true' data-autoplay="true" data-dots="false">
            @foreach (json_decode(get_setting('home_banner2_images'), true) as $key => $value)
                    <div class="carousel-box p-0 m-0">
                        <div class="d-flex flex-column justify-content-center align-items-center" >
                            <img src="{{ uploaded_asset($value) }}" style="height: 235px;width:100%;" alt="">
                        </div>
                    </div>

            @endforeach
        </div>

        @endif
    </div>

</section>

<section>
    <section class="py-5 my-4">
        <div class="container ">

            <div class="shadow-lg p-2 p-lg-4 bg-white">
                <div class="row aiz-carousel gutters-5 dot-small-black" data-items="7" data-xl-items="6" data-lg-items="6"  data-md-items="6" data-sm-items="2" data-xs-items="2" data-autoplay="true" data-dots="true">
                    @foreach(explode(',',get_setting('corporate_clients')) as $id)
                        <div class="carousel-box col" style="width: 100%;height:100%;">
                           <div class="d-flex justify-content-center align-items-center my-auto" >
                            <img src="{{ uploaded_asset($id) }}" >
                           </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</section>

{{-- inside oru factory --}}

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
