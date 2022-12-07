<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPo extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rab_non_pos(){

        return $this->hasMany(RabNonPo::class, 'non_po_id', 'id');
    }

    public function skks(){
        return $this->belongsTo(Skk::class, 'skk_id', 'id');
    }

    public function prks(){
        return $this->belongsTo(Prk::class, 'prk_id', 'id');
    }
}
