<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class room extends Model
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	public function reservations()
	{
		return $this->belongsToMany(Reservation::class, 'reservation_room');
	}
}
