<table class="table aiz-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Seller</th>
            <th data-breakpoints="lg">{{ translate('Order Code') }}</th>
            <th>{{ translate('Admin Commission') }}</th>
            <th>{{ translate('Seller Earning') }}</th>
            <th data-breakpoints="lg">{{ translate('Created At') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commission_history as $key => $history)
        <tr>
            @php

                $seller=App\Seller::where('user_id',$history->seller_id)->first();

            @endphp

            <td>{{ ($key+1) }}</td>
            <td>{{ $seller->user->name }}</td>
            <td>
                @if(isset($history->order))
                    {{ $history->order->code }}
                @else
                    <span class="badge badge-inline badge-danger">
                        {{ translate('Order Deleted') }}
                    </span>
                @endif
            </td>
            <td>{{ $history->admin_commission }}</td>
            <td>{{ $history->seller_earning }}</td>
            <td>{{ $history->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
