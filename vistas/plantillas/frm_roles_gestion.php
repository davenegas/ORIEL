<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Roles</title>
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="vistas/js/jquery.min.js"></script>   
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>        
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container">
            <h2>Gestión de Roles de Seguridad</h2>
            <p>Mediante esta pantalla, podrá agregar o editar Roles de seguridad:</p>
            <div class="container">
                <!FORM para ver lista de Modulos creados en el sistema>
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_rol&id=<?php echo trim($ide);?>">
                    <div class="form-group">
                        <label for="Descripcion">Descripción/Nombre de Rol</label>
                        <input type="text" required="required" class="form-control" id="descripcion" name="descripcion" value="<?php echo $desc;?>">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Estado</label>
                        <select class="form-control" id="estado" name="estado" >
                            <?php if ($esta==1){ ?>
                                <option value="Activo" selected="selected">Activo</option>
                                <option value="Inactivo">Inactivo</option>  
                            <?php } else { ?>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo" selected="selected">Inactivo</option>   
                            <?php } ?>  
                        </select>
                    </div>  
            
                    <h2>Listado de Módulos Asociados al Rol</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id de Módulo</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tam=count($params);
                            for ($i = 0; $i <$tam; $i++){
                                $estado=0; ?>
                                <tr>
                                    <td><?php echo $params[$i]['ID_Modulo'];?></td>
                                    <td><?php echo $params[$i]['Descripcion'];?></td>
                                    <?php
                                    for( $j = 0; $j < count($lista); $j++){
                                        if($lista[$j]['ID_Modulo']==$params[$i]['ID_Modulo']){
                                            $estado=1;
                                        }    
                                    }
                                    if($estado==0){?>
                                        <td>
                                            <label class="checkbox-inline"><input type="checkbox" 
                                               name="lista[]" value="<?php echo $params[$i]['ID_Modulo'];?>" ></label>
                                        </td>  
                                    <?php } else { ?>
                                        <td>
                                            <label class="checkbox-inline"><input type="checkbox" accept="" name="lista[]" checked value="<?php echo $params[$i]['ID_Modulo'];?>" ></label>
                                        </td> 
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <button type="submit" class="btn btn-default" >Guardar</button>
                <td><a href="index.php?ctl=listar_roles" class="btn btn-default" role="button">Cancelar</a></td>
                </form>     
            </div>  
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>