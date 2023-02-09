<?php

namespace App\Exports;

use App\Models\Skk;
use App\Models\Prk;
use App\Models\AiAo;
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


use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class SkkExport implements FromQuery, WithHeadings, WithTitle, WithEvents, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $sheets;
    protected $selects;
    protected $row_count;
    protected $column_count;
    protected $results;
    // protected $skk;

    function __construct($sheets) {
        // $
        $ai_ao = AiAo::pluck('aiao')->toArray();
        $skk = Skk::all();
        // dd($skk);
        $row_count = count($skk);

        $column_count = 9;
        $selects = [
            ['ai_ao' => 'A',
            'options' => $ai_ao]
        ];

        $this->row_count = $row_count;
        $this->column_count = $column_count;
        $this->selects = $selects;
        $this->sheets = $sheets;
        // $this->skk = $skk;
    }

    public function headings(): array
    {
        return [
            'ai_ao',
            'nomor_skk',
            'uraian_skk',
            'pagu_skk',
            'skk_terkontrak',
            'skk_terbayar',
            'skk_realisasi',
            'skk_sisa',
            'skk_progress',
        ];
    }

    public function title(): string
    {
        return 'Tabel SKK';
    }

    public function collection()
    {
        return Skk::select('ai_ao', 'nomor_skk', 'uraian_skk', 'pagu_skk', 'skk_terkontrak', 'skk_terbayar', 'skk_realisasi',  'skk_sisa', 'skk_progress')->get();
    }

    public function query()
    {
        // dd(Skk::all());
        return Skk::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $row_count = $this->row_count;
                $column_count = $this->column_count;

                foreach ($this->selects as $select){
                    $drop_column = $select['ai_ao'];
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
                    // dd($validation);
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
            }
        ];
    }
}
