<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $sheets;
    protected $khs_id;

    public function __construct(array $sheets, $khs_id)
    {
        $this->sheets = $sheets;
        $this->khs_id = $khs_id;

    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets():array
    {
        $sheets = [
            new RincianIndukExport($this->sheets[0], $this->khs_id),
            new SatuanExport($this->sheets[1]),
        ];

        return $sheets;
    }
}
