<?php

namespace App\Exports;

use App\Models\CommissionHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComissionsExport implements FromView
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($commission_history)
    {
        $this->commission_history = $commission_history;
    }

    public function view(): View
    {
        return view('exports.commission_history', [
            'commission_history' => $this->commission_history
        ]);
    }
}
