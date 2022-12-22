<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPekerjaan extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rincian_induks()
    {
        return $this->belongsTo(RincianInduk::class, 'id');
    }



}
