<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_inventario
 * Clase generada automáticamente el 2019-02-11 14:15
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_recepcion_inventario {
    /**
     * Columna [ID_RecepcionInventario] de la tabla [t_recepcion_inventario] en la clase [cls_recepcion_inventario] 
     * Llave primaria de la tabla 
     */
    public $ID_RecepcionInventario;
    /**
     * Columna [ID_Recepcion_Apertura] de la tabla [t_recepcion_inventario] en la clase [cls_recepcion_inventario] 
     * Llave foranea a tabla T_Recepcion_Apertura 
     */
    public $ID_Recepcion_Apertura;
    /**
     * Columna [Descripcion] de la tabla [t_recepcion_inventario] en la clase [cls_recepcion_inventario] 
     * Descripción del inventario 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_recepcion_inventario] en la clase [cls_recepcion_inventario] 
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
     *Retorna el valor de la propiedad ID_RecepcionInventario
     */
    function getID_RecepcionInventario() {
        return $this->ID_RecepcionInventario;
    }

    /**
     *Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function getID_Recepcion_Apertura() {
        return $this->ID_Recepcion_Apertura;
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
     * Retorna el valor de la propiedad ID_RecepcionInventario
     */
    function setID_RecepcionInventario($ID_RecepcionInventario) {
        $this->ID_RecepcionInventario = $ID_RecepcionInventario;
    }

    /**
     * Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function setID_Recepcion_Apertura($ID_Recepcion_Apertura) {
        $this->ID_Recepcion_Apertura = $ID_Recepcion_Apertura;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_inventario
     */
    public function __construct() {
        $this->ID_RecepcionInventario="";
        $this->ID_Recepcion_Apertura="";
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
    public function obtener_recepcion_inventario() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_inventario", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_inventario", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_inventario() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionInventario==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_inventario","ID_Recepcion_Apertura, Descripcion, Estado","'".$this->ID_Recepcion_Apertura."','".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_inventario","ID_Recepcion_Apertura='".$this->ID_Recepcion_Apertura."',Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_recepcion_inventario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_inventario","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}