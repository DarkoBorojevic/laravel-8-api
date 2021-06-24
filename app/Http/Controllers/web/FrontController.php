<?php

namespace App\Http\Controllers\web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index() {

        $products = Product::all()->sortByDesc('id');

        return view('home')->with('products', $products);

    }
}
