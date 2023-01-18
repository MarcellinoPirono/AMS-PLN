<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hpe extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rab_non_pos()
    {
        return $this->belongsTo(RabNonPo::class, 'rab_non_po_id');
    }

    public function non_pos()
    {
        return $this->belongsTo(NonPo::class, 'non_po_id');
    }

}
