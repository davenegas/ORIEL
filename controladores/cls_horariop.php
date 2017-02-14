<!DOCTYPE html>
<?php

class cls_horariop{
        
  public $id_horario;
  public $horario;
  public $horas_laboradas; //es el campo pasword
  public $arreglo;
  public $obj_data_provider;
  public $condicion;
  public $observaciones;
  public $estado;
  
  function getId_horario() {
      return $this->id_horario;
  }

  function getHorario() {
      return $this->horario;
  }

  function getHoras_laboradas() {
      return $this->horas_laboradas;
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

  function setId_horario($id_horario) {
      $this->id_horario = $id_horario;
  }

  function setHorario($horario) {
      $this->horario = $horario;
  }

  function setHoras_laboradas($horas_laboradas) {
      $this->horas_laboradas = $horas_laboradas;
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
      $this->id_horario ="";
      $this->horario ="";
      $this->horas_laboradas ="" ;
      $this->arreglo ="";
      $this->obj_data_provider = new Data_Provider();
      $this->condicion = "";
      $this->observaciones ="" ;
      $this->estado ="";
  }

  public function obtiene_todos_los_horariosp(){
     if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_horariop","*", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
      else
      {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_horariop", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
  
    }
    public function guardar_horariop() {
    if($this->id_horario=="0"){
       $this->obj_data_provider->conectar();
       $this->arreglo=$this->obj_data_provider->inserta_datos("T_horariop", "ID_Horariop,Horario,Observaciones,Estado", "null,'".$this->horario."','".$this->observaciones."','".$this->estado."'");
       $this->arreglo=$this->obj_data_provider->getArreglo();
       $this->obj_data_provider->desconectar();
       }else{
       $this->obj_data_provider->conectar();
       $this->arreglo=$this->obj_data_provider->edita_datos("T_horariop", "Horario='".$this->horario."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'","ID_Horariop=".$this->id_horario);
       $this->arreglo=$this->obj_data_provider->getArreglo();
       $this->obj_data_provider->desconectar();
       }
        
    }
  }   