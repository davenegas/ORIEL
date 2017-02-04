<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Tipos de Eventos</title>
        <?php require_once 'frm_librerias_head.html';?>
        <script>
            
        $(document).ready(function () {
                if ( $.fn.dataTable.isDataTable('#tabla') ) {
                    table = $('#tabla').DataTable();
                }
                table.destroy();
                table = $('#tabla').DataTable( {
                    stateSave: true,
                    "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]
                });       
            });
            
      function myFunction() {
   var table = document.getElementById("myTable");
//    
//    alert (table.rows.length);
 
    $('#myTable tr:last').after('<tr><td>Row1 cell1</td><td>Row1 cell2</td><td><a href="#" class="Subir">Subir</a></td><td><a href="#" class="Bajar">Bajar</a></td></td><td><a href="#" class="Eliminar">Eliminar</a></td></tr>');
   
    $(".Subir,.Bajar,.Eliminar").unbind('click'); 

    $(".Subir,.Bajar,.Eliminar").click(function(){
       // alert($('#myTable tr .active').index());
        var row = $(this).parents("tr:first");
        if ($(this).is(".Subir")) {
            row.insertBefore(row.prev());
        } 
        if ($(this).is(".Bajar")) {
            row.insertAfter(row.next());
        } 
        if ($(this).is(".Eliminar")) {
            row.remove();
        } 
  
    });
    
}


$(document).ready(function(){
    $(".Subir,.Bajar,.Eliminar").click(function(){
        //alert("10");
        var row = $(this).parents("tr:first");
        if ($(this).is(".Subir")) {
            row.insertBefore(row.prev());
        } 
        if ($(this).is(".Bajar")) {
            row.insertAfter(row.next());
        } 
        if ($(this).is(".Eliminar")) {
            row.remove();
        } 
  
    });
});

function agregar_unidad_de_video_al_puesto(id_uni,nom,tipo,desc){
      var table = document.getElementById("myTable");
//    
//    alert (table.rows.length);
 
    $('#myTable tr:last').after('<tr><td hidden="true">'+id_uni+'</td><td>'+nom+'</td><td>'+desc+'</td><td>'+tipo+'</td><td><a href="#" class="Subir">Subir</a></td><td><a href="#" class="Bajar">Bajar</a></td></td><td><a href="#" class="Eliminar">Eliminar</a></td></tr>');
   
    $(".Subir,.Bajar,.Eliminar").unbind('click'); 

    $(".Subir,.Bajar,.Eliminar").click(function(){
       // alert($('#myTable tr .active').index());
        var row = $(this).parents("tr:first");
        if ($(this).is(".Subir")) {
            row.insertBefore(row.prev());
        } 
        if ($(this).is(".Bajar")) {
            row.insertAfter(row.next());
        } 
        if ($(this).is(".Eliminar")) {
            row.remove();
        } 
  
    });
}

        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <!--<div class="container">-->
            
        <div class="col-md-5">
            <h3>Puesto de Monitoreo:</h3>
            <p>A continuación se detallan las Unidades de Video ligadas al puesto de monitoreo en orden de revisión del operador:</p>   
        <table id="myTable" class="table table-hover">
            <thead>
            <tr>
                <th hidden="hidden">Id Unidad Video</th>
              <th>Punto BCR</th>
               <th>Descripción</th>
               <th>Tipo Punto</th>
              <th></th> 
              <th></th>
              <th></th>
            </tr>
          </thead>
            <tr hidden="">
                <td hidden="hidden">Temporal</td>
                <td>Temporal</td>
          <td>Temporal</td>
           <td>
               <a href="#" class="Subir">Subir</a>    
          </td>
          <td>
              <a href="#" class="Bajar">Bajar</a>
          </td>
          </td>
           <td>
          <a href="#" class="Eliminar">Eliminar</a>
          </td>
        </tr>
        
      </table>
            <!--<button onclick="myFunction()">Try it</button>-->
        </div>
         <div class="col-md-7">
            <h3>Lista de Unidades de Video</h3>    
            <p>A continuación se detallan las Unidades de Video que están registradas en el sistema con un Punto BCR relacionado:</p>   
        <table id="tabla" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th hidden style="text-align:center">ID Unidad de Video</th>
                    <th style="text-align:center">Punto BCR</th>
                    <th style="text-align:center">Provincia</th>
                    <th style="text-align:center">Descripción</th>
                    <th style="text-align:center">Tipo de Punto</th>
                    <th style="text-align:center">#Serie</th>
                    <th style="text-align:center">Mac Address</th>
                    <th style="text-align:center">#Cámaras</th>   
                </tr>
          </thead>
          <tbody>
                <?php 
                $tam=count($params);
                for ($i = 0; $i <$tam; $i++) {
                //Solamente muestra los puntos activos o todos a quien puede cambiar el estado             
                ?>
                <tr>
                    <td hidden style="text-align:center"><?php echo $params[$i]['ID_Unidad_Video'];?></td>                   
                    <td style="text-align:center"><a href="#" onclick="agregar_unidad_de_video_al_puesto('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Nombre'];?>','<?php echo $params[$i]['Tipo_Punto'];?>','<?php echo $params[$i]['Descripcion'];?>');"><?php echo $params[$i]['Nombre'];?></a></td>
                    
                    <td style="text-align:center"><?php echo $params[$i]['Nombre_Provincia'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Descripcion'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Tipo_Punto'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Serie'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Mac_Address'];?></td>
                    <td style="text-align:center"><?php echo $params[$i]['Camaras_Habilitadas'];?></td>
                </tr>     
            <?php } ?>
            </tbody>
        </table>
         </div>
        <!--</div>-->
            <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
    </body>
</html>