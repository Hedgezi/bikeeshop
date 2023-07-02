<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use App\Models\Value;
use App\Models\Variant;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::delete(array_filter(Storage::allFiles('public'), static function ($file) {
            return !in_array($file, ['public/.gitignore', 'public/storage', 'public/blank.png']);
        }));

        User::create([
            'name' => 'root',
            'email' => 'root@root.com',
            'password' => bcrypt('rootrootroot')
        ]);
        Cart::create([
            'user_id' => 1
        ]);

        $typeBike = Type::create([
            'name' => 'Bike'
        ]);
        $typeSkateboard = Type::create([
            'name' => 'Skateboard'
        ]);
        $typeScooter = Type::create([
            'name' => 'Scooter'
        ]);

        Category::create([
            'name' => 'New arrivals',
            'description' => 'Newest arrivals from around the world'
        ]);
        Category::create([
            'name' => 'Discounts',
            'description' => 'The cheapest you can find!'
        ]);

        $attributeColor = Attribute::create([
            'name' => 'Color'
        ]);
        $attributeComputer = Attribute::create([
            'name' => 'Presence of bike computer',
            'description' => 'Is there bike computer on the bike'
        ]);
        $attributeElectro = Attribute::create([
            'name' => 'Is it electro'
        ]);
        $attributeBaby = Attribute::create([
            'name' => 'Baby chair'
        ]);
        $attributeMountain = Attribute::create([
            'name' => 'Mountain'
        ]);

        Brand::factory(3)->create();
        Product::factory(10)->create(['type_id'=> $typeBike->id]);
        Product::factory(10)->create(['type_id'=> $typeScooter->id]);
        Product::factory(10)->create(['type_id'=> $typeSkateboard->id]);
        for ($j = 1; $j < 30; $j++)
        {
            $valueFactory = Value::factory();
            Variant::factory(1)->create(['product_id' => $j + 1]);
            for ($i = 0; $i < 1; $i++)
            {
                $valueFactory->create(['variant_id' => $j + 1 - 1]);
            }
        }

        $firstVar = Variant::create([
            'price' => 2550,
            'product_id' => 1,
            "quantity" => 2,
        ]);
        $secondVar = Variant::create([
            'price' => 3000,
            'product_id' => 1,
            "quantity" => 4,
        ]);

        Value::create([
            'variant_id' => $firstVar->id,
            'attribute_id' => $attributeColor->id,
            'value' => 'Red'
        ]);
        Value::create([
            'variant_id' => $firstVar->id,
            'attribute_id' => $attributeComputer->id,
            'value' => 'No'
        ]);
        Value::create([
            'variant_id' => $secondVar->id,
            'attribute_id' => $attributeColor->id,
            'value' => 'Blue'
        ]);
        Value::create([
            'variant_id' => $secondVar->id,
            'attribute_id' => $attributeComputer->id,
            'value' => 'Yes'
        ]);
    }
}
