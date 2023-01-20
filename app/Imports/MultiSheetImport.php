<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Illuminate\Validation\Rule;


class MultiSheetImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */

    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            0 => new ImportItem_SPAPP(),
            1 => new KontrakIndukImport(),
            2 => new VendorImport(),
        ];
    }
    // public function rules($rules): array
    // {
    //      $rules = [
    //         'khs_id' => 'required',
    //         'kategori' => 'required',
    //         'nama_item' => 'required',
    //         'satuan_id' => 'required',
    //         'harga_satuan' => 'required',
    //         'tkdn' => 'required',

    //     ];
    //     // dd($rules);
    //     return $rules;
    // }

    // public function collection(Collection $collection)
    // {
    //     //
    // }


}
