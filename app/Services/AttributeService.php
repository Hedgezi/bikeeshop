<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Attribute;

class AttributeService
{
    public function store(array $data): bool
    {
        $attribute = new Attribute();
        $attribute->fill($data);

        return $attribute->save();
    }

    public function destroy(Attribute $attribute): bool|null
    {
        return $attribute->deleteOrFail();
    }

    public function update(Attribute $attribute, array $data): bool
    {
        $attribute->fill($data);

        return $attribute->update();
    }
}
