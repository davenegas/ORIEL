<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_apertura
 * Clase generada automáticamente el 2019-02-11 13:50
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_recepcion_apertura {
    /**
     * Columna [ID_Recepcion_Apertura] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Llave primaria de la tabla 
     */
    public $ID_Recepcion_Apertura;
    /**
     * Columna [ID_RecepcionPuesto] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Llave foranea a tabla T_Recepcion_Puesto 
     */
    public $ID_RecepcionPuesto;
    /**
     * Columna [ID_Usuario_Apertura] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Llave foranea a tabla T_Usuario_Apertura 
     */
    public $ID_Usuario_Apertura;
    /**
     * Columna [ID_Usuario_Cierre] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Llave foranea a tabla T_Usuario 
     */
    public $ID_Usuario_Cierre;
    /**
     * Columna [Fecha_Apertura] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Fecha hora apertura 
     */
    public $Fecha_Apertura;
    /**
     * Columna [Fecha_Cierre] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Fecha hora cierre 
     */
    public $Fecha_Cierre;
    /**
     * Columna [Descripcion] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Descripción de la apertura, Nota 
     */
    public $Descripcion;
    /**
     * Columna [Cant_Horas] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Cantidad de Horas 
     */
    public $Cant_Horas;
    /**
     * Columna [Estado_Apertura] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
     * Estad A= Abierto  C = Cierre 
     */
    public $Estado_Apertura;
    /**
     * Columna [Estado] de la tabla [t_recepcion_apertura] en la clase [cls_recepcion_apertura] 
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
     *Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function getID_Recepcion_Apertura() {
        return $this->ID_Recepcion_Apertura;
    }

    /**
     *Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function getID_RecepcionPuesto() {
        return $this->ID_RecepcionPuesto;
    }

    /**
     *Retorna el valor de la propiedad ID_Usuario_Apertura
     */
    function getID_Usuario_Apertura() {
        return $this->ID_Usuario_Apertura;
    }

    /**
     *Retorna el valor de la propiedad ID_Usuario_Cierre
     */
    function getID_Usuario_Cierre() {
        return $this->ID_Usuario_Cierre;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Apertura
     */
    function getFecha_Apertura() {
        return $this->Fecha_Apertura;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Cierre
     */
    function getFecha_Cierre() {
        return $this->Fecha_Cierre;
    }

    /**
     *Retorna el valor de la propiedad Descripcion
     */
    function getDescripcion() {
        return $this->Descripcion;
    }

    /**
     *Retorna el valor de la propiedad Cant_Horas
     */
    function getCant_Horas() {
        return $this->Cant_Horas;
    }

    /**
     *Retorna el valor de la propiedad Estado_Apertura
     */
    function getEstado_Apertura() {
        return $this->Estado_Apertura;
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
     * Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function setID_Recepcion_Apertura($ID_Recepcion_Apertura) {
        $this->ID_Recepcion_Apertura = $ID_Recepcion_Apertura;
    }

    /**
     * Retorna el valor de la propiedad ID_RecepcionPuesto
     */
    function setID_RecepcionPuesto($ID_RecepcionPuesto) {
        $this->ID_RecepcionPuesto = $ID_RecepcionPuesto;
    }

    /**
     * Retorna el valor de la propiedad ID_Usuario_Apertura
     */
    function setID_Usuario_Apertura($ID_Usuario_Apertura) {
        $this->ID_Usuario_Apertura = $ID_Usuario_Apertura;
    }

    /**
     * Retorna el valor de la propiedad ID_Usuario_Cierre
     */
    function setID_Usuario_Cierre($ID_Usuario_Cierre) {
        $this->ID_Usuario_Cierre = $ID_Usuario_Cierre;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Apertura
     */
    function setFecha_Apertura($Fecha_Apertura) {
        $this->Fecha_Apertura = $Fecha_Apertura;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Cierre
     */
    function setFecha_Cierre($Fecha_Cierre) {
        $this->Fecha_Cierre = $Fecha_Cierre;
    }

    /**
     * Retorna el valor de la propiedad Descripcion
     */
    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    /**
     * Retorna el valor de la propiedad Cant_Horas
     */
    function setCant_Horas($Cant_Horas) {
        $this->Cant_Horas = $Cant_Horas;
    }

    /**
     * Retorna el valor de la propiedad Estado_Apertura
     */
    function setEstado_Apertura($Estado_Apertura) {
        $this->Estado_Apertura = $Estado_Apertura;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_apertura
     */
    public function __construct() {
        $this->ID_Recepcion_Apertura="";
        $this->ID_RecepcionPuesto="";
        $this->ID_Usuario_Apertura="";
        $this->ID_Usuario_Cierre="";
        $this->Fecha_Apertura="";
        $this->Fecha_Cierre="";
        $this->Descripcion="";
        $this->Cant_Horas="";
        $this->Estado_Apertura="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_recepcion_apertura() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_apertura r INNER JOIN t_usuario u1 ON u1.ID_Usuario = r.ID_Usuario_Apertura "
                    ."LEFT JOIN t_usuario u2 ON u2.ID_Usuario = r.ID_Usuario_Cierre "
                    ."INNER JOIN t_recepcion_puesto p ON p.ID_RecepcionPuesto = r.ID_RecepcionPuesto ", 
                    "p.Nombre Puesto, r.ID_Recepcion_Apertura, r.ID_RecepcionPuesto, r.ID_Usuario_Apertura, "
                    ."r.ID_Usuario_Cierre,r.Fecha_Apertura,r.Fecha_Cierre, "
                    ."r.Descripcion, r.Cant_Horas,r.Estado_Apertura,r.Estado, IFNULL(concat(u1.Nombre,' ',u1.Apellido),'') UsuarioApertura, "
                    ."IFNULL(concat(u2.Nombre,' ',u2.Apellido),'') UsuarioCierre ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_apertura r INNER JOIN t_usuario u1 ON u1.ID_Usuario = r.ID_Usuario_Apertura "
                    ."LEFT JOIN t_usuario u2 ON u2.ID_Usuario = r.ID_Usuario_Cierre "
                    ."INNER JOIN t_recepcion_puesto p ON p.ID_RecepcionPuesto = r.ID_RecepcionPuesto ", 
                    "p.Nombre Puesto, r.ID_Recepcion_Apertura, r.ID_RecepcionPuesto, r.ID_Usuario_Apertura, "
                    ."r.ID_Usuario_Cierre,r.Fecha_Apertura,r.Fecha_Cierre, "
                    ."r.Descripcion, r.Cant_Horas,r.Estado_Apertura,r.Estado, IFNULL(concat(u1.Nombre,' ',u1.Apellido),'') UsuarioApertura, "
                    ."IFNULL(concat(u2.Nombre,' ',u2.Apellido),'') UsuarioCierre ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_apertura() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Recepcion_Apertura==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_apertura","ID_RecepcionPuesto, ID_Usuario_Apertura, ID_Usuario_Cierre, Fecha_Apertura, Fecha_Cierre, Descripcion, Cant_Horas, Estado_Apertura, Estado","'".$this->ID_RecepcionPuesto."','".$this->ID_Usuario_Apertura."','".$this->ID_Usuario_Cierre."','".$this->Fecha_Apertura."','".$this->Fecha_Cierre."','".$this->Descripcion."','".$this->Cant_Horas."','".$this->Estado_Apertura."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_apertura","ID_RecepcionPuesto='".$this->ID_RecepcionPuesto."',ID_Usuario_Apertura='".$this->ID_Usuario_Apertura."',ID_Usuario_Cierre='".$this->ID_Usuario_Cierre."',Fecha_Apertura='".$this->Fecha_Apertura."',Fecha_Cierre='".$this->Fecha_Cierre."',Descripcion='".$this->Descripcion."',Cant_Horas='".$this->Cant_Horas."',Estado_Apertura='".$this->Estado_Apertura."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function editar_recepcion_Descripcion() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_apertura","Descripcion='".$this->Descripcion."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_recepcion_apertura(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_apertura","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_recepcion_max_apertura() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_apertura", 
                "MAX(ID_Recepcion_Apertura) ID_Recepcion_Apertura", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
        
        $this->setID_Recepcion_Apertura(0);
        $conteo = count($this->arreglo);
        
        if($conteo > 0){
            $this->setID_Recepcion_Apertura($this->arreglo[0]["ID_Recepcion_Apertura"]);
        }
    }
        /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function editar_recepcion_liberar() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_apertura","ID_Usuario_Cierre='".$this->ID_Usuario_Cierre."',Fecha_Cierre='".$this->Fecha_Cierre."', Estado_Apertura='".$this->Estado_Apertura."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}
