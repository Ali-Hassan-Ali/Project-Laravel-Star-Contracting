<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
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

    public function scopeWhereDateBetween($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {

            return $query->whereDate('created_at', '>=',$startDate)
                         ->whereDate('created_at','<=',$endDate);
            
        } else {

            return $query;

        } //end of if

    }//end of fun
    
}//end of model