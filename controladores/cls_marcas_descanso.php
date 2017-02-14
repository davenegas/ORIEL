<?php
class cls_marcas_descanso{
  public $id_usuario;
  public $id_descanso;
  public $hora_descanso_salida;
  public $hora_descanso_entrada;
  public $justificar_descanso;
  public $validar_descanso;
  public $total_descanso;
  public $id_ajus_descanso;
  public $arreglo;
  public $obj_data_provider;
  public $condicion;
  public $observaciones;
  public $estado;
  public $Fecha_Descanso;
  
  function getFecha_Descanso() {
      return $this->Fecha_Descanso;
  }

  function setFecha_Descanso($Fecha_Descanso) {
      $this->Fecha_Descanso = $Fecha_Descanso;
  }

    function getId_usuario() {
      return $this->id_usuario;
  }

  function setId_usuario($id_usuario) {
      $this->id_usuario = $id_usuario;
  }

    function getId_descanso() {
      return $this->id_descanso;
  }

  function getHora_descanso_salida() {
      return $this->hora_descanso_salida;
  }

  function getHora_descanso_entrada() {
      return $this->hora_descanso_entrada;
  }

  function getJustificar_descanso() {
      return $this->justificar_descanso;
  }

  function getValidar_descanso() {
      return $this->validar_descanso;
  }

  function getTotal_descanso() {
      return $this->total_descanso;
  }

  function getId_ajus_descanso() {
      return $this->id_ajus_descanso;
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

  function setId_descanso($id_descanso) {
      $this->id_descanso = $id_descanso;
  }

  function setHora_descanso_salida($hora_descanso_salida) {
      $this->hora_descanso_salida = $hora_descanso_salida;
  }

  function setHora_descanso_entrada($hora_descanso_entrada) {
      $this->hora_descanso_entrada = $hora_descanso_entrada;
  }

  function setJustificar_descanso($justificar_descanso) {
      $this->justificar_descanso = $justificar_descanso;
  }

  function setValidar_descanso($validar_descanso) {
      $this->validar_descanso = $validar_descanso;
  }

  function setTotal_descanso($total_descanso) {
      $this->total_descanso = $total_descanso;
  }

  function setId_ajus_descanso($id_ajus_descanso) {
      $this->id_ajus_descanso = $id_ajus_descanso;
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
      $this->id_usuario ="";
      $this->id_descanso ="";
      $this->hora_descanso_salida = "";
      $this->hora_descanso_entrada = "";
      $this->justificar_descanso = "";
      $this->validar_descanso = "";
      $this->total_descanso = "";
      $this->id_ajus_descanso = "";
      $this->arreglo = "";
      $this->obj_data_provider = New Data_Provider();
      $this->condicion = "";
      $this->observaciones = "";
      $this->estado = "";
      $this->Fecha_Descanso ="";
  }

    public function obtiene_todas_las_marcas_descansos(){
         if($this->condicion==""){
           $this->obj_data_provider->conectar();
           $this->arreglo=$this->obj_data_provider->trae_datos("t_descanso 
           INNER JOIN  t_ajus_descanso ON  t_descanso.ID_Ajus_Descanso =  t_ajus_descanso.ID_Ajus_Descanso 
           ORDER BY  Fecha_Descanso,Hora_Descanso_Salida,Hora_Descanso_Entrada "," t_descanso.ID_Descanso ,  t_descanso.ID_Usuario ,  t_descanso.Fecha_Descanso ,  t_descanso.Hora_Descanso_Salida , t_descanso.Hora_Descanso_Entrada ,  t_descanso.Justificar_Descanso ,  t_descanso.Validar_Descanso,  t_descanso.Total_Descanso , t_descanso.ID_Ajus_Descanso ,  t_ajus_descanso.Duracion_Descanso ,  t_ajus_descanso.ID_Ajus_Descanso ", "");
           $this->arreglo=$this->obj_data_provider->getArreglo();
           $this->obj_data_provider->desconectar();
           $this->resultado_operacion=true;
         }else{
           $this->obj_data_provider->conectar();
           $this->arreglo=$this->obj_data_provider->trae_datos("T_Descanso", "*", $this->condicion);
           $this->arreglo=$this->obj_data_provider->getArreglo();
           $this->obj_data_provider->desconectar();
           $this->resultado_operacion=true;
         }
     }
    public function guardar_marcas_descanso() {
     
    if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->inserta_datos("t_descanso", "ID_Descanso,ID_Usuario,Fecha_Descanso,Hora_Descanso_Salida,Hora_Descanso_Entrada,Justificar_Descanso,Validar_Descanso,Total_Descanso,ID_Ajus_Descanso", "null,".$this->id_usuario.",'".$this->Fecha_Descanso."','".$this->hora_descanso_salida."','".$this->hora_descanso_entrada."','".$this->justificar_descanso."','".$this->validar_descanso."','".$this->total_descanso."','".$this->id_ajus_descanso."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }else{
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("t_descanso", "Hora_Descanso_Entrada='".$this->hora_descanso_entrada."',Justificar_Descanso='".$this->justificar_descanso."', Total_Descanso='".$this->total_descanso."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
         
} 
} 
