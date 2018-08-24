   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_tipos_porcentajes
 * Clase generada automáticamente el 2018-08-09 15:54
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_andru_tipos_porcentajes {
    /**
     * Columna [ID_Tipo_Porcentaje] de la tabla [t_andru_tipos_porcentajes] en la clase [cls_andru_tipos_porcentajes] 
     * Llave primaria de la tabla 
     */
    public $ID_Tipo_Porcentaje;
    /**
     * Columna [Descripcion] de la tabla [t_andru_tipos_porcentajes] en la clase [cls_andru_tipos_porcentajes] 
     * Descripción del tipo de porcentaje (Asalto, Robo) 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_andru_tipos_porcentajes] en la clase [cls_andru_tipos_porcentajes] 
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
     *Retorna el valor de la propiedad ID_Tipo_Porcentaje
     */
    function getID_Tipo_Porcentaje() {
        return $this->ID_Tipo_Porcentaje;
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
     * Retorna el valor de la propiedad ID_Tipo_Porcentaje
     */
    function setID_Tipo_Porcentaje($ID_Tipo_Porcentaje) {
        $this->ID_Tipo_Porcentaje = $ID_Tipo_Porcentaje;
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
     * Constructor: inicializa las variables de la clase cls_andru_tipos_porcentajes
     */
    public function __construct() {
        $this->ID_Tipo_Porcentaje="";
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
    public function obtener_andru_tipos_porcentajes() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_tipos_porcentajes", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_tipos_porcentajes", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_tipos_porcentajes() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Tipo_Porcentaje==0){
            $this->obj_data_provider->inserta_datos("t_andru_tipos_porcentajes","Descripcion, Estado","'".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_tipos_porcentajes","Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_andru_tipos_porcentajes(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_andru_tipos_porcentajes","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}