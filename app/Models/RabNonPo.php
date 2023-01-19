<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabNonPo extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function non_pos(){
        return $this->belongsTo(NonPo::class, 'non_po_id', 'id');
    }

    public function rab_hpes(){
        return $this->hasOne(RabHpe::class, 'rab_non_po_id', 'id');
    }
}
