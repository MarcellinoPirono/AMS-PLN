<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiPaket extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function khs()
    {
        return $this->belongsTo(Khs::class, 'khs_id', 'id');
    }

}
