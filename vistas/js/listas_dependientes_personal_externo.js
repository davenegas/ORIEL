$(document).ready(function(){
    
    //Check para habilitar edicion de Información General de Personal externo
    $("#chk_general").change(function(){
        //Si la identificación esta desbloqueada, bloquea todos los elementos del formulario
        if (document.getElementById('identificacion').readOnly==true){
            //Elementos del formulario, ordenados según aparecen en el formulario de arriba hacia abajo
            document.getElementById('identificacion').readOnly=false;
            $("#Empresa").attr("disabled",false);
            document.getElementById('nombre').readOnly=false;
            document.getElementById('apellido').readOnly=false;
            document.getElementById('fecha_nacimiento').readOnly=false;
            document.getElementById('fecha_ingreso').readOnly=false;
            document.getElementById('fecha_salida').readOnly=false;
            $("#nacionalidad").attr("disabled",false);
            document.getElementById('fecha_residencia').readOnly=false;
            document.getElementById('fecha_portacion').readOnly=false;
            $("#Provincia").attr("disabled",false);
            $("#Canton").attr("disabled",false);
            $("#Distrito").attr("disabled",false);
            document.getElementById('Direccion').readOnly=false;
            $("#estado_civil").attr("disabled",false);
            document.getElementById('correo').readOnly=false;
            $("#nivel_academico").attr("disabled",false);
            document.getElementById('observaciones').readOnly=false;
            $("#estado_persona").attr("disabled",false);
            $("#genero").attr("disabled",false);
            $("#validado").attr("disabled",false);
            document.getElementById('ocupacion').readOnly=false;
        }   else   {
            //Bloquea todos los elemetos del formulario
            document.getElementById('identificacion').readOnly=true;
            $("#Empresa").attr("disabled",true);
            document.getElementById('nombre').readOnly=true;
            document.getElementById('apellido').readOnly=true;
            document.getElementById('fecha_nacimiento').readOnly=true;
            document.getElementById('fecha_ingreso').readOnly=true;
            document.getElementById('fecha_salida').readOnly=true;
            $("#nacionalidad").attr("disabled",true);
            document.getElementById('fecha_residencia').readOnly=true;
            document.getElementById('fecha_portacion').readOnly=true;
            $("#Provincia").attr("disabled",true);
            $("#Canton").attr("disabled",true);
            $("#Distrito").attr("disabled",true);
            document.getElementById('Direccion').readOnly=true;
            $("#estado_civil").attr("disabled",true);
            document.getElementById('correo').readOnly=true;
            $("#nivel_academico").attr("disabled",true);
            document.getElementById('observaciones').readOnly=true;
            $("#estado_persona").attr("disabled",true);
            $("#genero").attr("disabled",true);
            $("#validado").attr("disabled",true);
            document.getElementById('ocupacion').readOnly=true;
            
            //Almacena la informacion del formulario en variables y la guarda en Personal Externo
            id_persona = document.getElementById('ID_Persona').value;
            identificacion = document.getElementById('identificacion').value;
            empresa = document.getElementById('Empresa').value;
            nombre = document.getElementById('nombre').value;
            apellido = document.getElementById('apellido').value;
            fecha_nacimiento = document.getElementById('fecha_nacimiento').value;
            fecha_ingreso = document.getElementById('fecha_ingreso').value;
            fecha_salida = document.getElementById('fecha_salida').value;
            nacionalidad = document.getElementById('nacionalidad').value;
            fecha_residencia = document.getElementById('fecha_residencia').value;
            fecha_portacion = document.getElementById('fecha_portacion').value;
            Distrito = document.getElementById('Distrito').value;
            Direccion = document.getElementById('Direccion').value;
            estado_civil = document.getElementById('estado_civil').value;
            correo = document.getElementById('correo').value;
            nivel_academico = document.getElementById('nivel_academico').value;
            observaciones = document.getElementById('observaciones').value;
            estado_persona = document.getElementById('estado_persona').value;
            genero = document.getElementById('genero').value;
            validado = document.getElementById('validado').value;
            ocupacion = document.getElementById('ocupacion').value
            //ejecuta una funcion del index para guardar la información
            $.post("index.php?ctl=persona_externa_guardar_informacion", 
            { id_persona:id_persona, identificacion: identificacion, empresa:empresa, nombre:nombre,
                apellido:apellido, fecha_nacimiento:fecha_nacimiento, fecha_ingreso:fecha_ingreso, fecha_salida:fecha_salida,
                nacionalidad:nacionalidad,fecha_residencia:fecha_residencia,fecha_portacion:fecha_portacion,
                Distrito:Distrito,Direccion:Direccion,estado_civil:estado_civil,correo:correo,nivel_academico:nivel_academico,
                observaciones:observaciones, estado_persona:estado_persona, genero:genero, validado:validado,ocupacion:ocupacion}, 
            function(data){
                //alert (data);
                document.getElementById('ID_Persona').value=parseInt(data);
            });
        }
    });
});

function ocultar_elemento(){
    document.getElementById('agregar_telefono').style.display = "none";
}

/////////////////////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número de persona externa
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
    document.getElementById('ID_Telefono').value="0";
    document.getElementById('numero').value=null;
    document.getElementById('observaciones_tel').value=null;
    document.getElementById('agregar_telefono').style.display = "block";
}
function eliminar_telefono(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar este número de teléfono?', 
        confirm: function(){
            id_telefono= ide;
            $.post("index.php?ctl=personal_externo_eliminar_telefono", { id_telefono: id_telefono}, function(data){
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
    document.getElementById('observaciones_tel').value=obser;
    
    document.getElementById('agregar_telefono').style.display = "block";
};

