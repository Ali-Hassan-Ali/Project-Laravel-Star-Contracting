<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
        
    }//end of  belongsTo


    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
        
    }//end of  belongsTo

}//end of model