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
    
    //Control cambio en provincia y canton al agregar Area de apoyo
    $("#provincia").change(function () {
        $("#provincia option:selected").each(function () {
            id_provincia = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_canton", { id_provincia: id_provincia}, function(data){
                $("#canton").html(data);
            });            
        });
    });
    $("#canton").change(function () {
        $("#canton option:selected").each(function () {
            id_canton = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_distrito", { id_canton: id_canton}, function(data){
                $("#distrito").html(data);  
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
    
    //Check para habilitar edicion de Información adicional
    $("#chk_info_adicional").change(function(){
        if (document.getElementById('Observaciones_generales').readOnly==true){
            document.getElementById('Observaciones_generales').readOnly=false;
            $("#Empresa").attr("disabled",false);
            $("#zonas_gerente").attr("disabled",false);
            $("#zonas_supervisores").attr("disabled",false);
        }else{
            document.getElementById('Observaciones_generales').readOnly=true;
            $("#Empresa").attr("disabled",true);
            $("#zonas_gerente").attr("disabled",true);
            $("#zonas_supervisores").attr("disabled",true);
            //Guarda Distrito y dirección en tabla  T_PuntoBCR
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            id_empresa = document.getElementById('Empresa').value;
            observaciones = document.getElementById('Observaciones_generales').value;
            id_gerente = document.getElementById('zonas_gerente').value;
            id_supervisor = document.getElementById('zonas_supervisores').value;
            
            $.post("index.php?ctl=PuntoBCR_actualiza_informacion_adicional", {id_puntobcr:id_puntobcr, id_empresa:id_empresa,
                observaciones:observaciones, id_gerente:id_gerente,id_supervisor:id_supervisor }, function(data){
                    //alert (data);
                    location.reload();    
                    
           });   
        }
    });
});  
//////////////////////////////////////////////////////////
//Función para Ocultas ventanas
function ocultar_elemento(){
    document.getElementById('agregar_telefono').style.display = "none";
    document.getElementById('asignar_ue').style.display = "none";
    document.getElementById('asignar_area').style.display = "none";
    document.getElementById('asignar_direccion_IP').style.display = "none";
    document.getElementById('asignar_horario').style.display = "none";
}

///////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número PuntoBCR
function check_empty() {
    if (document.getElementById('numero').value == "") {
        alert("Digita un número de teléfono !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('ventana').submit();
        document.getElementById('agregar_telefono').style.display = "none";
    }
}
function mostrar_agregar_telefono() {
    document.getElementById('agregar_telefono').style.display = "block";
}
function eliminar_telefono(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar este número de teléfono?', 
        confirm: function(){
            id_telefono= ide;
            $.post("index.php?ctl=puntobcr_desligar_telefono", { id_telefono: id_telefono}, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
};

////////////////////////////////////////////////////
//Funciones para UE
function mostrar_lista_ue(){
    document.getElementById('asignar_ue').style.display = "block";
}
function agregar_ue(id_ue){
    id_unidad_ejecutora = id_ue;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    document.getElementById('asignar_ue').style.display = "none";
    $.post("index.php?ctl=puntobcr_agregar_ue", { id_unidad_ejecutora: id_unidad_ejecutora, id_puntobcr:id_puntobcr}, function(data){
            location.reload();
            //alert (data);
          });
}
function eliminar_ue(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar la Unidad Ejecutora?', 
        confirm: function(){
            id_unidad_ejecutora= ide;
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=puntobcr_desligar_ue", { id_unidad_ejecutora: id_unidad_ejecutora,id_puntobcr:id_puntobcr }, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}
    
////////////////////////////////////////////////////
//Funcion para agregar o asignar Area de Apoyo
function mostrar_area_apoyo(){
    document.getElementById('asignar_area').style.display = "block";
}
function validar_area(){
     if (document.getElementById('nombre').value == "") {
        alert("Digita el nombre del Area de Apoyo !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('nueva_area_apoyo').submit();
        document.getElementById('asignar_area').style.display = "none";
    }
 }
function agregar_area(id){
    id_area_apoyo = id;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    $.post("index.php?ctl=puntobcr_asignar_area_apoyo", { id_area_apoyo: id_area_apoyo, id_puntobcr:id_puntobcr}, function(data){
            //alert (data);
            location.reload();
          });
}
function eliminar_area(ide){
    id_area_apoyo= ide;
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar el area de apoyo?', 
        confirm: function(){
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=puntobcr_desligar_area_apoyo", { id_area_apoyo: id_area_apoyo, id_puntobcr:id_puntobcr }, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}

///////////////////////////////////////////////
//Funciones para agregar o asignar Direccion IP
function mostrar_direccion_IP(){
    document.getElementById('asignar_direccion_IP').style.display = "block";
}
function asignar_ip(id){
    id_direccion_ip = id;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    $.post("index.php?ctl=puntobcr_asignar_direccion_ip", { id_direccion_ip: id_direccion_ip, id_puntobcr:id_puntobcr}, function(data){
            //alert (data);
            location.reload();
          });
}
function eliminar_ip(ide){
    id_direccion_ip= ide;
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar la dirección IP?', 
        confirm: function(){
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=puntobcr_desligar_direccion_ip", { id_direccion_ip: id_direccion_ip, id_puntobcr:id_puntobcr }, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}
function validar_direccion_ip(){
   if (document.getElementById('direccion_ip').value == "") {
        alert("Digita la dirección IP !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('nueva_direccion_ip').submit();
        document.getElementById('asignar_direccion_IP').style.display = "none";
    } 
}

///////////////////////////////////////////////////////////
//Funciones para asignar Horario al Punto BCR
function mostrar_horario(){
    document.getElementById('asignar_horario').style.display = "block";
}
function asignar_horario(id_hora){
    id_horario = id_hora;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    document.getElementById('asignar_horario').style.display = "none";
    $.post("index.php?ctl=puntobcr_asignar_horario", { id_horario: id_horario, id_puntobcr:id_puntobcr}, function(data){
            //alert (data);
            location.reload();
          });
}
