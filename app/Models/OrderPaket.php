<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaket extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function lokasis()
    {
        return $this->belongsTo(lokasi::class, 'lokasi_id', 'id');
    }

    public function order_khs()
    {
        return $this->hasMany(OrderKhs::class, 'order_paket_id', 'id');
    }
}
