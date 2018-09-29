   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_alerta_general_detalle
 * Clase generada automáticamente el 2018-08-25 14:46
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_alerta_general_detalle {
    /**
     * Columna [ID_Alerta_Detalle] de la tabla [t_alerta_general_detalle] en la clase [cls_alerta_general_detalle] 
     * Llave primaria de la tabla 
     */
    public $ID_Alerta_Detalle;
    /**
     * Columna [ID_Alerta] de la tabla [t_alerta_general_detalle] en la clase [cls_alerta_general_detalle] 
     * Llave foranea con la tabla t_alertageneral 
     */
    public $ID_Alerta;
    /**
     * Columna [Valor] de la tabla [t_alerta_general_detalle] en la clase [cls_alerta_general_detalle] 
     * Cantidad de estaciones según rango de horas 
     */
    public $Valor;
    /**
     * Columna [Fecha] de la tabla [t_alerta_general_detalle] en la clase [cls_alerta_general_detalle] 
     * Fecha y hora en la que se guarda el registro 
     */
    public $Fecha;
    /**
     * Columna [Estado] de la tabla [t_alerta_general_detalle] en la clase [cls_alerta_general_detalle] 
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
     *Retorna el valor de la propiedad ID_Alerta_Detalle
     */
    function getID_Alerta_Detalle() {
        return $this->ID_Alerta_Detalle;
    }

    /**
     *Retorna el valor de la propiedad ID_Alerta
     */
    function getID_Alerta() {
        return $this->ID_Alerta;
    }

    /**
     *Retorna el valor de la propiedad Valor
     */
    function getValor() {
        return $this->Valor;
    }

    /**
     *Retorna el valor de la propiedad Fecha
     */
    function getFecha() {
        return $this->Fecha;
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
     * Retorna el valor de la propiedad ID_Alerta_Detalle
     */
    function setID_Alerta_Detalle($ID_Alerta_Detalle) {
        $this->ID_Alerta_Detalle = $ID_Alerta_Detalle;
    }

    /**
     * Retorna el valor de la propiedad ID_Alerta
     */
    function setID_Alerta($ID_Alerta) {
        $this->ID_Alerta = $ID_Alerta;
    }

    /**
     * Retorna el valor de la propiedad Valor
     */
    function setValor($Valor) {
        $this->Valor = $Valor;
    }

    /**
     * Retorna el valor de la propiedad Fecha
     */
    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
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
     * Constructor: inicializa las variables de la clase cls_alerta_general_detalle
     */
    public function __construct() {
        $this->ID_Alerta_Detalle="";
        $this->ID_Alerta="";
        $this->Valor="";
        $this->Fecha="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_alerta_general_detalle() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_alerta_general_detalle", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_alerta_general_detalle", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_alerta_general_detalle() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Alerta_Detalle==0){
            $this->obj_data_provider->inserta_datos("t_alerta_general_detalle","ID_Alerta, Valor, Fecha, Estado","'".$this->ID_Alerta."','".$this->Valor."','".$this->Fecha."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_alerta_general_detalle","ID_Alerta='".$this->ID_Alerta."',Valor='".$this->Valor."',Fecha='".$this->Fecha."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_alerta_general_detalle(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_alerta_general_detalle","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_alerta_general_grafico() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_alerta_general_detalle", "DATE_ADD(Fecha, INTERVAL -1 MONTH) Fecha, Valor", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_alerta_general_detalle", "DATE_ADD(Fecha, INTERVAL -1 MONTH) Fecha, Valor", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}
