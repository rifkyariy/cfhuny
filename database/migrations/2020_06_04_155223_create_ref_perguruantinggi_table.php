<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefPerguruantinggiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_perguruantinggi', function(Blueprint $table)
		{
			$table->bigInteger('id');
			$table->string('name');
			$table->string('lembaga');
			$table->string('kabupaten');
			$table->string('provinsi');
			$table->string('telepon');
			$table->string('email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ref_perguruantinggi');
	}

}
