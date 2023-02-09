<?php

namespace App\Imports;

use App\Models\Skk;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class SkkImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Skk([
         'ai_ao'  => $row['ai_ao'],
         'nomor_skk'   => $row['nomor_skk'],
         'uraian_skk'   => $row['uraian_skk'],
         'pagu_skk'  => $row['pagu_skk'],
         'skk_terkontrak'  => $row['skk_terkontrak'],
         'skk_terbayar'  => $row['skk_terbayar'],
         'skk_realisasi'  => $row['skk_realisasi'],
         'skk_sisa'  => $row['skk_sisa'],
         'skk_progress'  => $row['skk_progress'],
        ]);
    }

    public function rules(): array
    {
        return  [
            'ai_ao' => 'required|exists:ai_aos,aiao',
            'nomor_skk' => 'required|unique:skks,nomor_skk',
            'uraian_skk' => 'required',
            'pagu_skk' => 'required|regex:/^-?[0-9]+$/',
            'skk_terkontrak' => 'required|regex:/^-?[0-9]+$/',
            'skk_terbayar' => 'required|regex:/^-?[0-9]+$/',
            'skk_realisasi' => 'required|regex:/^-?[0-9]+$/',
            'skk_sisa' => 'required|regex:/^-?[0-9]+$/',
            'skk_progress' => 'required|regex:/^-?[0-9]+$/',

        ];


    }

    public function customValidationMessages()
    {
        return [
            'ai_ao.required' => 'Kolom ai_ao tidak boleh Kosong !',
            'ai_ao.exists' => 'Kolom ai_ao harus berisi AI atau AO !',
            'nomor_skk.required' => 'Kolom nomor_skk tidak boleh Kosong !',
            'nomor_skk.unique' => 'Kolom nomor_skk SUDAH ADA !',
            'uraian_skk.required' => 'Kolom uraian_skk tidak boleh Kosong !',
            'pagu_skk.required' => 'Kolom pagu_skk tidak boleh Kosong !',
            'pagu_skk.regex' => 'Kolom pagu_skk harus Harus Numeric & tidak boleh ada (.  ,) !',
            'skk_terkontrak.required' => 'Kolom skk_terkontrak tidak boleh Kosong !',
            'skk_terkontrak.regex' => 'Kolom skk_terkontrak harus Harus Numeric & tidak boleh ada (.  ,) !',
            'skk_terbayar.required' => 'Kolom skk_terbayar tidak boleh Kosong !',
            'skk_terbayar.regex' => 'Kolom skk_terbayar harus Harus Numeric & tidak boleh ada (.  ,) !',
            'skk_realisasi.required' => 'Kolom skk_realisasi tidak boleh Kosong !',
            'skk_realisasi.regex' => 'Kolom skk_realisasi harus Harus Numeric & tidak boleh ada (.  ,) !',
            'skk_sisa.required' => 'Kolom skk_sisa tidak boleh Kosong !',
            'skk_sisa.regex' => 'Kolom skk_sisa harus Harus Numeric & tidak boleh ada (.  ,) !',
            'skk_progress.required' => 'Kolom skk_progress tidak boleh Kosong !',
            'skk_progress.regex' => 'Kolom skk_progress harus Harus Numeric & tidak boleh ada (.  ,) !',

        ];
    }

}
