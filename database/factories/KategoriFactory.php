<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['ATK', 'Mainan Anak', 'Kosmetik', 'Aksesoris', 'Perlengkapan Bayi', 'Alat Olahraga', 'Atribut Pramuka', 'Buku Bacaan', 'Lainnya']),
            'kode_kategori' => $this->faker->regexify('[A-Z]{3}'),
        ];
    }
}
