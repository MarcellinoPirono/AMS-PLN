<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skk extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function prks()
    {
        return $this->hasMany(Prk::class, 'no_skk_prk', 'id');
    }
    public function rabs()
    {
        return $this->hasMany(Rab::class, 'skk_id', 'id');
    }
}
