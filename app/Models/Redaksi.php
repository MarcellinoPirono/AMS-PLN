<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubRedaksi;

class Redaksi extends Model
{
    use HasFactory;
    protected $guarded = [''];

    // public function sub_redaksis()
    // {
    //     return $this->hasMany(SubRedaksi::class, 'redaksi_id', 'id');
    // }

    public function sub_redaksis()
    {
        return $this->hasMany(SubRedaksi::class, 'redaksi_id', 'id');
    }

}
