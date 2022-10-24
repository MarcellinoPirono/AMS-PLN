<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianInduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['item_rincian_induks'];


    public function item_rincian_induks()
    {
        return $this->belongsTo(ItemRincianInduk::class, 'kontraks_id', 'id');
    }
}
