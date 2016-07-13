<html>
    <head>
        <meta charset="utf-8"/>
        <title>Prueba de Listas Dependientes</title>
        <script language="javascript" src="vistas/plantillas/jquery.js"></script>
        <script language="javascript" src="vistas/plantillas/listas_dependientes.js"></script>
        <?php require_once 'frm_librerias_head.html';?>
    </head>
    <body>
        <?php
        $conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');
        ?>
        Provincia: <select name="provincia" id="provincia">
            <?php
            $result = $conexion->query("SELECT ID_Provincia, Nombre_Provincia FROM t_provincia ORDER BY Nombre_Provincia ASC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {                
                    echo '<option value="'.$row['ID_Provincia'].'">'.$row['Nombre_Provincia'].'</option>';
                    
                }
            }
            ?>
        </select>
         <br><br>
        Cantón: <select name="canton" id="canton"></select>
        <br><br>
        Distrito: <select name="distrito" id="distrito"></select>
    </body>
</html>
