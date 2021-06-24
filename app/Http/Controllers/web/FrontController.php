<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {

        $data = Product::orderBy('id', 'desc');

        return view('home')->with('products', $data);

    }
}
