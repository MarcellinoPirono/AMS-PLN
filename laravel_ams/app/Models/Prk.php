<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prk extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function skks()
    {
        return $this->belongsTo(Skk::class, 'no_skk_prk', 'id');
    }

    public function rabs()
    {
        return $this->hasMany(Rab::class, 'prk_id', 'id');
    }
}
