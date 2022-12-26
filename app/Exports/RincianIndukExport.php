<?php

namespace App\Exports;

use App\Models\RincianInduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class RincianIndukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $khs_id;

    function __construct($khs_id) {
            $this->khs_id = $khs_id;
    }

    public function collection()
    {

        return RincianInduk::where('khs_id',$this->khs_id)->select('khs_id', 'kategori', 'nama_item', 'satuan_id', 'harga_satuan')->get();
    }

    public function headings(): array
    {
        return [
            'khs_id',
            'kategori',
            'nama_item',
            'satuan_id',
            'harga_satuan',
        ];
    }
}
