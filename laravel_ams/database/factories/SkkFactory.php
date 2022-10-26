<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skk>
 */
class SkkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomor_skk' => mt_rand(1, 20),
            'uraian_skk' => fake()->text(),
            'pagu_skk' => fake()->text(),
            'skk_terkontrak' => fake()->name(),
            'skk_realisasi' => fake()->name(),
            'skk_terbayar' => fake()->name(),
            'skk_sisa' => fake()->name(),
        ];
    }
}
