<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ingredient extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'ingredients';
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function getLatestId(){
        $latestIngredient = Ingredient::latest('created_at')->first();
        return $latestIngredient ? $latestIngredient->id : null;
    }

    public static function getType($ingredient_id){
        $ingredient = Ingredient::findOrFail($ingredient_id);
        return $ingredient ? $ingredient->type : null;
    }
}
