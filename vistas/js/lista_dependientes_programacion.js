$(document).ready(function(){
    $("#tipo_solicitud").change(function () {
        $("#tipo_solicitud option:selected").each(function () {
            tipo_solicitud = $(this).val();
            switch(tipo_solicitud){
                case "Activar gafete":
                case "Desactivar gafete":
                    document.getElementById('puntobcr').disabled=true;
                    document.getElementById('gafete').removeAttribute("disabled");
                    document.getElementById('detalle').disabled=true;
                    break;
                case "Agregar areas":
                case "Eliminar areas":
                    document.getElementById('puntobcr').disabled=true;
                    document.getElementById('gafete').removeAttribute("disabled");
                    document.getElementById('detalle').removeAttribute("disabled");
                    break;
                case "Reporte":
                case "Modificar Continuum":
                case "Agregar video":    
                    document.getElementById('puntobcr').disabled=true;
                    document.getElementById('gafete').disabled=true;
                    document.getElementById('detalle').disabled=true;
                    break;
                case "Horario especial":
                case "Modificar horario":
                case "Agregar alarma":
                    document.getElementById('puntobcr').removeAttribute("disabled");
                    document.getElementById('gafete').disabled=true;
                    document.getElementById('detalle').disabled=true;
                    break;    
                default:
                    document.getElementById('puntobcr').disabled=true;
                    document.getElementById('gafete').disabled=true;
                    document.getElementById('detalle').disabled=true;
                    break;
            }    
        });
    });
});
function agregar_persona(id,cedula, nombre, depart, id_empresa){
    document.getElementById('solicitante').value=nombre;
    document.getElementById('ID_Persona').value=id;
    document.getElementById('ID_Empresa').value=id_empresa;
    document.getElementById('ventana_oculta_1').style.display = "none";
}

function agregar_persona_autoriza(id,cedula, nombre, depart, id_empresa,ue){
    if(id_empresa==1){
        document.getElementById('autoriza').value=nombre;
        document.getElementById('ID_Persona_Autoriza').value=id;
        document.getElementById('ID_Unidad_Ejecutora').value=ue;
        document.getElementById('unidad_ejecutora').value=depart;
        document.getElementById('ventana_oculta_1').style.display = "none";
    } else {
        alert("Solamente personal BCR puede autorizar solicitudes!");
    }
}

function buscar_persona(){
    document.getElementById('ventana_oculta_1').style.display = "block";
}

function seleccionar_modulos(){
    document.getElementById('ventana_oculta_2').style.display = "block";
}

function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none";
    document.getElementById('ventana_oculta_3').style.display = "none";
    document.getElementById('ventana_oculta_4').style.display = "none";
}

function validar_programacion(){
    if(document.getElementById('ID_Persona').value == "" || document.getElementById('ID_Persona_Autoriza').value == ""){
        alert("Se debe indicar la persona que solicita y la persona que autoriza");
    } else {
        if(document.getElementById('tipo_solicitud').value == "0"){
            alert("Seleccione el tipo de solicitud");
        } else {
            if(document.getElementById('tipo_solicitud').value == "Agregar areas" || document.getElementById('tipo_solicitud').value == "Eliminar areas" ){
                if(document.getElementById('gafete').value=="" ){
                    alert("Se debe indicar las areas y gafete");
                }else{
                    document.getElementById('nueva_programacion').submit();
                }
            } else {
                document.getElementById('nueva_programacion').submit();
            }
        }
    }
}

function generar_reporte(){
    $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');
    $('#cuerpo').html('<center><img align="center" src="vistas/Imagenes/loading.gif"/></center>');

    fecha_inicial_reporte=document.getElementById('fecha_inicial_reporte').value;
    fecha_final_reporte=document.getElementById('fecha_final_reporte').value;
    tipo_solicitud_reporte = document.getElementById('tipo_solicitud_reporte').value;
    numero_evento=document.getElementById('Numero_evento').value;
    
    $.post("index.php?ctl=actualiza_en_vivo_reporte_programaciones", {fecha_inicial_reporte: fecha_inicial_reporte,fecha_final_reporte:fecha_final_reporte,tipo_solicitud_reporte:tipo_solicitud_reporte, numero_evento:numero_evento}, function(data){
        document.getElementById('Numero_evento').value=0;
        $("#titulo").html("Eventos de acuerdo a parámetros:");  
        $("#tabla3").html(data);   
        $("#tabla3").dataTable().fnDestroy();
        $("#tabla3").DataTable().draw();
        //console.log(data);
    });    
}

function mostrar_lista_modulos(id){
    $.post("index.php?ctl=dibuja_tabla_modulos_programados", { id: id}, function(data){
        $("#tabla_modulos").html(data); 
        console.log(data);
    });
    //document.getElementById('ventana_oculta_1').style.display = "block";
    document.getElementById('ventana_oculta_3').style.display = "block";
}

function buscar_punto(){
    document.getElementById('ventana_oculta_4').style.display = "block";
}

function buscar_programacion(numero){
    document.getElementById('Numero_evento').value=numero;
    generar_reporte();
}

function agregar_punto(id, nombre){
    document.getElementById('ID_PuntoBCR').value=id;
    document.getElementById('puntobcr').value=nombre;
    document.getElementById('ventana_oculta_4').style.display = "none";    
}

function confirmar_programacion(id){     
    $.confirm({title: 'Confirmación!', content: 'Solamente se pueden completar las programaciones vencidas.\n¿Desea continuar con la acción?', 
        confirm: function(){
            $.post("index.php?ctl=programacion_completar", {id: id}, function(data){
                alert (data);
                var n= data.search("La solicitud se completó correctamente");
                if(n!=-1){
                    window.location.reload();
                }
            });
        },
        cancel: function(){
        }
    });
}