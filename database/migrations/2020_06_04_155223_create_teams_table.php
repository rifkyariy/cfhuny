<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teams', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name')->unique('name');
			$table->string('excel_member')->nullable();
			$table->string('archive_member')->nullable();
			$table->string('certificate')->nullable();
			$table->bigInteger('member_count')->nullable();
			$table->string('cabang_lomba');
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
		Schema::drop('teams');
	}

}
