<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;


class PaketPekerjaan extends Model
{
    use HasFactory;
    // use SLuggable;
    protected $guarded = [''];

    public function rincian_induks()
    {
        return $this->belongsTo(RincianInduk::class, 'item_id');
    }

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id');
    }





}
