@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Seller Payments')}}</h3>
        <div class="col">
            <form action="" method="GET">
                <div class="form-group row ">
                    <div class="col-md-4">
                        @php
                            $sellers=App\Seller::all()->where('verification_status','1');

                        @endphp
                        <div>
                            <select name="seller" class="form-control text-center" id="">
                                <option value="" class="text-center">--Select Seller--</option>
                                @foreach ($sellers as $key=>$seller)
                                    <option class="text-center" value="{{ $seller->user_id }}">{{ $seller->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <input type="text" class="aiz-date-range form-control" name="date" value="{{ $date }}" placeholder="Select Date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-light" type="submit">{{ translate('Filter') }}</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-light" type="submit" value="export" name="button">{{ translate('Export') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Date')}}</th>
                    <th>{{translate('Seller')}}</th>
                    <th>{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{ translate('Payment Details') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $key => $payment)
                    @if (\App\Seller::find($payment->seller_id) != null && \App\Seller::find($payment->seller_id)->user != null)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $payment->created_at }}</td>
                            <td>
                                @if (\App\Seller::find($payment->seller_id) != null)
                                    {{ \App\Seller::find($payment->seller_id)->user->name }} ({{ \App\Seller::find($payment->seller_id)->user->shop->name }})
                                @endif
                            </td>
                            <td>
                                {{ single_price($payment->amount) }}
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $payments->links() }}
        </div>
    </div>
</div>

@endsection
