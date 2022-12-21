<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakInduk extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id');
    }

    public function addendums()
    {
        return $this->hasMany(Addendum::class, 'kontrak_induk_id', 'id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
    public function rabs()
    {
        return $this->hasMany(Rab::class, 'nomor_kontrak_induk', 'id');
    }
}
