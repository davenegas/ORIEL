<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Personal BCR</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php require_once 'frm_librerias_head.html';?>
    </head>
    
    <body>
        <br>
        <center><img src="vistas/Imagenes/Banner_Centro_de_Control.jpg" alt=""/></center>
        <br>
        <!--Menú completo de la ventana-->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#">Oriel</a>-->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?ctl=inicio"><b>Inicio</b></a></li>
                        <li><a href="index.php?ctl=personal_listar_publico">Personal</a></li>
                        <li><a href="index.php?ctl=puntobcr_listar_publico">Puntos BCR</a></li>
                        <li><a href="index.php?ctl=personal_externo_listar_publico">Padrones Fotográficos</a></li>
                        <li class="active"><a href="index.php?ctl=frm_contacto_publico">Contáctenos</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ayuda
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?ctl=manual_personal_externo_publico">Manual Personal Externo</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?ctl=iniciar_sesion"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--Cuerpo de la página HTML-->
        <div class="container-fluid text-center">
            <div class="row content">
                <!--DIV de navegación lado izquierdo de la ventana-->
                <div class="col-sm-2 sidenav"></div>
                
                <!--DIV Central de la ventana-->
                <div class="col-sm-8 text-left">
                    <div class="row well text-center">
                        <div class="row espacio-arriba">
                            <div class="col-md-12"> 
                                <h2>Solicitud de Permiso</h2>
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-4"></div>
                            <div class="col-md-4">
                                <label for="ID_Persona">Fecha y hora de solicitud</label>
                                <input type="datetime" readonly class="form-control text-center" id="ID_Persona" name="ID_Persona" value="<?php echo date("Y-m-d H:i:s");;?>">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-2"></div>
                            <div class="col-md-4">
                                <label for="nombre_provincia">Provincia</label>
                                <select class="form-control text-center" required=”required” id="nombre_provincia" name="nombre_provincia" >
                                    <option value="0">Todas</option>
                                    <?php $tam_provincias = count($lista_provincias);
                                    for($i=0; $i<$tam_provincias;$i++) {
                                        if($lista_provincias[$i]['ID_Provincia']==$cantones[$distritos[$params[0]['ID_Distrito']]['ID_Canton']]['ID_Provincia']){ ?> 
                                            <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>" selected="selected"><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $lista_provincias[$i]['ID_Provincia']?>" ><?php echo $lista_provincias[$i]['Nombre_Provincia']?></option>  
                                        <?php } 
                                    } ?>  
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="punto_bcr">Punto BCR</label>
                                <select class="form-control text-center" required=”required” id="punto_bcr" name="punto_bcr" >
                                    <option value="0">Todos</option>
                                    <?php
                                    $tam_puntos_bcr=count($lista_puntos_bcr_oficinas_sj);
                                    for($i=0; $i<$tam_puntos_bcr;$i++){?>
                                        <option value="<?php echo $lista_puntos_bcr_oficinas_sj[$i]['ID_PuntoBCR']?>"><?php echo $lista_puntos_bcr_oficinas_sj[$i]['Nombre']?></option>                           
                                    <?php  } ?> 
                                </select>
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="ID_Persona">Funcionario que solicita el permiso</label>
                                <input type="text" readonly class="form-control text-center" id="ID_Persona" name="ID_Persona" value="">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <label for="ID_Persona">Número de contacto</label>
                                <input type="text" class="form-control text-center" id="ID_Persona" name="ID_Persona" value="" placeholder="Número de celular, extensión en caso de consulta sobre el permiso">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="ID_Persona">Funcionario que autoriza el permiso</label>
                                <input type="text" readonly class="form-control text-center" id="ID_Persona" name="ID_Persona" value="">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-2"></div>
                            <div class="col-md-4">
                                <label for="ID_Persona">Fecha de inicio de permiso</label>
                                <input type="date" class="form-control text-center" id="ID_Persona" name="ID_Persona" value="<?php echo date("Y-m-d");;?>">   
                            </div>
                            <div class="col-md-4">
                                <label for="ID_Persona">Fecha de finalización de permiso</label>
                                <input type="date" class="form-control text-center" id="ID_Persona" name="ID_Persona" value="<?php echo date("Y-m-d");;?>">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-sm-2"></div>
                            <div class="col-md-4">
                                <label for="ID_Persona">Hora de inicio de permiso</label>
                                <input type="time" class="form-control text-center" id="ID_Persona" name="ID_Persona" value="<?php echo date("Y-m-d H:i:s");;?>">   
                            </div>
                            <div class="col-md-4">
                                <label for="ID_Persona">Hora de finalización de permiso</label>
                                <input type="time" class="form-control text-center" id="ID_Persona" name="ID_Persona" value="<?php echo date("Y-m-d H:i:s");;?>">   
                            </div>
                        </div>
                        <div class="row espacio-abajo">
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--DIV de navegación lado derecho de la ventana-->
                <div class="col-sm-2 sidenav"></div>
            </div>
        </div>

        <!--Pie de página-->
        <footer class="container-fluid text-center">
          <hr/>
            Jefatura de Seguridad Banco de Costa Rica - Centro de Control y Monitoreo &copy; <br>
            <?php $hoy = date("F j, Y, g:i a"); 
                $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
                echo ", ".date("H:i", time()) . " hrs";?>
        </footer>

    </body>
</html>

        
            