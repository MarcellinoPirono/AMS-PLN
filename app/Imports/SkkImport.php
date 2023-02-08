<?php

namespace App\Imports;

use App\Models\Skk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SkkImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Skk([
         'ai_ao'  => $row['ai_ao'],
         'nomor_skk'   => $row['nomor_skk'],
         'uraian_skk'   => $row['uraian_skk'],
         'pagu_skk'  => $row['pagu_skk'],
         'skk_terkontrak'  => $row['skk_terkontrak'],
         'skk_terbayar'  => $row['skk_terbayar'],
         'skk_realisasi'  => $row['skk_realisasi'],
         'skk_sisa'  => $row['skk_sisa'],
         'skk_progress'  => $row['skk_progress'],
        ]);
    }
}
