<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablapedidocompras extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidocompras',function($table){
			$table->increments('id');
			$table->string('numero');
			$table->integer('nivel');
			$table->string('de');
			$table->string('seccion');
			$table->string('fecha');
			$table->string('al_almacen');
			$table->string('para_uso');
			$table->string('pedido_por');
			$table->string('cargo_pedido_por');
			$table->string('aprobado_por');
			$table->string('cargo_aprobado_por');
			$table->string('autorizado_por');
			$table->string('cargo_autorizado_por');
			$table->string('referencia');
			$table->boolean('confirmado_ingreso');
			$table->boolean('confirmado_egreso');
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
		Schema::drop('pedidocompras');
	}

}