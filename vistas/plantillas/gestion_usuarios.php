<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Usuarios</title>
        <?php require_once 'frm_librerias_head.html'; ?>
    </head>
    <body>
        <?php require_once 'encabezado.php'; ?>
        <div class="container">
            <h2>Gestión de Usuarios del Sistema</h2>
            <p>Mediante esta pantalla, podrá agregar o editar Usuarios del sistema:</p>
            <div class="container">
                <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=guardar_usuario&id=<?php echo trim($ide);?>">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" required="required" class="form-control" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre'];?>">
                    </div>

                    <div class="form-group">
                        <label for="Apellido">Apellido</label>
                        <input type="text" required="required" class="form-control" id="Apellido" name="Apellido" value="<?php echo $params[0]['Apellido'];?>">
                    </div>

                    <div class="form-group">
                        <label for="Cedula">Cédula</label>
                        <input type="text" data-mask="0-0000-0000" data-mask-clearifnotmatch="true"  required="required" maxlength="10" pattern="\d*" class="form-control" id="Cedula" name="Cedula" value="<?php echo $params[0]['Cedula'];?>">
                    </div>

                    <div class="form-group">
                        <label for="Correo">Correo</label>
                        <input type="email" class="form-control" id="Correo" name="Correo" value="<?php echo $params[0]['Correo'];?>">
                    </div>

                    <div class="form-group">
                        <label for="Observaciones">Observaciones</label>
                        <input type="text" class="form-control" id="Observaciones" name="Observaciones" value="<?php echo $params[0]['Observaciones'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="Rol">Rol</label>
                        <select class="form-control" id="Rol" name="Rol" > 
                            <?php
                            $tam = count($roles);
                            for($i=0; $i<$tam;$i++){
                                if($roles[$i]['ID_Rol']==$params[0]['ID_Rol']){ ?> 
                                    <option value="<?php echo $roles[$i]['ID_Rol']?>" selected="selected"><?php echo $roles[$i]['Descripcion']?></option><?php
                                } else { ?>
                                    <option value="<?php echo $roles[$i]['ID_Rol']?>" ><?php echo $roles[$i]['Descripcion']?></option>   
                                <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Estado">Estado</label>
                        <select class="form-control" id="Estado" name="Estado" >
                            <?php if ($params[0]['Estado']==1){ ?>
                                <option value="1" selected="selected">Activo</option>
                                <option value="0">Inactivo</option>  
                            <?php }  else { ?>
                                <option value="1">Activo</option>
                                <option value="0" selected="selected">Inactivo</option>   
                            <?php } ?>  
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-default" >Guardar</button>
                    <td><a href="index.php?ctl=listar_usuarios" class="btn btn-default" role="button">Cancelar</a></td>
                </form>     
            </div>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>