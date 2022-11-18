<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKhs extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function satuans()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
