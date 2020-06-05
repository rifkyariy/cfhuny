<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefCabanglombaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_cabanglomba', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name');
			$table->string('nickname');
			$table->string('desc');
			$table->string('category');
			$table->integer('proposal_submission')->nullable()->default(0);
			$table->integer('link_submission')->nullable()->default(0);
			$table->integer('orisinalitas_submission')->nullable()->default(0);
			$table->integer('anggota')->default(2);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ref_cabanglomba');
	}

}
