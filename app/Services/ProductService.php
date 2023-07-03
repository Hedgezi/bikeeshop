<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use App\Models\Value;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductService
{

    public function store(array $data): bool
    {
        $product = new Product();
        $product->fill($data);
        $result = $product->save();

        $this->update($product, $data);

        return $result;
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

        $this->setVariants($data['variants'] ?? [], $product);

        $this->deleteUnusedImages($product->images, collect($data['image_id'] ?? []));
        if ($data['image'] ?? null)
        {
            $this->addImages($product['id'], $data['image']);
        }

        return $product->update();
    }

    public function setVariants(array $variants, Product $product)
    {
        foreach ($variants as $variant_data)
        {
            if ($variant_data['id'] ?? null)
            {
                $variant = Variant::find($variant_data['id']);
            }
            else
            {
                $variant = new Variant();
            }
            $variant->product_id = $product->id;
            $variant->price = $variant_data['price'];
            $variant->quantity = $variant_data['quantity'];
            $variant->save();

            $values = array_combine($variant_data['attribute_id'], $variant_data['attribute_value']);
            foreach ($values as $key => $value)
            {
                $valueObj = Value::where('variant_id', $variant->id)->where('attribute_id', $key)->first();
                if (!$valueObj)
                {
                    $valueObj = new Value();
                    $valueObj->attribute_id = $key;
                    $valueObj->variant_id = $variant->id;
                }
                $valueObj->value = $value;

                $valueObj->save();
            }

        }
    }

    public function deleteUnusedImages(Collection $oldImages, \Illuminate\Support\Collection $newImages)
    {
        $oldImageIds = $oldImages->pluck('id');

        $unusedImages = $oldImageIds->diff($newImages);
        foreach ($unusedImages as $imageId)
        {
            $image = Image::find($imageId);
            Storage::delete($image['path']);
            $image->delete();
        }
    }

    public function addImages(int $productId, array $images): void
    {
        $curTime = time();
        for ($i = 0; $i < count($images); $i++)
        {
            $imagePath = 'public/images/products';
            $path = $images[$i]->store($imagePath);

            $savedImage = new Image();
            $savedImage['path'] = $path;
            $savedImage['imageable_id'] = $productId;
            $savedImage['imageable_type'] = Product::class;
            $savedImage->save();
        }
    }

    public function getImageUrl(Product $product): ?string
    {
        $allImages = $product->images();
        if ($allImages) {
            return asset('storage/' . $allImages[0]['path']);
        }
        return null;
    }
}
