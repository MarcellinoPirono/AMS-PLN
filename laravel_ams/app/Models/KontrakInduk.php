<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakInduk extends Model
{
    use HasFactory;

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id');
    }
}
