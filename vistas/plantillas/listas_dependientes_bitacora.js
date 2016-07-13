$(document).ready(function(){
           $("#tipo_punto").change(function () {
                   $("#tipo_punto option:selected").each(function () {
                    id_provincia = $(this).val();
                    $.post("vistas/plantillas/filtra_sitios_bcr_bitacora.php", { id_provincia: id_provincia }, function(data){
                        $("#punto_bcr").html(data);
                        
                    });            
                });
           });
        });
