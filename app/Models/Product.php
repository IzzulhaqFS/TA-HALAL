<?php

namespace App\Models;

use App\Helpers\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'products';
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class, 'product_id');
    }
}

