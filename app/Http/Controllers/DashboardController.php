<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use App\Models\transaction;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products_count = products::count();
        $products = products::latest()->paginate(4);
        $users_count = User::count();
        $user = User::latest()->paginate(6);
        $transactions_count = transaction::count();
        $transaction = transaction::with(['order','user'])->where('payment_url', '!=', '')->latest()->paginate(6);

        return view('dashboard',[
            'products_count' => $products_count,
            'users_count' => $users_count,
            'transactions_count' => $transactions_count,
            'products' => $products,
            'users' => $user,
            'transactions' => $transaction
        ]);
    }
}
