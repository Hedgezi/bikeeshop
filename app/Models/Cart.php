<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function total(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }
}
