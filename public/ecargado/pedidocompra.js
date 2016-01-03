$(document).on("ready",function(){

  var PCitem=1;   
   $("#PCbtnagregar").on("click",function(){
   		 


        if (PCvalidarcamposcarrito()==true)
        {
            PCingresar();
        }
        
            
	});
 
   $("#PCbtnborrar").on("click",function(){
         PCborrar_tabla();
   });
 
  $("#PCfrmingresoconfirmar").submit(function(){
            PCmiserializar();
             window.location.href="/";
           //hacer controles todavia falta!!!!!!!!!!
            /*if (PCIngresovalidarformconfirmacion()==false)
           {
                  PCmiserializar();
                  return true;
           }
           else
           {
              //alert("incorrecto");
              return false;
           }
       */
         
  });
  $("#PCexiste").click( function(){
     if( $(this).is(':checked') )
     {
                  $("#PCcodigo").removeAttr('disabled');
                  $("#PCnumero_interno").val(null);
                  $("#PCnumero_interno").attr('disabled','disabled');
                  $("#PCdescripcion").val(null);
                  $("#PCdescripcion").attr('disabled','disabled');
                  $("#PCubicacion").val(null);
                  $("#PCmedida").val(null);
                  $("#PCmedida").attr('disabled','disabled');
     
     } 
  });

   $("#PCnuevo").click( function(){
     if( $(this).is(':checked') )
     {
                
                  $("#divPCcodigo").removeClass().addClass("form-group");
                  $("#ctrlPCcodigo div").remove();
                  $("#PCcodigo").val(null);
                   $("#PCcodigo").attr('disabled','disabled');
                  $("#ctrlPCcodigo").attr('disabled','disabled');
                  $("#PCnumero_interno").val(null);
                  $("#PCnumero_interno").removeAttr("disabled");
                  $("#PCdescripcion").val(null);
                  $("#PCdescripcion").removeAttr('disabled');
                  $("#PCubicacion").val(null);
                  $("#PCmedida").val(null);
                  $("#PCmedida").removeAttr('disabled');
                  $("#PCprecioactual").val(null);
     } 
  });

  $("#PCcodigo").focusout(function(){
      PCrecpuerarproducto();
   });   

//funciones para el carrito
function PCingresar()
   {
            var tipoproduct;
            if ($("#PCexiste").is(':checked'))
            {
                tipoproduct="existente";
            }
            if ($("#PCnuevo").is(':checked'))
            {
                tipoproduct="nuevo";
            } 
            var PCcantidad=$("#PCcantidad").val();
            var PCmedida=$("#PCmedida").val();
            var PCdescripcion=$("#PCdescripcion").val();
            var PCubicacion=$("#PCubicacion").val();
            var PCcodigo=$("#PCcodigo").val();
            var PCnumero_interno=$("#PCnumero_interno").val();
            $("#PCcuerpo").append("<tr id='PCtr"+PCitem+"'><td><input type='text' name='PCitem' id='PCitem"+PCitem+"' readonly  class='sinstylo' value="+PCitem+"></td><td><input type='text' name='PCcantidad' id='PCcantidad"+PCitem+"' readonly  class='sinstylo' value="+PCcantidad+"></td><td><input type='text' name='PCmedida' id='PCmedida"+PCitem+"' readonly  class='sinstylo' value="+PCmedida+"></td><td><input type='text' name='PCdescripcion' id='PCdescripcion"+PCitem+"' readonly  class='sinstylo' value="+PCdescripcion+"></td><td><input type='text' name='PCubicacion' id='PCubicacion"+PCitem+"' readonly  class='sinstylo' value="+PCubicacion+"></td><td><input type='text' name='PCcodigo' id='PCcodigo"+PCitem+"' readonly  class='sinstylo' value="+PCcodigo+"></td><td><input type='text' name='PCnumero_interno' id='PCnumero_interno"+PCitem+"' readonly  class='sinstylo' value='"+PCnumero_interno+"'></td><td><input type='text' name='PCtipoproduct' id='PCtipoproduct"+PCitem+"' readonly  class='sinstylo' value='"+tipoproduct+"'></td></tr>");
           

            PCitem++;
            PClimpiar();
   }
   function PClimpiar(){
            $("#PCcantidad").val(null);
            $("#PCmedida").val(null);
            $("#PCdescripcion").val(null);
            $("#PCubicacion").val(null);
            $("#PCcodigo").val(null);
            $("#PCnumero_interno").val(null);
   }
   function PCborrar_tabla()
   {
            
      if (PCitem>1)
      {
             PCitem--;
             $("#PCtr"+PCitem+"").remove();            
      }
      
   }
   function PCmiserializar()
   {
      var PCconstante="";
      var PCvariables=["PCitem","PCcantidad","PCmedida","PCdescripcion","PCubicacion","PCcodigo","PCnumero_interno","PCtipoproduct"];
      for (var i = 1; i < PCitem; i++) {
               
               for (var j = 0; j < PCvariables.length; j++) {
                        PCconstante+=PCvariables[j]+"="+$("#"+PCvariables[j]+i).val()+"&";
               };
      };
      $("#PCdatos").val(null);
      $("#PCdatos").val(PCconstante);

      
   }
 
});


///////////////////////////// funciones de validacion para INGRESOS ///////////////////////////////////////////
function PCvalidarcamposcarrito(){
      var formcontrol=false;
      if ($("#PCexiste").is(':checked'))
      {
          if ($("#PCcodigo").val() != ""  && $("#PCcantidad").val() != "" )
          {
               formcontrol=true; 
          }
          else
          {
              alert("faltan campos producto existente");
          }
      }
      if ($("#PCnuevo").is(':checked'))
      {
          if ($("#PCnumero_interno").val()!="" && $("#PCmedida").val()!="" && $("#PCdescripcion").val()!="" && $("#PCcantidad").val()!="")
          {
               formcontrol=true;
          }  
          
          else
          {
              alert("faltan campos que llegar producto nuevo");
          }
      }    

      return formcontrol;

      
}
function PCIngresovalidarformconfirmacion()
{
      var inputs=$("#PCfrmingresoconfirmar :input");
      var PCformvalido = true;
       
      inputs.each(function(){
        
      alert(this.val().toString());
      if(this.val().length==0){
        $(this).parent().parent().addClass('has-error');
        formvalido = false;
      }else{
         $(this).parent().parent().removeClass('has-error');
      } 
      });     
      return PCformvalido;
}



function PCrecpuerarproducto()
{

   var PCcodigo=$("#PCcodigo").val();
   var ur="pedidocompra/recuperarproducto/"+PCcodigo;
   $.ajax({
      type:"GET",
      url:ur,
      dataType:"json",
      success:function(data){
           if(data['estado']==1)
           {
                  $("#divPCcodigo").removeClass().addClass("form-group");
                  $("#ctrlPCcodigo div").remove();
                  $("#PCdescripcion").val(data['descripcion']);
                  $("#PCubicacion").val(data['ubicacion']);
                  $("#PCmedida").val(data['unidad']);
                  $("#PCprecioactual").val(data['precio']);
           
           }
           if (data['estado']==2)
           {
                  
                  $("#divPCcodigo").removeClass().addClass("form-group has-warning");
                  $("#ctrlPCcodigo div").remove();
                  $("#PCdescripcion").val(null);
                  $("#PCubicacion").val(null);
                  $("#PCmedida").val(null);
                  $("#ctrlPCcodigo").append('<div class="alert alert-warning small text-center" role="alert">Este producto no existe, si desea comprar un nuevo producto selecione la opcion de nuevo producto</div>');
                  $("#PCcodigo").val(null);
                   $("#PCprecioactual").val(null);
           }
           
      }
   });

}




   
