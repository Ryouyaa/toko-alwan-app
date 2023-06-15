<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [    
            'name' => fake()->word(),
            'jumlah_stok' => fake()->numberBetween(20, 100),
            'stok_minimum' => fake()->numberBetween(0, 50),
            'harga_beli' => fake()->numberBetween(5000, 20000),
            'harga_jual' => fake()->numberBetween(20000, 50000),
            'harga_grosir' => fake()->numberBetween(50000, 200000),
        ];
    }
}
