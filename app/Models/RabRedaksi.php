<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabRedaksi extends Model{

    use HasFactory;

    protected $guarded = [''];

    public function subredaksi(){
        return $this->belongsTo(SubRedaksi::class, 'subdeskripsi_id');
    }
}
