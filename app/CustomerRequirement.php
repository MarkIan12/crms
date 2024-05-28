<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CustomerRequirement extends Model
{
    use SoftDeletes;
    protected $table = "customer_requirements";

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product_application() 
    {
        return $this->belongsTo(ProductApplication::class, 'application_id', 'id');
    }
}
