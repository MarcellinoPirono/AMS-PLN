<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemRincianInduk>
 */
class ItemRincianIndukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kategori' => fake()->name(),
            // 'khs_id' => mt_rand(1,20),
        ];
    }
}
