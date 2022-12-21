<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    public function rincian_induks()
    {
        return $this->belongsTo(RincianInduk::class, 'satuan_id', 'id');
    }

    public function order_khs()
    {
        return $this->hasMany(OrderKhs::class, 'satuan_id', 'id');
    }
}
