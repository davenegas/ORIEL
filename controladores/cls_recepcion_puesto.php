<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_puesto
 * Clase generada automáticamente el 2019-02-09 08:17
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_recepcion_puesto {
    /**
     * Columna [ID_RecepcionPuesto] de la tabla [t_recepcion_puesto] en la clase [cls_recepcion_puesto] 
     * Llave primaria de la tabla 
     */
    public $ID_RecepcionPuesto;
    /**
     * Columna [ID_Usuario] de la tabla [t_recepcion_puesto] en la clase [cls_recepcion_puesto] 
     * Código de usuario que toma el puesto 
     */
    public $ID_Usuario;
    /**
     * Columna [Nombre] de la tabla [t_recepcion_puesto] en la clase [cls_recepcion_puesto] 
     * Nombre del puesto 
     */
    public $Nombre;
    /**
     * Columna [Descripcion] de la tabla [t_recepcion_puesto] en la clase [cls_recepcion_puesto] 
     * Descripción del puesto 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_recepcion_puesto] en la clase [cls_recepcion_puesto] 
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
     *Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function getID_RecepcionPuesto() {
        return $this->ID_RecepcionPuesto;
    }

    /**
     *Retorna el valor de la propiedad ID_Usuario
     */
    function getID_Usuario() {
        return $this->ID_Usuario;
    }

    /**
     *Retorna el valor de la propiedad Nombre
     */
    function getNombre() {
        return $this->Nombre;
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
     * Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function setID_RecepcionPuesto($ID_RecepcionPuesto) {
        $this->ID_RecepcionPuesto = $ID_RecepcionPuesto;
    }

    /**
     * Retorna el valor de la propiedad ID_Usuario
     */
    function setID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    /**
     * Retorna el valor de la propiedad Nombre
     */
    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_puesto
     */
    public function __construct() {
        $this->ID_RecepcionPuesto="";
        $this->ID_Usuario="";
        $this->Nombre="";
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
    public function obtener_recepcion_puesto() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_puesto p LEFT JOIN t_usuario u ON u.ID_Usuario = p.ID_Usuario", 
                    "p.ID_RecepcionPuesto, p.ID_Usuario, p.Nombre, ".
                    "p.Descripcion, p.Estado, ".
                    "IFNULL(CONCAT(u.Nombre,' ',u.Apellido),'') Usuario ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_puesto", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_puesto() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionPuesto==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_puesto","ID_Usuario, Nombre, Descripcion, Estado","'".$this->ID_Usuario."','".$this->Nombre."','".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_puesto","ID_Usuario='".$this->ID_Usuario."',Nombre='".$this->Nombre."',Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_recepcion_puesto(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_puesto","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
        /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function actualizar_recepcion_puesto() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_puesto","ID_Usuario='".$this->ID_Usuario."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}