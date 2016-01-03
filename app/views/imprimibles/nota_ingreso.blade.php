<style>
	body{
		font-size:12px;
		font-family: verdana;
		width:21.4cm;
	}
	.numero{
		margin-left:19cm;
		margin-top:0cm;
		position: absolute;
	}
	.almacen{
		margin-left:1cm;
		margin-top:1.5cm;
		position: absolute;
	}
	.fecha{
		margin-left:13cm;
		margin-top:1.5cm;
		position: absolute;
	}
	.procedente{
		margin-left:1cm;
		margin-top:2cm;
		position: absolute;
	}
	.proveedor{
		margin-left:13cm;
		margin-top:2cm;
		position: absolute;
	}
	.orden{
		margin-left:1cm;
		margin-top:2.5cm;
		position: absolute;
	}
	.factura{
		margin-left:13cm;
		margin-top:2.5cm;
		position: absolute;
	}
	.nit{
		margin-left:13cm;
		margin-top:3cm;
		position: absolute;
	}
	.doc{
		margin-left:1cm;
		margin-top:3cm;
		position: absolute;
	}
	.tabla{ 
		font-size:12px;
		text-align: center;
		font-family: verdana;
		position: absolute;
		margin-top: 4cm;
		border-bottom:0px;
	}
	.pie{
		position: absolute;
		margin-left: 4;
		margin-top:20cm;
	}
	.total{
		margin-left: 14.5cm;
		margin-top: 20cm;
		position: absolute;
	}
	.user{
		margin-left: 4cm;
		margin-top: 21cm;
		position: absolute;
	}
	.pedi{
		margin-top: 21.5cm;
		margin-left: 5cm;
		position: absolute;
	}
	.num{
		margin-top: 21.5cm;
		margin-left: 13.5cm;
		position: absolute;
	}
	.val{
		margin-top: 23.8cm;
		margin-left: 6.5cm;
		position: absolute;
	}
	.dif{
		margin-top: 24.2cm;
		margin-left: 6.5cm;
		position: absolute;
	}
	.entr{
		margin-top: 24.7cm;
		margin-left: 5cm;
		position: absolute;
	}
	.reci{
		margin-top: 24.7cm;
		margin-left: 15.5cm;
		position: absolute;;
	}
	.item{
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}
	.cantidad{
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}.unidad{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.descri{
		width:8cm;
		border-width: 1px;
		border: solid;
	}
	.precio{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.total{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.titulo{
		margin-left:9cm;
		font-size: 30px;
		position: absolute;
	}
</style>
<div>SERVICIO DEPARTAMENTAL DE CAMINOS POTOSI - BOLIVIA</div>
<div class="titulo">NOTA DE INGRESO</div>
<div class="numero">N°: {{$ingreso->numero}}</div>
<div class="almacen">Al almacen de: {{$ingreso->al_almacen}}</div>
<div class="fecha">Fecha: {{$ingreso->fecha}}</div>
<div class="procedente">Procedente: {{$ingreso->procedente_de}}</div>
<div class="proveedor">Proveedor: {{$ingreso->proveedor}}</div>
<div class="orden">Orden de Compra: {{$ingreso->orden_compra}}</div>
<div class="factura">Numero de Factura: {{$ingreso->numero_factura}}</div>
<div class="nit">NIT: {{$ingreso->nit}}</div>
<div class="doc">Doctos de Repaldo: {{$ingreso->documento_respaldo}}</div>
<table border="0" cellspacing="0" cellpadding="0" class="tabla">
	<tr>
		<td style="border-width: 1px;border: solid;"><b>Item</b></td>
		<td style="border-width: 1px;border: solid;"><b>C/recibida</b></td>
		<td style="border-width: 1px;border: solid;"><b>Unidad de Medida</b></td>
		<td style="border-width: 1px;border: solid;"><b>DESCRIPCION</b></td>
		<td style="border-width: 1px;border: solid;"><b>Precio/U</b></td>
		<td style="border-width: 1px;border: solid;"><b>Valor total</b></td>
	</tr>
	@foreach($datos as $d)
	<tr>
		<td class="item">{{$d["codigo"]}}</td>
		<td class="cantidad">{{$d["cantidad"]}}</td>
		<td class="unidad">{{$d["unidad"]}}</td>
		<td class="descri">{{$d["descripcion"]}}</td>
		<td class="precio">{{$d["precio"]}}</td>
		

		<td class="total">{{$d["total"]}}</td>

	</tr>
	@endforeach
	<tr>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Valor Total: {{$ingreso->valor_total}}</td>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Observaciones: {{$ingreso->observaciones}}</td>
	</tr>
	<tr>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br>Entregado por:{{$ingreso->entregado_por}}</td>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br>Recibido por: {{$ingreso->recivido_por}}</td>
	</tr>
	<tr>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Firma: ....................</td>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Firma: ....................</td>
	</tr>
</table>