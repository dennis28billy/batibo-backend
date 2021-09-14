<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::latest();

        if(request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%');
        }

        return view('products.index',[
            'product' => $products->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('assets/product', 'public');
        $data['price_after_discount'] = $data['price']-($data['price']*($data['discount']/100));

        products::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(products $product)
    {
        return view('products.edit', [
            'item' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, products $product)
    {
        $data = $request->all();

        if($request->file('picturePath')){
            $data['picturePath'] = $request->file('picturePath')->store('assets/product', 'public');
        }
        
        $data['price_after_discount'] = $data['price']-($data['price']*($data['discount']/100));

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $product)
    {
        $product->delete();
        
        return redirect()->route('products.index');
    }
}
