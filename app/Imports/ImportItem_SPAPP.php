<?php

namespace App\Imports;

use App\Models\RincianInduk;
use App\Models\Satuan;
use App\Models\Khs;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class ImportItem_SPAPP implements ToModel, WithHeadingRow, WithValidation
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
            'nama_item' => 'required|unique:rincian_induks',
            'satuan_id' => 'required',
            'harga_satuan' => 'required|numeric',
            'tkdn' => 'required|numeric',

        ];


    }

    public function customValidationMessages()
    {
        return [
            'nama_item.required' => 'Kolom nama_item tidak boleh Kosong !',
            'nama_item.unique' => 'nama_item sudah ada !',
            'khs_id.required' => 'Kolom khs_id tidak boleh Kosong !',
            'kategori.required' => 'Kolom kategori tidak boleh Kosong !',
            'satuan_id.required' => 'Kolom satuan_id tidak boleh Kosong !',
            'harga_satuan.numeric' => 'Kolom harga_satuan harus numeric',
            'harga_satuan.required' => 'Kolom harga_satuan tidak boleh Kosong !',
            'tkdn.required' => 'Kolom tkdn tidak boleh Kosong !',
            'tkdn.numeric' => 'Kolom tkdn harus numeric',
        ];
    }


}
