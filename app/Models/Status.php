<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
        
    }//end of  belongsTo

    public function getAsOfAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));

    }//end oi fn

    public function getBreakDownDateAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));
        
    }//end of fun
    
}//end of model
