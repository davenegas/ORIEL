<?php

class cls_turno{
        
  public $id__turno;
  public $turno;  
  public $arreglo;
  public $obj_data_provider;
  public $condicion;
  public $observaciones;
  public $estado;
  
  function getId__turno() {
      return $this->id__turno;
  }

  function getTurno() {
      return $this->turno;
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

  function getObservaciones() {
      return $this->observaciones;
  }

  function getEstado() {
      return $this->estado;
  }

  function setId__turno($id__turno) {
      $this->id__turno = $id__turno;
  }

  function setTurno($turno) {
      $this->turno = $turno;
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

  function setObservaciones($observaciones) {
      $this->observaciones = $observaciones;
  }

  function setEstado($estado) {
      $this->estado = $estado;
  }

  function __construct() {
      $this->id__turno ="" ;
      $this->turno = "";
      $this->arreglo ="";
      $this->obj_data_provider = New Data_Provider();
      $this->condicion ="";
      $this->observaciones = "";
      $this->estado = "";
  }
  public function obtiene_todos_los_turnos(){
      if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Turno","*", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
      
      else
      {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Turno", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
  }
  public function guardar_turno() {
      if($this->id__turno=="0"){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->inserta_datos("T_turno", "ID_Turno,Turno,Observaciones,Estado", "null,'".$this->turno."','".$this->observaciones."','".$this->estado."'");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
       }else{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->edita_datos("T_Turno", "Turno='".$this->turno."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'", "ID_Turno=".$this->id__turno);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
       }
      
  }

}