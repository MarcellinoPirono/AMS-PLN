<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rabs()
    {
        return $this->hasMany(Rab::class, 'pejabat_id', 'id');
    }
}
