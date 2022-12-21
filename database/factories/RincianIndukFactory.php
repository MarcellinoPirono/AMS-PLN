<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RincianInduk>
 */
class RincianIndukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_item' => fake()->text(),
            'satuan' => fake()->text(),
            'harga_satuan' => mt_rand(1, 10),
            'kategori_id' => mt_rand(1, 20),
            // 'khs_id' => mt_rand(1,20),
        ];
    }
}
