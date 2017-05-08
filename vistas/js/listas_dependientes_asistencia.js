
//Ejecuta la funcion de actualizar hora, cada 1000 milisegundos
setInterval(ActualizarHora,1000);

function ActualizarHora(){
    var fecha = new Date();
    var segundos = fecha.getSeconds();
    var minutos = fecha.getMinutes();
    var horas = fecha.getHours();
    
    var elementoHoras= document.getElementById("pHoras");
    var elementoMinutos = document.getElementById("pMinutos");
    var elementoSegundos = document.getElementById("pSegundos");
    
    if(horas<=9){
        horas="0"+horas;
    }
    elementoHoras.textContent = horas;
    if(minutos<=9){
        minutos="0"+minutos;
    }
    elementoMinutos.textContent = minutos;
    if(segundos<=9){
        segundos="0"+segundos;
    }
    elementoSegundos.textContent = segundos;
}

