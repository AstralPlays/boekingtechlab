<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class material extends Model
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	protected $fillable = [
		'name',
		'quantity',
		'image',
		'rooms_id'
	];

	public function reservations()
	{
		return $this->belongsToMany(reservation::class, 'reservation_material');
	}
}
