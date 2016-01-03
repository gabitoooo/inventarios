$(document).on("ready",function(){
    var REitem=1;
    var egresos=new Array();
    var contegrs=0;
    $("#btnEgresoBuscar").on("click",function(){
        
        RErecuperarproductos($("#numeroEgreso").val());
    });
    $("#REbtnborrar").on("click",function(){
         for(i=1;i<=REitem;i++)
          {
            $("#REtr").remove();
          }
          egresos=new Array();
          REitem=1;
          contegrs=0;

          
    });

     $("#frmRemisionConfirmar").submit(function(){

       //controlar cosas todavia
                  REmiserializar();
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

 function RErecuperarproductos(numero)
    {
            egresos[contegrs]=numero;
            contegrs++;
            var ur="remision/recuperarproductos";
            var dataString = 'numero='+numero; 
             $.ajax({
                type:"POST",
                data:dataString,
                url:ur,
                dataType:"json",
               success:function(data){
                  $.each(data,function(i,item)
                   {
                          $("#REcuerpo").append("<tr id='REtr'><td><input type='text' readonly  class='sinstylo' value="+REitem+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].medida+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].cantidad+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].unidad+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].descripcion+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].codigo+"></td><td><input type='text' readonly  class='sinstylo' value="+data[i].pedido+"></td>");
                          REitem++;
                   });
                }
             });
    } 

    function REmiserializar()
   {
      var constante="";
     for (var i = 0; i < egresos.length; i++) {
            constante+="egreso"+"="+egresos[i]+"&";
               
      };
      $("#REdatos").val(null);
      $("#REdatos").val(constante);
      //alert(constante);
   }


 
});

   