<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;

class ProductService
{


    public function store(array $data): bool
    {
        $product = new Product();
        $product->fill($data);

        return $product->save();
    }

    public function destroy(Product $product): bool|null
    {
        return $product->deleteOrFail();
    }

    public function update(Product $product, array $data): bool
    {
        $product->fill($data);

        return $product->update();
    }
}
