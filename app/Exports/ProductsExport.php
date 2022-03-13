<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsExport implements FromView
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    public function view(): View
    {
        return view('exports.inhouse_product_sale', [
            'products' => $this->products
        ]);
    }
}
