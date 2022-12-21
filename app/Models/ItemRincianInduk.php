<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRincianInduk extends Model
{
    use HasFactory;

    // protected $appends = ['jenis_khs'];
    protected $fillable = ['nama_kategori', 'khs_id'];

    protected $guarded = [''];

    public function rincian_induks()
    {
        return $this->hasMany(RincianInduk::class, 'kategori_id', 'id');
    }

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id')->withDefault([
            'jenis_khs' => ' ',
        ]);
    }

    // public function getJenisKhsAttribute()
    // {
    //     return $this->khs->jenis_khs;
    // }

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
