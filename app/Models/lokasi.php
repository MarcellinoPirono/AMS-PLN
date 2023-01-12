<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function rabs()
    {
        return $this->belongsTo(Rab::class, 'rab_id', 'id');
    }

    public function order_pakets()
    {
        return $this->hasMany(OrderPaket::class, 'lokasi_id', 'id');
    }
}
