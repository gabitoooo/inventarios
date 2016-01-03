<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablapersonas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas',function($table){
			$table->increments('id');
			$table->string('nombres');
			$table->string('apellidos');
			$table->string('ci')->unique();
			$table->integer('telefono')->null();
			$table->string('direccion')->null();
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
		Schema::drop('personas');
	}

}
