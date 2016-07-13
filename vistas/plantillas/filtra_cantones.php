<?php
$conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');

$id_provincia = $_POST['id_provincia'];

$result = $conexion->query("SELECT ID_Canton, Nombre_Canton FROM t_canton WHERE ID_Provincia=".$id_provincia." ORDER BY Nombre_Canton ASC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['ID_Canton'].'">'.$row['Nombre_Canton'].'</option>';
    }
}
echo $html;
?>