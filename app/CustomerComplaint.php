<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CustomerComplaint extends Model
{
    use SoftDeletes;
    protected $table = "customerservices";
}
