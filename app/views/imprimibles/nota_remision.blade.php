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
		width:3cm;
		border-width: 1px;
		border: solid;
	}
	.cantidad{
		width:2cm;
		border-width: 1px;
		border: solid;
	}.unidad{
		width:2cm;
		border-width: 1px;
		border: solid;
	}
	.descri{
		width:3cm;
		border-width: 1px;
		border: solid;
	}
	.precio{
		width:5cm;
		border-width: 1px;
		border: solid;
	}
	.total{
		width:3.5cm;
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
		width:3.5cm;
		border-width: 1px;
		border: solid;
	}
	.recibi{
		width:4cm;
		border-width: 1px;
		border: solid;
	}
	.men{
		width:7cm;
		border-width: 1px;
		border: solid;
	}
</style>
<div>SERVICIO DEPARTAMENTAL DE CAMINOS POTOSI - BOLIVIA</div>
<div class="titulo">NOTA DE REMISION</div>
<div class="numero">N°: {{$remision->numero}}</div>
<div class="almacen">Almacen de: {{$remision->almacen_de}}</div>
<div class="fecha">Lugar y Fecha:{{$remision->fecha}}</div>
<div class="procedente">Remitimos a: {{$remision->remitidos_a}}</div>
<div class="proveedor">Segun Requisicion de materiales: _________________</div>
<div class="orden">Radio N°: _______________</div>
<div class="factura">Oficio N°: _______________</div>
<table border="0" cellspacing="0" cellpadding="0" class="tabla">
	<tr>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="unidades"><b>UNIDAD</b></td>
		<td colspan="2" style="border-width: 1px;border: solid;"><b>DATOS</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>N° Interno</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" colspan="2"><b>ARTICULO</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>VALOR /u</b></td>
		<td rowspan="2" style="border-width: 1px;border: solid;" class="int"><b>TOTAL</b></td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;"><b>cantidad</b></td>
		<td style="border-width: 1px;border: solid;"><b>Pedido</b></td>
	</tr>
	@foreach($datos as $d)
	<tr>
		<td class="item">{{$d["codigo"]}}</td>
		<td class="cantidad">{{$d["cantidad"]}}</td>
		<td class="unidad">{{$d["pedido"]}}</td>
		<td class="descri">{{$d["numero"]}}</td>
		<td class="precio" colspan="2">{{$d["descripcion"]}}</td>
		<td class="total">{{$d["precio"]}}</td>
		<td class="int">{{$d["total"]}}</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Revisado: {{$remision->revisado_por}}<br><br></td>
		<td colspan="3" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Autorizado: {{$remision->autorizado_por}}<br><br></td>
		<td colspan="2" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Despachado: {{$remision->despachado_por}}br><br></td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;">KARDEX</td>
		<td style="border-width: 1px;border: solid;">VIA</td>
		<td style="border-width: 1px;border: solid;">GUIA N°</td>
		<td style="border-width: 1px;border: solid;">BULTOS</td>
		<td style="border-width: 1px;border: solid;">PESO kg.</td>
		<td style="border-width: 1px;border: solid;" rowspan="4" class="recibi">Recibi conforme la carga arriba descrita comprometiendome entregarla conforme y en buenas condiciones	<br>Fecha: {{$remision->fecha}}</td>
		<td style="border-width: 1px;border: solid;" rowspan="4" class="men" colspan="2">RECIBIDO EN DESTINO	<br>Nota de Ingreso N°:__________ <br>Fecha: {{$remision->fecha}}<br>Nombre: {{$remision->remitidos_a}}</td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;">Aereo</td>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;"></td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;">Camion</td>
		<td style="border-width: 1px;border: solid;">{{$remision->codigo_camion}}</td>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;"></td>
	</tr>
	<tr>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;">FF.CC.</td>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;"></td>
		<td style="border-width: 1px;border: solid;"></td>
	</tr>
	<tr>
		<td colspan="4" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Flotero o Conductor: {{$remision->nombre_conductor}}</td>
		<td colspan="4" style="border-bottom:0; border-top:0;border-left: 0; border-right: 0;"><br><br>Firma: ______________________</td>
	</tr>
</table>