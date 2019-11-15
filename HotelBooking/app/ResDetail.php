<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResDetail extends Model
{
	protected $table = "resdetails";

	public function reservation()
	{
		return $this->belongsTo(Reservation::class);
	}

	    public function roomType()
    {
    	return $this->hasMany(RoomType::class);
    }
}
