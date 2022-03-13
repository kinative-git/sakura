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
<div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2 bg-white sticky-top position-sticky">
    <h5 class="mb-0 h6 strong-600">
        <i class="la la-shopping-cart fs-20"></i>
        @if(isset($cart) && count($cart) > 0)
        <span class="">{{ count($cart)}} Item(s)</span>
        @else
            <span class="">0 Item(s)</span>
        @endif
    </h5>
    <button class="btn btn-icon" data-toggle="class-toggle" data-target=".cart-sidebar"><i class="la la-times fs-24"></i></button>
</div>
@php
    $total = 0;
@endphp
@if(isset($cart) && count($cart) > 0)
    <div class="p-3 flex-grow-1">
        @foreach($cart as $key => $cartItem)
            @php
                $out_of_stock=false;
                $not_available=false;

                $verified_sellers = verified_sellers_id();
                $product = \App\Product::where('id',$cartItem['product_id'])->where('approved', '1')->where('published', '1')->where(function($p) use ($verified_sellers){
                $p->where('added_by', 'admin')->orWhere(function($q) use ($verified_sellers){
                    $q->whereIn('user_id', $verified_sellers);
                });
                })->first();
                if($product){
                    $product_variation = $cartItem['variation'];

                    $product_stock = $product->stocks->where('variant', $product_variation)->first();

                    if($product_stock->qty >= $cartItem['quantity']){
                        $total = $total + formated_discounted_price($product,$product_stock)*$cartItem['quantity'];
                    }else{
                        // out of stock
                        $out_of_stock=true;
                    }

                }else{
                    // product no longer available
                    $not_available=true;
                    \App\Cart::destroy($cartItem->id);
                }
            @endphp
            @if ( $out_of_stock || $not_available)
                @if ($out_of_stock)
                    <div class="cart-item d-flex align-items-center">
                        <div class="flex-shrink-0 mr-3">
                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="mw-100 size-60px" width="60">
                        </div>
                        <div class="flex-grow-1 minw-0">
                            <div class="fs-13 text-truncate fw-600">{{ $product->getTranslation('name') }}</div>
                            <small><span class="text text-info">( {{ $out_of_stock?" Not Enough Stock autometically will be removed from cart ":"Product Not Available" }} )</span></small>

                            <div class="my-1 c-base-1 fw-600">{{ single_price(formated_discounted_price($product,$product_stock)) }} x {{ $cartItem['quantity'] }}</div>
                            <div class="d-flex align-items-center">
                                <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="minus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" @if( $cartItem['quantity'] == 1) disabled @endif style="width: 30px;height: 30px;padding: 5px;">
                                    <i class="las la-minus"></i>
                                </button>
                                <span class="mx-3 qty">{{ $cartItem['quantity'] }}</span>
                                <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="plus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" style="width: 30px;height: 30px;padding: 5px;">
                                    <i class="las la-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="ml-3">
                            <button class="btn btn-default btn-icon btn-sm border" onclick="removeFromCart({{ $cartItem['id'] }})"><i class="la la-trash fs-18"></i></button>
                        </div>
                    </div>

                @endif

            @else
                <div class="cart-item d-flex align-items-center">
                    <div class="flex-shrink-0 mr-3">
                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="mw-100 size-60px" width="60">
                    </div>
                    <div class="flex-grow-1 minw-0">
                        <div class="fs-13 text-truncate fw-600">{{ $product->getTranslation('name') }}</div>


                        <div class="my-1 c-base-1 fw-600">{{ single_price(formated_discounted_price($product,$product_stock)) }} x {{ $cartItem['quantity'] }}</div>
                        <div class="d-flex align-items-center">
                            <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="minus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" @if( $cartItem['quantity'] == 1) disabled @endif style="width: 30px;height: 30px;padding: 5px;">
                                <i class="las la-minus"></i>
                            </button>
                            <span class="mx-3 qty">{{ $cartItem['quantity'] }}</span>
                            <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="plus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" style="width: 30px;height: 30px;padding: 5px;">
                                <i class="las la-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ml-3">
                        <button class="btn btn-default btn-icon btn-sm border" onclick="removeFromCart({{ $cartItem['id'] }})"><i class="la la-trash fs-18"></i></button>
                    </div>
                </div>

            @endif
        @endforeach
    </div>
    <div class="bg-white border-top px-3 py-2 sticky-bottom position-sticky">
        <a href="{{ route('home') }}" class="btn btn-link btn-block py-1">{{ translate('Back to shopping') }}</a>
        @auth
            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-block">
                <span>Checkout</span>
                <span class="ml-2">({{ single_price($total) }})</span>
            </a>
        @else
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#GuestCheckout">
                <span>Checkout</span>
                <span class="ml-2">({{ single_price($total) }})</span>
            </button>
        @endauth
    </div>
@else
    <div class="p-3 flex-grow-1 d-flex align-items-center text-center">
        <h4>Your shopping bag is empty. Start shopping</h4>
    </div>
@endif
