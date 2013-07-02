<?php

use Illuminate\Database\Migrations\Migration;

class CreateRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table) {
			$table->increments('id');

			$table->string('name', 32);
			$table->string('description', 320);
			$table->integer('level');

			$table->timestamps();
		});

		Schema::create('role_user', function($table) {
			$table->increments('id');

			$table->integer('role_id');
			$table->integer('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}