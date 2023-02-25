<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Vendor;



class VendorExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $sheets;


    function __construct($sheets) {

        $this->sheets = $sheets;
    }


    public function collection()
    {
        return Vendor::select('nama_vendor', 'nama_direktur', 'alamat_kantor_1', 'alamat_kantor_2', 'no_rek_1', 'nama_bank_1', 'no_rek_2',  'nama_bank_2', 'npwp')->get();

    }

    public function headings(): array
    {
        return [
            'nama_vendor',
            'nama_direktur',
            'alamat_kantor_1',
            'alamat_kantor_2',
            'no_rek_1',
            'nama_bank_1',
            'no_rek_2',
            'nama_bank_2',
            'npwp',
        ];
    }

    public function title(): string
    {
        return 'Tabel Vendor KHS';
    }
}
