<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $request->validate([

            'product_name'          => 'required|string|regex:/^[a-zA-Z0-9 ]+$/|min:2|max:255',
            'product_category'      => 'required|string|regex:/^[a-zA-Z]+$/|min:2|max:255',
            'product_description'   => 'required|string|regex:/^[a-zA-Z ]+$/|min:2|max:655',
            'product_excerpt'       => 'required|string|regex:/^[a-zA-Z ]+$/|min:2|max:155',
            'product_price'         => 'required|regex:/^[0-9]+(\\.[0-9]+)?$/',
            'product_price_low'     => 'required|regex:/^[0-9]+(\\.[0-9]+)?$/',
            'product_sale'          => 'required|string|regex:/^[a-zA-Z]+$/|min:2|max:255'

        ]);
        
        return Product::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $product = Product::find($id);

        return $product;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);

        $product->update($request->all());

        return $product;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return Product::destroy($id);

    }

    /**
     * Search the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        
        return Product::where('product_name', 'like', '%'.$name.'%')->get();

    }

}
