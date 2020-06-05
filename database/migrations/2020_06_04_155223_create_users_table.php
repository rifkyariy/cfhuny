<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name');
			$table->string('email')->nullable()->unique();
			$table->string('password')->nullable();
			$table->string('nim')->nullable()->unique('nim');
			$table->string('role')->default('Mahasiswa');
			$table->string('ktm')->nullable();
			$table->string('phone', 20)->nullable()->unique('phone');
			$table->string('prodi')->nullable();
			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('avatar')->nullable();
			$table->string('university_id')->nullable();
			$table->dateTime('email_verified_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
