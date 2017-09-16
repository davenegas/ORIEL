<?php

class cls_medio_enlace{
    public $id;
    public $nombre;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
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

    public function __construct() {
        $this->id="";
        $this->nombre="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    public function obtener_medio_enlaces(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_MedioEnlace", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_MedioEnlace", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_medio_enlaces(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->inserta_datos("T_MedioEnlace", "ID_Medio_Enlace, Medio_Enlace, Observaciones, Estado", 
                "null,'".$this->nombre."','".$this->observaciones."','".$this->estado."'");
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }   else    {
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->edita_datos("T_MedioEnlace", "Medio_Enlace='".$this->nombre."', Observaciones='".$this->observaciones."'", $this->condicion);
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function cambiar_estado_medio_enlace(){
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la consulta a la bd
        $this->obj_data_provider->edita_datos("T_MedioEnlace", "Estado='".$this->estado."'", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}
?>

