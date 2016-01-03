<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaEgresoProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('egreso_producto',function($table){
			$table->increments('id');
			$table->integer('egreso_id');
			$table->integer('producto_id');
			$table->date('fecha');
			$table->integer('cantidad');
			$table->double('precio');
			$table->string('unidad_uso')->null();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('egreso_producto');
	}

}