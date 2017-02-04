<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Lista de Unidades de Video</title>
        <?php require_once 'frm_librerias_head.html';?>
        <link rel="stylesheet" href="vistas/css/ventanaoculta.css"> 
        <script>
          $(document).ready(function () {
            // Una vez se cargue al completo la página desaparecerá el div "cargando"
            $('#cargando').hide();
          });
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
            
            //Valida para permitir solo numeros en un input
            //Llamarlo desde el evento  onkeypress="return valida(event)"
             function valida(e){
                tecla = (document.all) ? e.keyCode : e.which;

                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8){
                    return true;
                }

                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9.]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }

            //Valida informacion completa de formulario de notas de coordinacion
            function check_empty_AA() {

                var f = new Date();
                var estado_temp_num="";
                var estado_nuevo_valor="";
                m=f.getMonth() + 1; 
                if(m < 10){ 
                   m = '0' + m;
                } 

                fecha_actual=f.getFullYear()+"-"+m + "-" + f.getDate();
                
                if (document.getElementById('campo_a_editar_AA').value=='Arranque_Automatico'){
                  
                    var estado_temp=document.getElementById(document.getElementById('ID_Unidad_Video_AA').value+'-'+document.getElementById('campo_a_editar_AA').value).innerHTML;
                    if (estado_temp=="No"){
                        estado_temp_num=0;
                        estado_nuevo_valor="Si";
                    }else{
                        estado_temp_num=1;
                        estado_nuevo_valor="No";
                    }
                    if (document.getElementById('Estado_Arranque_Automatico').value!=estado_temp_num){
                        document.getElementById(document.getElementById('ID_Unidad_Video_AA').value+'-'+document.getElementById('campo_a_editar_AA').value).innerHTML=estado_nuevo_valor;
                        document.getElementById(document.getElementById('ID_Unidad_Video_AA').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                        $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video_AA').value ,campo_a_editar:document.getElementById('campo_a_editar_AA').value,valor:document.getElementById('Estado_Arranque_Automatico').value}, function(data){
                           var str = data;
                           var n = str.search("SI");
                           if (n!=-1){

                            }
                            }); 
                        
                        document.getElementById('ventana_oculta_2').style.display = "none";    
                    }
                 }
            }
            
             //Valida informacion completa de formulario de notas de coordinacion
            function check_empty_Estado_Unidad_Video() {

                var f = new Date();
                var estado_temp_num="";
                var estado_nuevo_valor="";
                m=f.getMonth() + 1; 
                if(m < 10){ 
                   m = '0' + m;
                } 

                fecha_actual=f.getFullYear()+"-"+m + "-" + f.getDate();
                             
                if (document.getElementById('campo_a_editar_estado').value=='Estado'){
                    var estado_temp=document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-'+document.getElementById('campo_a_editar_estado').value).innerHTML;
                    
                    if (estado_temp=="En producción"){
                        estado_temp_num=0;
                        estado_nuevo_valor="Si";
                    }
                    if (estado_temp=="Sin Utilizar/Disponible"){
                        estado_temp_num=1;
                        estado_nuevo_valor="Si";
                    }
                     if (estado_temp=="En taller/Con Avería"){
                        estado_temp_num=2;
                        estado_nuevo_valor="Si";
                    }
                     if (estado_temp=="Obsoleto-Descontinuado"){
                        estado_temp_num=3;
                        estado_nuevo_valor="Si";
                    }
                 
                    if (document.getElementById('Estado_Unidad_Video').value!=estado_temp_num){
                        var combo = document.getElementById('Estado_Unidad_Video');
                        document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-'+document.getElementById('campo_a_editar_estado').value).innerHTML=combo.options[combo.selectedIndex].text;;
                        document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                        document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-ID_PuntoBCR').innerHTML=""; 
                        document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-Provincia').innerHTML=""; 
                        document.getElementById(document.getElementById('ID_Unidad_Video_Estado').value+'-Tipo_Punto').innerHTML=""; 
                        $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video_Estado').value ,campo_a_editar:document.getElementById('campo_a_editar_estado').value,valor:document.getElementById('Estado_Unidad_Video').value}, function(data){
                           var str = data;
                           var n = str.search("SI");
                           if (n!=-1){

                            }
                            }); 
                        
                        document.getElementById('ventana_oculta_3').style.display = "none";    
                    }
                 }
            }
             //Valida informacion completa de formulario de notas de coordinacion
            function check_empty() {
                
                if (document.getElementById('detalle').value.trim()!=""){
                   
                    var f = new Date();
                    m=f.getMonth() + 1; 
                    if(m < 10){ 
                       m = '0' + m;
                    } 
                    
                    fecha_actual=f.getFullYear()+"-"+m + "-" + f.getDate();
                    if ((document.getElementById('campo_a_editar').value=='Cuadros_Por_Segundo')||(document.getElementById('campo_a_editar').value=='Camaras_Habilitadas')||(document.getElementById('campo_a_editar').value=='Cantidad_Entradas_Video')||(document.getElementById('campo_a_editar').value=='Regulacion')||(document.getElementById('campo_a_editar').value=='Calidad')||(document.getElementById('campo_a_editar').value=='Version_Software')||(document.getElementById('campo_a_editar').value=='Capacidad_Disco_Duro')||(document.getElementById('campo_a_editar').value=='Promedio_Dias')){
                        if (!isNaN(document.getElementById('detalle').value)){
                            if (document.getElementById('detalle').value!=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).value){
                               document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML=document.getElementById('detalle').value; 
                               document.getElementById(document.getElementById('ID_Unidad_Video').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                               $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video').value ,campo_a_editar:document.getElementById('campo_a_editar').value,valor:document.getElementById('detalle').value}, function(data){
                               document.getElementById('ventana_oculta_1').style.display = "none";
                          
                                }); 
                            }
                        }else{
                            alert('Es necesario detaller valores numéricos en el campo correspondiente');
                        }

                    }
                    if ((document.getElementById('campo_a_editar').value=='Observaciones')||(document.getElementById('campo_a_editar').value=='Descripcion')||(document.getElementById('campo_a_editar').value=='Resolucion')){
                            if (document.getElementById('detalle').value!=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).value){
                               document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML=document.getElementById('detalle').value; 
                               document.getElementById(document.getElementById('ID_Unidad_Video').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                               $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video').value ,campo_a_editar:document.getElementById('campo_a_editar').value,valor:document.getElementById('detalle').value}, function(data){
                               document.getElementById('ventana_oculta_1').style.display = "none";
                                                                                          
                                }); 
                            }
                    }
                    if (document.getElementById('campo_a_editar').value=='Mac_Address'){
                            if (document.getElementById('detalle').value!=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).value){
                               if (document.getElementById('detalle').value.trim().length==17){
                                   //alert(document.getElementById('detalle').value);
                                    $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video').value ,campo_a_editar:document.getElementById('campo_a_editar').value,valor:document.getElementById('detalle').value}, function(data){
                                    var n = data.search("SI");
                                    if (n!=-1){
                                        document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML=document.getElementById('detalle').value; 
                                        document.getElementById(document.getElementById('ID_Unidad_Video').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                                        document.getElementById('ventana_oculta_1').style.display = "none";
                                    }else{
                                        //alert (data);
                                        alert('Esta Mac Address ya se encuentra registrada en otra unidad de video de la Base de Datos. Proceda a revisar!!!');
                                    }

                                    }); 
                               }else{
                                    alert('El formato de la Mac Address debe cumplir con el tamaño correspondiente: 17 dígitos!!!');
                                    }
                            }
                    }
                     if (document.getElementById('campo_a_editar').value=='Serie'){
                            if (document.getElementById('detalle').value!=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).value){
                                    $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video').value ,campo_a_editar:document.getElementById('campo_a_editar').value,valor:document.getElementById('detalle').value}, function(data){
                                    var n = data.search("SI");
                                    if (n!=-1){
                                        document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML=document.getElementById('detalle').value; 
                                        document.getElementById(document.getElementById('ID_Unidad_Video').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                                        document.getElementById('ventana_oculta_1').style.display = "none";
                                    }else{
                                        alert('Este número de serie ya se encuentra registrado en otra unidad de video de la base de datos. Proceda a revisar!!!');
                                    }

                                    }); 
                            }
                    }
                }else{
                    alert('Es necesario completar el campo detalle');
                }
            }
            //Valida informacion completa de formulario de notas de coordinacion
            function edita_dato(id_unidad,texto,valida,titulo) {
                
              if (valida=="Arranque_Automatico"){
                  $("#Estado_Arranque_Automatico option[value="+texto+"]").attr("selected",true);
                  document.getElementById('ID_Unidad_Video_AA').value=id_unidad;
                  document.getElementById('campo_a_editar_AA').value=valida;
                  document.getElementById('ventana_oculta_2').style.display = "block";
                  
              }else{
                  if (valida=="Estado"){
                       $("#Estado_Unidad_Video option[value="+texto+"]").attr("selected",true);
                       document.getElementById('ID_Unidad_Video_Estado').value=id_unidad;
                       document.getElementById('campo_a_editar_estado').value=valida;
                       document.getElementById('ventana_oculta_3').style.display = "block";
                  }else{
                        if (valida=="ID_PuntoBCR"){
                            //$("#Estado_Unidad_Video option[value="+texto+"]").attr("selected",true);
                            document.getElementById('ID_Unidad_Video_PuntoBCR').value=id_unidad;
                            document.getElementById('campo_a_editar_puntobcr').value=valida;
                            document.getElementById('nombre_puntobcr').value=texto;
                            document.getElementById('ventana_oculta_4').style.display = "block";
                           
                         }else{
                            document.getElementById('titulo_ventana_oculta').innerHTML=titulo;
                            document.getElementById('ID_Unidad_Video').value=id_unidad;
                            document.getElementById('campo_a_editar').value=valida;
                            document.getElementById('detalle').value=document.getElementById(document.getElementById('ID_Unidad_Video').value+'-'+document.getElementById('campo_a_editar').value).innerHTML;
                            document.getElementById('ventana_oculta_1').style.display = "block"; 
                        }
                     }
              }
            }       
            //Funcion para ocultar ventana de mantenimiento de notas de coordinacion
            function ocultar_elemento(){
                document.getElementById('ventana_oculta_1').style.display = "none";
                document.getElementById('ventana_oculta_2').style.display = "none";
                document.getElementById('ventana_oculta_3').style.display = "none";
                document.getElementById('ventana_oculta_4').style.display = "none";
                //location.reload(true);

            }
            //Funcion para ocultar ventana de mantenimiento de notas de coordinacion
            function nueva_unidad_de_video(){
              $.post("index.php?ctl=agregar_nueva_unidad_de_video",{}, function(data){
                                    var n = data.search("SI");
                                    if (n!=-1){
                                        alert ('Fue ingresado un nuevo registro de unidad de video con siete ceros en el número de serie (0000000) y diecisiete ceros en la mac address (00000000000000000), esto para su respectiva actualización y utilización!!!');
                                        setTimeout ("location.reload(true);", 12000); 
                                    }else{
                                        alert('No fue posible ingresar un nuevo registro de unidad de video, verifique en la tabla ya que existe un registro disponible inicializado con número de serie de siete ceros (0000000) o mac address de diecisiete ceros (00000000000000000).');
                                    }

                                    }); 
            }
              //Valida informacion completa de formulario de notas de coordinacion
            function agregar_puntobcr(id_punt,nom,provin,tp){

                var f = new Date();
               
                m=f.getMonth() + 1; 
                if(m < 10){ 
                   m = '0' + m;
                } 

                fecha_actual=f.getFullYear()+"-"+m + "-" + f.getDate();
                document.getElementById(document.getElementById('ID_Unidad_Video_PuntoBCR').value+'-'+document.getElementById('campo_a_editar_puntobcr').value).innerHTML=nom;
                document.getElementById(document.getElementById('ID_Unidad_Video_PuntoBCR').value+'-Fecha_Actualizacion').innerHTML=fecha_actual; 
                document.getElementById(document.getElementById('ID_Unidad_Video_PuntoBCR').value+'-Estado').innerHTML="En producción"; 
                document.getElementById(document.getElementById('ID_Unidad_Video_PuntoBCR').value+'-Provincia').innerHTML=provin; 
                document.getElementById(document.getElementById('ID_Unidad_Video_PuntoBCR').value+'-Tipo_Punto').innerHTML=tp; 
                $.post("index.php?ctl=editar_campo_unidades_de_video", { id_unidad_video:document.getElementById('ID_Unidad_Video_PuntoBCR').value ,campo_a_editar:document.getElementById('campo_a_editar_puntobcr').value,valor:id_punt}, function(data){
                   var str = data;
                   var n = str.search("SI");
                   if (n!=-1){
                    }
                 }); 

                document.getElementById('ventana_oculta_4').style.display = "none";      
            }  
            function cargar_padron_fotografico(id_uni){  
                if (document.getElementById(id_uni+'-ID_PuntoBCR').innerHTML.length>0){
                    //alert(document.getElementById(id_uni+'-ID_PuntoBCR').innerHTML.length);
                    document.location.href="index.php?ctl=frm_unidades_de_video_padron_fotografico&id="+id_uni;
                }
            }
        </script>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
         <div id="cargando">
            <center><img align="center" src="vistas/Imagenes/Espere.gif"/></center>
        </div>
        <div class="container animated fadeIn col-xs-10 quitar-float">
        <h2>Listado General de Unidades de Video</h2>
        <p>A continuación se detallan las Unidades de Video que están registradas en el sistema:</p>   
        <table id="tabla" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th hidden style="text-align:center">ID Unidad de Video</th>
                    <th style="text-align:center">Imágenes</th>
                    <th style="text-align:center">Punto BCR</th>
                    <th style="text-align:center">Provincia</th>
                    <th style="text-align:center">Fecha Última Actualización</th>
                    <th style="text-align:center">Descripción</th>
                    <th style="text-align:center">Tipo de Punto</th>
                    <th style="text-align:center">#Serie</th>
                    <th style="text-align:center">Promedio Días</th>
                    <th style="text-align:center">Disco Duro (GB)</th>
                    <th style="text-align:center">Versión Software</th>
                    <th style="text-align:center">Mac Address</th>
                    <th style="text-align:center">Regulación(Kbps)</th>
                    <th style="text-align:center">#Entradas de Video</th>
                    <th style="text-align:center">#Cámaras</th>
                    <th style="text-align:center">Cuadros/Segundo(FS)</th>
                    <th style="text-align:center">Resolución</th>
                    <th style="text-align:center">Calidad</th>
                    <th style="text-align:center">Arranque Automático</th>
                    <th style="text-align:center">Observaciones</th>
                    <th style="text-align:center">Estado</th>         
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
                    <td style="text-align:center"><a href="#" align="right" onclick="cargar_padron_fotografico('<?php echo $params[$i]['ID_Unidad_Video'];?>');"><img src="vistas/Imagenes/gallery.gif" width="40" height="40"></a></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-ID_PuntoBCR';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['ID_PuntoBCR'];?>','ID_PuntoBCR','Punto BCR')"><?php echo $params[$i]['Nombre'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Provincia';?>"><?php echo $params[$i]['Nombre_Provincia'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Fecha_Actualizacion';?>"><?php echo $params[$i]['Fecha_Actualizacion'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Descripcion';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Descripcion'];?>','Descripcion','Descripción')"><?php echo $params[$i]['Descripcion'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Tipo_Punto';?>"><?php echo $params[$i]['Tipo_Punto'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Serie';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Serie'];?>','Serie','#Serie')"><?php echo $params[$i]['Serie'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Promedio_Dias';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Promedio_Dias'];?>','Promedio_Dias','Promedio Días')"><?php echo $params[$i]['Promedio_Dias'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Capacidad_Disco_Duro';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Capacidad_Disco_Duro'];?>','Capacidad_Disco_Duro','Disco Duro(GB)')"><?php echo $params[$i]['Capacidad_Disco_Duro'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Version_Software';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Version_Software'];?>','Version_Software','Versión Software')"><?php echo $params[$i]['Version_Software'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Mac_Address';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Mac_Address'];?>','Mac_Address','Mac Address')"><?php echo $params[$i]['Mac_Address'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Regulacion';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Regulacion'];?>','Regulacion','Regulación(Kbps)')"><?php echo $params[$i]['Regulacion'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Cantidad_Entradas_Video';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Cantidad_Entradas_Video'];?>','Cantidad_Entradas_Video','#Entradas de Video')"><?php echo $params[$i]['Cantidad_Entradas_Video'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Camaras_Habilitadas';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Camaras_Habilitadas'];?>','Camaras_Habilitadas','#Cámaras')"><?php echo $params[$i]['Camaras_Habilitadas'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Cuadros_Por_Segundo';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Cuadros_Por_Segundo'];?>','Cuadros_Por_Segundo','Cuadros/Segundo(FS)')"><?php echo $params[$i]['Cuadros_Por_Segundo'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Resolucion';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Resolucion'];?>','Resolucion','Resolución')"><?php echo $params[$i]['Resolucion'];?></td>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Calidad';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Calidad'];?>','Calidad','Calidad')"><?php echo $params[$i]['Calidad'];?></td>
                    <?php if($params[$i]['Arranque_Automatico']==1){ ?>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Arranque_Automatico';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Arranque_Automatico'];?>','Arranque_Automatico','Arranque Automático')">Si</td>
                    <?php }else{ ?>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Arranque_Automatico';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Arranque_Automatico'];?>','Arranque_Automatico','Arranque Automático')">No</td>
                    <?php } ?>
                    <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Observaciones';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Obser'];?>','Observaciones','Observaciones')"><?php echo $params[$i]['Obser'];?></td>
                  
                    <?php if ($params[$i]['Estad']==0){  ?>  
                         <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Estado';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Estad'];?>','Estado','Estado')">En Producción</td>
                     <?php } ?>  
                       <?php  if ($params[$i]['Estad']==1){  ?>  
                         <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Estado';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Estad'];?>','Estado','Estado')">Sin Utilizar-Disponible</td>
                     <?php } ?>  
                       <?php  if ($params[$i]['Estad']==2){  ?>  
                         <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Estado';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Estad'];?>','Estado','Estado')">En taller/Con Avería</td>
                     <?php } ?>   
                          <?php  if ($params[$i]['Estad']==3){  ?>  
                         <td style="text-align:center" id="<?php echo $params[$i]['ID_Unidad_Video'].'-Estado';?>" onclick="edita_dato('<?php echo $params[$i]['ID_Unidad_Video'];?>','<?php echo $params[$i]['Estad'];?>','Estado','Estado')">Obsoleto-Descontinuado</td>
                     <?php } ?>  
                </tr>     
            <?php } ?>
            </tbody>
        </table>
        
        <a href="#" class="btn btn-default" role="button" onclick="nueva_unidad_de_video();">Agregar Nueva Unidad de Video</a>
      
        </div> 
        
        <?php require 'vistas/plantillas/pie_de_pagina.php' ?>
        
        <!--Agregar o Editar Campos de la tabla -->
        <div id="ventana_oculta_1"> 
            <div id="popupventana">
                <!--Formulario para actualización-->
                <!--<form id="ventana" method="POST" name="form" action="index.php?ctl=editar_campo_unidades_de_video">-->
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2 align="center" id="titulo_ventana_oculta">Promedio de Días de Grabación:</h2>
                    <hr>
                    <input hidden id="ID_Unidad_Video" name="ID_Unidad_Video" type="text" value="">
                    <input hidden id="campo_a_editar" name="campo_a_editar" type="text" value="">
                    <label id="titulo_campo_ventana_oculta" for="detalle">Detalle</label>
                    <input id="detalle" name="detalle" type="text" value="">            
                    <hr>
                    <button><a href="javascript:%20check_empty()" id="submit">Guardar</a></button>
                </div>
                <!--</form>-->
            </div>
        </div>
        
        <!--Cambiar estado del arranque automático de un grabador de video-->
        <div id="ventana_oculta_2"> 
            <div id="popupventana">
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Arranque Automático</h2>
                    <hr>
                    <input hidden id="ID_Unidad_Video_AA" name="ID_Unidad_Video_AA" type="text" value="">
                    <input hidden id="campo_a_editar_AA" name="campo_a_editar_AA" type="text" value="">
                    <label for="Estado_Arranque_Automatico">¿Después de fallos eléctricos la unidad restaura sola?</label>
                        <select class="form-control espacio-abajo" id="Estado_Arranque_Automatico" name="Estado_Arranque_Automatico">                 
                                <option value="1" >SI</option>   
                                <option value="0" >NO</option>   
                        </select>
                    <button><a href="javascript:%20check_empty_AA()" id="submit">Guardar</a></button>
                </div>
            </div>
            <!--Cierre agregar teléfono a Punto BCR-->
        </div>
        
         <!--Cambiar estado del arranque automático de un grabador de video-->
        <div id="ventana_oculta_3"> 
            <div id="popupventana">  
                <div id="ventana">
                    <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()">
                    <h2>Estado de la Unidad de Video</h2>
                    <hr>
                    <input hidden id="ID_Unidad_Video_Estado" name="ID_Unidad_Video_Estado" type="text" value="">
                    <input hidden id="campo_a_editar_estado" name="campo_a_editar_estado" type="text" value="">
                    <label for="Estado_Unidad_Video">Estado</label>
                        <select class="form-control espacio-abajo" id="Estado_Unidad_Video" name="Estado_Unidad_Video">                 
                                <option value="1" >Sin Utilizar/Disponible</option>   
                                <option value="2" >En Taller/Con Avería</option>   
                                <option value="3" >Obsoleto/Descontinuado</option>   
                        </select>
                    <button><a href="javascript:%20check_empty_Estado_Unidad_Video()" id="submit">Guardar</a></button>
                </div>
            </div>
            <!--Cierre agregar teléfono a Punto BCR-->
        </div>
         <!--Asignar Puntos BCR a las Unidades-->
        <div id="ventana_oculta_4">
            <div id="popupventana2">
                <div id="ventana2">
                <img id="close" src='vistas/Imagenes/cerrar.png' width="25" onclick ="ocultar_elemento()"> 
                <input hidden id="ID_Unidad_Video_PuntoBCR" name="ID_Unidad_Video_PuntoBCR" type="text" value="">
                <input hidden id="campo_a_editar_puntobcr" name="campo_a_editar_puntobcr" type="text" value="">
                <input hidden id="nombre_puntobcr" name="nombre_puntobcr" type="text" value="">
                    <!--Tabla con la lista de Unidades Ejecutoras-->
                    <table id="tabla3" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">Código</th>
                            <th style="text-align:center">Nombre</th>
                            <th style="text-align:center">Tipo</th>
                            <th style="text-align:center">Provincia</th>
                            <th style="text-align:center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tam=count($puntosbcr);
                        for ($i = 0; $i <$tam; $i++) { ?>  
                        <tr>
                            <td style="text-align:center"><?php echo $puntosbcr[$i]['Codigo'];?></td>
                            <td style="text-align:center"><?php echo $puntosbcr[$i]['Nombre'];?></td>
                            <td style="text-align:center"><?php echo $puntosbcr[$i]['Tipo_Punto'];?></td>
                            <td style="text-align:center"><?php echo $puntosbcr[$i]['Nombre_Provincia'];?></td>
                            <td style="text-align:center"><a class="btn" role="button" onclick="agregar_puntobcr('<?php echo $puntosbcr[$i]['ID_PuntoBCR'];?>','<?php echo $puntosbcr[$i]['Nombre'];?>','<?php echo $puntosbcr[$i]['Nombre_Provincia'];?>','<?php echo $puntosbcr[$i]['Tipo_Punto'];?>');">
                                    Seleccionar Punto BCR</a></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                </div>
            </div>
        <!--Cierre Asignar UE a Punto BRC-->
        </div> 
    </body>
</html>