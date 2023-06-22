<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Barang;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lost>
 */
class LostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [   
            'barang_id' => $this->faker->randomElement(Barang::pluck('id')),
            'jumlah_stok' => fake()->numberBetween(20, 100),
            'kategori' => fake()->randomElement(['hilang', 'rusak']),
            'detail' => fake()->text(85)
        ];
    }
}
