<?php

namespace App\Exports;

use App\Models\Khs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class KhsExport implements FromCollection,  WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Khs::select('id', 'jenis_khs', 'nama_pekerjaan')->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'jenis_khs',
            'nama_pekerjaan',
        ];
    }

    public function title(): string
    {
        return 'khs_id';
    }
}
