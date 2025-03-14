<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // data dummy hanya utk contoh
        $transactions = [
            ['id' => 1, 'customer' => 'Aqueena', 'total' => 50000, 'status' => 'Paid'],
            ['id' => 2, 'customer' => 'Regita', 'total' => 75000, 'status' => 'Unpaid'],
        ];

        return view('transactions.index', compact('transactions'));
    }
}
