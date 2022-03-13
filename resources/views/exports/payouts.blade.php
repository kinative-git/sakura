<table class="table aiz-table mb-0">
    <thead>
        <tr>
            <th data-breakpoints="lg">#</th>
            <th data-breakpoints="lg">{{translate('Date')}}</th>
            <th>{{translate('Seller')}}</th>
            <th>{{translate('Shop')}}</th>
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
                    @if (\App\Seller::find($payment->seller_id) != null)
                        <td>
                            {{ \App\Seller::find($payment->seller_id)->user->name }}
                        </td>
                        <td>
                            {{ \App\Seller::find($payment->seller_id)->user->shop->name }}
                        </td>
                    @endif

                    <td>
                        {{ single_price($payment->amount) }}
                    </td>
                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
