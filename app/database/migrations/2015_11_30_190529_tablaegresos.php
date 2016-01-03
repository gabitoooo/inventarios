<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablaegresos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("egresos",function($table)
			{
				$table->increments('id');
				$table->string('numero');
				$table->string('fecha');
				$table->integer('nivel');
				$table->string('para_uso_en')->null();
				$table->string('entregado_por')->null();
				$table->string('cargo_entregado_por')->null();
				$table->string('recivido_por')->null();
				$table->string('cargo_recivido_por')->null();
				$table->integer('pedido_id')->null();
				$table->integer('pedidocompra_id')->null();
				$table->integer('remicione_id')->null();
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
		Schema::drop('egresos');
	}

}
