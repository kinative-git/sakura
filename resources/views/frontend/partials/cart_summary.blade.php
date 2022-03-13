<div class="card border-0 shadow-sm rounded">
    <div class="card-header">
        <h3 class="fs-16 fw-600 mb-0">{{translate('Summary')}}</h3>
        <div class="text-right">
            {{-- <span class="badge badge-inline badge-primary">
                {{ count($carts) }}
                Items
            </span> --}}
        </div>
    </div>

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = 0;
            @endphp
            @foreach ($carts as $key => $cartItem)
                @php
                   $verified_sellers = verified_sellers_id();
                        $product = \App\Product::where('id',$cartItem['product_id'])->where('approved', '1')->where('published', '1')->where(function($p) use ($verified_sellers){
                        $p->where('added_by', 'admin')->orWhere(function($q) use ($verified_sellers){
                            $q->whereIn('user_id', $verified_sellers);
                        });
                    })->first();
                    if($product){
                        $total_point += $product->earn_point * $cartItem['quantity'];
                    }
                @endphp
            @endforeach

            <div class="rounded px-2 mb-2 bg-soft-primary border-soft-primary border">
             Total Club point :
                <span class="fw-700 float-right">{{ $total_point }}</span>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                    $product_shipping_cost = 0;
                @endphp
                @foreach ($carts as $key => $cartItem)
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
                                $subtotal += formated_discounted_price($product,$product_stock) * $cartItem['quantity'];
                                $tax += $cartItem['tax'] * $cartItem['quantity'];
                                $product_shipping_cost = $cartItem['shipping_cost'];

                                $shipping += $product_shipping_cost;

                                $product_name_with_choice = $product->name;
                                if ($cartItem['variant'] != null) {
                                    $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                }
                            }else{

                                  // out of stock
                                  $out_of_stock=true;
                                  \App\Cart::destroy($cartItem->id);
                            }

                        }else{
                                // product no longer available
                                $not_available=true;
                                \App\Cart::destroy($cartItem->id);
                        }

                    @endphp
                    @if($out_of_stock || $not_available)

                    @else
                        <tr class="cart_item">
                            <td class="product-name">
                                {{ $product_name_with_choice }}
                                <strong class="product-quantity">
                                    × {{ $cartItem['quantity'] }}
                                </strong>
                            </td>
                            <td class="product-total text-right">
                                <span class="pl-4 pr-0">{{ single_price(formated_discounted_price($product,$product_stock)*$cartItem['quantity']) }}</span>
                            </td>
                        </tr>
                    @endif

                @endforeach
            </tbody>
        </table>

        <table class="table">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{translate('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="fw-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>

                <tr class="cart-shipping">
                    <th>{{translate('Tax')}}</th>
                    <td class="text-right">
                        <span class="font-italic">{{ single_price($tax) }}</span>
                    </td>
                </tr>

                <tr class="cart-shipping">
                    <th>{{translate('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="font-italic">{{ single_price($shipping) }}</span>
                    </td>
                </tr>

                @if (Session::has('club_point'))
                    <tr class="cart-shipping">
                        <th>{{translate('Redeem point')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price(Session::get('club_point')) }}</span>
                        </td>
                    </tr>
                @endif

                @if ($carts->sum('discount') > 0)
                    <tr class="cart-shipping">
                        <th>{{translate('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="font-italic">{{ single_price($carts->sum('discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('club_point')) {
                        $total -= Session::get('club_point');
                    }
                    if ($carts->sum('discount') > 0){
                        $total -= $carts->sum('discount');
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{translate('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ single_price($total) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @if (Session::has('club_point'))
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.remove_club_point') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="form-control">{{ Session::get('club_point')}}</div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Remove Redeem Point')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                {{--@if(Auth::user()->point_balance > 0)
                    <div class="mt-3">
                        <p>
                            {{translate('Your club point is')}}:
                            @if(isset(Auth::user()->point_balance))
                                {{ Auth::user()->point_balance }}
                            @endif
                        </p>
                        <form class="" action="{{ route('checkout.apply_club_point') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="point" placeholder="{{translate('Enter club point here')}}" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">{{translate('Redeem')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif--}}
            @endif
        @endif

        @if (Auth::check() && get_setting('coupon_system') == 1)
            @if ($carts[0]['discount'] > 0)
                <div class="mt-3">
                    <form class="" id="remove-coupon-form" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                        <div class="input-group">
                            <div class="form-control border border-2 border-primary">{{ $carts[0]['coupon_code'] }}</div>
                            <div class="input-group-append">
                                <button type="button" id="coupon-remove" class="btn btn-primary">{{translate('Change Coupon')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="" id="apply-coupon-form" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                        <div class="input-group">
                            <input type="text" class="form-control border border-2 border-primary" name="code" placeholder="{{translate('Add coupon')}}" required>
                            <div class="input-group-append">
                                <button type="button" id="coupon-apply" class="btn btn-primary">{{translate('Apply')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>
