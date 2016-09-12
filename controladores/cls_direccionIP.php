<?php

class cls_direccionIP{
        
  // Definicion de atributos de la clase
    private $id;
    private $id2;
    private $direccionIP;
    private $tipo_IP;
    private $observaciones;
    private $descripcion;
    private $estado;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;
    
    function getId2() {
        return $this->id2;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

        function getId() {
        return $this->id;
    }

    function getDireccionIP() {
        return $this->direccionIP;
    }

    function getTipo_IP() {
        return $this->tipo_IP;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
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

    function getResultado_operacion() {
        return $this->resultado_operacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDireccionIP($direccionIP) {
        $this->direccionIP = $direccionIP;
    }

    function setTipo_IP($tipo_IP) {
        $this->tipo_IP = $tipo_IP;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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

    function setResultado_operacion($resultado_operacion) {
        $this->resultado_operacion = $resultado_operacion;
    }

    public function __construct(){
        $this->id="";
        $this->id2="";
        $this->direccionIP="";
        $this->tipo_IP="";
        $this->observaciones="";
        $this->descripcion="";
        $this->estado="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->resultado_operacion="";
    }
    
    public function obtiene_direccionesIP() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_DireccionIP
			LEFT OUTER JOIN T_TipoIP ON T_DireccionIP.ID_Tipo_IP = T_TipoIP.ID_Tipo_IP", 
                    "DISTINCT T_DireccionIP.*, T_TipoIP.ID_Tipo_IP, T_TipoIP.Tipo_IP ",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_DireccionIP
			LEFT OUTER JOIN T_TipoIP ON T_DireccionIP.ID_Tipo_IP = T_TipoIP.ID_Tipo_IP
			LEFT OUTER JOIN T_PuntoBCRDireccionIP ON T_DireccionIP.ID_Direccion_IP = T_PuntoBCRDireccionIP.ID_Direccion_IP", 
                    "DISTINCT T_DireccionIP.*, T_PuntoBCRDireccionIP.*, T_TipoIP.ID_Tipo_IP, T_TipoIP.Tipo_IP ",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
    }
    
    public function eliminar_puntobcr_direccion_ip(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_puntoBCRDireccionIP","ID_PuntoBCR='".$this->id2."' AND ID_Direccion_IP='".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_PuntoBCR_direccionIP(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_puntoBCRDireccionIP", "ID_Direccion_IP, ID_PuntoBCR","'".$this->id."','".$this->id2."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function agregar_direccion_ip(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_DireccionIP", "ID_Tipo_IP, Direccion_IP, Observaciones","'".$this->tipo_IP."','".$this->direccionIP."','".$this->observaciones."'");
        $this->arreglo= $this->obj_data_provider->trae_datos("T_DireccionIP ORDER BY `ID_Direccion_IP` DESC LIMIT 1", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtiene_tipo_direcciones_ip(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoIP", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoIP", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } 
    }
}
  
  
