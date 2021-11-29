<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function all(Request $request)
    {   
        $id = $request->input('id');
        $limit = $request->input('limit', 10000);
        $product_id = $request->input('product_id');
        $transaction_id = $request->input('transaction_id');

        if($id)
        {
            $order = Order::with(['transaction'])->find($id);

            if($order){
                return ResponseFormatter::success(
                    $order,
                    'Data order berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data order tidak ada',
                    404
                );
            }
        }

        $order = Order::with(['product','transaction'])->where('user_id', Auth::user()->id);



        if($product_id)
        {
            $order->where('product_id', $product_id);
        }

        if($transaction_id)
        {
            $order->where('transaction_id', $transaction_id);
        }

        return ResponseFormatter::success(
            $order->paginate($limit),
            'Data list order berhasil diambil'
        );
    }

    public function addOrder(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'transaction_id' => 'required',
                'quantity' => 'required',
            ]);
            
            $product = products::find($request->product_id);

            $order = Order::create([
                'user_id' => $request->user_id,
                'transaction_id' => $request->transaction_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total' => $product->price_after_discount * $request->quantity,
            ]);

            //tampilkan order bersama transaction dan product 
            $order = Order::with(['transaction', 'product'])->find($order->id);


            return ResponseFormatter::success($order, 'Data order berhasil ditambahkan');

        } catch (Exception $error){
            return ResponseFormatter::error($error->getMessage(), 'Tidak berhasil menambahkan order');
        }
    }
}
