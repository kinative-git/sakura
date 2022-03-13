<table >
    <thead>
        <tr>
            <th>{{ translate('Seller Name') }}</th>
            <th data-breakpoints="lg">{{ translate('Shop Name') }}</th>
            <th data-breakpoints="lg">{{ translate('Number of Product Sale') }}</th>
            <th data-breakpoints="lg" class="text-center"> Product-
            Variation-
            Quantity</th>
            <th>{{ translate('Order Amount') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sellers as $key => $seller)
            @if($seller->user != null)
                <tr>
                    <td>{{ $seller->user->name }}</td>
                    @if($seller->user->shop != null)
                        <td>{{ $seller->user->shop->name }}</td>
                    @else
                        <td>--</td>
                    @endif
                    <td>
                        @php
                                  if($date!=null){
                                    $orders_count=\App\OrderDetail::where('seller_id', $seller->user->id)->where('delivery_status','delivered')->where('payment_status','paid')->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])))->count();
                                  }else{
                                    $orders_count=\App\OrderDetail::where('seller_id', $seller->user->id)->count();
                                  }
                               @endphp
                        {{ $orders_count }}
                    </td>
                    <td>



                               @php
                                  if($date!=null){
                                    $orders=\App\OrderDetail::where('seller_id', $seller->user->id)->where('delivery_status','delivered')->where('payment_status','paid')->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])))->get();
                                  }else{
                                    $orders=\App\OrderDetail::where('seller_id', $seller->user->id)->get();
                                  }
                               @endphp
                              @foreach ( $orders as $order)

                                    {{ $order->product->name }}-
                                    @if($order->variation)
                                        {{ $order->variation }}-
                                        @else
                                            Base
                                        @endif

                                    {{ $order->quantity }}
                                    <br>

                              @endforeach




                    </td>
                    <td>
                        @if($date!=null)
                            {{ single_price(\App\OrderDetail::where('seller_id', $seller->user->id)->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])))->sum('price')) }}
                        @else
                            {{ single_price(\App\OrderDetail::where('seller_id', $seller->user->id)->sum('price')) }}
                        @endif

                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
