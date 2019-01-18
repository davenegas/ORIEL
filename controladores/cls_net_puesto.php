<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_net_puesto
 * Clase generada automáticamente el 2019-01-16 13:53
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_net_puesto {
    /**
     * Columna [ID_Puesto_Monitoreo] de la tabla [t_net_puesto] en la clase [cls_net_puesto] 
     * Llave primaria de la tabla 
     */
    public $ID_Puesto_Monitoreo;
    /**
     * Columna [ID_PuntoBCR] de la tabla [t_net_puesto] en la clase [cls_net_puesto] 
     * Llave foranea a tabla T_PuntoBCR 
     */
    public $ID_PuntoBCR;
    /**
     * Columna [ID_Tipo_IP] de la tabla [t_net_puesto] en la clase [cls_net_puesto] 
     * Llave foranea a tabla T_Tipo_IP 
     */
    public $ID_Tipo_IP;
    /**
     * Columna [Estado] de la tabla [t_net_puesto] en la clase [cls_net_puesto] 
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
     *Retorna el valor de la propiedad ID_Puesto_Monitoreo
     */
    function getID_Puesto_Monitoreo() {
        return $this->ID_Puesto_Monitoreo;
    }

    /**
     *Retorna el valor de la propiedad ID_PuntoBCR
     */
    function getID_PuntoBCR() {
        return $this->ID_PuntoBCR;
    }

    /**
     *Retorna el valor de la propiedad ID_Tipo_IP
     */
    function getID_Tipo_IP() {
        return $this->ID_Tipo_IP;
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
     * Retorna el valor de la propiedad ID_Puesto_Monitoreo
     */
    function setID_Puesto_Monitoreo($ID_Puesto_Monitoreo) {
        $this->ID_Puesto_Monitoreo = $ID_Puesto_Monitoreo;
    }

    /**
     * Retorna el valor de la propiedad ID_PuntoBCR
     */
    function setID_PuntoBCR($ID_PuntoBCR) {
        $this->ID_PuntoBCR = $ID_PuntoBCR;
    }

    /**
     * Retorna el valor de la propiedad ID_Tipo_IP
     */
    function setID_Tipo_IP($ID_Tipo_IP) {
        $this->ID_Tipo_IP = $ID_Tipo_IP;
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
     * Constructor: inicializa las variables de la clase cls_net_puesto
     */
    public function __construct() {
        $this->ID_Puesto_Monitoreo="";
        $this->ID_PuntoBCR="";
        $this->ID_Tipo_IP="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_net_puesto() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_net_puesto p ".
                    "inner join (select ID_Puesto_Monitoreo, Nombre from t_puestomonitoreo where estado = 1 union select 0,'General') pm on p.ID_Puesto_Monitoreo = pm.ID_Puesto_Monitoreo ".
                    "inner join t_puntobcr bcr on p.id_puntobcr = bcr.id_puntobcr and bcr.Estado = 1 ".
                    "inner join t_tipoip tp on p.ID_Tipo_IP = tp.ID_Tipo_IP and tp.estado = 1 ", 
                    "p.*, pm.Nombre Puesto, bcr.Codigo, bcr.Nombre, tp.Tipo_Ip", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_net_puesto p ".
                    "inner join (select ID_Puesto_Monitoreo, Nombre from t_puestomonitoreo where estado = 1 union select 0,'General') pm on p.ID_Puesto_Monitoreo = pm.ID_Puesto_Monitoreo ".
                    "inner join t_puntobcr bcr on p.id_puntobcr = bcr.id_puntobcr and bcr.Estado = 1 ".
                    "inner join t_tipoip tp on p.ID_Tipo_IP = tp.ID_Tipo_IP and tp.estado = 1 ", 
                    "p.*, pm.Nombre Puesto, bcr.Codigo, bcr.Nombre, tp.Tipo_Ip", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_net_puesto() {
        $this->obj_data_provider->conectar();
        if ($this->condicion==""){
            $this->obj_data_provider->inserta_datos("t_net_puesto","ID_Puesto_Monitoreo,ID_PuntoBCR, ID_Tipo_IP, Estado","'".$this->ID_Puesto_Monitoreo."','".$this->ID_PuntoBCR."','".$this->ID_Tipo_IP."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_net_puesto","ID_PuntoBCR='".$this->ID_PuntoBCR."',ID_Tipo_IP='".$this->ID_Tipo_IP."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_net_puesto(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_net_puesto","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}