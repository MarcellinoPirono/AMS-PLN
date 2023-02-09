<?php

namespace App\Exports;

use App\Models\Prk;
use App\Models\Skk;
// use App\Models\Satuan;
// use App\Models\Vendor;
// use App\Models\KontrakInduk;
// use App\Models\RincianInduk;
// use App\Models\Khs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
// use PHPExcel\Cell\DataValidation.php;


use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class PrkExport implements  FromQuery, WithHeadings, WithTitle, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheets;
    protected $selects;
    protected $row_count;
    protected $column_count;
    protected $results;

    function __construct($sheets) {
            // $nomor = Prk::pluck('no_prk')->take(15)->toArray();;
            $nomor = Skk::pluck('nomor_skk')->toArray();
            $prk = Prk::all();
            $row_count = count($prk);

            $column_count = 9;
            $selects = [
                ['nomor'=>'A',
                'options'=>$nomor]
            ];

            $this->row_count = $row_count;
            $this->column_count = $column_count;
            $this->selects = $selects;
            $this->sheets = $sheets;
            // $this->no_skk_prk = $no_skk_prk;
    }


    public function headings(): array
    {
        return [
            'no_skk_prk',
            'no_prk',
            'uraian_prk',
            'pagu_prk',
            'prk_terkontrak',
            'prk_progress',
            'prk_terbayar',
            'prk_realisasi',
            'prk_sisa',
        ];
    }

    public function title(): string
    {
        return 'Tabel PRK';
    }


    public function map($prk): array
    {
         return[
             $prk->skks->nomor_skk,
             $prk->no_prk,
             $prk->uraian_prk,
             $prk->pagu_prk,
             $prk->prk_terkontrak,
             $prk->prk_progress,
             $prk->prk_terbayar,
             $prk->prk_realisasi,
             $prk->prk_sisa,
         ];
    }

    public function query()
    {
        return Prk::with('skks:id,nomor_skk');
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $row_count = $this->row_count;
                $column_count = $this->column_count;

                foreach ($this->selects as $select){
                    // $drop_column = $select['nomor'];
                    // $options = $select['options'];
                    // // set dropdown list for first data row
                    // $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    // // $validation->setType(PHPExcel_Cell_DataValidation::TYPE_TEXTLENGTH );
                    // $validation->setType(DataValidation::TYPE_LIST );
                    // // $validation->setType2(PHPExcel_Cell_DataValidation::TYPE_TEXTLENGTH );
                    // $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    // $validation->setAllowBlank(false);
                    // $validation->setShowInputMessage(true);
                    // $validation->setShowErrorMessage(true);
                    // $validation->setShowDropDown(true);
                    // $validation->setErrorTitle('Input error');
                    // $validation->setError('Value is not in list.');
                    // $validation->setPromptTitle('Pick from list');
                    // $validation->setPrompt('Please pick a value from the drop-down list.');
                    // $validation->setFormula1(sprintf('"%s"',implode(',',$options)));
                    // $validation->setFormula2(256);
                    // $validation->setFormula3(255);
                    // dd($validation);
                    // clone validation to remaining rows
                    // for ($i = 2; $i <= $row_count+1; $i++) {
                    //     $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    // }
                    // set columns to autosize
                    for ($i = 1; $i <= $column_count; $i++) {
                        $column = Coordinate::stringFromColumnIndex($i);
                        $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

            },
        ];
    }
}
