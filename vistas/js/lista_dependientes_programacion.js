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

    $.post("index.php?ctl=actualiza_en_vivo_reporte_programaciones", {fecha_inicial_reporte: fecha_inicial_reporte,fecha_final_reporte:fecha_final_reporte,tipo_solicitud_reporte:tipo_solicitud_reporte}, function(data){
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