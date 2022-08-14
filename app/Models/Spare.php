<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function city()
    {
        return $this->belongsTo(City::class);
        
    }//end of  belongsTo

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
        
    }//end of  belongsTo

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_has_manies');

    }//end of fun
    
}//end of model

