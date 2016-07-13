<?php
$conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');

$id_canton = $_POST['id_canton'];

$result = $conexion->query("SELECT ID_Distrito, Nombre_Distrito FROM t_distrito WHERE ID_Canton=".$id_canton." ORDER BY Nombre_Distrito ASC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['ID_Distrito'].'">'.$row['Nombre_Distrito'].'</option>';
    }
}
echo $html;
?>