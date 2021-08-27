<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $category = $request->input('category');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        if($id)
        {
            $product = product::find($id);

            if($food){
                return ResponseFormatter::success(
                    $food,
                    'Data produk berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }

        $product = product::query();

        if($name)
        {
            $product->where('name','like','%'. $name . '%');
        }

        if($category)
        {
            $product->where('name','like','%'. $category . '%');
        }

        if($price_from)
        {
            $product->where('price','>=','%', $price_from);
        }

        if($price_to)
        {
            $product->where('price','<=','%', $price_to);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
