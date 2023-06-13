<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Throwable;

class ProductService
{


    public function store(array $data): bool
    {
        $product = new Product();
        $product->fill($data);

        foreach ($data['image'] as $image)
        {
            $this->setImage($product['id'], $image);
        }

        return $product->save();
    }

    /**
     * @throws Throwable
     */
    public function destroy(Product $product): bool|null
    {
        return $product->deleteOrFail();
    }

    public function update(Product $product, array $data): bool
    {
        $product->fill($data);

        foreach ($data['image'] ?? [] as $image)
        {
            $this->setImage($product['id'], $image);
        }

        return $product->update();
    }

    public function setImage(int $productId, UploadedFile $image)
    {
        $imageName = $productId . '.' . time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public', $imageName);

        $savedImage = new Image();
        $savedImage['path'] = $imageName;
        $savedImage['product_id'] = $productId;
        $savedImage->save();
    }

    public function getImageUrl(Product $product)
    {
        $allImages = $product->images();
        if ($allImages) {
            return asset('storage/' . $allImages[0]['path']);
        }
        return null;
    }
}
