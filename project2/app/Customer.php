<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = "customer";

    public function reservation(){
    	return $this->hasMany('App\Reservation','id_customer', 'id');
    }
}
