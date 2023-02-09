<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NewMultiPrkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // use Exportable;

    public function collection()
    {
        return Satuan::select('id', 'singkatan', 'kepanjangan')->get();
    }
    public function headings(): array
    {
        return [
            'satuan_id',
            'singkatan',
            'kepanjangan',
        ];
    }

    public function title(): string
    {
        return 'satuan_id';
    }
}
