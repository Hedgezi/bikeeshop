<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, Product $product): View
    {
        return view('products.detail', [
            'product' => $product
        ]);
    }
}
