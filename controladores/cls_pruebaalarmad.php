<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_pruebaalarmad
 * Clase generada automáticamente el 2019-01-19 09:08
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_pruebaalarmad {
    /**
     * Columna [ID_Prueba_AlarmaD] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Llave primaria de la tabla 
     */
    public $ID_Prueba_AlarmaD;
    /**
     * Columna [ID_Prueba_Alarma] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Llave foranea a tabla T_PruebaAlarma 
     */
    public $ID_Prueba_Alarma;
    /**
     * Columna [ID_PuntoBCR] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Llave foranea a tabla T_PuntoBCR 
     */
    public $ID_PuntoBCR;
    /**
     * Columna [Fecha] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Fecha en la que se realizo el registro de prueba 
     */
    public $Fecha;
    /**
     * Columna [Hora_Prueba] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Hora en que se realizo el registro de prueba 
     */
    public $Hora_Prueba;
    /**
     * Columna [Hora_Cierre] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
     * Hora en que se realizo el registro de cierre 
     */
    public $Hora_Cierre;
    /**
     * Columna [Estado] de la tabla [t_pruebaalarmad] en la clase [cls_pruebaalarmad] 
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
     *Propiedad que indica que hora se debe actualizar (1 = Hora de prueba o 2 = Hora de cierre)
     */
    public $tipo_hora;

    /**
     *Retorna el valor de la propiedad ID_Prueba_AlarmaD
     */
    function getID_Prueba_AlarmaD() {
        return $this->ID_Prueba_AlarmaD;
    }

    /**
     *Retorna el valor de la propiedad ID_Prueba_Alarma
     */
    function getID_Prueba_Alarma() {
        return $this->ID_Prueba_Alarma;
    }

    /**
     *Retorna el valor de la propiedad ID_PuntoBCR
     */
    function getID_PuntoBCR() {
        return $this->ID_PuntoBCR;
    }

    /**
     *Retorna el valor de la propiedad Fecha
     */
    function getFecha() {
        return $this->Fecha;
    }

    /**
     *Retorna el valor de la propiedad Hora_Prueba
     */
    function getHora_Prueba() {
        return $this->Hora_Prueba;
    }

    /**
     *Retorna el valor de la propiedad Hora_Cierre
     */
    function getHora_Cierre() {
        return $this->Hora_Cierre;
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
     * Retorna el valor de la propiedad ID_Prueba_AlarmaD
     */
    function setID_Prueba_AlarmaD($ID_Prueba_AlarmaD) {
        $this->ID_Prueba_AlarmaD = $ID_Prueba_AlarmaD;
    }

    /**
     * Retorna el valor de la propiedad ID_Prueba_Alarma
     */
    function setID_Prueba_Alarma($ID_Prueba_Alarma) {
        $this->ID_Prueba_Alarma = $ID_Prueba_Alarma;
    }

    /**
     * Retorna el valor de la propiedad ID_PuntoBCR
     */
    function setID_PuntoBCR($ID_PuntoBCR) {
        $this->ID_PuntoBCR = $ID_PuntoBCR;
    }

    /**
     * Retorna el valor de la propiedad Fecha
     */
    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    /**
     * Retorna el valor de la propiedad Hora_Prueba
     */
    function setHora_Prueba($Hora_Prueba) {
        $this->Hora_Prueba = $Hora_Prueba;
    }

    /**
     * Retorna el valor de la propiedad Hora_Cierre
     */
    function setHora_Cierre($Hora_Cierre) {
        $this->Hora_Cierre = $Hora_Cierre;
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
     * Propiedad que indica que hora se debe actualizar (1 = Hora de prueba o 2 = Hora de cierre)
     */
    function setTipo_Hora($tipo_hora) {
        $this->tipo_hora = $tipo_hora;
    }

    /**
     * Constructor: inicializa las variables de la clase cls_pruebaalarmad
     */
    public function __construct() {
        $this->ID_Prueba_AlarmaD="";
        $this->ID_Prueba_Alarma="";
        $this->ID_PuntoBCR="";
        $this->Fecha="";
        $this->Hora_Prueba="";
        $this->Hora_Cierre="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_pruebaalarmad() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_pruebaalarmad", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_pruebaalarmad", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_pruebaalarmad() {
        
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_pruebaalarma","ID_Prueba_Alarma","Fecha ='".$this->Fecha."' AND ID_PuntoBCR = ".$this->ID_PuntoBCR . " LIMIT 1");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        
        $conteo = count($this->arreglo);
         if($conteo >0)
        {
            $this->ID_Prueba_Alarma=$this->arreglo[0]["ID_Prueba_Alarma"];
        }
        
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_pruebaalarmad","ID_Prueba_AlarmaD","Fecha ='".$this->Fecha."' AND ID_PuntoBCR = ".$this->ID_PuntoBCR . " LIMIT 1");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        
        $this->ID_Prueba_AlarmaD=0;        
        $conteo = count($this->arreglo);
        if($conteo >0)
        {
            $this->ID_Prueba_AlarmaD=$this->arreglo[0]["ID_Prueba_AlarmaD"];
            $this->setCondicion("ID_Prueba_AlarmaD = ".$this->ID_Prueba_AlarmaD);
        }
        
        $this->obj_data_provider->conectar();
        if ($this->ID_Prueba_AlarmaD==0){
            $this->obj_data_provider->inserta_datos("t_pruebaalarmad","ID_Prueba_Alarma, ID_PuntoBCR, Fecha, Hora_Prueba, Hora_Cierre, Estado","'".$this->ID_Prueba_Alarma."','".$this->ID_PuntoBCR."','".$this->Fecha."','".$this->Hora_Prueba."','".$this->Hora_Cierre."','".$this->Estado."'");
        }else{
            if($this->tipo_hora ==1)
            {
                $this->obj_data_provider->edita_datos("t_pruebaalarmad","Hora_Prueba='".$this->Hora_Prueba."',Estado='".$this->Estado."'",$this->condicion);
            }else{
                $this->obj_data_provider->edita_datos("t_pruebaalarmad","Hora_Cierre='".$this->Hora_Cierre."',Estado='".$this->Estado."'",$this->condicion);   
            }
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}