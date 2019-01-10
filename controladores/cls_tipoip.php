<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_tipoip
 * Clase generada automáticamente el 2018-12-19 15:28
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_tipoip {
    /**
     * Columna [ID_Tipo_IP] de la tabla [t_tipoip] en la clase [cls_tipoip] 
     * Campo llave de la tabla 
     */
    public $ID_Tipo_IP;
    /**
     * Columna [Tipo_IP] de la tabla [t_tipoip] en la clase [cls_tipoip] 
     * Tipo de ip 
     */
    public $Tipo_IP;
    /**
     * Columna [Observaciones] de la tabla [t_tipoip] en la clase [cls_tipoip] 
     * Descripción del tipo de ip 
     */
    public $Observaciones;
    /**
     * Columna [Estado] de la tabla [t_tipoip] en la clase [cls_tipoip] 
     * Estado de la columna 1= Activo 0= Negativo 
     */
    public $Estado;
    /**
     *Propiedad encargada del manejo de conexión 
     */
    public $obj_data_provider;
    /**
     *Propiedad que almacena los arreglos de las consultas 
     */
    public $arreglo;
    /**
     *Propiedad que almacena el where de las peticiones a la BD 
     */
    public $condicion;

    /**
     *Retorna el valor de la propiedad ID_Tipo_IP
     */
    function getID_Tipo_IP() {
        return $this->ID_Tipo_IP;
    }

    /**
     *Retorna el valor de la propiedad Tipo_IP
     */
    function getTipo_IP() {
        return $this->Tipo_IP;
    }

    /**
     *Retorna el valor de la propiedad Observaciones
     */
    function getObservaciones() {
        return $this->Observaciones;
    }

    /**
     *Retorna el valor de la propiedad Estado
     */
    function getEstado() {
        return $this->Estado;
    }

    /**
     * Retorna el valor de la propiedad Obj_data_provider
     */
    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    /**
     * Retorna el valor de la propiedad Arreglo
     */
    function getArreglo() {
        return $this->arreglo;
    }

    /**
     * Retorna el valor de la propiedad Condicion
     */
    function getCondicion() {
        return $this->condicion;
    }

    /**
     * Retorna el valor de la propiedad ID_Tipo_IP
     */
    function setID_Tipo_IP($ID_Tipo_IP) {
        $this->ID_Tipo_IP = $ID_Tipo_IP;
    }

    /**
     * Retorna el valor de la propiedad Tipo_IP
     */
    function setTipo_IP($Tipo_IP) {
        $this->Tipo_IP = $Tipo_IP;
    }

    /**
     * Retorna el valor de la propiedad Observaciones
     */
    function setObservaciones($Observaciones) {
        $this->Observaciones = $Observaciones;
    }

    /**
     * Retorna el valor de la propiedad Estado
     */
    function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    /**
     * Retorna el valor de la propiedad obj_data_provider
     */
    function setobj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    /**
     * Retorna el valor de la propiedad Arreglo
     */
    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    /**
     * Retorna el valor de la propiedad Condicion
     */
    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    /**
     * Constructor: inicializa las variables de la clase cls_tipoip
     */
    public function __construct() {
        $this->ID_Tipo_IP="";
        $this->Tipo_IP="";
        $this->Observaciones="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_tipoip() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_tipoip", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_tipoip", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_tipoip() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Tipo_IP==0){
            $this->obj_data_provider->inserta_datos("t_tipoip","Tipo_IP, Observaciones, Estado","'".$this->Tipo_IP."','".$this->Observaciones."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_tipoip","Tipo_IP='".$this->Tipo_IP."',Observaciones='".$this->Observaciones."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_tipoip(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_tipoip","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}