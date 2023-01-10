<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Redaksi;

class SubRedaksi extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function redaksis(){
        return $this->belongsTo(Redaksi::class, 'redaksi_id', 'id');
    }

    public function rab_redaksis()
    {
        return $this->belongsTo(RabRedaksi::class, 'subdeskripsi_id', 'id');
    }

}
