<?php

namespace App\Imports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VendorImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vendor([
            'nama_vendor'  => $row['nama_vendor'],
            'nama_direktur'   => $row['nama_direktur'],
            'alamat_kantor_1'   => $row['alamat_kantor_1'],
            'alamat_kantor_2'    => $row['alamat_kantor_2'],
            'no_rek_1'  => $row['no_rek_1'],
            'nama_bank_1'   => $row['nama_bank_1'],
            'no_rek_2'   => $row['no_rek_2'],
            'nama_bank_2'    => $row['nama_bank_2'],
            'npwp'  => $row['npwp'],
        ]);
    }
    public function rules(): array
    {
        return  [
            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'alamat_kantor_1' => 'required',

        ];


    }
}
