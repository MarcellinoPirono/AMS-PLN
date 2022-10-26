<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianInduk extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function item_rincian_induk()
    {
        return $this->belongsTo(ItemRincianInduk::class, 'id');
    }
}
