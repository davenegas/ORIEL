function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
}
function evento_buscar_puntobcr(){
    id= document.getElementById('numero_punto').value;
    var datos = new Array;
    var id_puntobcr=0;
    $.post("index.php?ctl=buscar_punto_prueba_alarma", { id: id}, function(data){
        //alert(data);
        var res = data.substring(data.indexOf("{"), data.length);
        datos =JSON.parse(res);
        document.getElementById('nombre_punto').value=datos['Nombre'];
        document.getElementById('tipo_punto').value=datos['Tipo_Punto'];
        document.getElementById('ID_PuntoBCR').value=datos['ID_PuntoBCR'];
        
        buscar_pruebas_alarma(datos['ID_PuntoBCR']);
    });
}
function borrar_datos(){
    document.getElementById('numero_punto').value="";
    document.getElementById('nombre_punto').value="";
    document.getElementById('tipo_punto').value="";
    document.getElementById('ID_PuntoBCR').value="0";
    document.getElementById('ID_Prueba_Alarma').value="0";
    document.getElementById('ID_Persona_Reporta_Apertura').value="0";
    document.getElementById('ID_Persona_Reporta_Cierre').value="0";
    buscar_pruebas_alarma(0);
}
function buscar_pruebas_alarma(id_puntobcr){
    $.post("index.php?ctl=buscar_prueba_alarma", { id_puntobcr: id_puntobcr}, function(data){
            //alert(data);
            //Verificar si encontró prueba de alarma de hoy al Punto BCR
            var n= data.search("No se encontró");
            if(n==-1){
                //Si encontró información la carga en la ventana
                var res = data.substring(data.indexOf("{"), data.length);
                datos =JSON.parse(res);
                //Se agrega la información de la prueba de la alarma a la ventana
                document.getElementById('ID_Prueba_Alarma').value=datos['ID_Prueba_Alarma'];
                document.getElementById('ID_Persona_Reporta_Apertura').value=datos['ID_Persona_Reporta_Apertura'];
                document.getElementById('ID_Persona_Reporta_Cierre').value=datos['ID_Persona_Reporta_Cierre'];
                document.getElementById('empresa_persona').value=datos['Empresa'];
                document.getElementById('nombre_persona_prueba').value=datos['Nombre_Persona_Apertura'];
                $("#tipo_prueba option[value='"+datos['Tipo_Prueba']+"']").attr("selected",true);
                $("#revision_atm option[value='"+datos['Revision_cajero']+"']").attr("selected",true);
                document.getElementById('hora_apertura').value=datos['Hora_Apertura_Alarma'];
                document.getElementById('hora_prueba').value=datos['Hora_Prueba_Alarma'];
                document.getElementById('zona_prueba').value=datos['Numero_Zona_Prueba'];
                document.getElementById('nombre_persona_cierre').value=datos['Nombre_Persona_Cierre'];
                $("#cuentas_secundarias option[value='"+datos['Particion_Secundaria_Cierre']+"']").attr("selected",true);
                $("#cuenta_principal option[value='"+datos['Particion_Principal_Cierre']+"']").attr("selected",true);
                document.getElementById('hora_cierre').value=datos['Hora_Cierre_Alarma'];
                document.getElementById('observaciones').value=datos['Observaciones'];
                
                //Agrega titulos a las ventanas con Usuarios que ingresan la información
                document.getElementById('nombre_persona_prueba').title="Usuario: "+datos['Nombre_Usuario_Reporte'];
                document.getElementById('hora_apertura').title="Usuario: "+datos['Nombre_Usuario_Prueba'];
                document.getElementById('nombre_persona_cierre').title="Usuario: "+datos['Nombre_Usuario_Reporte_Cierre'];
                document.getElementById('hora_cierre').title="Usuario: "+datos['Nombre_Usuario_Cierra'];
                //Se aplica la seguridad a la ventana, bloquea los datos ingresados --> frm_pruebas_alarma.php
                aplicar_seguridad(datos);
            } else {
                //Si no encontró información limpia la ventana
                //Se habilitan los campos de la ventana para ingresar la información.
                document.getElementById('nombre_persona_prueba').removeAttribute("disabled");
                document.getElementById('tipo_prueba').removeAttribute("disabled");
                document.getElementById('revision_atm').removeAttribute("disabled");
                document.getElementById('hora_apertura').removeAttribute("disabled");
                document.getElementById('hora_prueba').removeAttribute("disabled");
                document.getElementById('zona_prueba').removeAttribute("disabled");
                document.getElementById('hora_cierre').removeAttribute("disabled");
                //Limpia el formulario
                document.getElementById('ID_Prueba_Alarma').value="0";
                document.getElementById('ID_Persona_Reporta_Apertura').value="0";
                document.getElementById('ID_Persona_Reporta_Cierre').value="0";
                document.getElementById('empresa_persona').value="";
                document.getElementById('nombre_persona_prueba').value="";
                $("#tipo_prueba option[value='Panico']").attr("selected",true);
                $("#revision_atm option[value='NO']").attr("selected",true);
                document.getElementById('hora_apertura').value="";
                document.getElementById('hora_prueba').value="";
                document.getElementById('zona_prueba').value="";
                document.getElementById('nombre_persona_cierre').value="";
                $("#cuentas_secundarias option[value='']").attr("selected",true);
                $("#cuenta_principal option[value='']").attr("selected",true);
                document.getElementById('hora_cierre').value="";
                document.getElementById('observaciones').value="";
                
                //Elimina titulos de la busqueda anterior
                document.getElementById('nombre_persona_prueba').title="Usuario no Disponible";
                document.getElementById('hora_apertura').title="Usuario no Disponible";
                document.getElementById('nombre_persona_cierre').title="Usuario no Disponible";
                document.getElementById('hora_cierre').title="Usuario no Disponible";
            }
            
        });
}
function buscar_persona_prueba(){
   document.getElementById('ventana_oculta_1').style.display = "block";

}
function agregar_persona_prueba(id,cedula, nombre, depart, id_empresa){
    //alert (depart);
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else{
        document.getElementById('nombre_persona_prueba').value=nombre;
        document.getElementById('empresa_persona').value=depart;
        document.getElementById('ventana_oculta_1').style.display = "none";
        id_prueba = document.getElementById('ID_Prueba_Alarma').value;
        tipo_prueba = document.getElementById('tipo_prueba').value;
        revision_atm = document.getElementById('revision_atm').value;
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        tipo = "Persona_Prueba";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, tipo:tipo, id_persona: id, id_empresa:id_empresa, punto_bcr:punto_bcr,tipo_prueba:tipo_prueba,revision_atm:revision_atm}, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    }
}
function guardar_registro_prueba(tipo){
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else{
        id = document.getElementById('ID_Persona_Reporta_Apertura').value;
        id_prueba = document.getElementById('ID_Prueba_Alarma').value;
        tipo_prueba = document.getElementById('tipo_prueba').value;
        revision_atm = document.getElementById('revision_atm').value;
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, tipo:tipo, tipo_prueba:tipo_prueba,revision_atm:revision_atm, punto_bcr:punto_bcr}, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    }
}
function guardar_apertura(){
    if(document.getElementById('ID_PuntoBCR').value=="0" ){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        id_prueba = document.getElementById('ID_Prueba_Alarma').value;
        hora_apertura=document.getElementById('hora_apertura').value;
        tipo = "Apertura_Alarma_SIS";
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, tipo: tipo, punto_bcr:punto_bcr, hora_apertura:hora_apertura}, function(data){
            // alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    }
}
function guardar_prueba_alarma(){
    if(document.getElementById('empresa_persona').value=="" ){
        alert("Es necesaria registrar la persona que realiza reporte de prueba");
    } else {
        id_prueba = document.getElementById('ID_Prueba_Alarma').value;
        hora_prueba=document.getElementById('hora_prueba').value;
        zona= document.getElementById('zona_prueba').value;
        tipo = "Hora_Prueba_Alarma_SIS";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, tipo: tipo, hora_prueba:hora_prueba, zona:zona}, function(data){
            //alert(data);
        });
    }
}
function agregar_persona_cierre(id,cedula, nombre, depart, id_empresa){
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        document.getElementById('nombre_persona_cierre').value=nombre;
        document.getElementById('ventana_oculta_1').style.display = "none";
        document.getElementById('ID_Persona_Reporta_Cierre').value=id;
        
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        cuenta_secundaria = document.getElementById('cuentas_secundarias').value;
        cuenta_principal = document.getElementById('cuenta_principal').value;
        tipo = "Reporte_Cierre";
        
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, punto_bcr:punto_bcr, tipo:tipo, id_persona: id, id_empresa:id_empresa, 
        cuenta_secundaria:cuenta_secundaria, cuenta_principal:cuenta_principal }, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    }
}
function guarda_reporte_cuenta(){
    if(document.getElementById('ID_Persona_Reporta_Cierre').value=="0"){
        alert("Por favor seleccione la persona que reporta el cierre de alarma");
    } else {
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        id_empresa=0;
        cuenta_secundaria = document.getElementById('cuentas_secundarias').value;
        cuenta_principal = document.getElementById('cuenta_principal').value;
        tipo = "Reporte_Informacion_Cierre";
        
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, punto_bcr:punto_bcr, tipo:tipo, cuenta_secundaria:cuenta_secundaria, cuenta_principal:cuenta_principal }, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    }
}
function guardar_cierre(){
   if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        cierre = document.getElementById('hora_cierre').value;
        tipo = "Cierre_Agencia";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, punto_bcr:punto_bcr, tipo:tipo, cierre:cierre}, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
        });
    } 
}
function guardar_observaciones(){
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        observaciones = document.getElementById('observaciones').value;
        tipo = "Observaciones_Prueba";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba,tipo:tipo, observaciones:observaciones}, function(data){
            //alert(data);
        });
    } 
}
function eliminar_registro_prueba(){
    $.confirm({title: 'Confirmación!', content: 'Realmente desea eliminar el reporte de prueba de alarma?', 
        confirm: function(){
            id_prueba=document.getElementById('ID_Prueba_Alarma').value;
            if(document.getElementById('zona_prueba').value=="" &&document.getElementById('hora_prueba').value=="" 
            && document.getElementById('hora_cierre').value==""){
                $.post("index.php?ctl=prueba_alarma_eliminar", { id_prueba:id_prueba}, function(data){
                    //alert (data);
                    location.reload();
                });
            } else {
                alert("No es posible borrar el reporte de prueba de alarma, cuenta con información relacionada");
            }
        },
        cancel: function(){
            //$.alert('Canceled!')
        }
    });
}