<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use SoftDeletes;
    protected $table = "clientareas";

    public function region()
    {
        return $this->belongsTo(Region::class, 'RegionId');
    }
    
}

