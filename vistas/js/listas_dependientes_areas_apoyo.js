$(document).ready(function(){
    //Buscar Distritos al seleccionar cantón
    $("#Provincia").change(function () {
        $("#Provincia option:selected").each(function () {
            id_provincia = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_canton", { id_provincia: id_provincia}, function(data){
                $("#Canton").html(data);
            });            
        });
    });
    
    //Buscar Distritos al seleccionar cantón
    $("#Canton").change(function () {
        $("#Canton option:selected").each(function () {
            id_canton = $(this).val();
            //id_tipo_punto_bcr=document.getElementById('tipo_punto').value;
            $.post("index.php?ctl=actualiza_en_vivo_distrito", { id_canton: id_canton}, function(data){
                $("#Distrito").html(data);  
            });            
        });
    });
});
////////////////////////////////////////////////////////////
//Función para Ocultas ventanas
function ocultar_elemento(){
    document.getElementById('agregar_telefono').style.display = "none";
}
///////////////////////////////////////////////////////
//Funciones para ventana oculta de Agregar Número PuntoBCR
function check_empty() {
    if (document.getElementById('numero').value == "") {
        alert("Digita un número de teléfono !");
    } else {
        //alert("Form Submitted Successfully...");
        document.getElementById('ventana').submit();
        document.getElementById('agregar_telefono').style.display = "none";
    }
}
function mostrar_agregar_telefono() {
    document.getElementById('ID_Telefono').value="0";
    document.getElementById('numero').value=null;
    document.getElementById('observaciones').value=null;
    document.getElementById('agregar_telefono').style.display = "block";
}
function eliminar_telefono(ide){
    $.confirm({title: 'Confirmación!', content: 'Desea eliminar este número de teléfono?', 
        confirm: function(){
            id_telefono= ide;
            $.post("index.php?ctl=area_apoyo_eliminar_telefono", { id_telefono: id_telefono}, function(data){
                location.reload();
                //alert (data);
              });
        },
        cancel: function(){
                //$.alert('Canceled!')
        }
    });
};
function Editar_telefono(id_tel, tipo_tel, num, obser){
    $("#Tipo_Telefono option[value="+tipo_tel+"]").attr("selected",true);
    document.getElementById('ID_Telefono').value=id_tel;
    document.getElementById('numero').value=num;
    document.getElementById('Observaciones').value=obser;
    
    document.getElementById('agregar_telefono').style.display = "block";
};
