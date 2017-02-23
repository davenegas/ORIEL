
function evento_buscar_puntobcr(){
    id= document.getElementById('numero_punto').value;
    var datos = new Array;
    $.post("index.php?ctl=buscar_punto_prueba_alarma", { id: id}, function(data){
        //alert(data);
        var res = data.substring(data.indexOf("{"), data.length);
        datos =JSON.parse(res);
        document.getElementById('nombre_punto').value=datos['Nombre'];
        document.getElementById('tipo_punto').value=datos['Tipo_Punto'];
        document.getElementById('ID_PuntoBCR').value=datos['ID_PuntoBCR'];
        
        
    });
}