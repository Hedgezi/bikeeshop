<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
    public function product(): HasOneThrough
    {
        return $this->hasOneThrough(Product::class, Variant::class, 'id', 'id', 'variant_id', 'product_id');
    }
}
