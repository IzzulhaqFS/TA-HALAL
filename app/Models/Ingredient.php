<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Ingredient extends Model
{
    use HasFactory, hasuu;
    protected $table = 'ingredients';
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
