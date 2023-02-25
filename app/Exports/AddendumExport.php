<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;


use App\Models\Addendum;

class AddendumExport implements FromQuery, WithTitle, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheets;

    function __construct($sheets) {

        $this->sheets = $sheets;
    }


    public function map($addendum): array
    {
         return[
             $addendum->kontrak_induks->nomor_kontrak_induk,
             $addendum->nomor_addendum,
             $addendum->tanggal_addendum,

         ];
    }

    public function query()
    {
        return Addendum::with('kontrak_induks:id,nomor_kontrak_induk');
    }


    public function headings(): array
    {
        return [
            'nomor_kontrak_induk',
            'nomor_addendum',
            'tanggal_addendum',
        ];
    }

    public function title(): string
    {
        return 'Tabel Addendum KHS';
    }
}
