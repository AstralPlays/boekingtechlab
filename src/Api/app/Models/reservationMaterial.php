<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reservationMaterial extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'reservation_material';
	protected $fillable = [
		'reservation_id',
		'material_id',
		'quantity'
	];

	public function reservation()
	{
		return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
	}
}
