<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hpe>
 */
class HpeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rab_id' => mt_rand(1,20),
            'harga_perkiraan' => mt_rand(1,100),
            'jumlah_harga_perkiraan'=> mt_rand(1,1000000)
        ];
    }
}
