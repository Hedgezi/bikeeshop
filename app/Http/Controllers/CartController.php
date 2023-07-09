<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index(Request $request)
    {
        return view('orders.cart', [
            'user' => $request->user(),
        ]);
    }
    public function add(AddToCartRequest $request)
    {
        if (!$this->cartService->addVariantToCart($request->user(), $request->validated()['variant_id'])) {
            throw new \Exception('Could not add item to cart');
        }
        return redirect('cart');
    }
    public function remove(RemoveFromCartRequest $request)
    {
        if (!$this->cartService->removeVariantFromCart($request->user(), $request->validated('variant_id'))) {
            throw new \Exception('Could not remove item from cart');
        }
        return redirect('cart');
    }
    public function checkout(Request $request)
    {
        dd($request->all());
        return view('orders.checkout', [
            'user' => $request->user(),
        ]);
    }
}
