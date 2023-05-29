<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class EventLog extends Model
{
    use HasFactory;
    protected $table = 'event_logs';
    protected $guarded = ['id'];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function subActivity(){
        return $this->hasMany(SubActivity::class, 'event_log_id', 'code');
    }
}
