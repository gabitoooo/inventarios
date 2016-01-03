$(document).on("ready",function(){
  function editar_cuenta(id){
  var di = id;
  alert(di);
  //var faction = window.location.href="editarcuenta/"+id;
  var faction = "<?php echo URL::to('editarcuenta/"+di+"'); ?>";
  var fdata = $('#val').serialize();
  $.post(faction, fdata, function(json){
    if(json.success){
        $('#formCuenta input[name="id_cuenta"]').val(json.id);
        $('#formCuenta input[name="nombre"]').val(json.nombre);
        $('#formCuenta input[name="numero"]').val(json.numero);
    }else{
        $('#errorMenssage').html(json.menssage);
        $('#errorMenssage').show();   
    }
  });
  }
});

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