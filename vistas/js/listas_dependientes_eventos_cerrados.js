     $(document).ready(function(){
           $("#tipo_punto").change(function () {
                $("#tipo_punto option:selected").each(function () {
                    id_tipo_punto_bcr = $(this).val();
                    id_provincia=document.getElementById('nombre_provincia').value;
                    $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data);
                    });            
                });
           });
           $("#nombre_provincia").change(function () {
                $("#nombre_provincia option:selected").each(function () {
                    id_provincia = $(this).val();
                    id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("index.php?ctl=actualiza_en_vivo_punto_bcr", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data); 
                    });            
                });
           });
        });

    function hacer_click(){
        $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
        $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
        
        fecha_inicial=document.getElementById('fecha_inicial').value;
        fecha_final=document.getElementById('fecha_final').value;
        id_punto_bcr=document.getElementById('punto_bcr').value;
        tipo_evento = document.getElementById('tipo_evento').value;
        provincia = document.getElementById('nombre_provincia').value;
        tipo_punto = document.getElementById('tipo_punto').value;
        //tabla=document.getElementById('tabla_afectada').value;
                           
        $.post("index.php?ctl=actualiza_en_vivo_reporte_cerrados", {fecha_inicial: fecha_inicial,fecha_final:fecha_final,id_punto_bcr:id_punto_bcr, tipo_evento:tipo_evento, provincia:provincia, tipo_punto:tipo_punto}, function(data){
            $("#titulo").html("Eventos de acuerdo a parámetros:");  
            $("#tabla").html(data);   
            $("#tabla").dataTable().fnDestroy();
            $("#tabla").DataTable().draw();
        });    
    }