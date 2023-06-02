<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    //
    public function index()
    {
        return view('components.fee.fee_invoice');
    }
}
