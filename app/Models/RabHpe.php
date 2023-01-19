<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabHpe extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rab_non_pos(){
        return $this->belongsTo(RabNonPo::class, 'rab_non_po_id');
    }
}
