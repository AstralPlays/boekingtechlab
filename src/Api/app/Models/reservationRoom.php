<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reservationRoom extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'reservation_room';
	protected $fillable = [
		'reservation_id',
		'room_id'
	];

	public function reservation()
	{
		return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
	}
}
