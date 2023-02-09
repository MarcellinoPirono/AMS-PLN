<?php

namespace App\Exports;

use App\Models\Skk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class SheetSkk2Export implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Skk::select('nomor_skk')->get();
    }
    public function headings(): array
    {
        return [
            'no_skk_prk',
            // 'uraian_skk',
        ];
    }

    public function title(): string
    {
        return 'no_skk_prk';
    }
}
