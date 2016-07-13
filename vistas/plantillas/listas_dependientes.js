$(document).ready(function(){

           $("#provincia").change(function () {
                   $("#provincia option:selected").each(function () {
                    id_provincia = $(this).val();
                    $.post("vistas/plantillas/filtra_cantones.php", { id_provincia: id_provincia }, function(data){
                        $("#canton").html(data);
                        
                    });            
                });
           });
        });
        
$(document).ready(function(){
   $("#canton").change(function () {
           $("#canton option:selected").each(function () {
            id_canton = $(this).val();
            $.post("vistas/plantillas/filtra_distritos.php", { id_canton: id_canton }, function(data){
                $("#distrito").html(data);
            });            
        });
   });
});