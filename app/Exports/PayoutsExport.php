<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PayoutsExport implements FromView
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function view(): View
    {
        return view('exports.payouts', [
            'payments' => $this->payments
        ]);
    }
}
