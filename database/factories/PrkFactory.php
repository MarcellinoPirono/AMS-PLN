<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prk>
 */
class PrkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'no_skk_prk' => mt_rand(1, 20),
            'no_prk' => mt_rand(21, 200),
            'uraian_prk' => fake()->text(),
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',

        ];
    }
}
