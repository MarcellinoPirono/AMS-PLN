<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

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

    // public function collection(Collection $collection)
    // {
    //     //
    // }


}
