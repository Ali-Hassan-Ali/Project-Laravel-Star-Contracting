<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait, HasFactory, Notifiable, SoftDeletes;

    protected $guard    = 'admin';

    protected $fillable = ['name','email','password','phone','image'];

    protected $hidden   = ['password','remember_token'];
    
    protected $casts    = ['email_verified_at' => 'datetime'];

    protected $appends  = ['image_path'];

     //attributes----------------------------------
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);

    }//end of get image path

    //scopes -------------------------------------
    public function scopeWhenSearch($query , $search) 
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('name' , 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%");
        });
        
    }//end of scopeWhenSearch`

    //relations ----------------------------------

    public function city()
    {
        return $this->belongsTo(City::class);

    }//end of hasMany city

}//end of model
