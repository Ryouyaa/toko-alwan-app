<?php

namespace Database\Factories;

use App\Models\Kategori;
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
            'kode_barang' => $this->faker->regexify('[A-Z0-9]{6}'),
            'kategori_id' => $this->faker->randomElement(Kategori::pluck('id')),
            'satuan' => fake()->randomElement(['pcs', 'lusin', 'kodi', 'gross', 'rim'])
        ];
    }
}
