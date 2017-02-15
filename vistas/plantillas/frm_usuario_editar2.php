<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina inicio</title>
        <link href="../../../bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="vistas/js/jquery.min.js"></script>   
        <script src="../../../bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div>
            <label>Cedula</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['Cedula']?>">
            <label>Nombre y apellido</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['Apellido_Nombre']?>">
            <label>Contraseña</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['Password']?>">
            <label>Observaciones</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['Observaciones']?>">
            <label>Rol</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['ID_Rol']?>">
            <label>Turno</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['ID_Turno']?>">
            <label>Horario</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['ID_Horario']?>">
            <label>Estado</label>
            <input type="text"  class="form-control" value="<?php echo $params[0]['Estado']?>">
        </div>
        <a class="btn btn-default" role="button">Guardar usuario</a>
    </body>
</html>
