<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRedaksiKHS extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function redaksi()
    {
        return $this->belongsTo(Redaksi::class, 'redaksi_id');
    }
}
