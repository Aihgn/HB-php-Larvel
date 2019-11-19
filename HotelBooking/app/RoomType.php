<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roomtype extends Model
{
    protected $table = "room_types";

    protected $fillable = [
        'name', 'price','description', 'quantity', 'available'
    ];

    public function res_detail(){
    	return $this->belongsto(ResDetail::class);
    }
}
