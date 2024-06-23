<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use App\Models\screeningProdukHewani;
use App\Models\screeningProdukNabati;
use App\Models\screeningProdukJadi;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that appends to returned entities.
     *
     * @var array
     */
    protected $appends = ['photo'];

    /**
     * The getter that return accessible URL for user photo.
     *
     * @var array
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->foto !== null) {
            return url('media/user/' . $this->id . '/' . $this->foto);
        } else {
            return url('media-example/no-image.png');
        }
    }

    public function products(){
        return $this->hasMany(Product::class, 'user_id');
    }

    public function screeningProdukHewani()
    {
        return $this->hasMany(screeningProdukHewani::class, 'user_id');
    }

    public function screeningProdukNabati()
    {
        return $this->hasMany(screeningProdukNabati::class, 'user_id');
    }

    public function screeningProdukJadi()
    {
        return $this->hasMany(screeningProdukJadi::class, 'user_id');
    }
}
