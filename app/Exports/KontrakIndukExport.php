<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;


use App\Models\KontrakInduk;

class KontrakIndukExport implements FromQuery, WithTitle, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $sheets;

    function __construct($sheets) {

        $this->sheets = $sheets;
    }


    public function map($kontrak): array
    {
         return[
             $kontrak->khs->jenis_khs,
             $kontrak->nomor_kontrak_induk,
             $kontrak->tanggal_kontrak_induk,
             $kontrak->vendors->nama_vendor,

         ];
    }

    public function query()
    {
        return KontrakInduk::with('vendors:id,nama_vendor')->with('khs:id,jenis_khs');
    }


    public function headings(): array
    {
        return [
            'jenis_khs',
            'nomor_kontrak_induk',
            'tanggal_kontrak_induk',
            'nama_vendor',
        ];
    }

    public function title(): string
    {
        return 'Tabel Kontrak induk KHS';
    }
}
