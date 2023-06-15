<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Barang;
use App\Models\Penjualan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\detail_penjualan>
 */
class DetailPenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penjualan_id' => $this->faker->randomElement(Penjualan::pluck('id')),
            'barang_id' => $this->faker->randomElement(Barang::pluck('id')),
            'jumlah' => fake()->numberBetween(1, 10),
            'jumlah_harga' => fake()->numberBetween(50000, 200000),
        ];
    }
}
