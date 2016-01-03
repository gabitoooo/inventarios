$(document).on("ready",function(){

  var PNitem=1;
   var PNcontprecios=0;
   var PNprecios=new Array();
	var PNvalortotal=0;
   $("#PNbtnagregar").on("click",function(){
   		  if (PNvalidarcamposcarrito()==true)
        {
            var actual=parseInt($("#PNcantidadactual").val());
            var pedida=parseInt($("#PNcantidad").val());
            if(pedida<=actual)
            {
                  PNingresar();
            }
            else
            {
                alert("no existe esa cantidad a pedir");
            }
        }
        else 
        {
           //alert("incorrecto");
        }
            
	});
 
   $("#PNbtnborrar").on("click",function(){
         PNborrar_tabla();
   });
 
  $("#PNfrmingresoconfirmar").submit(function(){

       //controlar cosas todavia
                  PNmiserializar();
                   window.location.href="/";
           /* if (PNIngresovalidarformconfirmacion())
           {
                  
           }
           else
           {
              //alert("incorrecto");
              return false;
           }*/
       
         
  });

  $("#PNcodigo").focusout(function(){
      PNrecpuerarproducto();
   });   
  $("#PNcodigo").focusin(function(){
          $("#divPNcodigo").removeClass().addClass("form-group");
          $("#PNcodigo").val(null);
          $("#ctrlPNcodigo div").remove();
          $("#PNdescripcion").val(null);
          $("#PNubicacion").val(null);
          $("#PNmedida").val(null);
          $("#PNcuenta").val(null);
          $("#PNpreciounitario").val(null);
          $("#PNcantidad").val(null);
          $("#PNcantidadactual").val(null);
         
  });

//funciones para el carrito
function PNingresar()
   {
            var PNcantidad=$("#PNcantidad").val();
            var PNmedida=$("#PNmedida").val();
            var PNdescripcion=$("#PNdescripcion").val();
            var precio=$("#PNpreciounitario").val();
            var prec=precio.split(",");
            if(prec.length>1)
            {
                precio=prec[0]+'.'+prec[1];
                alert(precio.toString());
            }
            var total=PNcantidad*precio;
            var PNubicacion=$("#PNubicacion").val();
            var PNcodigo=$("#PNcodigo").val();
            var PNcuenta=$("#PNcuenta").val();
            PNvalortotal+=total;
            PNprecios[PNcontprecios]=total;
            PNcontprecios++;
            $("#PNcuerpo").append("<tr id='PNtr"+PNitem+"'><td><input type='text' name='PNitem' id='PNitem"+PNitem+"' readonly  class='sinstylo' value="+PNitem+"></td><td><input type='text' name='PNcantidad' id='PNcantidad"+PNitem+"' readonly  class='sinstylo' value="+PNcantidad+"></td><td><input type='text' name='PNmedida' id='PNmedida"+PNitem+"' readonly  class='sinstylo' value="+PNmedida+"></td><td><input type='text' name='PNdescripcion' id='PNdescripcion"+PNitem+"' readonly  class='sinstylo' value="+PNdescripcion+"></td><td><input type='text' name='precio' id='PNprecio"+PNitem+"' readonly  class='sinstylo' value="+precio+"></td><td><input type='text' name='PNtotal' id='PNtotal"+PNitem+"' readonly  class='sinstylo' value="+total+"></td><td><input type='text' name='PNubicacion' id='PNubicacion"+PNitem+"' readonly  class='sinstylo' value="+PNubicacion+"></td><td><input type='text' name='PNcodigo' id='PNcodigo"+PNitem+"' readonly  class='sinstylo' value="+PNcodigo+"></td><td><input type='text' name='PNcuenta' id='PNcuenta"+PNitem+"' readonly  class='sinstylo' value='"+PNcuenta+"'></td></tr>");
            $("#PNvalortotal").html("<i>"+PNvalortotal+"</i>");
            $("#PNvalor_total").val(PNvalortotal);
            PNitem++;
            PNlimpiar();
   }
   function PNlimpiar(){
            $("#divPNcodigo").removeClass().addClass("form-group");
            $("#PNcantidad").val(null);
            $("#PNmedida").val(null);
            $("#PNdescripcion").val(null);
            $("#PNpreciounitario").val(null);
            $("#PNubicacion").val(null);
            $("#PNcodigo").val(null);
   }
   function PNborrar_tabla()
   {
            
      if (PNitem>1)
      {
             PNitem--;
             PNcontprecios--;
             $("#PNtr"+PNitem+"").remove();            
             PNvalortotal=$("#PNvalor_total").val()-PNprecios[PNcontprecios];
             PNprecios[PNcontprecios]=null;
             $("#PNvalortotal").html("<i>"+PNvalortotal+"</i>");
             $("#PNvalor_total").val(PNvalortotal);
             if(PNitem==1)
             {
                  $("#PNvalor_total").val(0);
             }
      }
      
   }
   function PNmiserializar()
   {
      var constante="";
      var variables=["PNitem","PNmedida","PNdescripcion","PNprecio","PNtotal","PNubicacion","PNcodigo","PNcuenta","PNcantidad"];
      for (var i = 1; i < PNitem; i++) {
               
               for (var j = 0; j < variables.length; j++) {
                        constante+=variables[j]+"="+$("#"+variables[j]+i).val()+"&";
               };
      };
      $("#PNdatos").val(null);
      $("#PNdatos").val(constante);
    //  alert(constante);
   }
 
});


///////////////////////////// funciones de validacion para INGRESOS ///////////////////////////////////////////
function PNvalidarcamposcarrito(){
      var inputs=$("#PNfrmcarrito :input");
      var formvalido = true;
       
      inputs.each(function(){
        
      if(this.value.length==0){
        $(this).parent().parent().addClass('has-error');
        formvalido = false;
      }else{
         $(this).parent().parent().removeClass('has-error');
      }
      });       
      return formvalido;
}
function PNIngresovalidarformconfirmacion()
{
      var inputs=$("#PNfrmingresoconfirmar :input");
      var formvalido = true;
       
      inputs.each(function(){
        
      //alert(this.value.toString());
      if(this.value.length==0){
        $(this).parent().parent().addClass('has-error');
        formvalido = false;
      }else{
         $(this).parent().parent().removeClass('has-error');
      } 
      });     
      return formvalido;
}



function PNrecpuerarproducto()
{

   var PNcodigo=$("#PNcodigo").val();
   var ur="pedidonormal/recuperarproducto/"+PNcodigo;
   $.ajax({
      type:"GET",
      url:ur,
      dataType:"json",
      success:function(data){
           if(data['estado']==1)
           {
                  $("#divPNcodigo").removeClass().addClass("form-group");
                  $("#ctrlPNcodigo div").remove();
                  $("#PNdescripcion").val(data['descripcion']);
                  $("#PNubicacion").val(data['ubicacion']);
                  $("#PNmedida").val(data['unidad']);
                  $("#PNcuenta option").remove();
                  $("#PNcuenta").val(data['cuenta']);
                  $("#PNpreciounitario").val(data['preciounitario']);
                  $("#PNcantidadactual").val(data['existencia']);
                  $("#PNcantidad").focus();

           }
           if (data['estado']==2)
           {
                  $("#divPNcodigo").removeClass().addClass("form-group has-warning");
                  $("#ctrlPNcodigo div").remove();
                  $("#PNdescripcion").val(null);
                  $("#PNubicacion").val(null);
                  $("#PNmedida").val(null);
                  $("#PNcuenta").val(null);
                  $("#PNpreciounitario").val(null);
                  ("#PNcantidadactual").val(null);
                  $("#ctrlPNcodigo").append('<div class="alert alert-warning small text-center" role="alert">El producto no Existe</div>');
           }
           
      }
   });

}



$(".numeros").keydown(function(event) {
         if(event.shiftKey)
         {
              event.preventDefault();
         }
       
         if (event.keyCode == 46 || event.keyCode == 8){
         }
         else {
              if (event.keyCode < 95) {
                if (event.keyCode < 48 || event.keyCode > 57) {
                      event.preventDefault();
                }
              } 
              else {

                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
              }
            }
         });

var contadordecimal=0;
$(".decimales").keydown(function(event) {
         
         if(event.shiftKey)
         {
              event.preventDefault();
         }
        if(this.value.length==0)
        {
               contadordecimal=0;
        }

                    if (event.keyCode == 110 || event.keyCode == 188 || event.keyCode==190)
                                  {
                                          if (contadordecimal<1)
                                          {
                                            contadordecimal++;
                                            //alert(contadordecimal.toString());
                                          }
                                          else
                                          {
                                                event.preventDefault();
                                          }
                                          
                                          
                                  }            
               
               else {
                        if (event.keyCode == 46 || event.keyCode == 8){
                       }
                       else{
                        if (event.keyCode < 95) {
                              if (event.keyCode < 48 || event.keyCode > 57) {
                                    event.preventDefault();
                              }
                            } 
                            else {
                                  
                                  if (event.keyCode < 96 || event.keyCode > 105) {
                                      event.preventDefault();
                                  }
                            }
                       }
                  
                  }
                  
                 
                 
           
         
         });



   

