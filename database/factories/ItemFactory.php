<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'stock_quantity' => $this->faker->numberBetween(1, 100),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000),
            'location' => $this->faker->word(),
            'condition' => $this->faker->randomElement(['baik', 'rusak', 'perlu_perbaikan']),
            'purchase_date' => $this->faker->date(),
            'warranty_expiry' => $this->faker->date(),
            'status' => $this->faker->randomElement(['tersedia', 'dipinjam', 'dikeluarkan']),
        ];
    }
}
