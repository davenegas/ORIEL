<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_puesto_tipos
 * Clase generada automáticamente el 2019-02-08 10:14
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_recepcion_puesto_tipos {
    /**
     * Columna [ID_RecepcionPuesto] de la tabla [t_recepcion_puesto_tipos] en la clase [cls_recepcion_puesto_tipos] 
     * Llave foranea a tabla T_Recepcion_Puestos 
     */
    public $ID_RecepcionPuesto;
    /**
     * Columna [ID_RecepcionTipo] de la tabla [t_recepcion_puesto_tipos] en la clase [cls_recepcion_puesto_tipos] 
     * Llave foranea a tabla T_Recepcion_Tipos 
     */
    public $ID_RecepcionTipo;
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
     *Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function getID_RecepcionPuesto() {
        return $this->ID_RecepcionPuesto;
    }

    /**
     *Retorna el valor de la propiedad ID_RecepcionTipo
     */
    function getID_RecepcionTipo() {
        return $this->ID_RecepcionTipo;
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
     * Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function setID_RecepcionPuesto($ID_RecepcionPuesto) {
        $this->ID_RecepcionPuesto = $ID_RecepcionPuesto;
    }

    /**
     * Retorna el valor de la propiedad ID_RecepcionTipo
     */
    function setID_RecepcionTipo($ID_RecepcionTipo) {
        $this->ID_RecepcionTipo = $ID_RecepcionTipo;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_puesto_tipos
     */
    public function __construct() {
        $this->ID_RecepcionPuesto="";
        $this->ID_RecepcionTipo="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_recepcion_puesto_tipos() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_puesto_tipos pt INNER JOIN t_recepcion_puesto p ON pt.ID_RecepcionPuesto = p.ID_RecepcionPuesto AND p.Estado = 1 "
                    ." INNER JOIN T_Recepcion_Tipos r ON pt.ID_RecepcionTipo = r.ID_RecepcionTipo AND r.Estado = 1 ", 
                    "pt.ID_RecepcionPuesto,pt.ID_RecepcionTipo, p.Nombre Puesto, r.Descripcion Tipo", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_puesto_tipos pt INNER JOIN t_recepcion_puesto p ON pt.ID_RecepcionPuesto = p.ID_RecepcionPuesto AND p.Estado = 1 "
                    ." INNER JOIN T_Recepcion_Tipos r ON pt.ID_RecepcionTipo = r.ID_RecepcionTipo AND r.Estado = 1 ", 
                    "pt.ID_RecepcionPuesto,pt.ID_RecepcionTipo, p.Nombre Puesto, r.Descripcion Tipo", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_puesto_tipos() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionPuesto==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_puesto_tipos","ID_RecepcionTipo","'".$this->ID_RecepcionTipo."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_puesto_tipos","ID_RecepcionTipo='".$this->ID_RecepcionTipo."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}
