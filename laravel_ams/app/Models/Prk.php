<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function skk()
    {
        return $this->belongsTo(Skk::class, 'no_skk_prk', 'id');
    }
}
