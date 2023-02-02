<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSuratDinas extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function pejabats_pengirim(){
        return $this->belongsTo(Pejabat::class,'pengirim_id');
    }
    public function pejabats_penerima(){
        return $this->belongsTo(Pejabat::class,'penerima_id');
    }
    public function non_pos(){
        return $this->belongsTo(NonPo::class, 'non_po_id');
    }





}
