<?php

namespace App\Imports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;

class VendorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vendor([
            'nama_vendor'  => $row[1],
            'nama_direktur'   => $row[2],
            'alamat_kantor_1'   => $row[3],
            'alamat_kantor_2'    => $row[4],
            'no_rek_1'  => $row[5],
            'nama_bank_1'   => $row[6],
            'no_rek_2'   => $row[7],
            'nama_bank_2'    => $row[8],
            'npwp'  => $row[9],
        ]);
    }
}
