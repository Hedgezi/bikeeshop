<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function catalogue(Request $request): View
    {
        return view('products.catalogue', [
            'products' => Product::paginate(15)
        ]);
    }
    public function show(Request $request, Product $product): View
    {
        return view('products.detail', [
            'product' => $product,
            'images' => $product->images
        ]);
    }
}
