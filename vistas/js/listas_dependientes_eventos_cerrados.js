      function hacer_click(){

        $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
        
         fecha_inicial=document.getElementById('fecha_inicial').value;
         fecha_final=document.getElementById('fecha_final').value;
         usuario=document.getElementById('lista_usuarios').value;
         tabla=document.getElementById('tabla_afectada').value;
                           
        $.post("index.php?ctl=actualiza_en_vivo_reporte_trazabilidad", {fecha_inicial: fecha_inicial,fecha_final:fecha_final,usuario:usuario,tabla:tabla }, function(data){
        
            $("#titulo").html("Movimientos de acuerdo a parámetros:");  
            $("#tabla").html(data);   
            $("#tabla").dataTable().fnDestroy();
            $("#tabla").dataTable().draw();
            
        });    
	}