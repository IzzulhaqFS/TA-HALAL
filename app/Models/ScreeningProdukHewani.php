<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ScreeningProdukHewani extends Model
{
    use HasFactory;
    protected $table = 'screening_hewani';
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
