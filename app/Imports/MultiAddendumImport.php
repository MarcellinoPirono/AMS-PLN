<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Illuminate\Validation\Rule;

class MultiAddendumImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            0 => new AddendumImport(),

        ];
    }
}
