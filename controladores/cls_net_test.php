<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_net_test
 * Clase generada automáticamente el 2018-12-28 13:31
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_net_test {
    /**
     * Columna [ID_Net] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Llave primaria de la tabla 
     */
    public $ID_Net;
    /**
     * Columna [ID_PuntoBCR] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Punto BCR 
     */
    public $ID_PuntoBCR;
    /**
     * Columna [ID_Tipo_IP] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Código de Tipo de IP 
     */
    public $ID_Tipo_IP;
    /**
     * Columna [Direccion_IP] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Dirección IP del Ping 
     */
    public $Direccion_IP;
    /**
     * Columna [Estado] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Estado del ping 
     */
    public $Estado;
    /**
     * Columna [Fecha] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Fecha y hora en que se ejecuto el ping 
     */
    public $Fecha;
    /**
     * Columna [Duracion] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Duración del respuesta del PING 
     */
    public $Duracion;
    /**
     * Columna [Activo] de la tabla [t_net_test] en la clase [cls_net_test] 
     * Estado si esta activo o inactivo 
     */
    public $Activo;
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
     *Retorna el valor de la propiedad ID_Net
     */
    function getID_Net() {
        return $this->ID_Net;
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
     *Retorna el valor de la propiedad Direccion_IP
     */
    function getDireccion_IP() {
        return $this->Direccion_IP;
    }

    /**
     *Retorna el valor de la propiedad Estado
     */
    function getEstado() {
        return $this->Estado;
    }

    /**
     *Retorna el valor de la propiedad Fecha
     */
    function getFecha() {
        return $this->Fecha;
    }

    /**
     *Retorna el valor de la propiedad Duracion
     */
    function getDuracion() {
        return $this->Duracion;
    }

    /**
     *Retorna el valor de la propiedad Activo
     */
    function getActivo() {
        return $this->Activo;
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
     * Retorna el valor de la propiedad ID_Net
     */
    function setID_Net($ID_Net) {
        $this->ID_Net = $ID_Net;
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
     * Retorna el valor de la propiedad Direccion_IP
     */
    function setDireccion_IP($Direccion_IP) {
        $this->Direccion_IP = $Direccion_IP;
    }

    /**
     * Retorna el valor de la propiedad Estado
     */
    function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    /**
     * Retorna el valor de la propiedad Fecha
     */
    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    /**
     * Retorna el valor de la propiedad Duracion
     */
    function setDuracion($Duracion) {
        $this->Duracion = $Duracion;
    }

    /**
     * Retorna el valor de la propiedad Activo
     */
    function setActivo($Activo) {
        $this->Activo = $Activo;
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
     * Constructor: inicializa las variables de la clase cls_net_test
     */
    public function __construct() {
        $this->ID_Net="";
        $this->ID_PuntoBCR="";
        $this->ID_Tipo_IP="";
        $this->Direccion_IP="";
        $this->Estado="";
        $this->Fecha="";
        $this->Duracion="";
        $this->Activo="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_net_test() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_net_test", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_net_test", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_net_test() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Net==0){
            $this->obj_data_provider->inserta_datos("t_net_test","ID_PuntoBCR, ID_Tipo_IP, Direccion_IP, Estado, Fecha, Duracion, Activo","'".$this->ID_PuntoBCR."','".$this->ID_Tipo_IP."','".$this->Direccion_IP."','".$this->Estado."','".$this->Fecha."','".$this->Duracion."','".$this->Activo."'");
        }else{
            $this->obj_data_provider->edita_datos("t_net_test","ID_PuntoBCR='".$this->ID_PuntoBCR."',ID_Tipo_IP='".$this->ID_Tipo_IP."',Direccion_IP='".$this->Direccion_IP."',Estado='".$this->Estado."',Fecha='".$this->Fecha."',Duracion='".$this->Duracion."',Activo='".$this->Activo."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_net_test(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_net_test","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_net_buscar() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(" t_net_test nt "
                    ." inner join t_puntobcr p on nt.ID_PuntoBCR = p.ID_PuntoBCR "
                    ." inner join t_tipoip t on nt.ID_Tipo_IP = t.ID_Tipo_IP limit 10   ", 
                    " p.ID_PuntoBCR, p.Nombre, p.Codigo, "
                    ." nt.Direccion_IP, nt.Estado, nt.Fecha,nt.Duracion, t.Tipo_IP ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(" t_net_test nt "
                    ." inner join t_puntobcr p on nt.ID_PuntoBCR = p.ID_PuntoBCR "
                    ." inner join t_tipoip t on nt.ID_Tipo_IP = t.ID_Tipo_IP ", 
                    " p.ID_PuntoBCR, p.Nombre, p.Codigo, "
                    ." nt.Direccion_IP, nt.Estado, nt.Fecha,nt.Duracion, t.Tipo_IP ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}
