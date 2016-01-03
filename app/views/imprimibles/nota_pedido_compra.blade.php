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
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}
	.cantidad{
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}.unidad{
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}
	.descri{
		width:10cm;
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
		margin-left:9cm;
		font-size: 30px;
		position: absolute;
	}
	.unidades{
		width:2cm;
		border-width: 1px;
		border: solid;
	}
	.int{
		width:2.5cm;
		border-width: 1px;
		border: solid;
	}
</style>
<div>SERVICIO DEPARTAMENTAL DE CAMINOS POTOSI - BOLIVIA</div>
<div class="titulo">PEDIDO DE COMPRA</div>
<div class="numero">N°: PC{{$pedidocompra->numero}}</div>
<div class="almacen">Administracion: {{$pedidocompra->al_almacen}}</div>
<div class="fecha">Fecha:{{$pedidocompra->fecha}}</div>
<div class="procedente">De: {{$pedidocompra->de}}</div>
<div class="proveedor">Al almacen: {{$pedidocompra->al_almacen}}</div>
<div class="orden">Seccion:{{$pedidocompra->seccion}}</div>
<div class="factura">Para uso en:{{$pedidocompra->para_uso}}</div>
<table border="0" cellspacing="0" cellpadding="0" class="tabla">
	<tr>
		<td colspan="2" style="border-width: 1px;border: solid;"><b>CANTIDAD</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="unidades"><b>UNIDAD</b></td>
		<td colspan="" style="border-width: 1px;border: solid;"><b>DETALLE</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>N° Interno</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>CODIGO</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>UBICACION</b></td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;"><b>Pedida</b></td>
		<td style="border-width: 1px;border: solid;"><b>Aprobada</b></td>
		<td style="border-width: 1px;border: solid;"><b>Articulo</b></td>
	</tr>
	@foreach($datos as $d)
	<tr>
		

		<td class="item">{{$d["cantidad"]}}</td>
		<td class="cantidad">{{$d["cantidad"]}}</td>
		<td class="unidad">{{$d["unidad"]}}</td>
		<td class="descri">{{$d["detalle"]}}</td>
		<td class="int">{{$d["num_interno"]}}</td>
		<td class="int">{{$d["codigo"]}}</td>
		<td class="int">{{$d["ubicacion"]}}</td>
		
	</tr>
	@endforeach
	<tr>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Pedido por: {{$pedidocompra->pedido_por}}</td>
		<td style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Aprobado por: {{$pedidocompra->aprobado_por}}</td>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Autprizado por: {{$pedidocompra->autorizado_por}}</td>
	</tr>
	<tr>
		<td colspan="7" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Referencia: {{$pedidocompra->referencia}}</td>
	</tr>
</table>