$(document).ready(function(){

    $("#tipo_funcionario").change(function () {
        document.getElementById('ID_Persona').value="";
        document.getElementById('ID_Empresa').value="";
        document.getElementById('cedula_persona').value="";
        document.getElementById('nombre_persona').value="";
        document.getElementById('unidad_ejecutora').value="";
        document.getElementById('cedula_persona').readOnly=true;
        $("#cajeros_persona").html("");
    });

});
////////////////////////////////////////////////////////////////////////////////
////////////Función para ventanas ocultas General///////////////////////////////
function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none";
    document.getElementById('ventana_oculta_3').style.display = "none";
    document.getElementById('ventana_oculta_4').style.display = "none";
}

////////////////////////////////////////////////////////////////////////////////
////////////////////Funciones de catalogo de CENCON/////////////////////////////
function buscar_persona() {
    if(document.getElementById('tipo_funcionario').value==0){
        document.getElementById('ventana_oculta_1').style.display = "block";
    } if(document.getElementById('tipo_funcionario').value==1){
        document.getElementById('ventana_oculta_2').style.display = "block";
    }
}
function agregar_persona(id,ident, nombre, depart, empresa){
    document.getElementById('ID_Persona').value=id;
    document.getElementById('ID_Empresa').value=empresa;
    ident = ident.replace("-","");ident = ident.replace("-","");
    ident = parseInt(ident);
    document.getElementById('cedula_persona').value=ident;
    document.getElementById('nombre_persona').value=nombre;
    document.getElementById('unidad_ejecutora').value=depart;
    document.getElementById('cedula_persona').readOnly=false;
    document.getElementById('ventana_oculta_1').style.display = "none";
    document.getElementById('ventana_oculta_2').style.display = "none";
    $.post("index.php?ctl=cencon_buscar_relaciones", { id_persona:id, empresa:empresa}, function(data){
            //alert(data);
            $("#cajeros_persona").html(data);
          });
}
function cencon_observaciones(ide, obser){
    document.getElementById('ID_Cencon').value=ide;
    document.getElementById('observaciones_cencon').value=document.getElementById(ide).innerHTML;
    document.getElementById('ventana_oculta_4').style.display = "block";
}
function guardar_observaciones_cencon(){
    id_cencon= document.getElementById('ID_Cencon').value;
    observaciones= document.getElementById('observaciones_cencon').value;
    $.post("index.php?ctl=cencon_observaciones",{id_cencon:id_cencon, observaciones:observaciones}, function(data){
        document.getElementById(id_cencon).innerHTML=observaciones;
    });
    document.getElementById('ventana_oculta_4').style.display = "none";
}
function buscar_cajero(){
    if(document.getElementById('tipo_funcionario').value==0 || document.getElementById('tipo_funcionario').value==1){
        document.getElementById('ventana_oculta_3').style.display = "block";
    }
}
function agregar_atm(id){
    id_atm= id;
    id_persona = document.getElementById('ID_Persona').value;
    cedula = document.getElementById('cedula_persona').value;
    empresa = document.getElementById('ID_Empresa').value;
    $.post("index.php?ctl=cencon_agregar_relacion", { id_atm: id_atm, 
        id_persona:id_persona, cedula: cedula, empresa: empresa}, function(data){
            //alert(data);
            $("#cajeros_persona").html(data);
          });
    document.getElementById('ventana_oculta_3').style.display = "none";
    
}
function eliminar_cajero(id){
    id_cencon= id;
    id_persona = document.getElementById('ID_Persona').value;
    empresa = document.getElementById('ID_Empresa').value;
    $.post("index.php?ctl=cencon_eliminar_relacion", { id_cencon: id_cencon, id_persona:id_persona, empresa: empresa}, function(data){
            //alert(data);
            $("#cajeros_persona").html(data);
          });
}
function todos_cajero(funcion){
    //alert ("todos");
    accion = funcion;
    id_persona = document.getElementById('ID_Persona').value;
    cedula = document.getElementById('cedula_persona').value;
    empresa = document.getElementById('ID_Empresa').value;
    $.confirm({title: 'Confirmación!', content: 'Realmente desea '+accion+' todos los cajeros ?', 
        confirm: function(){
            $("#cajeros_persona").html('<center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>');
            $.post("index.php?ctl=todos_cajero_relacion", { accion:accion, id_persona: id_persona, cedula: cedula, empresa:empresa }, function(data){
                //alert (data);
                $("#cajeros_persona").html(data);
              });
        },
        cancel: function(){
            //$.alert('Canceled!')
        }
    });
}
////////////////////////////////////////////////////////////////////////////////
///////////////////////////FUNCIONES DE MÓDULO CENCON//////////////////////////
function evento_buscar_cajero(){
    id= document.getElementById('numero_atm').value;
    var datos = new Array;
    $.post("index.php?ctl=evento_buscar_cajero", { id: id}, function(data){
        //alert(data);
        datos =JSON.parse(data);
        document.getElementById('nombre_atm').value=datos['Nombre'];
        document.getElementById('tipo_atm').value=datos['Tipo_Punto'];
        document.getElementById('ID_PuntoBCR').value=datos['ID_PuntoBCR'];
    });
}
function evento_buscar_persona(){
    //Variables necesarias para la busqueda
    id= document.getElementById('cedula').value;
    
    //Busca información de la cedula digitada
    var datos = new Array;
    $.post("index.php?ctl=evento_buscar_persona", { id: id}, function(data){
        //alert(data);
        datos =JSON.parse(data);
        document.getElementById('ID_Empresa').value=datos['ID_Empresa'];
        if(datos['ID_Empresa']==1){
            document.getElementById('nombre_persona').value=datos['Apellido_Nombre'];
            document.getElementById('unidad_ejecutora').value=datos['Departamento'];
            document.getElementById('ID_Persona').value=datos['ID_Persona'];
        } else {
            document.getElementById('nombre_persona').value=datos['Apellido']+datos['Nombre'];
            document.getElementById('unidad_ejecutora').value=datos['Empresa'];
            document.getElementById('ID_Persona').value=datos['ID_Persona_Externa'];
        }
        
    });
    //Busca lista de cajeros con acceso de la persona
    var cajeros= new Array();
    var accesos = "";
    empresa = document.getElementById('ID_Empresa').value;
    $.post("index.php?ctl=evento_buscar_relaciones", { id: id, empresa:empresa}, function(data){
        //alert (data);
        cajeros= JSON.parse(data);
        var result=[];
        for (var i in cajeros){
            result.push([i,cajeros[i]]);
        }

        //alert (result.length);
        for( var j=0; j<result.length;j++){
            accesos+=" -"+(cajeros[j]['Codigo']);
        }
        document.getElementById('acceso_atms').value= accesos;
        
    });
    
}
function agregar_evento_cencon(){
    
    if (document.getElementById('cedula').value == "" || document.getElementById('numero_atm').value == "") {
        alert("Digite el número de cajero y el número de cedula para generar una apertura!");
    } else{
        id= document.getElementById('cedula').value;
        empresa = document.getElementById('ID_Empresa').value;
        
        var cajeros= new Array();
        var result=[];
        var valida_cajero=0;
        $.post("index.php?ctl=evento_buscar_relaciones", { id: id, empresa:empresa}, function(data){
            cajeros= JSON.parse(data);

            for (var i in cajeros){
                result.push([i,cajeros[i]]);
            }

            for( var j=0; j<result.length;j++){
                if(document.getElementById('numero_atm').value==cajeros[j]['Codigo']){
                    fecha_apertura= document.getElementById('fecha').value;
                    hora_apertura= document.getElementById('hora').value;
                    id_puntobcr= document.getElementById('ID_PuntoBCR').value;
                    id_persona= document.getElementById('ID_Persona').value;
                    id_empresa= document.getElementById('ID_Empresa').value;
                    observaciones = document.getElementById('observaciones').value;
                    seguimiento = document.getElementById('seguimiento').value;
                    $.post("index.php?ctl=evento_nuevo_guardar", { fecha_apertura: fecha_apertura, hora_apertura:hora_apertura,
                    id_puntobcr:id_puntobcr, id_persona:id_persona, id_empresa:id_empresa, observaciones:observaciones, seguimiento:seguimiento}, function(data){
                        //alert (data);
                        var srt = data;
                        var n= srt.search("No es posible");
                        if(n!=-1){
                            n= srt.search("futuros");
                            if(n!=-1){
                                alert('No es posible ingresar eventos futuros!!!');
                            }else{
                                alert("Esta cajero tiene una apertura pendiente de cierre");
                            }
                        } else{
                            location.reload();
                        }
                    });
                    valida_cajero=1;
                }
            }
            if(valida_cajero==0){
                alert("Esta persona no puede abrir este cajero \nPor favor intente nuevamente");
            }
        });
    }
}
function evento_cencon_cerrar(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea cerrar este cajero?', 
        confirm: function(){
            id_evento_cencon= ide;
            $.post("index.php?ctl=evento_cencon_cerrar", { id_evento_cencon: id_evento_cencon}, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}
function editar_observaciones(ide, obser){
    document.getElementById('ID_Evento_Cencon').value=ide;
    document.getElementById('observaciones_evento').value=obser;
    document.getElementById('ventana_oculta_1').style.display = "block";
}
function guardar_observaciones_evento(){
    id_evento_cencon= document.getElementById('ID_Evento_Cencon').value;
    observaciones= document.getElementById('observaciones_evento').value;
    $.post("index.php?ctl=evento_cencon_observaciones",{id_evento_cencon:id_evento_cencon, observaciones:observaciones}, function(data){
                location.reload();
                //alert (data);
              });
    document.getElementById('ventana_oculta_1').style.display = "none";
}
function editar_seguimiento(ide, seguimiento){
    document.getElementById('ID_Evento_Cencon').value=ide;
    $("#seguimiento_evento option[value='"+seguimiento+"']").attr("selected",true);
    document.getElementById('ventana_oculta_3').style.display = "block";
}
function guardar_seguimiento_evento(){
    id_evento_cencon= document.getElementById('ID_Evento_Cencon').value;
    seguimiento= document.getElementById('seguimiento_evento').value;
    
    $.post("index.php?ctl=evento_cencon_seguimiento",{id_evento_cencon:id_evento_cencon, seguimiento:seguimiento}, function(data){
                location.reload();
                //alert (data);
              });
    document.getElementById('ventana_oculta_3').style.display = "none";
}
function reasignar_apertura(ide,cajero, obser){
    document.getElementById('ID_Evento_Cencon').value=ide;
    document.getElementById('numero_cajero').value=cajero;
    document.getElementById('Cedula_persona').value="";
    document.getElementById('ventana_oculta_2').style.display = "block";
}
function reasignar_apertura_cencon(){
    $.confirm({title: 'Confirmación!', content: 'Desea reasignar la apertura de este cajero?', 
        confirm: function(){
            id_evento_cencon= document.getElementById('ID_Evento_Cencon').value;
            numero_cajero=document.getElementById('numero_cajero').value;
            cedula_cencon = document.getElementById('Cedula_persona').value;
            $.post("index.php?ctl=evento_cencon_reasignar", { id_evento_cencon: id_evento_cencon, numero_cajero:numero_cajero, cedula_cencon:cedula_cencon}, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
}
