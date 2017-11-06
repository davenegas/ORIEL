function ocultar_elemento(){
    document.getElementById('ventana_oculta_1').style.display = "none";
}

function evento_buscar_puntobcr(){
    id= document.getElementById('numero_punto').value;
    var datos = new Array;
    var id_puntobcr=0;
    //console.log("HELLO!");
    $.post("index.php?ctl=buscar_punto_prueba_alarma", { id: id}, function(data){
        //console.log(data);
        var res = data.substring(data.indexOf("{"), data.length);
        datos =JSON.parse(res);
        document.getElementById('nombre_punto').value=datos['Nombre'];
        document.getElementById('tipo_punto').value=datos['Tipo_Punto'];
        document.getElementById('ID_PuntoBCR').value=datos['ID_PuntoBCR'];
        document.getElementById('Hora_Apertura_Publico').value=datos['Hora_Apertura_Publico'];
        document.getElementById('Hora_Cierre_Publico').value=datos['Hora_Cierre_Publico'];
        document.getElementById('Hora_Apertura_Agencia').value=datos['Hora_Apertura_Agencia'];
        document.getElementById('Hora_Cierre_Agencia').value=datos['Hora_Cierre_Agencia'];
        buscar_pruebas_alarma(datos['ID_PuntoBCR']);
        
        if(document.getElementById('Hora_Apertura_Agencia').value=="" && document.getElementById('Hora_Apertura_Publico').value==""){
            //alert("hoy no abre");
            document.getElementById("codigo_agencia").innerHTML="Código de agencia- NO ABRE";
            document.getElementById("numero_punto").style.border="2px solid red";
            //animated bounceInUp
            //$('#codigo_agencia').html("Código de agencia- hoy no abre");
        }
        if(datos['Evento_Pendiente']==1){
            document.getElementById("codigo_agencia").innerHTML="Código de agencia- Apertura temprana";
            document.getElementById("numero_punto").style.border="2px solid red";
            $("#evento_pendiente").html("Evento apertura temprana");
            function blink(){
                $("#evento_pendiente").fadeTo(200, 0.1).fadeTo(600, 1.0);
            }
            setInterval(blink, 1000);
        }
        
        id_tipo = datos['ID_Tipo_Punto'];
        id_puntobcr=document.getElementById('ID_PuntoBCR').value;
        $.post("index.php?ctl=numero_zona_prueba_realizadas", { id_puntobcr: id_puntobcr, id_tipo: id_tipo}, function(data){
            //console.log(data);
            $("#pruebas_anteriores").html(data);
        });
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
    document.getElementById('Hora_Apertura_Publico').value=null;
    document.getElementById('Hora_Cierre_Publico').value=null;
    document.getElementById('Hora_Apertura_Agencia').value=null;
    document.getElementById('Hora_Cierre_Agencia').value=null;    
    document.getElementById("codigo_agencia").innerHTML="Código de agencia";
    document.getElementById("numero_punto").removeAttribute("style");
    document.getElementById("hora_apertura").removeAttribute("style");
    document.getElementById("hora_prueba").removeAttribute("style");
    document.getElementById("hora_cierre").removeAttribute("style"); 
    buscar_pruebas_alarma(0);
    $("#pruebas_anteriores").html("");
    $("#evento_pendiente").html("");
}

function listas_desplegables(){
    //Limpia la listas deplegables para cargar nuevamente la información

    //Lista de Tipo Prueba
    var tipo_prueba='<option value="Pánico">Pánico</option>';
    var tipo_prueba=tipo_prueba+'<option value="Intrusion">Intrusión</option>';
    var tipo_prueba=tipo_prueba+'<option value="Fuego">Fuego</option>';
    $('#tipo_prueba').html(tipo_prueba);
    
    //Lista de Revisión de cajero
    var revision_atm='<option value="NO">No</option>';
    var revision_atm=revision_atm+'<option value="SI">Si</option>';
    var revision_atm=revision_atm+'<option value="NA">NA</option>';
    $('#revision_atm').html(revision_atm);
    
    //Lista de Revisión de cuenta secundaria
    var cuentas_secundarias='<option value=""></option>';
    var cuentas_secundarias=cuentas_secundarias+'<option value="Se confirman los cierres">Se confirman los cierres</option>';
    var cuentas_secundarias=cuentas_secundarias+'<option value="Partición(es) abierta(s)">Partición(es) abierta(s)</option>';
    $('#cuentas_secundarias').html(cuentas_secundarias);
    
    //Lista de Revisión de cuenta principal
    var cuenta_principal='<option value=""></option>';
    var cuenta_principal=cuenta_principal+'<option value="Se confirma el cierre">Se confirma el cierre</option>';
    var cuenta_principal=cuenta_principal+'<option value="Partición abierta">Partición abierta</option>';
    $('#cuenta_principal').html(cuenta_principal);
    
    //Lista de Seguimiento
    var seguimiento='<option value=value=""></option>';
    var seguimiento=seguimiento+'<option value="Se solicitó la prueba">Se solicitó la prueba</option>';
    var seguimiento=seguimiento+'<option value="Oficina en Asueto">Oficina en Asueto</option>';
    var seguimiento=seguimiento+'<option value="Oficina con trabajos">Oficina con Trabajos</option>';
    var seguimiento=seguimiento+'<option value="Alarma abierta 24 horas">Alarma abierta 24 horas</option>';
    $('#seguimiento').html(seguimiento);
}

function buscar_pruebas_alarma(id_puntobcr){
    $.post("index.php?ctl=buscar_prueba_alarma", { id_puntobcr: id_puntobcr}, function(data){
        //alert(data);
        //Verificar si encontró prueba de alarma de hoy al Punto BCR
        listas_desplegables();
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
            $("#seguimiento option[value='"+datos['Seguimiento']+"']").attr("selected",true);

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
            document.getElementById('hora_apertura').value="";
            document.getElementById('hora_prueba').value="";
            document.getElementById('zona_prueba').value="";
            document.getElementById('nombre_persona_cierre').value="";
            document.getElementById('hora_cierre').value="";
            document.getElementById('observaciones').value="";

            //Elimina titulos de la busqueda anterior
            document.getElementById('nombre_persona_prueba').title="Usuario no Disponible";
            document.getElementById('hora_apertura').title="Usuario no Disponible";
            document.getElementById('nombre_persona_cierre').title="Usuario no Disponible";
            document.getElementById('hora_cierre').title="Usuario no Disponible";
        }
        
        //Busca información de pruebas realizadas en días anteriores
        $.post("index.php?ctl=pruebas_alarma_anteriores", { id_puntobcr: id_puntobcr}, function(data){
            $("#personas_anteriores").html(data);
        });
    });
}

function buscar_persona_prueba(){
   document.getElementById('ventana_oculta_1').style.display = "block";
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
        
        hora_apertura=document.getElementById('hora_apertura').value;
        if(hora_apertura=="" || hora_apertura==null ){
            document.getElementById("hora_apertura").style.border="2px solid red";
        } else {
            //Calculo diferencias en horas
            var fecha1 = new Date("2017/01/01 "+document.getElementById('hora_apertura').value);
            var fecha2= new Date("2017/01/01 "+document.getElementById('Hora_Apertura_Agencia').value);
            var diff= ((fecha2-fecha1)/60000);
            
            if(diff>0){
                $.confirm({title: 'Confirmación!', content: 'La apertura indicada es antes de lo establecido por normativa, si continua deberá ingresar un evento para justificar la apertura temprana.', 
                confirm: function(){
                    document.getElementById("hora_apertura").removeAttribute("style");
                    id_prueba = document.getElementById('ID_Prueba_Alarma').value;
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
                    window.open('index.php?ctl=frm_eventos_agregar&id='+document.getElementById('ID_PuntoBCR').value);
                },
                cancel: function(){}
                });
            } if(diff<=0){
                var fecha1 = new Date("2017/01/01 "+document.getElementById('hora_apertura').value);
                var fecha2= new Date("2017/01/01 "+document.getElementById('Hora_Apertura_Publico').value);
                var diff2= ((fecha2-fecha1)/60000);
                //console.log(diff2);
                if(document.getElementById('Hora_Apertura_Publico').value!="" && diff2<0){
                    $.confirm({title: 'Confirmación!', content: 'La apertura es posterior a la apertura a público, si continua debera ingresar un evento para justificar la apertura tardía.', 
                    confirm: function(){
                        document.getElementById("hora_apertura").removeAttribute("style");
                        id_prueba = document.getElementById('ID_Prueba_Alarma').value;
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
                        window.open('index.php?ctl=frm_eventos_agregar&id='+document.getElementById('ID_PuntoBCR').value);
                    },
                    cancel: function(){}
                    });
                } else {
                    document.getElementById("hora_apertura").removeAttribute("style");
                    id_prueba = document.getElementById('ID_Prueba_Alarma').value;
                    tipo = "Apertura_Alarma_SIS";
                    punto_bcr = document.getElementById('ID_PuntoBCR').value;

                    $.post("index.php?ctl=prueba_alarma_guardar", {id_prueba: id_prueba, tipo: tipo, punto_bcr:punto_bcr, hora_apertura:hora_apertura}, function(data){
                        // alert(data);
                        numero= data.replace(/\D/g,'');
                        if(numero>0){
                            numero= parseInt(numero);
                            document.getElementById('ID_Prueba_Alarma').value=numero;
                        }
                    });
                }
            }
        }
    }
}

function guardar_prueba_alarma(){
    if(document.getElementById('empresa_persona').value=="" ){
        alert("Es necesaria registrar la persona que realiza reporte de prueba");
    } else {
        hora_prueba=document.getElementById('hora_prueba').value;
        if(hora_prueba=="" || hora_prueba==null ){
            document.getElementById("hora_prueba").style.border="2px solid red";
        } else {
            document.getElementById("hora_prueba").removeAttribute("style");
            id_prueba = document.getElementById('ID_Prueba_Alarma').value;
            zona= document.getElementById('zona_prueba').value;
            tipo = "Hora_Prueba_Alarma_SIS";
            punto_bcr = document.getElementById('ID_PuntoBCR').value;
            $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, tipo: tipo, hora_prueba:hora_prueba, zona:zona, punto_bcr:punto_bcr}, function(data){
                //alert(data);
                //console.log(data);
            });
        }
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
        cierre = document.getElementById('hora_cierre').value;
        if(cierre=="" || cierre==null ){
            document.getElementById("hora_cierre").style.border="2px solid red";
        } else {
            //Calculo de tiempo con cierre de la agencia
            var fecha1 = new Date("2017/01/01 "+document.getElementById('hora_cierre').value);
            var fecha2= new Date("2017/01/01 "+document.getElementById('Hora_Cierre_Agencia').value);
            var diff= ((fecha1-fecha2)/60000);
            
            //Calculo de tiempo con cierre al público
            var fecha1 = new Date("2017/01/01 "+document.getElementById('hora_cierre').value);
            var fecha2= new Date("2017/01/01 "+document.getElementById('Hora_Cierre_Publico').value);
            var diff2= ((fecha1-fecha2)/60000);
            
            //console.log("diff agencia: "+diff);
            //console.log("diff2 público: "+diff2);
            if(diff2<0){
                $.confirm({title: 'Confirmación!', content: 'El cierre indicado es antes del cierre a público, si continua deberá ingresar un evento para justificar el cierre temprano', 
                confirm: function(){
                    document.getElementById("hora_cierre").removeAttribute("style");
                    punto_bcr = document.getElementById('ID_PuntoBCR').value;
                    id_prueba=document.getElementById('ID_Prueba_Alarma').value;
                    tipo = "Cierre_Agencia";
                    $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, punto_bcr:punto_bcr, tipo:tipo, cierre:cierre}, function(data){
                        //alert(data);
                        numero= data.replace(/\D/g,'');
                        if(numero>0){
                            numero= parseInt(numero);
                            document.getElementById('ID_Prueba_Alarma').value=numero;
                        }
                    });
                    window.open('index.php?ctl=frm_eventos_agregar&id='+document.getElementById('ID_PuntoBCR').value);
                },
                cancel: function(){}
                });
            }
            if(diff>0){
               $.confirm({title: 'Confirmación!', content: 'El cierre indicado es 4 horas después del cierre a público, si continua deberá ingresar un evento para justificar el cierre tardío', 
                confirm: function(){
                    document.getElementById("hora_cierre").removeAttribute("style");
                    punto_bcr = document.getElementById('ID_PuntoBCR').value;
                    id_prueba=document.getElementById('ID_Prueba_Alarma').value;
                    tipo = "Cierre_Agencia";
                    $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba, punto_bcr:punto_bcr, tipo:tipo, cierre:cierre}, function(data){
                        //alert(data);
                        numero= data.replace(/\D/g,'');
                        if(numero>0){
                            numero= parseInt(numero);
                            document.getElementById('ID_Prueba_Alarma').value=numero;
                        }
                    });
                    window.open('index.php?ctl=frm_eventos_agregar&id='+document.getElementById('ID_PuntoBCR').value);
                },
                cancel: function(){}
                }); 
            }
            if(diff2>=0 && diff<=0){
                document.getElementById("hora_cierre").removeAttribute("style");
                punto_bcr = document.getElementById('ID_PuntoBCR').value;
                id_prueba=document.getElementById('ID_Prueba_Alarma').value;
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
    } 
}

function guardar_observaciones(){
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        observaciones = document.getElementById('observaciones').value;
        tipo = "Observaciones_Prueba";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba,tipo:tipo, punto_bcr:punto_bcr, observaciones:observaciones}, function(data){
            //alert(data);
            numero= data.replace(/\D/g,'');
            if(numero>0){
                numero= parseInt(numero);
                document.getElementById('ID_Prueba_Alarma').value=numero;
            }
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

function guarda_seguimiento(){
    if(document.getElementById('ID_PuntoBCR').value=="0"){
        alert("Por favor seleccione una agencia para guardar la información");
    } else {
        id_prueba=document.getElementById('ID_Prueba_Alarma').value;
        seguimiento = document.getElementById('seguimiento').value;
        punto_bcr = document.getElementById('ID_PuntoBCR').value;
        tipo = "Seguimiento_Prueba";
        $.post("index.php?ctl=prueba_alarma_guardar", { id_prueba: id_prueba,tipo:tipo, punto_bcr:punto_bcr, seguimiento:seguimiento}, function(data){
            //alert(data);
        });
    }
}