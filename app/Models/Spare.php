<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    use HasFactory, SoftDeletes;

    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $guarded = [];
    protected $appends = ['equipments_ids'];

    protected $casts = [
       'equipments' => 'json',
    ];

    public function equipments()
    {
        return $this->belongsToJson(Equipment::class, 'equipments->equipments_ids');
    }

    public function getEquipmentsIdsAttribute()
    {
        return json_decode($this->equipments);

    }//end of fun

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
        
    }//end of  belongsTo

    public function city()
    {
        return $this->belongsTo(City::class);
        
    }//end of  belongsTo

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
        
    }//end of  belongsTo
    
}//end of model

