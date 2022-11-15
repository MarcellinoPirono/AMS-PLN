<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addendum extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function kontrak_induks()
    {
        return $this->belongsTo(KontrakInduk::class, 'kontrak_induk_id', 'id');
    }
}
