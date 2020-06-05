<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submissions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('judul');
			$table->bigInteger('team_id');
			$table->string('file')->nullable();
			$table->string('link')->nullable();
			$table->string('orisinalitas');
			$table->string('status');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submissions');
	}

}
