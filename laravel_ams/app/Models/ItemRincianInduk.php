<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRincianInduk extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function rincian_induks()
    {
        return $this->hasMany(RincianInduk::class, 'kategori_id', 'id');
    }

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id');
    }

    public function rabs()
    {
        return $this->hasMany(Rab::class, 'kategori_id', 'id');
    }
    // public function scopeFilter($query, array $filters)
    // {
      
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         return $query->where(function ($query) use ($search) {
    //             $query->where('nama_kontrak', 'like', '%' . $search . '%')
    //                 ->orWhere('id', 'like', '%' . $search . '%');
    //         });
    //     });

    
    // }
}
