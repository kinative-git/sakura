<div class="aiz-card-box has-transition hov-shadow-md mx-1 mb-2 mt-1 ">
        @php
        $discount_applicable = false;
        $lowest_price = $product->stocks->min('price');
        if($lowest_price == 0){
        $lowest_price=1;
        }

        $discount_percent = 0;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $discount_percent = round($product->discount);
            }
            elseif($product->discount_type == 'amount'){

                $discount_percent = round($product->discount*100/$lowest_price);
            }
        }
    @endphp

    <div class="position-relative ">
         @if($discount_percent > 0)
        <span class="badge badge-inline badge-danger absolute-top-right z-1 fs-12 text-uppercase px-2 py-1 d-inline-block h-auto" style="background:#f00">{{ $discount_percent }}% OFF</span>
        @endif
        <a href="{{ route('product', $product->slug) }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->name  }}"
                class="mw-100"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
    </div>
    <div class="px-md-3 pt-3 text-center pb-0 bg-white">
        <div class="fw-600 fs-12 lh-1-4 mb-1">
            <a href="{{ route('product', $product->slug) }}" class="text-reset text-dark text-uppercase  fw-400 fs-15 roboto  text-truncate-2" style="height:40px;">{{  $product->name  }}</a>
        </div>
        <div class="fs-13 fw-700 text-dark" >
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class=" text-uppercase text-alter  fw-400 fs-14 roboto mr-1">{{ home_base_price($product) }}</del>
            @endif
            <span class="text-uppercase text-primary fw-400 fs-14 roboto">{{ home_discounted_base_price($product) }}</span>
        </div>
        @if($product->variant_product == 1)
           <div class="d-flex align-items-center justify-content-center">

                <button type="button" class="btn text-uppercase text-primary fw-400 fs-14 roboto" onclick="showAddToCartModal({{ $product->id }})"><div class="d-flex align-items-center "><img src="{{ static_asset('assets/img/buy.png') }}" class="mx-2" alt=""><span>buy this item</span></div></button>
           </div>
        @else
        <div class="d-flex align-items-center justify-content-center">

            <button type="button" class="btn text-uppercase text-primary fw-400 fs-14 roboto" onclick="addToCart(this)" data-id="{{ $product->id }}"> <div class="d-flex align-items-center "><img src="{{ static_asset('assets/img/buy.png') }}" class="mx-2" alt=""><span>buy this item</span></div></button>
        </div>

        @endif
    </div>
    {{-- <div class="d-flex justify-content-center align-items-center bg-white">

    </div> --}}
</div>
