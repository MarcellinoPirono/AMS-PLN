<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class KontrakIndukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomor_kontrak_induk' => fake()->text(),            
            'nama_vendor' => fake()->text(),
            // 'khs_id' => mt_rand(1,20),
        ];
    }
}
