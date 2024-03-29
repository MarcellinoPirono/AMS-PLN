<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKhs extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function satuans()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function rincian_induks()
    {
        return $this->belongsTo(RincianInduk::class, 'item_order', 'id');
    }

    public function order_pakets()
    {
        return $this->belongsTo(OrderPaket::class, 'order_paket_id', 'id');
    }
}
