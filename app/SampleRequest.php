<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SampleRequest extends Model
{
    use SoftDeletes;
    protected $table = "samplerequests";
}
