<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = ('public/images/products');
        if(!\Illuminate\Support\Facades\Storage::exists($path)){
            \Illuminate\Support\Facades\Storage::makeDirectory($path);
        }
    
        $img = storage_path('app/public/images/products');

        $dir = $img;
        $width = 800;
        $height = 600;
        $category = 'sports';
        $fullpath = true;
        $randomize = true;
        $word = 'man-ahmad-montazeri-hastam';
    
        $img = $this->faker->image($dir, $width, $height, $category,$fullpath, $randomize, $word);

        return [
            'categoryId' => ProductCategory::factory()->create()->id,
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(0, 9),
            'description' => $this->faker->sentence(),
            'image' => $img,
            'status' => 'ACTIVE'
        ];
    }
}
