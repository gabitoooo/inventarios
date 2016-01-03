<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablapedidocompraProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidocompra_producto',function($table){
			$table->increments('id');
			$table->integer('pedidocompra_id');
			$table->integer('producto_id');
			$table->date('fecha');
			$table->integer('cantidad');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedidocompra_producto');
	}

}