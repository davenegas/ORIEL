<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Puntos BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <script language="javascript" src="vistas/js/listas_dependientes_puntobcr.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>

    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
        <h2>Agregar Puntos BCR</h2>
        <h3>Información General del Punto BCR</h3>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="index.php?ctl=punto_bcr_guardar&id=<?php echo trim($ide);?>">
        <div>    
            <div class="col-md-6">
              <label for="Codigo">Codigo</label>
              <input type="text" required="required" placeholder="Codigo ó número de mil del Punto BCR" class="form-control" id="Codigo" name="Codigo" value="<?php echo $params[0]['Codigo'];?>">
            </div>
            <div class="col-md-6">
              <label for="Cuenta_SIS">Cuenta SIS</label>
              <input type="text" class="form-control" id="Cuenta_SIS" placeholder="Número de Cuenta del SIS" name="Cuenta_SIS" value="<?php echo $params[0]['Cuenta_SIS'];?>">
            </div>
            <div class="col-md-6 espacio-arriba">
              <label for="Nombre">Nombre</label>
              <input type="text" style="text-transform: uppercase" required="required" class="form-control" placeholder="Nombre del Sitio, inicia con AG, ATM, CA" id="Nombre" name="Nombre" value="<?php echo $params[0]['Nombre'];?>">
            </div>
            <div class="col-md-6 espacio-arriba ">
                <label for="Tipo_Punto">Tipo de Punto</label>
                <select class="form-control" id="Tipo_Punto" name="Tipo_Punto" > 
                <?php
                $tam = count($tipo_puntos);

                for($i=0; $i<$tam;$i++)
                {   ?>
                    <option value="<?php echo $tipo_puntos[$i]['ID_Tipo_Punto']?>" ><?php echo $tipo_puntos[$i]['Tipo_Punto']?></option>   
                <?php   
                } ?>
                </select>
            </div>
        </div> 
        <div>
            <div class="col-md-4 espacio-arriba">
                <label for="Provincia">Provincia</label>
                <select class="form-control" id="Provincia" name="Provincia" > 
                <?php
                $tam = count($provincias);
                
                for($i=0; $i<$tam;$i++)
                { ?>
                    <option value="<?php echo $provincias[$i]['ID_Provincia']?>" ><?php echo $provincias[$i]['Nombre_Provincia']?></option>   
                    <?php  
                }   ?>
                </select>
            </div>
            
            <div class="col-md-4 espacio-arriba">
                <label for="Canton">Cantón</label>
                <select class="form-control" id="Canton" name="Canton" > 
                <?php
                $tam = count($cantones);
                for($i=0; $i<$tam;$i++)
                {?>
                    <option value="<?php echo $cantones[$i]['ID_Canton']?>" ><?php echo $cantones[$i]['Nombre_Canton']?></option>   
                    <?php    
                } ?>
                </select>
            </div>
            <div class="col-md-4 espacio-arriba">
                <label for="Distrito">Distrito</label>
                <select class="form-control" required="required" id="Distrito" name="Distrito" > 
                <?php
                $tam = count($distritos);
                for($i=0; $i<$tam;$i++)
                {   ?>
                    <option value="<?php echo $distritos[$i]['ID_Distrito']?>" ><?php echo $distritos[$i]['Nombre_Distrito']?></option>   
                    <?php   
                }   ?>
                </select>
            </div>
            
            <div class="col-md-12 espacio-arriba">
              <label for="Direccion">Dirección</label>
              <input type="text" class="form-control" id="Direccion" placeholder="Dirección exacta del Punto BCR" name="Direccion" value="<?php echo $params[0]['Direccion'];?>">
            </div>
        </div>  
            <div>
        <div class="col-md-4 espacio-arriba">
            <label for="Empresa">Remesa</label>
            <select class="form-control" id="Empresa" name="Empresa"> 
                <?php
                $tam = count($empresas);
                for($i=0; $i<$tam;$i++)
                {   ?>
                    <option value="<?php echo $empresas[$i]['ID_Empresa']?>" ><?php echo $empresas[$i]['Empresa']?></option>   
                    <?php 
                }  ?>
                </select>
            </div>
            
            <div class="col-md-4 espacio-arriba">
              <label for="Observaciones">Observaciones</label>
              <input type="text" class="form-control" id="Observaciones" placeholder="Observaciónes del Punto BCR" name="Observaciones" value="<?php echo $params[0]['Observaciones'];?>">
            </div>
            
            <div class="col-md-4 espacio-arriba">
                <label for="Estado">Estado</label>
                <select class="form-control" id="Estado" name="Estado" >
                    <?php if ($params[0]['Estado']==1){
                    ?>
                        <option value="1" selected="selected">Activo</option>
                        <option value="0">Inactivo</option>  
                    <?php
                    }  else {
                    ?>
                       <option value="1">Activo</option>
                       <option value="0" selected="selected">Inactivo</option>   
                    <?php
                    }
                    ?>  
                </select>
            </div>
            </div>
            <button type="submit" class="btn btn-default quitar-float espacio-arriba" >Guardar</button>
            <a href="index.php?ctl=puntos_bcr_listar" class="btn btn-default espacio-arriba" role="button">Volver</a> 
        </form>  
            <!--<button type="submit" class="btn btn-default" >Guardar</button>-->
            
            
        </div>                         
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
    </div>
</html>