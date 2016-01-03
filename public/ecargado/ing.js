$(document).on("ready",function(){

  var item=1;
   var contprecios=0;
   var precios=new Array();
  var valortotal=0;
   $("#btnagregar").on("click",function(){
        if (validarcamposcarrito()==true)
        {
            ingresar();
        }
        else 
        {
           //alert("incorrecto");
        }
            
  });
 
   $("#btnborrar").on("click",function(){
         borrar_tabla();
   });
 
  $("#frmingresoconfirmar").submit(function(){

       //controlar cosas todavia
            miserializar();
            window.location.href="/";
           /* if (Ingresovalidarformconfirmacion()==false)
           {
                  
                return false;
           }
           else
           {
              
              //alert("incorrecto");
              
           }*/
       
         
  });

  $("#codigo").focusout(function(){
      recpuerarproducto();
   });   

//funciones para el carrito
function ingresar()
   {
            var cantidad=$("#cantidad").val();
            var medida=$("#medida").val();
            var descripcion=$("#descripcion").val();
            var precio=$("#preciounitario").val();
            var prec=precio.split(",");
            if (prec.length>1)
            {
                precio=prec[0]+'.'+prec[1];
                alert(precio.toString());
            }
            var total=cantidad*precio;
            var ubicacion=$("#ubicacion").val();
            var codigo=$("#codigo").val();
            var cuenta=$("#cuenta").val();
            valortotal+=total;
            precios[contprecios]=total;
            contprecios++;
            $("#cuerpo").append("<tr id='tr"+item+"'><td><input type='text' name='item' id='item"+item+"' readonly  class='sinstylo' value="+item+"></td><td><input type='text' name='cantidad' id='cantidad"+item+"' readonly  class='sinstylo' value="+cantidad+"></td><td><input type='text' name='medida' id='medida"+item+"' readonly  class='sinstylo' value="+medida+"></td><td><input type='text' name='descripcion' id='descripcion"+item+"' readonly  class='sinstylo' value="+descripcion+"></td><td><input type='text' name='precio' id='precio"+item+"' readonly  class='sinstylo' value="+precio+"></td><td><input type='text' name='total' id='total"+item+"' readonly  class='sinstylo' value="+total+"></td><td><input type='text' name='ubicacion' id='ubicacion"+item+"' readonly  class='sinstylo' value="+ubicacion+"></td><td><input type='text' name='codigo' id='codigo"+item+"' readonly  class='sinstylo' value="+codigo+"></td><td><input type='text' name='cuenta' id='cuenta"+item+"' readonly  class='sinstylo' value='"+cuenta+"'></td></tr>");
            $("#valortotal").html("<i>"+valortotal+"</i>");
            $("#valor_total").val(valortotal);
            item++;
            limpiar();
   }
   function limpiar(){
            $("#divcodigo").removeClass().addClass("form-group");
            $("#cantidad").val(null);
            $("#medida").val(null);
            $("#descripcion").val(null);
            $("#preciounitario").val(null);
            $("#ubicacion").val(null);
            $("#codigo").val(null);
   }
   function borrar_tabla()
   {
            
      if (item>1)
      {
             item--;
             contprecios--;
             $("#tr"+item+"").remove();            
             valortotal=$("#valor_total").val()-precios[contprecios];
             $("#valortotal").html("<i>"+valortotal+"</i>");
             $("#valor_total").val(valortotal);
      }
      
   }
   function miserializar()
   {
      var constante="";
      var variables=["item","medida","descripcion","precio","total","ubicacion","codigo","cuenta","cantidad"];
      for (var i = 1; i < item; i++) {
               
               for (var j = 0; j < variables.length; j++) {
                        constante+=variables[j]+"="+$("#"+variables[j]+i).val()+"&";
               };
      };
      $("#datos").val(constante);
      //alert(constante);
   }
 
});


///////////////////////////// funciones de validacion para INGRESOS ///////////////////////////////////////////
function validarcamposcarrito(){
      var inputs=$("#frmcarrito :input");
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
function Ingresovalidarformconfirmacion()
{
      var inputs=$("#frmingresoconfirmar :input");
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



function recpuerarproducto()
{

   var codigo=$("#codigo").val();
   var ur="ingreso/recuperarproducto/"+codigo;
   $.ajax({
      type:"GET",
      url:ur,
      dataType:"json",
      success:function(data){
           if(data['estado']==1)
           {
                  $("#divcodigo").removeClass().addClass("form-group");
                  $("#ctrlcodigo div").remove();
                  $("#descripcion").val(data['descripcion']);
                  $("#ubicacion").val(data['ubicacion']);
                  $("#medida").val(data['unidad']);
                  $("#cuenta option").remove();
                  $("#cuenta").append('<option>'+data['cuenta']+'</option>')
                  $("#preciounitario").focus();

           }
           if (data['estado']==2)
           {
                  $("#divcodigo").removeClass().addClass("form-group has-warning");
                  $("#ctrlcodigo div").remove();
                  $("#cuenta option").remove();
                  $("#descripcion").val(null);
                  $("#ubicacion").val(null);
                  $("#medida").val(null);
                  $("#cuenta option").remove();
                  //alert(data['cuentas'][0].nombre_cuenta);
                  //alert(data['cuentas'][1].nombre_cuenta);
                  //alert(data['cuentas'][2].nombre_cuenta)
                  for (var i = 0; i < data['cuentas'].length; i++) 
                  {
                        $("#cuenta").append('<option>'+data['cuentas'][i].nombre_cuenta+'</option>')         
                  };       
                  $("#ctrlcodigo").append('<div class="alert alert-warning small text-center" role="alert">Este es un nuevo producto</div>');
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



   

