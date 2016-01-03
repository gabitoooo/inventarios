<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ppppedidoproductospedido extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido_producto',function($table){
				$table->increments('id');
				$table->integer('pedido_id');
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
		Schema::drop('pedido_producto');
	}

}

