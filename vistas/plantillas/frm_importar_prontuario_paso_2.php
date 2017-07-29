<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Importar Prontuario Paso 2 (Listado de Personas)</title>
        <?php require_once 'frm_librerias_head.html'; ?>  
        <script>
            $(document).ready(function () {
                // Una vez se cargue al completo la página desaparecerá el div "cargando"
                $('#cargando').hide();
            });
        </script>        
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container animated fadeIn">
            <h2>Listado de Personal Recibido (2/10):</h2>
            <h4><?php echo $mensaje;?></h4>

            <a href="index.php?ctl=frm_importar_prontuario_paso_3" class="btn btn-default espacio-abajo" role="button">Gestionar Unidades Ejecutoras</a>
            <a href="index.php?ctl=principal" class="btn btn-default espacio-abajo" role="button">Salir del Asistente</a> 

            <table id="tabla" class="display">
                <thead>
                    <tr>
                        <th>Nombre Funcionario</th>
                        <th>Cédula</th>
                        <th>Clase</th>
                        <th>Puesto</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Extensión</th>
                        <th>Unidad Ejecutora</th>
                        <th>Dirección</th>
                        <th>Teléfono Residencia</th>
                        <th>Teléfono Celular</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tam=count($_SESSION['prontuario']);
                    for ($i = 0; $i <$tam; $i++) { ?>
                        <tr>
                            <td><?php echo $_SESSION['prontuario'][$i][0];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][1];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][2];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][3];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][4];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][5];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][6];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][7];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][8];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][9];?></td>
                            <td><?php echo $_SESSION['prontuario'][$i][10];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>