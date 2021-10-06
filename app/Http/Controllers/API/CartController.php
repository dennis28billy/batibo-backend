<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10);
        $product_id = $request->input('product_id');

        if($id)
        {
            $cart = Carts::with(['product'])->find($id);

            if($cart){
                return ResponseFormatter::success(
                    $cart,
                    'Data keranjang berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data keranjang tidak ada',
                    404
                );
            }
        }

        $cart = Carts::with(['product'])->where('user_id', Auth::user()->id);

        if($product_id)
        {
            $cart->where('product_id', $product_id);
        }

        return ResponseFormatter::success(
            $cart->paginate($limit),
            'Data list keranjang berhasil diambil'
        );
    }

    public function addCart(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
            ]);
            
            //panggil data produk untuk ambil harga produk
            $product = products::find($request->product_id);

            $cart = Carts::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => 1,
                'total' => $product->price_after_discount,
            ]);

            $cart = Carts::with(['user'])->find($cart->id);


            return ResponseFormatter::success($cart, 'Data cart berhasil ditambahkan');

        } catch (Exception $error){
            return ResponseFormatter::error($error->getMessage(), 'Tidak berhasil menambahkan cart');
        }
    }

    public function updateCart(Request $request, $id)
    {

        $data = $request->all();

        $cart = Carts::findOrFail($id);
        $cart->update($data);

        return ResponseFormatter::success($cart, 'Cart Updated');
    }

    public function deleteCart($id)
    {

        $cart = Carts::findOrFail($id);
        $cart->delete();

        return ResponseFormatter::success($cart, 'Cart Deleted');
    }
}
