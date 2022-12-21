<?php

namespace App\Imports;

use App\Models\RincianInduk;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportItem_SPAPP implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RincianInduk([
         'khs_id'  => $row[1],
         'kategori'   => $row[2],
         'nama_item'   => $row[3],
         'satuan_id'    => $row[4],
         'harga_satuan'  => $row[5],
        ]);
    }
}
