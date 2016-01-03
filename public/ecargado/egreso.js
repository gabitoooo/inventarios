$(document).on("ready",function(){

  var EGitem=1;
  $("#EGbtnagregar").on("click",function(){
   		  if (EGvalidarcamposcarrito()==true)
        {
            var actual=parseInt($("#EGcantidadactual").val());
            var pedida=parseInt($("#EGcantidad").val());
            if(pedida<=actual)
            {
                  EGingresar();
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
 
   $("#EGbtnborrar").on("click",function(){
         EGborrar_tabla();
   });
 
  $("#frmegresoconfirmar").submit(function(){

       //controlar cosas todavia
        if ($("#EGnumero_pedido").val()=="No hay pedido pedidos normales ni de compras")
        {
                alert("no hay pedidos pendientes");
                return false;
        }else
        {
                 EGmiserializar();
                 window.location.href="/";
        }
                  
           /* if (EGIngresovalidarformconfirmacion())
           {
                  
           }
           else
           {
              //alert("incorrecto");
              return false;
           }*/
       
         
  });

  $("#EGcodigo").focusout(function(){
      EGrecpuerarproducto();
   });   
  $("#EGcodigo").focusin(function(){
          $("#divEGcodigo").removeClass().addClass("form-group");
          $("#EGcodigo").val(null);
          $("#ctrlEGcodigo div").remove();
          $("#EGdescripcion").val(null);
          $("#EGubicacion").val(null);
          $("#EGmedida").val(null);
          $("#EGcuenta").val(null);
          $("#EGpreciounitario").val(null);
          $("#EGcantidad").val(null);
          $("#EGcantidadactual").val(null);
          $("#EGunidad_uso").val(null);
         
  });

//funciones para el carrito
function EGingresar()
   {
            var EGcodigo=$("#EGcodigo").val();
            var EGcantidad=$("#EGcantidad").val();
            var EGmedida=$("#EGmedida").val();
            var EGdescripcion=$("#EGdescripcion").val();           
            var EGunidad_uso=$("#EGunidad_uso").val();
            $("#EGcuerpo").append("<tr id='EGtr"+EGitem+"'><td><input type='text' name='EGitem' id='EGitem"+EGitem+"' readonly  class='sinstylo' value="+EGitem+"></td><td><input type='text' name='EGcodigo' id='EGcodigo"+EGitem+"' readonly  class='sinstylo' value="+EGcodigo+"></td><td><input type='text' name='EGcantidad' id='EGcantidad"+EGitem+"' readonly  class='sinstylo' value="+EGcantidad+"></td><td><input type='text' name='EGmedida' id='EGmedida"+EGitem+"' readonly  class='sinstylo' value="+EGmedida+"></td><td><input type='text' name='EGunidad_uso' id='EGunidad_uso"+EGitem+"' readonly  class='sinstylo' value="+EGunidad_uso+"></td><td><input type='text' name='EGdescripcion' id='EGdescripcion"+EGitem+"' readonly  class='sinstylo' value="+EGdescripcion+"></td>");
            EGitem++;
            EGlimpiar();
   }
   function EGlimpiar(){
            $("#divEGcodigo").removeClass().addClass("form-group");
            $("#EGcantidad").val(null);
            $("#EGmedida").val(null);
            $("#EGdescripcion").val(null);
            $("#EGpreciounitario").val(null);
            $("#EGubicacion").val(null);
            $("#EGprecio")
            $("#EGcodigo").val(null);
            $("#EGcantidadactual").val(null);
            $("#EGunidad_uso").val(null);
   }
   function EGborrar_tabla()
   {
            
      if (EGitem>1)
      {
             EGitem--;
             $("#EGtr"+EGitem+"").remove();            
     }
      
   }
   function EGmiserializar()
   {
      var constante="";
      var variables=["EGitem","EGcodigo","EGcantidad","EGunidad_uso"];
      for (var i = 1; i < EGitem; i++) {
               
               for (var j = 0; j < variables.length; j++) {
                        constante+=variables[j]+"="+$("#"+variables[j]+i).val()+"&";
               };
      };
      $("#EGdatos").val(null);
      $("#EGdatos").val(constante);
      //alert(constante);
   }
 
});


///////////////////////////// funciones de validacion para INGRESOS ///////////////////////////////////////////
function EGvalidarcamposcarrito(){
      var inputs=$("#EGfrmcarrito :input");
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
function EGIngresovalidarformconfirmacion()
{
      var inputs=$("#EGfrmingresoconfirmar :input");
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



function EGrecpuerarproducto()
{

   var EGcodigo=$("#EGcodigo").val();
   var ur="egreso/recuperarproducto/"+EGcodigo;
   $.ajax({
      type:"GET",
      url:ur,
      dataType:"json",
      success:function(data){
           if(data['estado']==1)
           {
                  $("#divEGcodigo").removeClass().addClass("form-group");
                  $("#ctrlEGcodigo div").remove();
                  $("#EGdescripcion").val(data['descripcion']);
                  $("#EGubicacion").val(data['ubicacion']);
                  $("#EGmedida").val(data['unidad']);
                  $("#EGcuenta").val(data['cuenta']);
                  $("#EGpreciounitario").val(data['preciounitario']);
                  $("#EGcantidadactual").val(data['existencia']);
                  $("#EGcantidad").focus();

           }
           if (data['estado']==2)
           {
                  $("#divEGcodigo").removeClass().addClass("form-group has-warning");
                  $("#ctrlEGcodigo div").remove();
                  $("#EGdescripcion").val(null);
                  $("#EGubicacion").val(null);
                  $("#EGmedida").val(null);
                  $("#EGcuenta").val(null);
                  $("#EGpreciounitario").val(null);
                  ("#EGcantidadactual").val(null);
                  $("#ctrlEGcodigo").append('<div class="alert alert-warning small text-center" role="alert">El producto no Existe</div>');
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



   

