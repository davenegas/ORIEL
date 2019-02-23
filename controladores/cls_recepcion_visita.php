<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_visita
 * Clase generada automáticamente el 2019-02-22 13:53
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_recepcion_visita {
    /**
     * Columna [ID_RecepcionVisita] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Llave primaria de la tabla 
     */
    public $ID_RecepcionVisita;
    /**
     * Columna [ID_Recepcion_Apertura] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Llave foranea a tabla T_Recepcion_Apertura 
     */
    public $ID_Recepcion_Apertura;
    /**
     * Columna [ID_UsuarioIngreso] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Usuario que registra el ingreso 
     */
    public $ID_UsuarioIngreso;
    /**
     * Columna [ID_UsuarioSalida] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Usuario que registra la salida 
     */
    public $ID_UsuarioSalida;
    /**
     * Columna [ID_Persona] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Llave foranea a tabla T_Personal 
     */
    public $ID_Persona;
    /**
     * Columna [ID_Ubicacion] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Llave foranea a tabla T_Recepcion_Ubicacion 
     */
    public $ID_Ubicacion;
    /**
     * Columna [Nombre] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Nombre de la persona de visita 
     */
    public $Nombre;
    /**
     * Columna [Cedula] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Cédula del visitante 
     */
    public $Cedula;
    /**
     * Columna [Carnet] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Carnet que se presta al visitante 
     */
    public $Carnet;
    /**
     * Columna [Empresa] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Empresa a la que pertenece el visitante 
     */
    public $Empresa;
    /**
     * Columna [Departamento] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Departamento que se desea visitar 
     */
    public $Departamento;
    /**
     * Columna [Motivo] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Motivo de la visita 
     */
    public $Motivo;
    /**
     * Columna [Fecha_Entrada] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Fecha en que ingreso 
     */
    public $Fecha_Entrada;
    /**
     * Columna [Hora_Entrada] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Hora en que ingreso 
     */
    public $Hora_Entrada;
    /**
     * Columna [Fecha_Salida] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Fecha en que se retiro 
     */
    public $Fecha_Salida;
    /**
     * Columna [Hora_Salida] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Hora en que se retiro 
     */
    public $Hora_Salida;
    /**
     * Columna [Estado_Uso] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
     * Muestra el estado de la persona I = registro ingreso ingreso, S = Registro Salida 
     */
    public $Estado_Uso;
    /**
     * Columna [Estado] de la tabla [t_recepcion_visita] en la clase [cls_recepcion_visita] 
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
     *Retorna el valor de la propiedad ID_RecepcionVisita
     */
    function getID_RecepcionVisita() {
        return $this->ID_RecepcionVisita;
    }

    /**
     *Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function getID_Recepcion_Apertura() {
        return $this->ID_Recepcion_Apertura;
    }

    /**
     *Retorna el valor de la propiedad ID_UsuarioIngreso
     */
    function getID_UsuarioIngreso() {
        return $this->ID_UsuarioIngreso;
    }

    /**
     *Retorna el valor de la propiedad ID_UsuarioSalida
     */
    function getID_UsuarioSalida() {
        return $this->ID_UsuarioSalida;
    }

    /**
     *Retorna el valor de la propiedad ID_Persona
     */
    function getID_Persona() {
        return $this->ID_Persona;
    }

    /**
     *Retorna el valor de la propiedad ID_Ubicacion
     */
    function getID_Ubicacion() {
        return $this->ID_Ubicacion;
    }

    /**
     *Retorna el valor de la propiedad Nombre
     */
    function getNombre() {
        return $this->Nombre;
    }

    /**
     *Retorna el valor de la propiedad Cedula
     */
    function getCedula() {
        return $this->Cedula;
    }

    /**
     *Retorna el valor de la propiedad Carnet
     */
    function getCarnet() {
        return $this->Carnet;
    }

    /**
     *Retorna el valor de la propiedad Empresa
     */
    function getEmpresa() {
        return $this->Empresa;
    }

    /**
     *Retorna el valor de la propiedad Departamento
     */
    function getDepartamento() {
        return $this->Departamento;
    }

    /**
     *Retorna el valor de la propiedad Motivo
     */
    function getMotivo() {
        return $this->Motivo;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Entrada
     */
    function getFecha_Entrada() {
        return $this->Fecha_Entrada;
    }

    /**
     *Retorna el valor de la propiedad Hora_Entrada
     */
    function getHora_Entrada() {
        return $this->Hora_Entrada;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Salida
     */
    function getFecha_Salida() {
        return $this->Fecha_Salida;
    }

    /**
     *Retorna el valor de la propiedad Hora_Salida
     */
    function getHora_Salida() {
        return $this->Hora_Salida;
    }

    /**
     *Retorna el valor de la propiedad Estado_Uso
     */
    function getEstado_Uso() {
        return $this->Estado_Uso;
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
     * Retorna el valor de la propiedad ID_RecepcionVisita
     */
    function setID_RecepcionVisita($ID_RecepcionVisita) {
        $this->ID_RecepcionVisita = $ID_RecepcionVisita;
    }

    /**
     * Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function setID_Recepcion_Apertura($ID_Recepcion_Apertura) {
        $this->ID_Recepcion_Apertura = $ID_Recepcion_Apertura;
    }

    /**
     * Retorna el valor de la propiedad ID_UsuarioIngreso
     */
    function setID_UsuarioIngreso($ID_UsuarioIngreso) {
        $this->ID_UsuarioIngreso = $ID_UsuarioIngreso;
    }

    /**
     * Retorna el valor de la propiedad ID_UsuarioSalida
     */
    function setID_UsuarioSalida($ID_UsuarioSalida) {
        $this->ID_UsuarioSalida = $ID_UsuarioSalida;
    }

    /**
     * Retorna el valor de la propiedad ID_Persona
     */
    function setID_Persona($ID_Persona) {
        $this->ID_Persona = $ID_Persona;
    }

    /**
     * Retorna el valor de la propiedad ID_Ubicacion
     */
    function setID_Ubicacion($ID_Ubicacion) {
        $this->ID_Ubicacion = $ID_Ubicacion;
    }

    /**
     * Retorna el valor de la propiedad Nombre
     */
    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    /**
     * Retorna el valor de la propiedad Cedula
     */
    function setCedula($Cedula) {
        $this->Cedula = $Cedula;
    }

    /**
     * Retorna el valor de la propiedad Carnet
     */
    function setCarnet($Carnet) {
        $this->Carnet = $Carnet;
    }

    /**
     * Retorna el valor de la propiedad Empresa
     */
    function setEmpresa($Empresa) {
        $this->Empresa = $Empresa;
    }

    /**
     * Retorna el valor de la propiedad Departamento
     */
    function setDepartamento($Departamento) {
        $this->Departamento = $Departamento;
    }

    /**
     * Retorna el valor de la propiedad Motivo
     */
    function setMotivo($Motivo) {
        $this->Motivo = $Motivo;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Entrada
     */
    function setFecha_Entrada($Fecha_Entrada) {
        $this->Fecha_Entrada = $Fecha_Entrada;
    }

    /**
     * Retorna el valor de la propiedad Hora_Entrada
     */
    function setHora_Entrada($Hora_Entrada) {
        $this->Hora_Entrada = $Hora_Entrada;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Salida
     */
    function setFecha_Salida($Fecha_Salida) {
        $this->Fecha_Salida = $Fecha_Salida;
    }

    /**
     * Retorna el valor de la propiedad Hora_Salida
     */
    function setHora_Salida($Hora_Salida) {
        $this->Hora_Salida = $Hora_Salida;
    }

    /**
     * Retorna el valor de la propiedad Estado_Uso
     */
    function setEstado_Uso($Estado_Uso) {
        $this->Estado_Uso = $Estado_Uso;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_visita
     */
    public function __construct() {
        $this->ID_RecepcionVisita="";
        $this->ID_Recepcion_Apertura="";
        $this->ID_UsuarioIngreso="";
        $this->ID_UsuarioSalida="";
        $this->ID_Persona="";
        $this->ID_Ubicacion="";
        $this->Nombre="";
        $this->Cedula="";
        $this->Carnet="";
        $this->Empresa="";
        $this->Departamento="";
        $this->Motivo="";
        $this->Fecha_Entrada="";
        $this->Hora_Entrada="";
        $this->Fecha_Salida="";
        $this->Hora_Salida="";
        $this->Estado_Uso="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_recepcion_visita() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_visita", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_visita", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_visita() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionVisita==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_visita","ID_Recepcion_Apertura, ID_UsuarioIngreso, ID_UsuarioSalida, ID_Persona, ID_Ubicacion, Nombre, Cedula, Carnet, Empresa, Departamento, Motivo, Fecha_Entrada, Hora_Entrada, Fecha_Salida, Hora_Salida, Estado_Uso, Estado","'".$this->ID_Recepcion_Apertura."','".$this->ID_UsuarioIngreso."','".$this->ID_UsuarioSalida."','".$this->ID_Persona."','".$this->ID_Ubicacion."','".$this->Nombre."','".$this->Cedula."','".$this->Carnet."','".$this->Empresa."','".$this->Departamento."','".$this->Motivo."','".$this->Fecha_Entrada."','".$this->Hora_Entrada."','".$this->Fecha_Salida."','".$this->Hora_Salida."','".$this->Estado_Uso."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_visita","ID_Recepcion_Apertura='".$this->ID_Recepcion_Apertura."',ID_UsuarioIngreso='".$this->ID_UsuarioIngreso."',ID_UsuarioSalida='".$this->ID_UsuarioSalida."',ID_Persona='".$this->ID_Persona."',ID_Ubicacion='".$this->ID_Ubicacion."',Nombre='".$this->Nombre."',Cedula='".$this->Cedula."',Carnet='".$this->Carnet."',Empresa='".$this->Empresa."',Departamento='".$this->Departamento."',Motivo='".$this->Motivo."',Fecha_Entrada='".$this->Fecha_Entrada."',Hora_Entrada='".$this->Hora_Entrada."',Fecha_Salida='".$this->Fecha_Salida."',Hora_Salida='".$this->Hora_Salida."',Estado_Uso='".$this->Estado_Uso."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_recepcion_visita(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_visita","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
        /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function registrar_recepcion_salida() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionVisita!=0){  
            $this->obj_data_provider->edita_datos("t_recepcion_visita","ID_UsuarioSalida='".$this->ID_UsuarioSalida."',Fecha_Salida='".$this->Fecha_Salida."',Hora_Salida='".$this->Hora_Salida."',Estado_Uso='".$this->Estado_Uso."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}