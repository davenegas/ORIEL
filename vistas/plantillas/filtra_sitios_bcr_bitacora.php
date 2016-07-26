<?php

$conexion = new mysqli('localhost', 'root', '', 'bd_Gerencia_Seguridad');

$id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];
$id_provincia= $_POST['id_provincia'];

$result = $conexion->query("SELECT t_PuntoBCR.ID_PuntoBCR, t_PuntoBCR.Nombre FROM t_puntobcr 
        INNER JOIN t_Distrito ON t_PuntoBCR.ID_Distrito=t_Distrito.ID_Distrito 
        INNER JOIN t_Canton ON t_Distrito.ID_Canton=t_Canton.ID_Canton 
        INNER JOIN t_Provincia ON t_Canton.ID_Provincia=t_Provincia.ID_Provincia 
        WHERE ID_Tipo_Punto=".$id_tipo_punto_bcr." AND t_Provincia.ID_Provincia=".$id_provincia. 
        " ORDER BY t_PuntoBCR.Nombre ASC");

//$result = $conexion->query("SELECT ID_PuntoBCR, Nombre FROM t_puntobcr WHERE ID_Tipo_Punto=".$id_tipo_punto_bcr." AND ID_Distrito=4 ORDER BY Nombre ASC");


/*$id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];

$obj_even=new cls_eventos();

$obj_even->setCondicion("ID_Tipo_Punto=".$id_tipo_punto_bcr." ORDER BY Nombre ASC");

$obj_even->obtener_puntos_bcr_por_provincia_y_tipo_de_punto();

$result=$obj_even->getArreglo();*/

if ($result->num_rows > 0) {
    
    /*for ($index = 0; $index < count($result); $index++) {
        $html .= '<option value="'.$result[i]['ID_PuntoBCR'].'">'.$result[i]['Nombre'].'</option>';
    }*/
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['ID_PuntoBCR'].'">'.$row['Nombre'].'</option>';
    }
}

//$html .= '<option value="'.$result[0]['ID_PuntoBCR'].'">'.$result[0]['Nombre'].'</option>';
echo $html;
?>