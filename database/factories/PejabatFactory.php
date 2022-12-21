<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PejabatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_pejabat' => fake()->name(),
            'jabatan' => fake()->text(),
            'unit_up3' => fake()->text(),
            'unit_ulp' => fake()->text(),    
        ];
    }
}
