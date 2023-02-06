<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TembusanPoKhs extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function rabs()
    {
        return $this->belongsTo(Rab::class, 'rab_id', 'id');
    }
}
