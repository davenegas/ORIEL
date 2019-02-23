<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de recepcion_parqueo</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> <script>
            function limpiar_campos()
            {
                document.getElementById("Nombre").value="";
                document.getElementById("Cedula").value="";
                document.getElementById("Carnet").value="";
                document.getElementById("Empresa").value="";
                document.getElementById("Departamento").value="";
                document.getElementById("Motivo").value="";
                document.getElementById("Fecha_Entrada").value="";
                document.getElementById("Hora_Entrada").value="";

                document.getElementById("Nombre").readOnly = false;
                document.getElementById("Cedula").readOnly = false;
                document.getElementById("Carnet").readOnly = false;
                document.getElementById("Empresa").readOnly = false;
                document.getElementById("Departamento").readOnly = false;
                document.getElementById("Motivo").readOnly = false;
                document.getElementById('divliberar').style.display = "none";
                document.getElementById('divreservar').style.display = "block";
            }
            function ver_registro(pID_RecepcionVisita)
            {                
                $.post("index.php?ctl=recepcion_buscar_visita", { ID_RecepcionVisita: pID_RecepcionVisita}, function(data){
                    ///console.log(data);
                    var n= data.search("No se encontró");
                    if(n==-1){
                        var res = data.substring(data.indexOf("{"), data.length);
                        var datos =JSON.parse(res);
                        document.getElementById("Nombre").value=datos['ID_RecepcionParqueo'];
                        document.getElementById("Cedula").value=datos['Cedula'];
                        document.getElementById("Carnet").value=datos['Carnet'];
                        document.getElementById("Empresa").value=datos['Empresa'];
                        document.getElementById("Departamento").value=datos['Departamento'];
                        document.getElementById("Motivo").value=datos['Motivo'];
                        document.getElementById("Fecha_Entrada").value=datos['Fecha_Entrada'];
                        document.getElementById("Hora_Entrada").value=datos['Hora_Entrada'];
                        
                        document.getElementById("Nombre").readOnly = true;
                        document.getElementById("Cedula").readOnly = true;
                        document.getElementById("Carnet").readOnly = true;
                        document.getElementById("Empresa").readOnly = true;
                        document.getElementById("Departamento").readOnly = true;
                        document.getElementById("Motivo").readOnly = true;
                        document.getElementById('divliberar').style.display = "block";
                        document.getElementById('divreservar').style.display = "none";
                    }                    
                });
            }
            function registrar_salidapersona(pID_RecepcionVisita,pNombre,pCedula)
            {
                msgConfirmacion = "Realmente desea registrar la salida de "+pNombre+", Cédula: "+pCedula+"?";
                $.confirm({title: 'Confirmación!', content: msgConfirmacion, 
                    confirm: function(){
                        $.post("index.php?ctl=recepcion_visita_salir",{ID_RecepcionVisita:pID_RecepcionVisita}, function(data){
                            location.reload();
                        });
                    },
                    cancel: function(){
                    }
                });
            }
            function registrar_ingreso()
            {
                var esError = false;
                pID_Recepcion_Apertura =document.getElementById("ID_Recepcion_Apertura").value;
                pNombre =document.getElementById("Nombre").value;
                pCedula =document.getElementById("Cedula").value;
                pCarnet =document.getElementById("Carnet").value;
                pEmpresa =document.getElementById("Empresa").value;
                pDepartamento =document.getElementById("Departamento").value;
                pMotivo =document.getElementById("Motivo").value;
               
                if(pNombre <=0)
                {
                    alert("Por favor ingrese un nombre!");
                    esError=true;
                }
                if(pCedula <=0)
                {
                    alert("Por favor ingrese un número de cédula!");
                    esError=true;
                }
                if(pCarnet <=0)
                {
                    alert("Por favor ingrese un número de cédula!");
                    esError=true;
                }
                if(pEmpresa <=0)
                {
                    alert("Por favor ingrese la empresa!");
                    esError=true;
                }
                if(pDepartamento <=0)
                {
                    alert("Por favor ingrese el departamento!");
                    esError=true;
                }
                if(pMotivo <=0)
                {
                    alert("Por favor ingrese el motivo de la visita!");
                    esError=true;
                }
                if(esError==false)
                {                     
                    $.post("index.php?ctl=recepcion_visita_guardar",{ID_Recepcion_Apertura:pID_Recepcion_Apertura,Nombre:pNombre,Cedula:pCedula,Carnet:pCarnet,Empresa:pEmpresa,Departamento:pDepartamento,Motivo:pMotivo}, function(data){                        
                        location.reload();
                    });
                }
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <a class="btn btn-info pull-right" href="index.php?ctl=recepcion_puesto_tomar" id="regresar">Regresar</a>
            <h2>Listado General de control de visitas del BCR</h2>
            <p>A continuación se detallan los campos a registrar:</p>
            <input hidden id="ID_Recepcion_Apertura" name="ID_Recepcion_Apertura" type="text" value="<?php echo $ID_Recepcion_Apertura;?>">            
            <input hidden required id="ID_Usuario_Apertura" name="ID_Usuario_Apertura" placeholder="ID_Usuario_Apertura" type="text" value="<?php echo $ID_Usuario_Apertura?>">
            <input hidden required id="ID_UsuarioLog" name="ID_UsuarioLog" placeholder="ID_UsuarioLog" type="text" value="<?php echo $UsuarioSIS?>">
            <div class="row">
                <form id="recervar_espacio" method="POST" name="recervar_espacio" action="index.php?ctl=">
                    <input hidden  required id="ID_Persona" name="ID_Persona" placeholder="ID_Persona" type="text">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">                        
                    <div class="form-group col-md-3">
                        <label for="Nombre">Nombre Completo</label>
                        <input class="form-control espacio-abajo" required id="Nombre" name="Nombre" placeholder="Nombre" type="text">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Cedula">Cédula</label>
                        <input class="form-control espacio-abajo" required id="Cedula" name="Cedula" placeholder="Cédula" type="text">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="Carnet">Carnet</label>
                        <input class="form-control espacio-abajo" required id="Carnet" name="Carnet" placeholder="Carnet" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Empresa">Empresa</label>
                        <input class="form-control espacio-abajo" required id="Empresa" name="Empresa" placeholder="Empresa" type="text">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="Empresa">Departamento</label>
                        <input class="form-control espacio-abajo" required id="Departamento" name="Departamento" placeholder="Departamento" type="text">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="Motivo">Motivo</label>
                        <input class="form-control espacio-abajo" required id="Motivo" name="Motivo" placeholder="Motivo" type="text">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="Fecha_Entrada">Fecha Entrada</label>
                        <input readonly class="form-control espacio-abajo" required id="Fecha_Entrada" name="Fecha_Entrada" placeholder="Fecha Entrada" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Hora_Entrada">Hora Entrada</label>
                        <input readonly class="form-control espacio-abajo" required id="Hora_Entrada" name="Hora_Entrada" placeholder="Hora Entrada" type="text">
                    </div>
                    
                    <div hidden class="form-group col-md-3">
                        <label for="Fecha_Entrada">Fecha Salida</label>
                        <input readonly class="form-control espacio-abajo" required id="Fecha_Entrada" name="Fecha_Entrada" placeholder="Fecha Entrada" type="text">
                    </div>

                    <div hidden class="form-group col-md-3">
                        <label for="Hora_Entrada">Hora Salida</label>
                        <input readonly class="form-control espacio-abajo" required id="Hora_Entrada" name="Hora_Entrada" placeholder="Hora Entrada" type="text">
                    </div>
                    <div class="row"></div>
                    <?php if($ID_Usuario_Apertura == $UsuarioSIS ){?>
                    <div id="divliberar" name="divliberar" hidden><a class="btn btn-warning pull-right" href="javascript:%20limpiar_campos()" id="liberarC" name="liberarC">Limpiar Consulta</a></div>
                    <div id="divreservar" name="divreservar" ><a class="btn btn-primary pull-right" href="javascript:%20registrar_ingreso()" id="reservarC" name="reservarC">Registrar Ingreso</a></div>
                     <?php }?>
                </form>
            </div>
            <div class="bordegris">&nbsp;</div>            
            <div>&nbsp;</div>
            <div class="row">
             <table id="tabla" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden style="text-align:center">ID_RecepcionVisita</th>
                        <th style="text-align:center">Nombre</th>
                        <th style="text-align:center">Cédula</th>
                        <th style="text-align:center">Carnet</th>
                        <th style="text-align:center">Empresa</th>
                        <th style="text-align:center">Departamento</th>
                        <th style="text-align:center">Motivo</th>
                        <th style="text-align:center">Fecha Entrada</th>
                        <th style="text-align:center">Hora Entrada</th>
                        <th style="text-align:center">Fecha Salida</th>
                        <th style="text-align:center">Hora Salida</th>                        
                        <th style="text-align:center">Ver</th>
                        <?php if($ID_Usuario_Apertura == $UsuarioSIS ){?>
                        <th style="text-align:center">Salida</th>
                        <?php }?>
                    </tr>
                </thead>
            <tbody>
                <?php $tam=count($recepcion_visita); for ($i = 0; $i <$tam; $i++) { ?>
                <tr>
                        <td hidden style="text-align:center"><?php echo $recepcion_visita[$i]['ID_RecepcionVisita'];?></td>                                                
                        <td><?php echo $recepcion_visita[$i]['Nombre'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Cedula'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Carnet'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Empresa'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Departamento'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Motivo'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Fecha_Entrada'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Hora_Entrada'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Fecha_Salida'];?></td>
                        <td><?php echo $recepcion_visita[$i]['Hora_Salida'];?></td>
                        <td style="text-align:center"><a role="button" onclick="ver_registro('<?php echo $recepcion_visita[$i]['ID_RecepcionVisita'];?>')">Ver</a></td>
                        <?php if($ID_Usuario_Apertura == $UsuarioSIS ){?>
                        <td style="text-align:center"><a role="button" onclick="registrar_salidapersona('<?php echo $recepcion_visita[$i]['ID_RecepcionVisita'];?>','<?php echo $recepcion_visita[$i]['Nombre'];?>','<?php echo $recepcion_visita[$i]['Cedula'];?>')">Salida</a></td>                        
                        <?php }?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>