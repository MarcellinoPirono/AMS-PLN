<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPo extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rab_non_pos(){

        return $this->hasMany(RabNonPo::class, 'non_po_id', 'id');
    }

    public function skks(){
        return $this->belongsTo(Skk::class, 'skk_id', 'id');
    }

    public function prks(){
        return $this->belongsTo(Prk::class, 'prk_id', 'id');
    }

    public function pejabats(){
        return $this->belongsTo(Pejabat::class, 'pejabat_id', 'id');
    }

    public function hpes(){
        return $this->hasOne(Hpe::class, 'non_po_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
