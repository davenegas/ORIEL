<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_preguntas
 * Clase generada automáticamente el 2018-08-09 16:04
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_andru_preguntas {
    /**
     * Columna [ID_Pregunta] de la tabla [t_andru_preguntas] en la clase [cls_andru_preguntas] 
     * Llave primaria de la tabla 
     */
    public $ID_Pregunta;
    /**
     * Columna [ID_Fase] de la tabla [t_andru_preguntas] en la clase [cls_andru_preguntas] 
     * Llave foranea con la tabla T_Andru_Fases 
     */
    public $ID_Fase;
    /**
     * Columna [ID_Categoria] de la tabla [t_andru_preguntas] en la clase [cls_andru_preguntas] 
     * Llave foranea con la tabla T_Andru_Categorias 
     */
    public $ID_Categoria;
    /**
     * Columna [Descripcion] de la tabla [t_andru_preguntas] en la clase [cls_andru_preguntas] 
     * Descripción del apregunta 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_andru_preguntas] en la clase [cls_andru_preguntas] 
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
     *Retorna el valor de la propiedad ID_Pregunta
     */
    function getID_Pregunta() {
        return $this->ID_Pregunta;
    }

    /**
     *Retorna el valor de la propiedad ID_Fase
     */
    function getID_Fase() {
        return $this->ID_Fase;
    }

    /**
     *Retorna el valor de la propiedad ID_Categoria
     */
    function getID_Categoria() {
        return $this->ID_Categoria;
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
     * Retorna el valor de la propiedad ID_Pregunta
     */
    function setID_Pregunta($ID_Pregunta) {
        $this->ID_Pregunta = $ID_Pregunta;
    }

    /**
     * Retorna el valor de la propiedad ID_Fase
     */
    function setID_Fase($ID_Fase) {
        $this->ID_Fase = $ID_Fase;
    }

    /**
     * Retorna el valor de la propiedad ID_Categoria
     */
    function setID_Categoria($ID_Categoria) {
        $this->ID_Categoria = $ID_Categoria;
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
     * Constructor: inicializa las variables de la clase cls_andru_preguntas
     */
    public function __construct() {
        $this->ID_Pregunta="";
        $this->ID_Fase="";
        $this->ID_Categoria="";
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
    public function obtener_andru_preguntas() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p INNER JOIN t_andru_fases f ON p.ID_Fase = f.ID_Fase "
                    ."INNER JOIN t_andru_categoria c ON p.ID_Categoria = c.ID_Categoria ", 
                    "p.ID_Pregunta, p.ID_Fase, p.ID_Categoria, p.Descripcion, p.Estado,f.Descripcion fase, c.Descripcion categoria ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_preguntas() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Pregunta==0){
            $this->obj_data_provider->inserta_datos("t_andru_preguntas","ID_Fase, ID_Categoria, Descripcion, Estado","'".$this->ID_Fase."','".$this->ID_Categoria."','".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_preguntas","ID_Fase='".$this->ID_Fase."',ID_Categoria='".$this->ID_Categoria."',Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_andru_preguntas(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_andru_preguntas","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método trae todas las preguntas con su respuesta
     */
    public function obtener_andru_preguntas_respuesta() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p INNER JOIN t_andru_preguntas_respuestas r ON p.ID_Pregunta = r.ID_Pregunta", 
                "p.ID_Pregunta,r.ID_Respuesta ,r.Descripcion Respuesta,r.Nivel",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;      
    }
    /**
     * Método trae todas las posibles respuestas por pregunta
     */
    public function obtener_andru_preguntas_fase() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p INNER JOIN t_andru_categoria c ON p.ID_Categoria = c.ID_Categoria", 
                "p.ID_Pregunta,p.Descripcion Pregunta,c.Descripcion Fase,-1 ID_Respuesta",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;      
    }
    /**
     * Método trae todas las posibles respuestas por pregunta
     */
    public function obtener_andru_preguntas_porcentaje() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p  INNER JOIN t_andru_preguntas_porcentajes por ON por.ID_Pregunta = p.ID_Pregunta", 
                "p.ID_Pregunta,por.ID_Tipo_Porcentaje,CONVERT(por.Valor,DECIMAL(6,2)) Valor ", 
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }    
}
