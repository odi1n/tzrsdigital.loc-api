<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany("App\Models\Product", 'property_product', 'property_id', 'product_id');
    }

    protected $fillable = [
        'title',
        'value',
    ];

    public $timestamps = false;

}
