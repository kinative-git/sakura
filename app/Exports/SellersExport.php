<?php

namespace App\Exports;

use App\Models\Seller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SellersExport implements FromView
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($sellers,$date)
    {
        $this->sellers = $sellers;
        $this->date=$date;
    }

    public function view(): View
    {
        return view('exports.sellers_sales', [
            'sellers' => $this->sellers,
            'date'=>$this->date
        ]);
    }
}
