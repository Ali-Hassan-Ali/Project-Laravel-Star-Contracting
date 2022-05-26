<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    //scopes -------------------------------------
    public function scopeWhenSearch($query, $search) 
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('id' , 'like', "%$search%");
        });
        
    }//end of scopeWhenSearch`

}//end of model
