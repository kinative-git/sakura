<table >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Variation-Quantity</th>
            <th>Num of Sale</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{ ($key+1)}}</td>
                <td>{{ $product->getTranslation('name') }}</td>
                <td>
                    @foreach ($product->stocks as $key => $stock )
                        <span>@if($stock->variant ) {{ $stock->variant }} - @endif {{ $stock->qty_sold }} @if($key!=count($product->stocks)-1) , @endif<br></span>
                    @endforeach
                </td>
                <td>{{ $product->num_of_sale }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
