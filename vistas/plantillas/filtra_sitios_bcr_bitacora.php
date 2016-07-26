<?php
/*$conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');

$id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];

$result = $conexion->query("SELECT ID_PuntoBCR, Nombre FROM t_puntobcr WHERE ID_Tipo_Punto=".$id_tipo_punto_bcr." ORDER BY Nombre ASC");*/


$id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];

$obj_even=new cls_eventos();

$obj_even->setCondicion("ID_Tipo_Punto=".$id_tipo_punto_bcr." ORDER BY Nombre ASC");


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['ID_PuntoBCR'].'">'.$row['Nombre'].'</option>';
    }
}
echo $html;
?>