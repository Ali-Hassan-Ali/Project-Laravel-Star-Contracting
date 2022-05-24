<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $appends = ['name','image_path'];
    protected $hidden  = ['password'];
    protected $casts   = ['Email_verified_at' => 'datetime'];

    public function Rents()
    {
        return $this->hasMany(Rent::class);

    }//endo frents

    public function getNameAttribute()
    {
        return $this->f_name . $this->l_name;

    }//end of name

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);

    }//end of get image path

    public function scopeWhenSearch($query , $search) 
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('f_name' , 'like', "%$search%")
            ->orWhere('l_name', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%")
            ->orWhere('Email', 'like', "%$search%");
        });
        
    }//end ofscopeWhenSearch

}//end of model
