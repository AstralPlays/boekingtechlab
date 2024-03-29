<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservation_room', function (Blueprint $table) {
			$table->id();
			$table->foreignId('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
			$table->foreignId('room_id')->references('id')->on('rooms')->onDelete('cascade');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('reservation_room');
	}
};
