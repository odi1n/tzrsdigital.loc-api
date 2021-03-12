<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesLists extends Model
{
    use HasFactory;

    public function get($product_id)
    {
        return PropertiesLists::where("product_id", $product_id)
            ->get();
    }

    public $timestamps = false;
}
