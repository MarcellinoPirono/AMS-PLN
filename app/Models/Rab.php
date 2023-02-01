<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function prks()
    {
        return $this->belongsTo(Prk::class, 'prk_id', 'id');
    }
    public function skks()
    {
        return $this->belongsTo(Skk::class, 'skk_id', 'id');
    }

    public function pejabats()
    {
        return $this->belongsTo(Pejabat::class, 'pejabat_id', 'id');
    }
    public function addendums()
    {
        return $this->belongsTo(Addendum::class, 'addendum_id', 'id');
    }
    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
    public function nomor_kontraks()
    {
        return $this->belongsTo(KontrakInduk::class, 'nomor_kontrak_induk', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(ItemRincianInduk::class, 'kategori_id', 'id')->withDefault([
            'nama_kategori' => ' ',

        ]);
    }

    public function items()
    {
        return $this->belongsTo(RincianInduk::class, 'item_id', 'id')->withDefault([
            'nama_item' => ' ',

        ]);
    }

    public function lokasis()
    {
        return $this->hasMany(lokasi::class, 'rab_id', 'id');
    }

}
