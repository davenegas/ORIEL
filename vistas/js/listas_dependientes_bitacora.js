$(document).ready(function(){
           $("#tipo_punto").change(function () {
                   $("#tipo_punto option:selected").each(function () {
                    id_tipo_punto_bcr = $(this).val();
                    id_provincia=document.getElementById('nombre_provincia').value;
                    $.post("vistas/plantillas/filtra_sitios_bcr_bitacora.php", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data);
                        
                    });            
                });
           });
           $("#nombre_provincia").change(function () {
                   $("#nombre_provincia option:selected").each(function () {
                    id_provincia = $(this).val();
                    id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("vistas/plantillas/filtra_sitios_bcr_bitacora.php", { id_tipo_punto_bcr: id_tipo_punto_bcr,id_provincia:id_provincia }, function(data){
                        $("#punto_bcr").html(data);
                        
                    });            
                });
           });
           $("#tipo_evento").change(function () {
                   $("#tipo_evento option:selected").each(function () {
                    id_tipo_evento = $(this).val();
                    //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("index.php?ctl=actualiza_en_vivo_estado_evento", { id_tipo_evento: id_tipo_evento}, function(data){
                        $("#estado_evento").html(data);
                        
                    });            
                });
           });
            $("#Provincia").change(function () {
                   $("#Provincia option:selected").each(function () {
                    id_provincia = $(this).val();
                    //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("index.php?ctl=actualiza_en_vivo_canton", { id_provincia: id_provincia}, function(data){
                        $("#Canton").html(data);
                        
                    });            
                });
           });
           $("#Canton").change(function () {
                   $("#Canton option:selected").each(function () {
                    id_canton = $(this).val();
                    //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
                    $.post("index.php?ctl=actualiza_en_vivo_distrito", { id_canton: id_canton}, function(data){
                        $("#Distrito").html(data);
                        
                    });            
                });
           });
           $("#chk_ubicacion").change(function(){
                if (document.getElementById('Direccion').readOnly==true){
                    document.getElementById('Direccion').readOnly=false;
                    $("#Provincia").attr("disabled",false);

                }else{
                    document.getElementById('Direccion').readOnly=true;
                    $("#Provincia").attr("disable",true);
                }
           });
        });
    
   

