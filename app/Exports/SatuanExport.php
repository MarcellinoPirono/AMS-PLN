<?php

namespace App\Exports;

use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SatuanExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

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
