$(document).ready(function(){
    
    //Check para habilitar edicion de Información General de Persona
    $("#chk_general").change(function(){
        if (document.getElementById('cedula').readOnly==true){
            document.getElementById('cedula').readOnly=false;
            document.getElementById('observaciones').readOnly =false;
            document.getElementById('nombre').readOnly =false;
            document.getElementById('numero_gafete').readOnly =false;
            document.getElementById('correo').readOnly =false;
            document.getElementById('direccion').readOnly =false;
            $("#Empresa").attr("disabled",false);
        }else{
            document.getElementById('cedula').readOnly=true;
            document.getElementById('observaciones').readOnly =true;
            document.getElementById('nombre').readOnly =true;
            document.getElementById('numero_gafete').readOnly =true;
            document.getElementById('correo').readOnly =true;
            document.getElementById('direccion').readOnly =true;
            $("#Empresa").attr("disabled",true);
            
            //Almacena la informacion en variables y la guarda en Personal
            id_persona = document.getElementById('ID_Persona').value;
            cedula=document.getElementById('cedula').value;
            observaciones=document.getElementById('observaciones').value;
            nombre=document.getElementById('nombre').value;
            empresa= 1;
            numero_gafete =document.getElementById('numero_gafete').value;
            correo=document.getElementById('correo').value;
            direccion = document.getElementById('direccion').value;
            
            $.post("index.php?ctl=persona_guardar_informacion_general", { id_persona:id_persona, cedula: cedula, 
                observaciones:observaciones, nombre:nombre,empresa:empresa, numero_gafete:numero_gafete, 
                correo:correo, direccion:direccion}, function(data){
                    //alert (data);
            });   
        }
    });
});
////////////////////////////////////////////////////////////
//Función para Ocultas ventanas
function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none"; 
    document.getElementById('ventana_oculta_3').style.display = "none";
}

///////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número PuntoBCR
function check_empty() {
    if (document.getElementById('numero').value == "") {
        alert("Digita un número de teléfono !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('ventana').submit();
        document.getElementById('ventana_oculta_1').style.display = "none";
    }
}
function mostrar_agregar_telefono() {
    document.getElementById('ID_Telefono').value="0";
    document.getElementById('numero').value=null;
    document.getElementById('observaciones').value=null;
    document.getElementById('ventana_oculta_1').style.display = "block";
}
function eliminar_telefono(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar este número de teléfono?', 
        confirm: function(){
            id_telefono= ide;
            $.post("index.php?ctl=personal_eliminar_telefono", { id_telefono: id_telefono}, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
};
function Editar_telefono(id_tel, tipo_tel, num, obser){
    $("#Tipo_Telefono option[value="+tipo_tel+"]").attr("selected",true);
    document.getElementById('ID_Telefono').value=id_tel;
    document.getElementById('numero').value=num;
    document.getElementById('observaciones').value=obser;
    
    document.getElementById('ventana_oculta_1').style.display = "block";
};

////////////////////////////////////////////////////////
//Funciones para ventana oculta de Cambiar_UE
function mostrar_lista_ue(){
    document.getElementById('ventana_oculta_2').style.display = "block";
}
function cambiar_ue(id_ue){
    id_unidad_ejecutora = id_ue;
    id_persona = document.getElementById('ID_Persona').value;
    document.getElementById('ventana_oculta_2').style.display = "none";
    $.post("index.php?ctl=personal_cambiar_ue", { id_unidad_ejecutora: id_unidad_ejecutora, id_persona:id_persona}, function(data){
            location.reload();
            //alert (data);
          });
}
///////////////////////////////////////////////////////////////////////
//Funciones para ventana oculta de cambiar Puesto
function mostrar_lista_puesto(){
    document.getElementById('ventana_oculta_3').style.display = "block";
}
function cambiar_puesto(puesto){
    id_puesto = puesto;
    id_persona = document.getElementById('ID_Persona').value;
    document.getElementById('ventana_oculta_3').style.display = "none";
    $.post("index.php?ctl=personal_cambiar_puesto", { id_puesto: id_puesto, id_persona:id_persona}, function(data){
            location.reload();
            //alert (data);
          });
}
