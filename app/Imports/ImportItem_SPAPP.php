<?php

namespace App\Imports;

use App\Models\RincianInduk;
use App\Models\Satuan;
use App\Models\Khs;
use Illuminate\Validation\Rule;
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
         'khs_id'  => $this->Tokhsid($row['khs_id']),
         'kategori'   => $row['kategori'],
         'nama_item'   => $row['nama_item'],
         'satuan_id'    => $this->ToSatuanId($row['satuan_id']),
         'harga_satuan'  => $row['harga_satuan'],
         'tkdn'  => $row['tkdn'],
        ]);
    }


    public function ToSatuanId($value) {
        $satuan = Satuan::where('singkatan', $value)->first();

        if(! $satuan){
            return null;
        }

        return $satuan->id;
    }

    public function Tokhsid($value) {
        $khs = Khs::where('jenis_khs', $value)->first();

        if(! $khs){
            return null;
        }

        return $khs->id;
    }
    public function rules(): array
    {
        return  [
            'khs_id' => 'required',
            'kategori' => 'required',
            'nama_item' => 'required',
            'satuan_id' => 'required',
            'harga_satuan' => 'required',
            'tkdn' => 'required',

        ];


    }

}
