@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
    <section class="mb-2 pt-2 bg-alter-3">
        <div class="container-fluid bg-alter-3">
            <div class="bg-alter-3 shadow-sm rounded p-2">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 mb-3">
                        <div class="sticky-top z-3 row gutters-10">

                            @php
                                $photos = explode(',', $detailedProduct->photos);
                            @endphp
                            <div class="col-12 order-1 order-md-1">
                                <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                                    @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded" style="height: 80vh;width:50vw;">
                                            <img
                                                class="img-fit lazyload"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                    @endforeach
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box img-zoom rounded"  style="height: 80vh;width:50vw;">
                                                <img
                                                    class="img-fit lazyload"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- gallery  --}}
                          <div class="col-12 order-2 order-md-2 mt-3 mt-md-0">
                            <div class="aiz-carousel product-gallery-thumb" data-items='4' data-nav-for='.product-gallery' data-vertical='false' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>

                                @foreach ($photos as $key => $photo)
                                <div class="carousel-box c-pointer m-1 p-1 " style="height: 12vh;">
                                    <img
                                        class="lazyload mw-100 img-fit mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($photo) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                    >
                                </div>
                                @endforeach
                                @foreach ($detailedProduct->stocks as $key => $stock)
                                    @if ($stock->image != null)
                                        <div class="carousel-box c-pointer m-1 p-1" data-variation="{{ $stock->variant }}" style="height: 12vh;" >
                                            <img
                                                class="lazyload mw-100 img-fit mx-auto"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($stock->image) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                          </div>
                        </div>


                    </div>

                    <div class="col-xl-6 col-lg-6 p-5">
                        <div class="text-left ">
                            <div class="d-flex pb-md-3 mb-md-5">
                               <a href="{{ route('home') }}" class="text-alter roboto fs-16 fw-400"> <span>Home</span></a>
                                <span class="text-alter roboto fs-16 fw-400 mx-1" >/</span>

                                @if($detailedProduct->category->parentCategory !=null)
                                <a href="{{ route('products.category',$detailedProduct->category->parentCategory->slug) }}" class="text-alter roboto fs-16 fw-400"> <span>{{ $detailedProduct->category->parentCategory->name }}</span></a>
                                <span class="text-alter roboto fs-16 fw-400 mx-1">/</span>
                                @endif

                               <a href="{{ route('products.category',$detailedProduct->category->slug) }}" class="text-alter roboto fs-16 fw-400"> <span>{{ $detailedProduct->category->name }}</span></a>
                                <span class="text-alter roboto fs-16 fw-400 mx-1">/</span>

                                <span class="text-dark roboto fs-16 fw-400 d-none d-lg-block">{{ $detailedProduct->name }}</span>
                            </div>
                           <div class="d-lg-none mb-4 pb-4"> <span class="text-dark roboto fs-16 fw-400 ">{{ $detailedProduct->name }}</span></div>
                            <h5 class="text text-cetner fw-500 roboto" style="font-size: 28px">   {{ $detailedProduct->getTranslation('name') }}</h5>



                            <div class="row align-items-center">

                                @if ($detailedProduct->est_shipping_days)
                                <div class="col-auto ml">
                                    <small class="mr-2 opacity-50">{{ translate('Estimate Shipping Time')}}: </small>{{ $detailedProduct->est_shipping_days }} {{  translate('Days') }}
                                </div>
                                @endif
                            </div>

                            <hr>

                            @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))

                            <div class="row no-gutters mt-3">
                                <div class="col-sm-4  d-flex align-items-center">
                                    <div class="opacity-50 my-2 fs-17  ">{{ translate('Price')}}:</div>
                                </div>
                                <div class="col-sm-8 fw-500 roboto  d-flex align-items-center">
                                    <div class="fs-24 opacity-60">

                                            {{ home_price($detailedProduct) }}
                                            @if($detailedProduct->unit != null)
                                                <span>/{{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif

                                    </div>
                                </div>
                            </div>

                            <div class="row no-gutters my-2">
                                <div class="col-sm-4  d-flex align-items-center">
                                    <div class="opacity-50  fs-17">{{ translate('Discount Price')}}:</div>
                                </div>
                                <div class="col-sm-8 fw-500 roboto d-flex align-items-center">
                                    <div class="fs-24">
                                        <strong class="h2 fw-500 text-orange roboto">
                                            {{ home_discounted_price($detailedProduct) }}
                                        </strong>
                                        @if($detailedProduct->unit != null)
                                            <span class="opacity-70"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row no-gutters mt-3">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Price')}}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="">
                                        <strong class="h2  text-orange fw-500 roboto">
                                            {{ home_discounted_price($detailedProduct) }}
                                        </strong>
                                        @if($detailedProduct->unit != null)
                                            <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row no-gutters my-2">
                            <div class="col-sm-12  d-flex align-items-center">
                                <div class="opacity-50  fs-17 my-3">{{ translate('Short Description:')}}</div>
                            </div>
                            <div class="col-sm-12 fw-500 roboto d-flex align-items-center">
                                <div class="fs-24">
                                    <strong class="h6 fw-500 text-dark roboto">
                                        {!! $detailedProduct->description !!}
                                    </strong>

                                </div>
                            </div>
                        </div>


                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $detailedProduct->earn_point > 0)
                                <div class="row no-gutters mt-4">
                                    <div class="col-sm-2">
                                        <div class="opacity-50 my-2">{{  translate('Club Point') }}:</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="d-inline-block rounded px-2 bg-soft-primary border-soft-primary border">
                                            <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr>
                            </div>

                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters d-flex align-items-center">
                                        <div class="col-sm-3">
                                            <div class="opacity-50 fs-17 my-2">{{ translate('Select Color')}}:</div>
                                        </div>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <div class="aiz-radio-inline">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="{{ \App\Color::where('code', $color)->first()->name }}"
                                                        @if($key == 0) checked @endif
                                                    >
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2" style="border-radius: 30px!important;">
                                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color }};border-radius: 30px!important;"></span>
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                @endif
                                @if ($detailedProduct->choice_options != null)
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                    <div class="row no-gutters">
                                        <div class="col-sm-12 d-flex ">
                                            <div class="opacity-50 my-2 fs-17">Select {{ \App\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</div>
                                           @if(\App\Attribute::find($choice->attribute_id)->getTranslation('name') == 'Size' )

                                           <div class="ml-auto"><span class="text text-orange fs-18  roboto fw-600" data-toggle="modal" data-target="#exampleModal" >View Size Guide</span></div>
                                           @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="aiz-radio-inline">
                                                @foreach ($choice->values as $key => $value)
                                                <label class="aiz-megabox pl-0 mr-2">
                                                    <input
                                                        type="radio"
                                                        name="attribute_id_{{ $choice->attribute_id }}"
                                                        value="{{ $value }}"
                                                        @if($key == 0) checked @endif
                                                    >
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2 fs-17">
                                                        {{ $value }}
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    @endforeach
                                @endif



                                 {{-- Quantity + Add to cart --}}
                                <div class="row no-gutters">
                                    <div class="col-sm-2">
                                        <div class="opacity-50 my-2 fs-17">{{ translate('Quantity')}}:</div>
                                    </div>
                                    {{-- <div class="col-sm-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10">
                                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div> --}}
                                    @php
                                    $qty = 0;
                                    foreach ($detailedProduct->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                @endphp
                                {{-- <div class="avialable-amount opacity-60">
                                    @if($detailedProduct->stock_visibility_state == 'quantity')
                                    (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                    @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                        (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                    @endif
                                </div> --}}
                                    <div class="col-sm-10">
                                        @if($detailedProduct->is_wholesale==1)

                                         <div class="product-quantity d-flex align-items-center">
                                                 <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                                     <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                                         <i class="las la-minus fs-16"></i>
                                                     </button>

                                                     <input type="text" name="quantity" class="col  text-center flex-grow-1 fs-16 input-number-wholesale mx-2 fs-17" placeholder="0" value="{{ $detailedProduct->min_variant_cost[0]->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="{{ $qty }}">

                                                     <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                         <i class="las la-plus fs-16"></i>
                                                     </button>
                                                 </div>
                                                 <div class="avialable-amount opacity-60 fs-17">
                                                     @if($detailedProduct->stock_visibility_state != 'hide')
                                                     (<span id="available-quantity">{{ $qty }}{{ translate('available')}}</span> )
                                                     @endif
                                                 </div>
                                             </div>
                                         @else
                                             <div class="product-quantity d-flex align-items-center">
                                                 <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                                     <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                                         <i class="las la-minus fs-16"></i>
                                                     </button>
                                                     <input type="text" name="quantity" class="col border-0 text-center flex-grow-1 fs-20 input-number"  placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="100" style="background-color: #f3f3f3">
                                                     <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                         <i class="las la-plus fs-16"></i>
                                                     </button>
                                                 </div>
                                                 <div class="avialable-amount opacity-60 fs-17">
                                                     @if($detailedProduct->stock_visibility_state != 'hide')
                                                     (<span id="available-quantity">{{ $qty }}{{ translate('available')}}</span> )
                                                     @endif
                                                 </div>
                                             </div>
                                        @endif
                                     </div>
                                </div>

                                <hr>
                                @if($detailedProduct->is_wholesale && $detailedProduct->variant_costs->first() != null)
                                <div class="card shadow-none">
                                    <div class="card-header fs-16 fw-600">{{ translate('Wholesale Prices')}}</div>
                                    <div class="card-body p-0" id="wholesale-prices">
                                    </div>
                                </div>
                                @endif

                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <div class="opacity-50 my-2 fs-17 roboto">{{ translate('Total Price')}}:</div>
                                    </div>
                                    <div class="col-sm-10 d-flex align-items-center">
                                        <div class="product-price">
                                            <strong id="chosen_price" class="h4 fw-600 text-primary roboto">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>
                           @if($detailedProduct->is_wholesale=='1')
                                 @if (Auth::user()->customer->can_buy_wholesale == 1)
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600" onclick="addToCart()">
                                            <i class="las la-shopping-bag"></i>
                                            <span class=" d-md-inline-block"> {{ translate('Add to cart')}}</span>
                                        </button>
                                        <button type="button" class="btn btn-primary buy-now fw-600" onclick="buyNow()">
                                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                        </button>
                                        <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                                        </button>
                                    </div>
                                @else
                                    <h6 class="text text-danger">Your Account Is Not Verified Yet By Admin..!!</h6>
                                @endif
                           @else
                            <div class="mt-3">
                                        <button type="button" class="btn btn-primary mr-2 add-to-cart fw-500" onclick="addToCart()">

                                            <span class="d-md-inline-block roboto fs-14 text-uppercase" style="letter-spacing: 2px"> {{ translate('Add to cart')}}</span>
                                        </button>
                                        {{-- <button type="button" class="btn btn-primary buy-now fw-600" onclick="buyNow()">
                                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                        </button>
                                        <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                                        </button> --}}
                                    </div>
                           @endif




                            {{-- <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">

                                    <button type="button" class="btn pl-0 btn-link fw-600" onclick="addToWishList({{ $detailedProduct->id }})">
                                        {{ translate('Add to wishlist')}}
                                    </button>

                                    <button type="button" class="btn btn-link btn-icon-left fw-600" onclick="addToCompare({{ $detailedProduct->id }})">
                                        {{ translate('Add to compare')}}
                                    </button>
                                    @if(Auth::check() && \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && (\App\AffiliateOption::where('type', 'product_sharing')->first()->status || \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                        @php
                                            if(Auth::check()){
                                                if(Auth::user()->referral_code == null){
                                                    Auth::user()->referral_code = substr(Auth::user()->id.Str::random(10), 0, 10);
                                                    Auth::user()->save();
                                                }
                                                $referral_code = Auth::user()->referral_code;
                                                $referral_code_url = URL::to('/product').'/'.$detailedProduct->slug."?product_referral_code=$referral_code";
                                            }
                                        @endphp
                                        <div>
                                            <button type=button id="ref-cpurl-btn" class="btn btn-sm btn-secondary" data-attrcpy="{{ translate('Copied')}}" onclick="CopyToClipboard(this)" data-url="{{$referral_code_url}}">{{ translate('Copy the Promote Link')}}</button>
                                        </div>
                                    @endif
                                </div>
                            </div> --}}


                            @php
                                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                $refund_sticker = \App\BusinessSetting::where('type', 'refund_sticker')->first();
                            @endphp
                            {{-- @if ($refund_request_addon != null && $refund_request_addon->activated == 1 && $detailedProduct->refundable)
                                <div class="row no-gutters mt-4">
                                    <div class="col-sm-2">
                                        <div class="opacity-50 my-2">{{ translate('Refund')}}:</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <!--<a href="{{ route('returnpolicy') }}" target="_blank">-->
                                        <!--    @if ($refund_sticker != null && $refund_sticker->value != null)-->
                                        <!--        <img src="{{ uploaded_asset($refund_sticker->value) }}" height="36">-->
                                        <!--    @else-->
                                        <!--        <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">-->
                                        <!--    @endif-->
                                        <!--</a>-->
                                        <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">{{ translate('View Policy') }}</a>
                                    </div>
                                </div>
                            @endif
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- static 4 cards  --}}
    <section>
       <div class="container">
           <div class="row my-5 ">
               <div class="col-md-4 px-2" >
                   <div class="border p-3 d py-4 d-flex flex-column justify-content-center align-items-center text-center " style="height: 160px;">

                            <h5 class="text text-uppercase pt-md-2 text-cetner text-primary fs-19 fw-700" >EASY RETURN PRODUCT
                            </h5>

                                <h6 class="text  text-cetner pt-md-2 px-3 fs-16 fw-400 roboto" >Wrong product or dosent fit? We have no question asked return policy
                                </h6>

                   </div>
               </div>
               <div class="col-md-4 px-2 " >
                    <div class="border p-3  py-4 d-flex flex-column justify-content-center align-items-center  text-center" style="height: 160px;">
                        <h5 class="text text-uppercase pt-md-2 text-cetner text-primary fs-19 fw-700" >GURANTED FAST DELIVERY

                        </h5>
                       <h6 class="text  pt-md-2  text-cetner px-3  fs-16 fw-400 roboto" >Inside dhaka 4 days and outside dhaka 7 days guranteed delivery time
                        </h6>
                    </div>
                </div>
                <div class="col-md-4 px-2" >
                    <div class="border p-3   py-4 d-flex flex-column justify-content-center align-items-center  text-center" style="height: 160px;">
                         <h5 class="text text-uppercase pt-md-2 text-cetner text-primary fs-19 fw-700" >CHECK PRODUCT THEN PAY

                         </h5>
                        <h6 class="text pt-md-2 text-cetner  px-3 fs-16 fw-400 roboto" >You can open the box and check the product before paying us a penny
                        </h6>
                    </div>
                </div>

           </div>
       </div>
    </section>

    <section class="mb-4" style="background-color: #f3f3f3">
        <div class="container">

        {{-- customer review --}}
        <div class="" >
            <div class="container pt-5">
                <h5 class="text text-uppercase opacity-80 pt-md-2 text-cetner fs-20 fw-700 text-center mb-3" style="letter-spacing:4px;">customer review</h5>
                <div class="aiz-carousel gutters-10 dot-small-white pb-5 pt-3" data-items="3" data-xl-items="3" data-lg-items="2"  data-md-items="2" data-sm-items="1" data-xs-items="1" data-dots='true' data-infinite='false'>

                    @foreach ($detailedProduct->reviews as $key => $review)
                            @if($review->user != null)

                                <div class="carousel-box">
                                    <div class="text-center">
                                        <img
                                        class="size-90px rounded-circle img-fit mb-3 mx-auto"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            @if($review->user->avatar_original !=null)
                                                data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                            @else
                                                data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            @endif
                                        >
                                        <h6 class=" lh-1-7 mb-3 opacity-60">{{ $review->user->name }}</h6>

                                        <div class="media-body text-center">
                                            <div class="d-flex flex-column justify-content-center align-items-centner">
                                                <div class="fs-18 fw-600 mb-0">{{ $review->comment }}</div>
                                                <span class="rating rating-lg my-2">
                                                    @for ($i=0; $i < $review->rating; $i++)
                                                        <i class="las la-star active-y"></i>
                                                    @endfor
                                                    @for ($i=0; $i < 5-$review->rating; $i++)
                                                        <i class="las la-star"></i>
                                                    @endfor
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                </div>
            </div>
        </div>


        </div>

    </section>



    <section class="bg-white">
        @php
            $rp=filter_products(\App\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get()
        @endphp
       @if ($rp->count()>0)
            <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center mt-4 mb-2">
                <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                    <div class="py-4 d-flex align-items-center justify-content-center" style=" background-image: url({{ static_asset('assets/img/backicon.png') }});
                    background-repeat: no-repeat;background-position: center;">
                        <h5 class="text text-uppercase opacity-80 pt-md-2 text-cetner fs-22 fw-700" style="letter-spacing:4px;">related products</h5>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="bg-white rounded shadow-sm">
                    <div class="p-3">
                        <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                            @foreach ( $rp as $key => $related_product)
                            <div class="carousel-box ">
                                @include('frontend.partials.product_box_1',['product'=>$related_product])
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
       @endif
    </section>


@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(get_setting('google_login') == 1 ||
                            get_setting('facebook_login') == 1 ||
                            get_setting('twitter_login') == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (get_setting('facebook_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(get_setting('google_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('twitter_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- view size guide  --}}

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 20vh;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Size Guide</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @if($detailedProduct->size_guide)
                <div style="height: 40vh;width:100%;">
                    <img src="{{ uploaded_asset($detailedProduct->size_guide) }}" class="img-fit" alt="">
                </div>
            @else
            <h5 class="text text-orange text-center"> No Image Given..!!</h5>
            @endif
        </div>

      </div>
    </div>
  </div>





@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
    	});

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

    </script>
@endsection
