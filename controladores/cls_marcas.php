<?php
class cls_marcas{
  public $id__asistencia;
  public $id__usuario;
  public $hora_entrada_turno;
  public $justificar_entrada;
  public $validar_entrada;
  public $hora_salida_turno;
  public $justificar_salida;
  public $validar_salida;   
  public $arreglo;
  public $obj_data_provider;
  public $condicion;
  public $fecha;
  public $observaciones;
  public $estado;
  public $contador;
  
  public $Apellido_Nombre;
  function getContador() {
      return $this->contador;
  }

  function setContador($contador) {
      $this->contador = $contador;
  }

    function getApellido_Nombre() {
      return $this->Apellido_Nombre;
  }

  function setApellido_Nombre($Apellido_Nombre) {
      $this->Apellido_Nombre = $Apellido_Nombre;
  }

    function getFecha() {
      return $this->fecha;
  }

  function setFecha($fecha) {
      $this->fecha = $fecha;
  }

    
  function getId__asistencia() {
      return $this->id__asistencia;
  }

  function getId__usuario() {
      return $this->id__usuario;
  }

  function getHora_entrada_turno() {
      return $this->hora_entrada_turno;
  }

  function getJustificar_entrada() {
      return $this->justificar_entrada;
  }

  function getValidar_entrada() {
      return $this->validar_entrada;
  }

  function getHora_salida_turno() {
      return $this->hora_salida_turno;
  }

  function getJustificar_salida() {
      return $this->justificar_salida;
  }

  function getValidar_salida() {
      return $this->validar_salida;
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

  function setId__asistencia($id__asistencia) {
      $this->id__asistencia = $id__asistencia;
  }

  function setId__usuario($id__usuario) {
      $this->id__usuario = $id__usuario;
  }

  function setHora_entrada_turno($hora_entrada_turno) {
      $this->hora_entrada_turno = $hora_entrada_turno;
  }

  function setJustificar_entrada($justificar_entrada) {
      $this->justificar_entrada = $justificar_entrada;
  }

  function setValidar_entrada($validar_entrada) {
      $this->validar_entrada = $validar_entrada;
  }

  function setHora_salida_turno($hora_salida_turno) {
      $this->hora_salida_turno = $hora_salida_turno;
  }

  function setJustificar_salida($justificar_salida) {
      $this->justificar_salida = $justificar_salida;
  }

  function setValidar_salida($validar_salida) {
      $this->validar_salida = $validar_salida;
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
      $this->id__asistencia = "";
      $this->id__usuario = "";
      $this->hora_entrada_turno = "";
      $this->justificar_entrada = "";
      $this->validar_entrada = "";
      $this->hora_salida_turno = "";
      $this->justificar_salida = "";
      $this->validar_salida = "";
      $this->arreglo = "";
      $this->obj_data_provider = New Data_Provider();
      $this->condicion = "";
      $this->observaciones = "";
      $this->estado = "";
      $this->fecha = "";
      $this->contador= "";
       $this->Apellido_Nombre = "";
  }
  public function obtiene_todas_las_marcas(){
      if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_asistencia
INNER JOIN  t_jornadaoperadores ON  t_asistencia.ID_Operadores = t_jornadaoperadores.ID_Operadores ","t_asistencia.ID_Asistencia,t_asistencia.ID_Operadores,Hora_Entrada_Turno,Justificar_Entrada,Validar_Entrada ,Hora_Salida_Turno,Justificar_Salida,Validar_Salida,t_asistencia.Fecha,t_asistencia.Contador,t_Operadores.Nombre,t_Operadores.Apellido", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
      
      else
      {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_asistencia
INNER JOIN  t_jornadaoperadores ON  t_asistencia.ID_Operadores = t_jornadaoperadores.ID_Operadores ","t_asistencia.ID_Asistencia,t_asistencia.ID_Operadores,Hora_Entrada_Turno,Justificar_Entrada,Validar_Entrada ,Hora_Salida_Turno,Justificar_Salida,Validar_Salida,t_asistencia.Fecha,t_asistencia.Contador,t_jornadaoperadores.Nombre,t_jornadaoperadores.Nombre", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
  }
  
public function guardar_marcas() {
    //echo $this->justificar_entrada;
    if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->inserta_datos("t_asistencia", "ID_Asistencia,ID_Operadores,Hora_Entrada_Turno,Justificar_Entrada,Hora_Salida_Turno,Justificar_Salida,Fecha,Contador", "null,".$this->id__usuario.",'".$this->hora_entrada_turno."','".$this->justificar_entrada."','".$this->hora_salida_turno."','".$this->justificar_salida."','".$this->fecha."',1");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }else{
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("t_asistencia", "Hora_Salida_Turno='".$this->hora_salida_turno."',Justificar_Entrada='".$this->justificar_entrada."',Justificar_Salida='".$this->justificar_salida."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
        
    }  
  
Public function guardar_contador(){
    $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("t_asistencia","Contador=".$this->contador,$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
}
  
  
  
    
    
}    
