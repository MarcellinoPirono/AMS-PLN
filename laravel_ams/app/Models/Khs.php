<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    public function kontrak_induks()
    {
        return $this->hasMany(KontrakInduk::class, 'khs_id');
    }

    public function item_rincian_induks()
    {
        return $this->hasMany(ItemRincianInduk::class, 'khs_id');
    }

    // public function rincian_induks()
    // {
    //     return $this->hasMany(RincianInduk::class, 'khs_id');
    // }
}
