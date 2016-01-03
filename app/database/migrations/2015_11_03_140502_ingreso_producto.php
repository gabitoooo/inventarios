<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IngresoProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingreso_producto',function($table){
			$table->increments('id');
			$table->integer('ingreso_id');
			$table->integer('producto_id');
			$table->date('fecha');
			$table->integer('cantidad');
			$table->double('precio');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ingreso_producto');
	}

}