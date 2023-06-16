<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reservation extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',
		'name',
		'email',
		'start_time',
		'end_time',
		'date',
	];

	public function user()
	{
		return $this->hasOne(user::class, 'id', 'user_id');
	}

	public function rooms()
	{
		return $this->belongsToMany(room::class, 'reservation_room');
	}

	public function materials()
	{
		return $this->belongsToMany(material::class, 'reservation_material');
	}
}
