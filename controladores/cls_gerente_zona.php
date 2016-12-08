<?php
class cls_gerente_zona{
    public $id;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $id_persona;
    public $zona;
    
    function getId() {
        return $this->id;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getId_persona() {
        return $this->id_persona;
    }

    function getZona() {
        return $this->zona;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setId_persona($id_persona) {
        $this->id_persona = $id_persona;
    }

    function setZona($zona) {
        $this->zona = $zona;
    }

       
    public function __construct() {
        $this->id="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
        $this->id_persona="";
        $this->zona="";
    }
    
    public function agregar_gerente_zona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_GerenteZonaBCR", 
                                                    "ID_Gerente_Zona, ID_Persona, Zona_Gerencia_BCR, Observaciones, Estado", 
                                                    "null,'".$this->id_persona."','".$this->zona."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
} ?>
