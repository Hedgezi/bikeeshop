<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Variant;

class CartService
{
    public function addVariantToCart(User $user, int $variantId)
    {
        $cart = $user->cart;
        if ($cart->items->contains('variant_id', $variantId))
        {
            $cartItem = CartItem::where('cart_id', $cart->id)->where('variant_id', $variantId)->first();
            $cartItem->quantity += 1;
            $cartItem->save();

            return $cartItem;
        }

        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'variant_id' => $variantId,
            'quantity' => 1,
            'price' => Variant::where('id', $variantId)->first()->price,
        ]);
        $cartItem->save();

        return $cartItem;
    }

    public function removeVariantFromCart(User $user, int $variantId)
    {
        $cart = $user->cart;
        $cartItem = CartItem::where('cart_id', $cart->id)->where('variant_id', $variantId)->first();

        return $cartItem->delete();
    }
}
