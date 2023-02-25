<?php

namespace App\Imports;

use App\Models\KontrakInduk;
use App\Models\Vendor;
use App\Models\Khs;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KontrakIndukImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KontrakInduk([
            'khs_id'  => $this->Tokhsid($row['jenis_khs']),
            'nomor_kontrak_induk' => $row['nomor_kontrak_induk'],
            'tanggal_kontrak_induk' => $row['tanggal_kontrak_induk'],
            'vendor_id' => $this->Tovendorid($row['nama_vendor']),
        ]);
    }

    public function Tokhsid($value) {
        $khs = Khs::where('jenis_khs', $value)->first();

        if(! $khs){
            return null;
        }

        return $khs->id;
    }

    public function Tovendorid($value) {
        $vendor = Vendor::where('nama_vendor', $value)->first();

        if(! $vendor){
            return null;
        }

        return $vendor->id;
    }

    public function rules(): array
    {
        return  [
            'jenis_khs' => 'required|exists:khs,jenis_khs',
            'nomor_kontrak_induk' => 'required',
            'tanggal_kontrak_induk' => 'required|date',
            'nama_vendor' => 'required|exists:vendors,nama_vendor',

        ];


    }

    public function customValidationMessages()
    {
        return [
            'tanggal_kontrak_induk.date' => 'Format tanggal_kontrak_induk harus yyyy-mm-dd',

        ];
    }
}
