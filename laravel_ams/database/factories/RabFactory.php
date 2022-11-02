<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rab>
 */
class RabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'skk_id' => mt_rand(1, 20),
            'prk_id' => mt_rand(1, 20),
            'kategori_id' => mt_rand(1, 20),
            'item_id' => mt_rand(1, 20),

            'pekerjaan' => fake()->name(),
            'lokasi' => fake()->text(),
            'volume' => mt_rand(1, 20),
            'isi_surat' => fake()->text(),

        ];
    }
}
