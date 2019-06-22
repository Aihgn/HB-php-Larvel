<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roomtype extends Model
{
    protected $table = "type_room";

    protected $fillable = [
        'name', 'price','description'
    ];

    public function room(){
    	return $this->hasMany('App\Room', 'id_type', 'id');
    }
}
