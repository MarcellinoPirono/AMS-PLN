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
        // $startingdate = $faker->dateTimeThisYear('+1 month');
        // $endingdate = strtotime('+1 Week', $startingdate->getTimeStamp());
        return [
            'nomor_po' => mt_rand(1, 20),
            'tanggal_po' => fake()->date(),
            'skk_id' => mt_rand(1, 20),
            'prk_id' => mt_rand(1, 20),
            // 'kategori_id' => mt_rand(1, 2),
            // 'item_id' => mt_rand(1, 7),
            'nomor_kontrak_induk' => mt_rand(1, 2),
            'total_harga' => mt_rand(50000, 2000000),
            'addendum_id' => mt_rand(1, 3),
            'pejabat_id' => mt_rand(1, 2),
            'vendor_id' => mt_rand(1, 2),
            'startdate' => fake()->date(),
            'enddate' => fake()->date(),
            'pekerjaan' => fake()->name(),
            'lokasi' => fake()->text(),
            'pengawas' => fake()->text(),
            // 'volume' => mt_rand(1, 200),
            // 'isi_surat' => fake()->text(),

        ];
    }
}
