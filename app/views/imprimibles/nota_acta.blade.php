<style>
	body{
		font-size:12px;
		font-family: verdana;
		width:21.4cm;
	}
	.numero{
		margin-left:19cm;
		margin-top:-0.5cm;
		position: absolute;
	}
	.fecha{
		margin-left:1cm;
		margin-top:1.5cm;
		position: absolute;
	}
	.procedente{
		margin-left:1cm;
		margin-top:2cm;
		position: absolute;
	}
	.orden{
		margin-left:1cm;
		margin-top:2.5cm;
		position: absolute;
	}
	.tabla{ 
		font-size:12px;
		text-align: center;
		font-family: verdana;
		position: absolute;
		margin-top: 3.5cm;
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
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.cantidad{
		width:4cm;
		border-width: 1px;
		border: solid;
	}.unidad{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.descri{
		width:12cm;
		border-width: 1px;
		border: solid;
	}
	.precio{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.total{
		width:3cm;
		border-width: 1px;
		border: solid;
	}
	.titulo{
		margin-left:2cm;
		font-size: 30px;
		position: absolute;
	}
	.unidades{
		width:2cm;
		border-width: 1px;
		border: solid;
	}
</style>
<div>SERVICIO DEPARTAMENTAL DE CAMINOS POTOSI - BOLIVIA</div>
<div class="titulo">ACTA de ENTREGA de MATERIALES y SUMINISTROS</div>
<div class="numero">N°:{{$egreso->numero}}</div>
<div class="fecha">Fecha: {{$egreso->fecha}}</div>
@if($egreso->pedido_id > 0)
<?php $pedido=Pedido::find($egreso->pedido_id); ?>
<div class="procedente">Referencia de pedido: PN{{$pedido->numero}}</div>
@endif
@if($egreso->pedidocompra_id > 0)
<?php $pedidocompra=Pedidocompra::find($egreso->pedidocompra_id); ?>
<div class="procedente">Referencia de pedido: PC{{$pedidocompra->numero}}</div>
@endif
<div class="orden">Para uso en: {{$egreso->para_uso_en}}</div>
<table border="0" cellspacing="0" cellpadding="0" class="tabla">
	<tr>
		<td style="border-width: 1px;border: solid;"><b>ITEM</b></td>
		<td style="border-width: 1px;border: solid;" class="unidades"><b>CANTIDAD RECIBIDA</b></td>
		<td style="border-width: 1px;border: solid;"><b>UNIDAD</b></td>
		<td style="border-width: 1px;border: solid;"><b>DESCRIPCION</b></td>
	</tr>
	@foreach($datos as $d)
	<tr>
		<td class="item">{{$d["codigo"]}}</td>
		<td class="cantidad">{{$d["cantidad"]}}</td>
		<td class="unidad">{{$d["unidad"]}}</td>
		<td class="descri">{{$d["descripcion"]}}</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="3" style="border-width: 1px;border: solid;"><br><b>ENTREGE:</b>Todos los articulos mencionados en la olumna cantidad (item), en constancia firmo al pie del presente. <br><br>FIRMA: __________________________ 	<br>Nombre:{{$egreso->entregado_por}}</td>
		<td colspan="1" style="border-width: 1px;border: solid;"><br><b>RECIBI:</b>Todos los articulos mencionados en la olumna cantidad (item), en constancia firmo al pie del presente. <br><br>FIRMA: __________________________ 	<br>Nombre:{{$egreso->recivido_por}}</td>
	</tr>
</table>