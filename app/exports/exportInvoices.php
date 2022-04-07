<?php

namespace App\Exports;

use App\Model\Invoices;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class exportInvoices implements FromView
{
    public function __construct($invoices){
        $this->invoices = $invoices;
    }

    public function view(): View {
        return view('admin.exports.reports.branchCount.index', [
            'invoices' => $this->invoices
        ]);

    }
}
