<?php

namespace App\Imports;

use App\Models\Addendum;
use Maatwebsite\Excel\Concerns\ToModel;

class AddendumImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Addendum([
            'kontrak_induk_id'  => $row[0],
            'nomor_addendum' => $row[1],
            'tanggal_addendum' => '2022-09-28',
        ]);
    }
}
