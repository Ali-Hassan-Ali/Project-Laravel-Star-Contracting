<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Notifiable, LaratrustUserTrait, SoftDeletes;

    protected $guarded = [];
     
    protected $appends = ['image_path'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //atr
    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }// end of getNameAttribute

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return Storage::url('uploads/' . $this->image);
        }

        return asset('admin_assets/images/default.png');

    }// end of getImagePathAttribute

    //scope
    public function scopeWhenRoleId($query, $roleId)
    {
        return $query->when($roleId, function ($q) use ($roleId) {

            return $q->whereHas('roles', function ($qu) use ($roleId) {

                return $qu->where('id', $roleId);

            });

        });

    }// end of scopeWhenRoleId

    //rel
    public function favoriteMovies()
    {
        return $this->belongsToMany(Movie::class, 'user_favorite_movie', 'user_id', 'movie_id');

    }// end of favoriteMovies

    //fun
    public function hasImage()
    {
        return $this->image != null;

    }// end of hasImage

    protected static function booted()
    {
        // static::created(function ($user) {
        //     $user->api_token = Str::random(60);
        //     $user->save();
        // });

    }//end of booted

}//end of model
