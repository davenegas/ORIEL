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
        if (document.getElementById('Cuenta_SIS').readOnly==true){
            document.getElementById('Cuenta_SIS').readOnly =false;
            $("#Tipo_Punto").attr("disabled",false);
            //document.getElementById('Codigo').readOnly=false;
            //document.getElementById('Nombre').readOnly =false;
        }else{
            document.getElementById('Cuenta_SIS').readOnly =true;
            $("#Tipo_Punto").attr("disabled",true);
            //document.getElementById('Codigo').readOnly=true;
            //document.getElementById('Nombre').readOnly =true;
            
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
            document.getElementById('Geolocalizacion').hidden=false;
        }else{
            document.getElementById('Direccion').readOnly=true;
            $("#Provincia").attr("disabled",true);
            $("#Canton").attr("disabled",true);
            $("#Distrito").attr("disabled",true);
            document.getElementById('Geolocalizacion').hidden=true;
            //Guarda Distrito y dirección en tabla  T_PuntoBCR
            id_distrito=document.getElementById('Distrito').value;
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            direccion = document.getElementById('Direccion').value;
            Geolocalizacion= document.getElementById('Geolocalizacion').value;
            $.post("index.php?ctl=distrito_PuntoBCR_guardar", { id_distrito: id_distrito, id_puntobcr:id_puntobcr, direccion:direccion, Geolocalizacion:Geolocalizacion}, function(data){
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
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none";
    document.getElementById('ventana_oculta_3').style.display = "none";
    document.getElementById('ventana_oculta_4').style.display = "none";
    document.getElementById('ventana_oculta_5').style.display = "none";
    document.getElementById('ventana_oculta_6').style.display = "none";
}

///////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número PuntoBCR
function check_empty() {
    if (document.getElementById('numero_telefono').value == "") {
        alert("Digita un número de teléfono !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('ventana').submit();
        document.getElementById('ventana_oculta_1').style.display = "none";
    }
}

function mostrar_agregar_telefono() {
    $("#Tipo_Telefono option[value=1]").attr("selected",true);
    document.getElementById('ID_Telefono').value="0";
    document.getElementById('numero_telefono').value="";
    document.getElementById('observaciones_telefono').value="";
    
    document.getElementById('ventana_oculta_1').style.display = "block";
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
}

function editar_telefono(id_tel, tipo_tel, num, obser){
    $("#Tipo_Telefono option[value="+tipo_tel+"]").attr("selected",true);
    document.getElementById('ID_Telefono').value=id_tel;
    document.getElementById('numero_telefono').value=num;
    document.getElementById('observaciones_telefono').value=obser;
    
    document.getElementById('ventana_oculta_1').style.display = "block";
}

////////////////////////////////////////////////////
//Funciones para UE
function mostrar_lista_ue(){
    document.getElementById('ventana_oculta_2').style.display = "block";
}

function agregar_ue(id_ue){
    id_unidad_ejecutora = id_ue;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    document.getElementById('ventana_oculta_2').style.display = "none";
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
    document.getElementById('ventana_oculta_3').style.display = "block";
}

function validar_area(){
     if (document.getElementById('nombre').value == "") {
        alert("Digita el nombre del Area de Apoyo !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('nueva_area_apoyo').submit();
        document.getElementById('ventana_oculta_3').style.display = "none";
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
    document.getElementById('ID_Direccion_IP').value = "0";
    document.getElementById('lista_direcciones').hidden=false;
    document.getElementById('direccion_ip').value = "";
    document.getElementById('observaciones_ip').value = "";
    document.getElementById('ventana_oculta_4').style.display = "block";
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
        document.getElementById('ventana_oculta_4').style.display = "none";
    } 
}

function editar_ip(ide, tipo, direc, obser){
    document.getElementById('lista_direcciones').hidden=true;
    document.getElementById('ID_Direccion_IP').value = ide;
    $("#tipo_ip option[value="+tipo+"]").attr("selected",true);
    document.getElementById('direccion_ip').value = direc;
    document.getElementById('observaciones_ip').value = obser;
    document.getElementById('ventana_oculta_4').style.display = "block";
}

///////////////////////////////////////////////////////////
//Funciones para asignar Horario al Punto BCR
function mostrar_horario(){
    document.getElementById('ventana_oculta_5').style.display = "block";
}

function asignar_horario(id_hora, tipo){
    id_horario = id_hora;
    tipo_horario= tipo;
    id_puntobcr = document.getElementById('ID_PuntoBCR').value;
    document.getElementById('ventana_oculta_5').style.display = "none";
    $.post("index.php?ctl=puntobcr_asignar_horario", { id_horario: id_horario, id_puntobcr:id_puntobcr, tipo_horario: tipo_horario}, function(data){
        //alert (data);
        location.reload();
    });
}

function eliminar_horario(tipo){
    tipo_horario = tipo;
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar el Horario del Punto?', 
        confirm: function(){
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=puntobcr_eliminar_horario", { id_puntobcr:id_puntobcr, tipo_horario:tipo_horario}, function(data){
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
//Funciones para agregar o editar enlaces de telecomunicaciones
function mostrar_enlace_telecom(){
    document.getElementById('ID_Enlace').value="0";
    $("#enlace option[value=1]").attr("selected",true);
    document.getElementById('interface').value="";
    document.getElementById('linea').value="";
    document.getElementById('bandwidth').value="";
    $("#medio_enlace option[value=1]").attr("selected",true);
    $("#proveedor_enlace option[value=1]").attr("selected",true);
    $("#tipo_enlace option[value=1]").attr("selected",true);
    document.getElementById('observaciones_enlace').value="";
    document.getElementById('ventana_oculta_6').style.display = "block";
}

function mostrar_editar_enlace(id, enlace, interf, linea,provee, tipo, bandw, medio, obser ){
    document.getElementById('ID_Enlace').value=id;
    $("#enlace option[value='"+enlace+"']").attr("selected",true);
    document.getElementById('interface').value=interf;
    document.getElementById('linea').value=linea;
    document.getElementById('bandwidth').value=bandw;
    $("#medio_enlace option[value="+medio+"]").attr("selected",true);
    $("#proveedor_enlace option[value="+provee+"]").attr("selected",true);
    $("#tipo_enlace option[value="+tipo+"]").attr("selected",true);
    document.getElementById('observaciones_enlace').value=obser;
    document.getElementById('ventana_oculta_6').style.display = "block";
}

function eliminar_enlace(ide){
    id_enlace= ide;
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar el enlace de Telecomunicaciones?', 
        confirm: function(){
            id_puntobcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=puntobcr_eliminar_enlace", { id_enlace: id_enlace, id_puntobcr:id_puntobcr }, function(data){
                location.reload();
                //alert (data);
            });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}

function validar_enlace(){
   if (document.getElementById('interface').value == "" ||document.getElementById('linea').value==""
        ||document.getElementById('bandwidth').value=="") {
        alert("Completa la información del enlace !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('frm_enlace_guardar').submit();
        document.getElementById('ventana_oculta_6').style.display = "none";
    }  
}