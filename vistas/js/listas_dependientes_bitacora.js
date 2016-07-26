$(document).ready(function(){
           $("#tipo_punto").change(function () {
                   $("#tipo_punto option:selected").each(function () {
                    id_tipo_punto_bcr = $(this).val();
                    $.post("vistas/plantillas/filtra_sitios_bcr_bitacora.php", { id_tipo_punto_bcr: id_tipo_punto_bcr }, function(data){
                        $("#punto_bcr").html(data);
                        
                    });            
                });
           });
        });
