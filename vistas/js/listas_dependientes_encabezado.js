var j = jQuery.noConflict();
    j(function (){
        j(".esthela").hover(function(){
        j(".esthela").stop(true, false).animate({right:"0"},"medium");
        },function(){
        j(".esthela").stop(true, false).animate({right:"-400"},"medium");
        },500);
        return false;
    });
            
function guardar_informacion(){
    id = "1";
    nota=document.getElementById('notas').value;
    
    $.post("index.php?ctl=nota_guardar", { nota: nota,  id:id}, function(data){
        //  alert (data);
    }); 
};