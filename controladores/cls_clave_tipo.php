<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_clave_tipo
 * Clase generada automáticamente el 2018-12-07 14:37
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_clave_tipo {
    /**
     * Columna [ID_TipoClave] de la tabla [t_clave_tipo] en la clase [cls_clave_tipo] 
     * Llave primaria de la tabla 
     */
    public $ID_TipoClave;
    /**
     * Columna [Descripcion] de la tabla [t_clave_tipo] en la clase [cls_clave_tipo] 
     * Descripción del tipo de clave del código de la radiofrecuencia 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_clave_tipo] en la clase [cls_clave_tipo] 
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
     *Retorna el valor de la propiedad ID_TipoClave
     */
    function getID_TipoClave() {
        return $this->ID_TipoClave;
    }

    /**
     *Retorna el valor de la propiedad Descripcion
     */
    function getDescripcion() {
        return $this->Descripcion;
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
     * Retorna el valor de la propiedad ID_TipoClave
     */
    function setID_TipoClave($ID_TipoClave) {
        $this->ID_TipoClave = $ID_TipoClave;
    }

    /**
     * Retorna el valor de la propiedad Descripcion
     */
    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
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
     * Constructor: inicializa las variables de la clase cls_clave_tipo
     */
    public function __construct() {
        $this->ID_TipoClave="";
        $this->Descripcion="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_clave_tipo() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_clave_tipo", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_clave_tipo", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_clave_tipo() {
        $this->obj_data_provider->conectar();
        if ($this->ID_TipoClave==0){
            $this->obj_data_provider->inserta_datos("t_clave_tipo","Descripcion, Estado","'".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_clave_tipo","Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_clave_tipo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_clave_tipo","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}
