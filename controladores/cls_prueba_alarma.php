<?php

class cls_proveedor_enlace{
    public $id_prueba;
    public $id_punto;
    public $codigo;
    public $id_persona;
    public $empresa;
    public $tipo_prueba;
    public $revision;
    public $id_usuario;
    public $fecha;
    public $hora1;
    public $hora2;
    public $zona;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    
    public function __construct() {
        $this->id_prueba="";
        $this->id_punto="";
        $this->codigo="";
        $this->id_persona="";
        $this->empresa="";
        $this->tipo_prueba="";
        $this->revision="";
        $this->id_usuario="";
        $this->fecha="";
        $this->hora1="";
        $this->hora2="";
        $this->zona="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
}
?>
