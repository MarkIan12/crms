<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductEvaluation extends Model
{
    use SoftDeletes;
    protected $table = "product_evaluations";
}
