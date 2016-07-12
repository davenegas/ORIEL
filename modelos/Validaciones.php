<?php

class cls_validaciones{
    public $nombre;
    public $email;
    public $texto;
    public $id;
    public $cedula;
    public $telefono;
    public $fecha;
    public $hora;
    public $direccionIP;
    
public function validar_email($email){
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else{
        return false;
    }
}

public function validar_direccion_ip($ip){
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return true;
    }
    else{
        return false;
    }
}

}
