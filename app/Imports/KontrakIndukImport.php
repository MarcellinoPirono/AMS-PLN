<?php

namespace App\Imports;

use App\Models\KontrakInduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class KontrakIndukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KontrakInduk([
            'khs_id'  => $row[1],
            'nomor_kontrak_induk' => $row[2],
            'tanggal_kontrak_induk' => '2020-04-01',
            // 'tanggal_kontrak_induk' => $row[3],
            'vendor_id' => $row[4],
        ]);
    }
}
