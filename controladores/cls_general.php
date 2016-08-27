<?php
 class cls_general{
     
    private $id;
    private $nota;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
      
    function getId() {
        return $this->id;
    }

    function getNota() {
        return $this->nota;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }
    
    function getArreglo() {
        return $this->arreglo;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    public function __construct() {
      $this->id="";
      $this->nota="";
      $this->arreglo;
      $this->obj_data_provider=new Data_Provider();
      $this->condicion="";
    }
    
    public function guardar_nota(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Notas", "Nota='".$this->nota."'","ID_Nota='".$this->id."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_notas(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Notas", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            //$this->resultado_operacion=true;
        }
    }
 }