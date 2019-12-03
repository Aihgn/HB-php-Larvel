<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResDetail extends Model
{
	protected $table = "res_details";

	protected $fillable = [
        'reservation_id', 'room_type_id','quantity', 'checkin_date', 'checkout_date'
    ];

	public function reservation()
	{
		return $this->belongsTo(Reservation::class);
	}

	    public function roomType()
    {
    	return $this->hasMany(RoomType::class);
    }
}
