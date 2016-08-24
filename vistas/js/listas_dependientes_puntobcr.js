$(document).ready(function(){
    //Buscar Distritos al seleccionar cantón
    $("#Provincia").change(function () {
        $("#Provincia option:selected").each(function () {
            id_provincia = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_canton", { id_provincia: id_provincia}, function(data){
                $("#Canton").html(data);
            });            
        });
    });
    
    //Buscar Distritos al seleccionar cantón
    $("#Canton").change(function () {
        $("#Canton option:selected").each(function () {
            id_canton = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_distrito", { id_canton: id_canton}, function(data){
                $("#Distrito").html(data);  
            });            
        });
    });
    
    //Check para habilitar edicion de Información General del PuntoBCR
    $("#chk_informacion_general").change(function(){
        if (document.getElementById('Codigo').readOnly==true){
            document.getElementById('Codigo').readOnly=false;
            document.getElementById('Cuenta_SIS').readOnly =false;
            document.getElementById('Nombre').readOnly =false;
            $("#Tipo_Punto").attr("disabled",false);
        }else{
            document.getElementById('Codigo').readOnly=true;
            document.getElementById('Cuenta_SIS').readOnly =true;
            document.getElementById('Nombre').readOnly =true;
            $("#Tipo_Punto").attr("disabled",true);
            //Guarda codigo, cuenta_SIS, Nombre y tipo de punto en tabla  T_PuntoBCR
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            codigo=document.getElementById('Codigo').value;
            cuenta=document.getElementById('Cuenta_SIS').value;
            nombre=document.getElementById('Nombre').value;
            tipo_punto= document.getElementById('Tipo_Punto').value;
            $.post("index.php?ctl=puntoBCR_guardar_informacion_general", { id_puntobcr:id_puntobcr, codigo: codigo, cuenta:cuenta, nombre:nombre,tipo_punto:tipo_punto}, function(data){
                //alert (data);
            });   
        }
    });
    
    //Check para habilitar edicion de Ubicación del PuntoBCR
    $("#chk_ubicacion").change(function(){
        if (document.getElementById('Direccion').readOnly==true){
            document.getElementById('Direccion').readOnly=false;
            $("#Provincia").attr("disabled",false);
            $("#Canton").attr("disabled",false);
            $("#Distrito").attr("disabled",false);
        }else{
            document.getElementById('Direccion').readOnly=true;
            $("#Provincia").attr("disabled",true);
            $("#Canton").attr("disabled",true);
            $("#Distrito").attr("disabled",true);
            //Guarda Distrito y dirección en tabla  T_PuntoBCR
            id_distrito=document.getElementById('Distrito').value;
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            direccion = document.getElementById('Direccion').value;
            $.post("index.php?ctl=distrito_PuntoBCR_guardar", { id_distrito: id_distrito, id_puntobcr:id_puntobcr, direccion:direccion}, function(data){
                //alert (data);
            });   
        }
    });
});   

function eliminar_telefono(ide){
        id_telefono= ide;
        //$.post("index.php?ctl=puntobcr_desligar_telefono", { id_telefono: id_telefono}, function(data){
          //      alert (data);
           // });
    };