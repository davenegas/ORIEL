function hacer_click(){
    $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
        
    fecha_inicial=document.getElementById('fecha_inicial').value;
    fecha_final=document.getElementById('fecha_final').value;
    usuario=document.getElementById('lista_usuarios').value;
    tabla=document.getElementById('tabla_afectada').value;
                  
    //$("#cuerpo").empty();
    //$("#tabla").dataTable().fnReloadAjax();

    /*$.ajax({
       type: "POST",
       url: "index.php?ctl=actualiza_en_vivo_reporte_trazabilidad",
       data: {fecha_inicial: fecha_inicial,fecha_final:fecha_final,usuario:usuario,tabla:tabla },
       success: function(data) {
           //Cargamos finalmente el contenido deseado
           $("#cuerpo").empty();
           $('#cuerpo').fadeIn(1000).html(data);
           $("#tabla").refresh();
       }
    });*/
     /*$("#tabla").dataTable().empty();
     $("#tabla").dataTable().reload();
     $("#tabla").dataTable().reset();
     $("#tabla").dataTable().clear();*/
    //$("#tabla").dataTable().fnDestroy();
    //$("#cuerpo").dataTable().fnPageChange('first');

    $.post("index.php?ctl=actualiza_en_vivo_reporte_trazabilidad", {fecha_inicial: fecha_inicial,fecha_final:fecha_final,usuario:usuario,tabla:tabla }, function(data){
        // $("#cuerpo").empty();
        //$("#tabla").dataTable().fnDestroy();
        //$("#tabla").dataTable().fnPageChange('first');
        //$("#tabla").dataTable().fnClear();
        //location.reload();
        //$("#tabla").html().empty();
         $("#titulo").html("Movimientos de acuerdo a parámetros:");  
         $("#tabla").html(data);   
         $("#tabla").dataTable().fnDestroy();
         $("#tabla").dataTable().draw();

        //$("#tabla").dataTable().fnReloadAjax();
    });    
}