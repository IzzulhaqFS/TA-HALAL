<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EventLog extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'event_logs';
    protected $guarded = [];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
