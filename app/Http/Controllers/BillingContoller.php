<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingContoller extends Controller
{
    public function index()
    {
        return view('billings.index');
    }
}
