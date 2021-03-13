<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function catalogs()
    {
        return $this->belongsTo(Catalog::class, 'catalogs_id', 'id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_product', 'product_id', 'property_id');
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'count',
        'catalogs_id'
    ];
}
