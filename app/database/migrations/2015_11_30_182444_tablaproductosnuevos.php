<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablaproductosnuevos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productosnuevos',function($table){
				$table->increments('id');
				$table->integer('pedidocompra_id');
				$table->string('descripcion');
				$table->string('unidad');
				$table->string('numero_interno');
				$table->integer('nivel');
				$table->integer('cantidad');
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
		Schema::drop('productosnuevos');
	}

}
