<?php

namespace App\Imports;

use App\Models\RincianInduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportItem_SPAPP implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RincianInduk([
         'khs_id'  => $row['khs_id'],
         'kategori'   => $row['kategori'],
         'nama_item'   => $row['nama_item'],
         'satuan_id'    => $row['satuan_id'],
         'harga_satuan'  => $row['harga_satuan'],
         'tkdn'  => $row['tkdn'],
        ]);
    }
}
