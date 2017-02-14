<?php 

class cls_descansos{ 
  public $Cantidad_descanso;      
  public $Duracion_descanso;
  public $condicion;
  public $ID_Ajus_Descanso; 
  public $estado;    
  public $Observaciones; 
  public $arreglo;
  public $obj_data_provider;
  
  
  function getCantidad_descanso() {
      return $this->Cantidad_descanso;
  }

  function getDuracion_descanso() {
      return $this->Duracion_descanso;
  }

  function getCondicion() {
      return $this->condicion;
  }

  function getID_Ajus_Descanso() {
      return $this->ID_Ajus_Descanso;
  }

  function getObservaciones() {
      return $this->Observaciones;
  }

  function getArreglo() {
      return $this->arreglo;
  }
  function getEstado() {
      return $this->estado;
  }

  function setCantidad_descanso($Cantidad_descanso) {
    $this->Cantidad_descanso = $Cantidad_descanso;
  }

  function setDuracion_descanso($Duracion_descanso) {
      $this->Duracion_descanso = $Duracion_descanso;
  }

  function setCondicion($condicion) {
      $this->condicion = $condicion;
  }

  function setID_Ajus_Descanso($ID_Ajus_Descanso) {
      $this->ID_Ajus_Descanso = $ID_Ajus_Descanso;
  }

  function setObservaciones($Observaciones) {
      $this->Observaciones = $Observaciones;
  }

  function setArreglo($arreglo) {
      $this->arreglo = $arreglo;
  }
  function setEstado($estado) {
      $this->estado = $estado;
      
  }    
  public function __construct() {
       $this->ID_Ajus_Descanso="";
       $this->Duracion_descanso="";
       $this->Cantidad_descanso="";
       $this->arreglo="";
       $this->obj_data_provider=new Data_Provider();
       $this->condicion="";
       $this->observaciones="";
       $this->estado="";
     
  }
  public function obtiene_todos_los_descansos(){
    if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Ajus_Descanso", "*", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }else{
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Ajus_Descanso", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
  }     
  public function guardar_descansos() {
    if($this->ID_Ajus_Descanso=="0"){
       $this->obj_data_provider->conectar();
       $this->arreglo=$this->obj_data_provider->inserta_datos("t_ajus_descanso", "ID_Ajus_Descanso,Duracion_Descanso,Observaciones,Estado", "null,'".$this->Duracion_descanso."','".$this->Observaciones."','".$this->estado."'");
       $this->arreglo=$this->obj_data_provider->getArreglo();
       $this->obj_data_provider->desconectar();
    }else{
       $this->obj_data_provider->conectar();
       $this->arreglo=$this->obj_data_provider->edita_datos("t_ajus_descanso", "Duracion_Descanso='".trim($this->Duracion_descanso)."',Observaciones='".$this->Observaciones."',Estado='".$this->estado."'", "ID_Ajus_Descanso=".$this->ID_Ajus_Descanso);
       $this->arreglo=$this->obj_data_provider->getArreglo();
       $this->obj_data_provider->desconectar();
       }
        
    }
  
}
  
        
  