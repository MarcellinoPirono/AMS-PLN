<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRincianInduk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'item_rincian_induks';
    protected $fillable = ['nama_kontrak',];

    public function rincian_induks()
    {
        return $this->hasMany(RincianInduk::class, 'kontraks_id', 'id');
    }
}
