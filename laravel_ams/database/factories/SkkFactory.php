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
            'nomor_skk' => fake()->name(),
            'uraian_skk' => fake()->name(),
            'pagu_skk' => mt_rand(10000, 2000000),
            'skk_terkontrak' => mt_rand(10000, 2000000),
            'skk_realisasi' => mt_rand(10000, 2000000),
            'skk_terbayar' => mt_rand(10000, 2000000),
            'skk_sisa' => mt_rand(10000, 2000000),
        ];
    }
}
