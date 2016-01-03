<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaRemiciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remiciones',function($table)
			{
					$table->increments('id');
					$table->string('numero');
					$table->string('almacen_de');
					$table->string('fecha');
					$table->integer('nivel');
					$table->string('remitidos_a');
					$table->string('revisado_por');
					$table->string('cargo_revisado_por');
					$table->string('autorizado_por');
					$table->string('cargo_autorizado_por');
					$table->string('despachado_por');
					$table->string('cargo_despachado_por');
					$table->string('codigo_camion');
					$table->string('nombre_conductor');
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
		//
	}

}

