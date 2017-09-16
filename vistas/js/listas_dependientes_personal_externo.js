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
        } else {
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
            ocupacion = document.getElementById('ocupacion').value
            //ejecuta una funcion del index para guardar la información
            if (document.getElementById('Distrito').value == '0') {
                alert("Seleccione la el Distrito de la persona!!");
            } if (document.getElementById('fecha_ingreso').value == '') {
                alert("Ingrese la fecha de ingreso de la persona!!");
            } if (document.getElementById('apellido').value == '') {
                alert("Ingrese el(los) apellido(s) de la persona!!");
            } if (document.getElementById('nombre').value == '') {
                alert("Ingrese el nombre de la persona!!");
            } if (document.getElementById('identificacion').value == '') {
                alert("Ingrese el número de identificación de la persona!!");
            } else {
                $.post("index.php?ctl=persona_externa_guardar_informacion", 
                { id_persona:id_persona, identificacion: identificacion, empresa:empresa, nombre:nombre,
                    apellido:apellido, fecha_nacimiento:fecha_nacimiento, fecha_ingreso:fecha_ingreso, fecha_salida:fecha_salida,
                    nacionalidad:nacionalidad,fecha_residencia:fecha_residencia,fecha_portacion:fecha_portacion,
                    Distrito:Distrito,Direccion:Direccion,estado_civil:estado_civil,correo:correo,nivel_academico:nivel_academico,
                    observaciones:observaciones, estado_persona:estado_persona, genero:genero, ocupacion:ocupacion}, 
                function(data){
                    //alert (data);
                    console.log(data);
                    var srt = data;
                    var n= srt.search("Repetido");
                    if(n!=-1){
                        alert("Esta persona ya se encuentra registrada en el sistema");
                    } else {
                        document.getElementById('ID_Persona').value= parseInt(data);
                    }
                });
            }
        }
    });
    
    //Funcionalidad de carruzel de imagenes
    $(document).ready(function() {
        $(".fancybox-button").fancybox({
            prevEffect		: 'none',
            nextEffect		: 'none',
            closeBtn		: false,
            helpers		: {
                    title	: { type : 'inside' },
                    buttons	: {}
            }
        });
    });
        
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
    
});

function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none";
}

/////////////////////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número de persona externa
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
    if (document.getElementById('ID_Persona').value > 0) {
        document.getElementById('ID_Persona_Telefono').value = document.getElementById('ID_Persona').value;
        document.getElementById('ID_Telefono').value="0";
        document.getElementById('numero').value=null;
        document.getElementById('observaciones_tel').value=null;
        document.getElementById('ventana_oculta_1').style.display = "block";
    }
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
    
    document.getElementById('ventana_oculta_1').style.display = "block";
};

////////////////////////////////////////////////////////////////////
////////Funciones para agregar fotos de personal externo///////////
function mostrar_agregar_foto(){
    if (document.getElementById('ID_Persona').value > 0) {
        document.getElementById('ventana_oculta_2').style.display = "block";
    } 
}

function valida_foto(){
    if (document.getElementById('Nombre').value == "" || document.getElementById('Descripcion').value == "") {
        alert("Digita el nombre y la descripción de la foto !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('guardar_foto').submit();
        document.getElementById('ventana_oculta_2').style.display = "none";
    }
}

function eliminar_imagen(id_imagen){
    id=id_imagen;
    //alert(id_imagen);   
    $.confirm({
        title: 'Confirmación!',
        content: 'Desea eliminar esta imagen?',
        confirm: function(){
        //alert (id_imagen );
            $.post("index.php?ctl=eliminar_imagen_personal_externo", {id_imagen:id_imagen});//,function(data){
                $.alert({
                    title: 'Información!',
                    content: 'Imagen eliminada con éxito!!!',      
                });       
            location.reload();  
            },
        cancel: function(){
        }
    });
}  

function validar_persona_externa(){
    id_persona = document.getElementById('ID_Persona').value;
    validar = document.getElementById('validado').value;
    Fecha_Salida = document.getElementById('fecha_salida').value;
    Fecha_Residencia = document.getElementById('fecha_residencia').value;
    Fecha_Portacion = document.getElementById('fecha_portacion').value;
    Estado_Persona =document.getElementById('estado_persona').value;
    fecha_actual= new Date().toJSON().slice(0,10);
    if(validar==1){
        if(fecha_actual<Fecha_Salida || Fecha_Salida==''){
            if(fecha_actual<Fecha_Residencia || Fecha_Residencia==''){
                if(fecha_actual<Fecha_Portacion || Fecha_Portacion==''){
                    if(Estado_Persona==1){
                    $.post("index.php?ctl=personal_externo_validar", { id_persona: id_persona, validar:validar}, function(data){
                        location.reload(); 
                    });
                    }else{
                        document.getElementById('validado').selectedIndex=0;
                        alert("La persona no esta Activa \nNo se puede Validar la persona");
                    }
                }else{
                    document.getElementById('validado').selectedIndex=0;
                    alert("Fecha Portación invalida \nNo se puede Validar la persona");
                }
            } else{
                document.getElementById('validado').selectedIndex=0;
                alert("Fecha residencia invalida \nNo se puede Validar la persona");
            }
        } else{
            document.getElementById('validado').selectedIndex=0;
            alert("Fecha de Salida invalida\nNo se puede Validar la persona");
        }
    }else{
        $.post("index.php?ctl=personal_externo_validar", { id_persona: id_persona, validar:validar}, function(data){
            location.reload(); 
        }); 
    }
}