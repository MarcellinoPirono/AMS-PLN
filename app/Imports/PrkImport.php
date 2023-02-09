<?php

namespace App\Imports;

use App\Models\Prk;
use App\Models\Skk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;




class PrkImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Prk([
        'no_skk_prk'  => $this->Toskkid($row['no_skk_prk']),
         'no_prk'   => $row['no_prk'],
         'uraian_prk'   => $row['uraian_prk'],
         'pagu_prk'  => $row['pagu_prk'],
         'prk_terkontrak'  => $row['prk_terkontrak'],
         'prk_progress'  => $row['prk_progress'],
         'prk_realisasi'  => $row['prk_realisasi'],
         'prk_terbayar'  => $row['prk_terbayar'],
         'prk_sisa'  => $row['prk_sisa'],
        ]);
    }

    public function Toskkid($value) {
        $skk = Skk::where('nomor_skk', $value)->first();

        if(! $skk){
            return null;
        }

        return $skk->id;
    }

    public function rules(): array
    {
        return  [
            'no_skk_prk' => 'required|exists:skks,nomor_skk',
            'no_prk' => 'required|unique:prks,no_prk',
            'uraian_prk' => 'required',
            'pagu_prk' => 'required|regex:/^-?[0-9]+$/',
            'prk_terkontrak' => 'required|regex:/^-?[0-9]+$/',
            'prk_terbayar' => 'required|regex:/^-?[0-9]+$/',
            'prk_realisasi' => 'required|regex:/^-?[0-9]+$/',
            'prk_sisa' => 'required|regex:/^-?[0-9]+$/',
            'prk_progress' => 'required|regex:/^-?[0-9]+$/',

        ];


    }

    public function customValidationMessages()
    {
        return [
            'no_skk_prk.required' => 'Kolom no_skk_prk tidak boleh Kosong !',
            'no_skk_prk.exists' => 'Kolom no_skk_prk harus sesuai dengan Nomor SKK di tabel SKK !',
            'no_prk.required' => 'Kolom no_prk tidak boleh Kosong !',
            'no_prk.unique' => 'Kolom no_prk SUDAH ADA !',
            'uraian_prk.required' => 'Kolom uraian_prk tidak boleh Kosong !',
            'pagu_prk.required' => 'Kolom pagu_prk tidak boleh Kosong !',
            'pagu_prk.regex' => 'Kolom pagu_prk harus Harus Numeric & tidak boleh ada (.  ,) !',
            'prk_terkontrak.required' => 'Kolom prk_terkontrak tidak boleh Kosong !',
            'prk_terkontrak.regex' => 'Kolom prk_terkontrak harus Harus Numeric & tidak boleh ada (.  ,) !',
            'prk_terbayar.required' => 'Kolom prk_terbayar tidak boleh Kosong !',
            'prk_terbayar.regex' => 'Kolom prk_terbayar harus Harus Numeric & tidak boleh ada (.  ,) !',
            'prk_realisasi.required' => 'Kolom prk_realisasi tidak boleh Kosong !',
            'prk_realisasi.regex' => 'Kolom prk_realisasi harus Harus Numeric & tidak boleh ada (.  ,) !',
            'prk_sisa.required' => 'Kolom prk_sisa tidak boleh Kosong !',
            'prk_sisa.regex' => 'Kolom prk_sisa harus Harus Numeric & tidak boleh ada (.  ,) !',
            'prk_progress.required' => 'Kolom prk_progress tidak boleh Kosong !',
            'prk_progress.regex' => 'Kolom prk_progress harus Harus Numeric & tidak boleh ada (.  ,) !',

        ];
    }
}
