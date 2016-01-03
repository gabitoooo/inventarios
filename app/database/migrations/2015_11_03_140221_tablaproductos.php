<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablaproductos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos',function($table){
			$table->increments('id');
			$table->string('codigo_interno');
			$table->string('descripcion');
			$table->integer('cuenta_id');
			$table->text('ubicacion')->null();
			$table->double('precio');
			$table->integer('existencias');
			$table->string('unidad');
			$table->integer('nivel');
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
		Schema::drop('productos');
	}

}