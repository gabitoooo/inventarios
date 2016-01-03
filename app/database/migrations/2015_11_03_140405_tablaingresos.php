<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tablaingresos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingresos', function($table){
				$table->increments('id');
				$table->string('numero');
				$table->string('fecha');
				$table->integer('nivel');
				$table->string('al_almacen');
				$table->string('procendente_de');
				$table->string('numero_factura');
				$table->string('documento_respaldo');
				$table->string('proveedor');
				$table->string('nit');
				$table->integer('valor_total');
				$table->integer('valor_recivido');
				$table->string('entregado_por');
				$table->string('recivido_por');
				$table->text('observaciones');
				$table->string('orden_compra');
				$table->integer('pedidocompra_id');
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
			Schema::drop('ingresos');	
	}

}