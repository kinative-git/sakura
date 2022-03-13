<table >
    <thead>
        <tr>
            <th>{{ translate('Product Name') }}</th>
            <th>{{ translate('Variant-Stock') }}</th>
            <th>{{ translate('Stock') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            @php
                $qty = 0;
                foreach ($product->stocks as $key => $stock) {
                    $qty += $stock->qty;
                }
            @endphp
            <tr>
                <td>
                    {{ $product->getTranslation('name') }}

                </td>
                <td>
                @foreach ($product->stocks as $key => $stock )
                    <span>@if($stock->variant ) {{ $stock->variant }} -@endif {{ $stock->qty }} @if($key!=count($product->stocks)-1) , @endif<br></span>
                @endforeach
                </td>
                <td>{{ $qty }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
