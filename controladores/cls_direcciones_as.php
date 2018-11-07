   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_direcciones_as
 * Clase generada automáticamente el 2018-10-30 15:37
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_direcciones_as {
    /**
     * Columna [ID_Direccion] de la tabla [t_direcciones_as] en la clase [cls_direcciones_as] 
     * Llave primaria de la tabla direcciones As 
     */
    public $ID_Direccion;
    /**
     * Columna [Descripcion] de la tabla [t_direcciones_as] en la clase [cls_direcciones_as] 
     * Descripcion de ubicación donde ocurren los hechos 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_direcciones_as] en la clase [cls_direcciones_as] 
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
     *Retorna el valor de la propiedad ID_Direccion
     */
    function getID_Direccion() {
        return $this->ID_Direccion;
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
     * Retorna el valor de la propiedad ID_Direccion
     */
    function setID_Direccion($ID_Direccion) {
        $this->ID_Direccion = $ID_Direccion;
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
     * Constructor: inicializa las variables de la clase cls_direcciones_as
     */
    public function __construct() {
        $this->ID_Direccion="";
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
    public function obtener_direcciones_as() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_direcciones_as", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_direcciones_as", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_direcciones_as() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Direccion==0){
            $this->obj_data_provider->inserta_datos("t_direcciones_as","Descripcion, Estado","'".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_direcciones_as","Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_direcciones_as(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_direcciones_as","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}