<?php

namespace App\Exports;

use App\Models\RincianInduk;
use App\Models\Satuan;
use App\Models\Khs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;


use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class RincianIndukExport implements FromQuery, WithHeadings, WithTitle, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $sheets;
    protected $khs_id;
    protected $selects;
    protected $row_count;
    protected $column_count;
    protected $results;

    function __construct($sheets, $khs_id) {
            // $
            $satuan = Satuan::pluck('singkatan')->toArray();
            $khss = Khs::pluck('jenis_khs')->toArray();
            $khs = RincianInduk::where('khs_id', $khs_id)->get();
            $row_count = count($khs);
            $column_count = 7;
            $selects = [
                ['satuan'=>'D',
                'options'=>$satuan]
            ];

            $this->row_count = $row_count;
            $this->column_count = $column_count;
            $this->selects = $selects;
            $this->sheets = $sheets;
            $this->khs_id = $khs_id;
    }

    // public function collection()
    // {
    //     // dd($this->khs_id);
    //     $this->results = $this->getActionItems();

    //     return $this->results;

    //     // return RincianInduk::where('khs_id',$this->khs_id)->select('khs_id', 'kategori', 'nama_item', 'satuan_id', 'harga_satuan', 'tkdn')->get();
    //     // return RincianInduk::all();
    // }

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
    }

    public function title(): string
    {
        return 'Tabel Item KHS';
    }

    // public function collection()
    // {
    //     return collect([]);
    // }

    public function map($item): array
    {
         return[
             $item->khs->jenis_khs,
             $item->kategori,
             $item->nama_item,
             $item->satuans->singkatan,
             $item->harga_satuan,
             $item->tkdn,
         ];
    }

    public function query()
    {
        return RincianInduk::with('satuans:id,singkatan')->with('khs:id,jenis_khs')->where('khs_id',$this->khs_id);
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                // dd($this->selects);
                // dd($this->row_count);
                $row_count = $this->row_count;
                $column_count = $this->column_count;
                foreach ($this->selects as $select){
                    $drop_column = $select['satuan'];
                    $options = $select['options'];
                    // set dropdown list for first data row
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST );
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick from list');
                    $validation->setPrompt('Please pick a value from the drop-down list.');
                    $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                    // clone validation to remaining rows
                    for ($i = 2; $i <= $row_count+1; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // set columns to autosize
                    for ($i = 1; $i <= $column_count; $i++) {
                        $column = Coordinate::stringFromColumnIndex($i);
                        $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

            },
        ];
    }




    // public function registerEvents(): array
    // {
    //     return [
    //         // handle by a closure.
    //         AfterSheet::class => function(AfterSheet $event) {

    //             // get layout counts (add 1 to rows for heading row)
    //             $row_count = $this->results->count() + 1;
    //             $column_count = count($this->results[0]->toArray());

    //             // set dropdown column
    //             $drop_column = 'G';

    //             // set dropdown options
    //             $options = [
    //                 'option 1',
    //                 'option 2',
    //                 'option 3',
    //             ];

    //             // set dropdown list for first data row
    //             $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
    //             $validation->setType(DataValidation::TYPE_LIST );
    //             $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
    //             $validation->setAllowBlank(false);
    //             $validation->setShowInputMessage(true);
    //             $validation->setShowErrorMessage(true);
    //             $validation->setShowDropDown(true);
    //             $validation->setErrorTitle('Input error');
    //             $validation->setError('Value is not in list.');
    //             $validation->setPromptTitle('Pick from list');
    //             $validation->setPrompt('Please pick a value from the drop-down list.');
    //             $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

    //             // clone validation to remaining rows
    //             for ($i = 3; $i <= $row_count; $i++) {
    //                 $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
    //             }

    //             // set columns to autosize
    //             for ($i = 1; $i <= $column_count; $i++) {
    //                 $column = Coordinate::stringFromColumnIndex($i);
    //                 $event->sheet->getColumnDimension($column)->setAutoSize(true);
    //             }
    //         },
    //     ];
    // }
}
