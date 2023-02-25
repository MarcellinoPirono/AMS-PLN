<?php

namespace App\Imports;

use App\Models\Addendum;
use App\Models\KontrakInduk;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AddendumImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Addendum([
            'kontrak_induk_id'  => $this->Tokontrak($row['nomor_kontrak_induk']),
            'nomor_addendum' => $row['nomor_addendum'],
            'tanggal_addendum' => $row['tanggal_addendum'],
        ]);
    }
    public function Tokontrak($value) {
        $kontrak = KontrakInduk::where('nomor_kontrak_induk', $value)->first();

        if(! $kontrak){
            return null;
        }

        return $kontrak->id;
    }

    public function rules(): array
    {
        return  [
            'nomor_kontrak_induk' => 'required|exists:kontrak_induks,nomor_kontrak_induk',
            'nomor_addendum' => 'required',
            'tanggal_addendum' => 'required|date',

        ];


    }

    public function customValidationMessages()
    {
        return [
            'tanggal_addendum.date' => 'Format tanggal_addendum harus yyyy-mm-dd',

        ];
    }
}
