<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hpe extends Model
{
    use HasFactory;

    public function rabs()
    {
        return $this->belongsTo(Rab::class, 'rab_id', 'id');
    }


}
