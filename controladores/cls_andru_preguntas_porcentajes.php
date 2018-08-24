   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_preguntas_porcentajes
 * Clase generada automáticamente el 2018-08-10 13:21
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_andru_preguntas_porcentajes {
    /**
     * Columna [ID_Pregunta] de la tabla [t_andru_preguntas_porcentajes] en la clase [cls_andru_preguntas_porcentajes] 
     * Llave foranea con la tabla t_andru_preguntas 
     */
    public $ID_Pregunta;
    /**
     * Columna [ID_Tipo_Porcentaje] de la tabla [t_andru_preguntas_porcentajes] en la clase [cls_andru_preguntas_porcentajes] 
     * Llave foranea con la tabla t_andru_tipo_porcentajes 
     */
    public $ID_Tipo_Porcentaje;
    /**
     * Columna [Valor] de la tabla [t_andru_preguntas_porcentajes] en la clase [cls_andru_preguntas_porcentajes] 
     * El valor es un porcentaje definido por el usuario 
     */
    public $Valor;
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
     *Retorna el valor de la propiedad ID_Tipo_Porcentaje
     */
    function getID_Tipo_Porcentaje() {
        return $this->ID_Tipo_Porcentaje;
    }

    /**
     *Retorna el valor de la propiedad Valor
     */
    function getValor() {
        return $this->Valor;
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
     * Retorna el valor de la propiedad ID_Tipo_Porcentaje
     */
    function setID_Tipo_Porcentaje($ID_Tipo_Porcentaje) {
        $this->ID_Tipo_Porcentaje = $ID_Tipo_Porcentaje;
    }

    /**
     * Retorna el valor de la propiedad Valor
     */
    function setValor($Valor) {
        $this->Valor = $Valor;
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
     * Constructor: inicializa las variables de la clase cls_andru_preguntas_porcentajes
     */
    public function __construct() {
        $this->ID_Pregunta="";
        $this->ID_Tipo_Porcentaje="";
        $this->Valor="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_andru_preguntas_porcentajes() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas_porcentajes", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas_porcentajes", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_preguntas_porcentajes() {
        $this->obj_data_provider->conectar();
        if ($this->condicion==""){
            $this->obj_data_provider->inserta_datos("t_andru_preguntas_porcentajes","ID_Pregunta, ID_Tipo_Porcentaje, Valor","'".$this->ID_Pregunta."','".$this->ID_Tipo_Porcentaje."','".$this->Valor."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_preguntas_porcentajes","Valor='".$this->Valor."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }   
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}
