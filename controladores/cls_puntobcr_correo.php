   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_puntobcr_correo
 * Clase generada automáticamente el 2018-09-01 14:04
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_puntobcr_correo {
    /**
     * Columna [ID_Correo] de la tabla [t_puntobcr_correo] en la clase [cls_puntobcr_correo] 
     * Llave primaria de la tabla 
     */
    public $ID_Correo;
    /**
     * Columna [ID_PuntoBCR] de la tabla [t_puntobcr_correo] en la clase [cls_puntobcr_correo] 
     * Llave foranea con la tabla t_puntobcr 
     */
    public $ID_PuntoBCR;
    /**
     * Columna [Correo] de la tabla [t_puntobcr_correo] en la clase [cls_puntobcr_correo] 
     * Correo del grupo de oficina o agencia 
     */
    public $Correo;
    /**
     * Columna [Estado] de la tabla [t_puntobcr_correo] en la clase [cls_puntobcr_correo] 
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
     *Retorna el valor de la propiedad ID_Correo
     */
    function getID_Correo() {
        return $this->ID_Correo;
    }

    /**
     *Retorna el valor de la propiedad ID_PuntoBCR
     */
    function getID_PuntoBCR() {
        return $this->ID_PuntoBCR;
    }

    /**
     *Retorna el valor de la propiedad Correo
     */
    function getCorreo() {
        return $this->Correo;
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
     * Retorna el valor de la propiedad ID_Correo
     */
    function setID_Correo($ID_Correo) {
        $this->ID_Correo = $ID_Correo;
    }

    /**
     * Retorna el valor de la propiedad ID_PuntoBCR
     */
    function setID_PuntoBCR($ID_PuntoBCR) {
        $this->ID_PuntoBCR = $ID_PuntoBCR;
    }

    /**
     * Retorna el valor de la propiedad Correo
     */
    function setCorreo($Correo) {
        $this->Correo = $Correo;
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
     * Constructor: inicializa las variables de la clase cls_puntobcr_correo
     */
    public function __construct() {
        $this->ID_Correo="";
        $this->ID_PuntoBCR="";
        $this->Correo="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_puntobcr_correo() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_puntobcr_correo", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_puntobcr_correo", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_puntobcr_correo() {
        $this->obj_data_provider->conectar();
        if ($this->condicion==''){
            $this->obj_data_provider->inserta_datos("t_puntobcr_correo","ID_PuntoBCR, Correo, Estado","'".$this->ID_PuntoBCR."','".$this->Correo."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_puntobcr_correo","Correo='".$this->Correo."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_puntobcr_correo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_puntobcr_correo","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
}
