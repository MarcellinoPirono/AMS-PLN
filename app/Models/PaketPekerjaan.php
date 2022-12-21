<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPekerjaan extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function items()
    {
        return $this->belongsTo(RincianInduk::class, 'pakerjaan_id', 'id');
    }



}
