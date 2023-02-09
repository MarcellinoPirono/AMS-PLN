<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiPrkExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;

    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets():array
    {
        $sheets = [
            new PrkExport($this->sheets[0]),
            new SheetSkk2Export($this->sheets[1]),
        ];

        return $sheets;
    }
}
