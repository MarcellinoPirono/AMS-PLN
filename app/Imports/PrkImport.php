<?php

namespace App\Imports;

use App\Models\Prk;
use App\Models\Skk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PrkImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Prk([
        'no_skk_prk'  => $this->Toskkid($row['no_skk_prk']),
         'no_prk'   => $row['no_prk'],
         'uraian_prk'   => $row['uraian_prk'],
         'pagu_prk'  => $row['pagu_prk'],
         'prk_terkontrak'  => $row['prk_terkontrak'],
         'prk_progress'  => $row['prk_progress'],
         'prk_realisasi'  => $row['prk_realisasi'],
         'prk_terbayar'  => $row['prk_terbayar'],
         'prk_sisa'  => $row['prk_sisa'],
        ]);
    }

    public function Toskkid($value) {
        $skk = Skk::where('nomor_skk', $value)->first();

        if(! $skk){
            return null;
        }

        return $skk->id;
    }
}
