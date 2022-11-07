<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianInduk extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function item_rincian_induks()
    {
        return $this->belongsTo(ItemRincianInduk::class, 'kategori_id', 'id');
    }
    public function rabs()
    {
        return $this->hasMany(Rab::class, 'item_id', 'id');
    }
    // public function khs()
    // {
    //     return $this->belongsTo(Khs::class, 'khs_id');
    // }
}
