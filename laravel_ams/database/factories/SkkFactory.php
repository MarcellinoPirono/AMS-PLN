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
            'pagu_skk' => '0',
            'skk_terkontrak' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ];
    }
}
