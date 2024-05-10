<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use SoftDeletes;
    protected $table = "activities";
}
