<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $product_id = $request->input('product_id');
        $status = $request->input('status')

        if($id)
        {
            $product = transaction::with(['product', 'user']);

            if($transaction){
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaction berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data transaction tidak ada',
                    404
                );
            }
        }

        $transaction = transaction::with(['food', 'user'])->where('user_id',Auth::user()->id);

        if($product_id)
        {
            $transaction->where('name', $product_id);
        }

        if($status)
        {
            $transaction->where('name', $status);
        }

        if($category)
        {
            $transaction->where('name','like','%'. $category . '%');
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }
}
