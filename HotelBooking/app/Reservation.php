<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $table = "reservations";

    public function resDetail()
    {
    	return $this->hasMany(ResDetail::class);
    }

    public $timestamps = true;
}
