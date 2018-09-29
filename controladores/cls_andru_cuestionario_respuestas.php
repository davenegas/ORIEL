<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_cuestionario_respuestas
 * Clase generada automáticamente el 2018-09-07 13:08
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_andru_cuestionario_respuestas {
    /**
     * Columna [ID_Cuestionario] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
     * Llave foranea con la tabla t_andru_cuestionario 
     */
    public $ID_Cuestionario;
    /**
     * Columna [ID_Pregunta] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
     * Llave foranea con la tabla t_andru_preguntas 
     */
    public $ID_Pregunta;
    /**
     * Columna [ID_Respuesta] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
     * Llave foranea con la tabla t_andru_preguntas_respuestas 
     */
    public $ID_Respuesta;
    /**
     * Columna [ID_Usuario_Upd] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
     * Usuario que actualiza 
     */
    public $ID_Usuario_Upd;
    /**
     * Columna [Fecha_Actualiza] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
     * Fecha Actualiza 
     */
    public $Fecha_Actualiza;
    /**
     * Columna [Estado] de la tabla [t_andru_cuestionario_respuestas] en la clase [cls_andru_cuestionario_respuestas] 
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
     *Retorna el valor de la propiedad ID_Cuestionario
     */
    function getID_Cuestionario() {
        return $this->ID_Cuestionario;
    }

    /**
     *Retorna el valor de la propiedad ID_Pregunta
     */
    function getID_Pregunta() {
        return $this->ID_Pregunta;
    }

    /**
     *Retorna el valor de la propiedad ID_Respuesta
     */
    function getID_Respuesta() {
        return $this->ID_Respuesta;
    }

    /**
     *Retorna el valor de la propiedad ID_Usuario_Upd
     */
    function getID_Usuario_Upd() {
        return $this->ID_Usuario_Upd;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Actualiza
     */
    function getFecha_Actualiza() {
        return $this->Fecha_Actualiza;
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
     * Retorna el valor de la propiedad ID_Cuestionario
     */
    function setID_Cuestionario($ID_Cuestionario) {
        $this->ID_Cuestionario = $ID_Cuestionario;
    }

    /**
     * Retorna el valor de la propiedad ID_Pregunta
     */
    function setID_Pregunta($ID_Pregunta) {
        $this->ID_Pregunta = $ID_Pregunta;
    }

    /**
     * Retorna el valor de la propiedad ID_Respuesta
     */
    function setID_Respuesta($ID_Respuesta) {
        $this->ID_Respuesta = $ID_Respuesta;
    }

    /**
     * Retorna el valor de la propiedad ID_Usuario_Upd
     */
    function setID_Usuario_Upd($ID_Usuario_Upd) {
        $this->ID_Usuario_Upd = $ID_Usuario_Upd;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Actualiza
     */
    function setFecha_Actualiza($Fecha_Actualiza) {
        $this->Fecha_Actualiza = $Fecha_Actualiza;
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
     * Constructor: inicializa las variables de la clase cls_andru_cuestionario_respuestas
     */
    public function __construct() {
        $this->ID_Cuestionario="";
        $this->ID_Pregunta="";
        $this->ID_Respuesta="";
        $this->ID_Usuario_Upd="";
        $this->Fecha_Actualiza="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }
    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_andru_cuestionario_respuestas() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_cuestionario_respuestas", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_cuestionario_respuestas", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_cuestionario_respuestas() {
        $this->obj_data_provider->conectar();
        if ($this->condicion==""){
            $this->obj_data_provider->inserta_datos("t_andru_cuestionario_respuestas","ID_Cuestionario,ID_Pregunta, ID_Respuesta, ID_Usuario_Upd, Fecha_Actualiza, Estado","'".$this->ID_Cuestionario."','".$this->ID_Pregunta."','".$this->ID_Respuesta."','".$this->ID_Usuario_Upd."','".$this->Fecha_Actualiza."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_cuestionario_respuestas","ID_Pregunta='".$this->ID_Pregunta."',ID_Respuesta='".$this->ID_Respuesta."',ID_Usuario_Upd='".$this->ID_Usuario_Upd."',Fecha_Actualiza='".$this->Fecha_Actualiza."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_andru_cuestionario_respuestas(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_andru_cuestionario_respuestas","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
     /**
     * Método que actualiza en base de datos,
     * Marca todos los registros como borrados según el cuestionario 
     */
    public function guardar_andru_cuestionario_Actualiza() {
        $this->obj_data_provider->conectar();
        if ($this->condicion!=""){
            $this->obj_data_provider->edita_datos("t_andru_cuestionario_respuestas","Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}
