<?php

namespace App\Exports;

use App\Models\RincianInduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


class RincianIndukExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $sheets;
    protected $khs_id;

    function __construct($sheets, $khs_id) {
            $this->sheets = $sheets;
            $this->khs_id = $khs_id;
    }

    public function collection()
    {
        // dd($this->khs_id);

        return RincianInduk::where('khs_id',$this->khs_id)->select('khs_id', 'kategori', 'nama_item', 'satuan_id', 'harga_satuan', 'tkdn')->get();
        // return RincianInduk::all();
    }

    public function headings(): array
    {
        return [
            'khs_id',
            'kategori',
            'nama_item',
            'satuan_id',
            'harga_satuan',
            'tkdn',
        ];
        // return [
        //     'item_id',
        //     'khs_id',
        //     'kategori',
        //     'nama_item',
        //     'satuan_id',
        //     'harga_satuan',
        //     'tkdn',
        // ];
    }

    public function title(): string
    {
        return 'Tabel Item KHS';
    }
}
