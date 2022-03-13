@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Seller Based Selling Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('seller_sale_report.index') }}" method="GET">
                    <div class="form-group row ">
                        <label class="col-md-3 col-form-label">{{translate('Sort by verificarion status')}} :</label>
                        <div class="col-md-3">
                            <select class="from-control aiz-selectpicker" name="verification_status" required>
                               <option value="1" @if($sort_by == '1') selected @endif>{{ translate('Approved') }}</option>
                               <option value="0" @if($sort_by == '0') selected @endif>{{ translate('Non Approved') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                                <input type="text" class="aiz-date-range form-control" name="date" value="{{ $date }}" placeholder="Select Date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-light" type="submit" value="export" name="button">{{ translate('Export') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Seller Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Shop Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Number of Product Sale') }}</th>
                            <th data-breakpoints="lg" class="text-center">Details</th>
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
                                        <table>
                                           <thead>
                                                <th>Product</th>
                                                <th>Variation</th>
                                                <th>Quantity</th>
                                           </thead>
                                           <tbody>
                                               @php
                                                  if($date!=null){
                                                    $orders=\App\OrderDetail::where('seller_id', $seller->user->id)->where('delivery_status','delivered')->where('payment_status','paid')->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])))->get();
                                                  }else{
                                                    $orders=\App\OrderDetail::where('seller_id', $seller->user->id)->get();
                                                  }
                                               @endphp
                                              @foreach ( $orders as $order)
                                                <tr>
                                                    <td>{{ $order->product->name }}</td>
                                                    <td>@if($order->variation)
                                                        {{ $order->variation }}
                                                        @else
                                                            Base
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->quantity }}</td>
                                                </tr>
                                              @endforeach
                                           </tbody>

                                        </table>
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
                <div class="aiz-pagination mt-4">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
