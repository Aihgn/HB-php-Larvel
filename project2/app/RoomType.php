<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_room extends Model
{
    protected $table = "type_room";

    public function room(){
    	return $this->hasMany('App\Room', 'id_type', 'id');
    }
}
