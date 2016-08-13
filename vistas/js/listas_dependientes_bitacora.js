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
           
           $("#punto_bcr").change(function () {
                   $("#punto_bcr option:selected").each(function () {
                    id_punto_bcr = $(this).val();
                    id_tipo_evento=document.getElementById('tipo_evento').value;
                    $.post("index.php?ctl=alerta_en_vivo_mismo_punto_bcr_y_evento", { id_punto_bcr: id_punto_bcr,id_tipo_evento:id_tipo_evento }, function(data){
                        //$(document).html(data);
                    if (data!=""){
                         alert(data);
                     }
                    });            
                });
           });
           $("#tipo_evento").change(function () {
                   $("#tipo_evento option:selected").each(function () {
                    id_tipo_evento = $(this).val();
                     if(document.getElementById('punto_bcr').value==""){
                        id_punto_bcr=0;
                    }else{
                        id_punto_bcr=document.getElementById('punto_bcr').value;
                    }          
                    $.post("index.php?ctl=alerta_en_vivo_mismo_punto_bcr_y_evento", { id_punto_bcr: id_punto_bcr,id_tipo_evento:id_tipo_evento }, function(prueba){
                        //$(document).html(data);
                    if (prueba!=""){
                         alert(prueba);
                     }
                    });    
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
                    $("#Canton").attr("disabled",false);
                    $("#Distrito").attr("disabled",false);
                    //Guarda Distrito en table  T_PuntoBCR
                    
                    
                }else{
                    document.getElementById('Direccion').readOnly=true;
                    $("#Provincia").attr("disabled",true);
                    $("#Canton").attr("disabled",true);
                    $("#Distrito").attr("disabled",true);
                    
                    id_distrito=document.getElementById('Distrito').value;
                    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
                    direccion = document.getElementById('Direccion').value;
                    
                    $.post("index.php?ctl=distrito_PuntoBCR_guardar", { id_distrito: id_distrito, id_puntobcr:id_puntobcr, direccion:direccion}, function(data){
                        //alert (data);
                    });   
                }
           });
        });
    
   

