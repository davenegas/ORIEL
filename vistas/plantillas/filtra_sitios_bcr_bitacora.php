<?php
$conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');

$id_provincia = $_POST['id_provincia'];

$result = $conexion->query("SELECT ID_PuntoBCR, Nombre FROM t_puntobcr WHERE ID_Tipo_Punto=".$id_provincia." ORDER BY Nombre ASC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['ID_PuntoBCR'].'">'.$row['Nombre'].'</option>';
    }
}
echo $html;
?>