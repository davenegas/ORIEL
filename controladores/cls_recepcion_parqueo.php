<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_recepcion_parqueo
 * Clase generada automáticamente el 2019-02-18 09:14
 * Base de datos: bd_gerencia_seguridad
 * Generada por:  
 */ 
class cls_recepcion_parqueo {
    /**
     * Columna [ID_RecepcionParqueo] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Llave primaria de la tabla 
     */
    public $ID_RecepcionParqueo;
    /**
     * Columna [ID_Recepcion_Apertura] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Llave foranea a tabla T_Recepcion_Apertura 
     */
    public $ID_Recepcion_Apertura;
    /**
     * Columna [ID_Persona] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Llave foranea a tabla T_Personal 
     */
    public $ID_Persona;
    /**
     * Columna [ID_Ubicacion] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Llave foranea a tabla T_Recepcion_Ubicacion 
     */
    public $ID_Ubicacion;
    /**
     * Columna [ID_Tipo_Vehiculo] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Llave foranea a tabla T_Recepcion_Tipovehiculo 
     */
    public $ID_Tipo_Vehiculo;
    /**
     * Columna [Nombre] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Nombre de la persona dueña del espacio de parqueo 
     */
    public $Nombre;
    /**
     * Columna [Es_Prestamo] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Muestra sí el lugar esta en prestamo 
     */
    public $Es_Prestamo;
    /**
     * Columna [Prestamo] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Nombre de la persona dueña a la que se presta el parqueo 
     */
    public $Prestamo;
    /**
     * Columna [Num_Lugar] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Número de lugar en el parqueo 
     */
    public $Num_Lugar;
    /**
     * Columna [Es_Externo] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Es personal del banco o externo 
     */
    public $Es_Externo;
    /**
     * Columna [Cedula] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Cédula de identidad de la persona que ocupa el espacio en el parqueo 
     */
    public $Cedula;
    /**
     * Columna [Placa] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Número de placa 
     */
    public $Placa;
    /**
     * Columna [Fecha_Entrada] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Fecha de entrada al parqueo 
     */
    public $Fecha_Entrada;
    /**
     * Columna [Hora_Entrada] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Hora de entrada al parqueo 
     */
    public $Hora_Entrada;
    /**
     * Columna [Fecha_Salida] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Fecha de salida del parqueo 
     */
    public $Fecha_Salida;
    /**
     * Columna [Hora_Salida] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Hora de salida del parqueo 
     */
    public $Hora_Salida;
    /**
     * Columna [Estado_Uso] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
     * Estado de uso D=Disponible O= Ocupado N=No disponible por alguna falla 
     */
    public $Estado_Uso;
    /**
     * Columna [Estado] de la tabla [t_recepcion_parqueo] en la clase [cls_recepcion_parqueo] 
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
     *Retorna el valor de la propiedad ID_RecepcionParqueo
     */
    function getID_RecepcionParqueo() {
        return $this->ID_RecepcionParqueo;
    }

    /**
     *Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function getID_Recepcion_Apertura() {
        return $this->ID_Recepcion_Apertura;
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
     *Retorna el valor de la propiedad ID_Tipo_Vehiculo
     */
    function getID_Tipo_Vehiculo() {
        return $this->ID_Tipo_Vehiculo;
    }

    /**
     *Retorna el valor de la propiedad Nombre
     */
    function getNombre() {
        return $this->Nombre;
    }

    /**
     *Retorna el valor de la propiedad Es_Prestamo
     */
    function getEs_Prestamo() {
        return $this->Es_Prestamo;
    }

    /**
     *Retorna el valor de la propiedad Prestamo
     */
    function getPrestamo() {
        return $this->Prestamo;
    }

    /**
     *Retorna el valor de la propiedad Num_Lugar
     */
    function getNum_Lugar() {
        return $this->Num_Lugar;
    }

    /**
     *Retorna el valor de la propiedad Es_Externo
     */
    function getEs_Externo() {
        return $this->Es_Externo;
    }

    /**
     *Retorna el valor de la propiedad Cedula
     */
    function getCedula() {
        return $this->Cedula;
    }

    /**
     *Retorna el valor de la propiedad Placa
     */
    function getPlaca() {
        return $this->Placa;
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
     * Retorna el valor de la propiedad ID_RecepcionParqueo
     */
    function setID_RecepcionParqueo($ID_RecepcionParqueo) {
        $this->ID_RecepcionParqueo = $ID_RecepcionParqueo;
    }

    /**
     * Retorna el valor de la propiedad ID_Recepcion_Apertura
     */
    function setID_Recepcion_Apertura($ID_Recepcion_Apertura) {
        $this->ID_Recepcion_Apertura = $ID_Recepcion_Apertura;
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
     * Retorna el valor de la propiedad ID_Tipo_Vehiculo
     */
    function setID_Tipo_Vehiculo($ID_Tipo_Vehiculo) {
        $this->ID_Tipo_Vehiculo = $ID_Tipo_Vehiculo;
    }

    /**
     * Retorna el valor de la propiedad Nombre
     */
    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    /**
     * Retorna el valor de la propiedad Es_Prestamo
     */
    function setEs_Prestamo($Es_Prestamo) {
        $this->Es_Prestamo = $Es_Prestamo;
    }

    /**
     * Retorna el valor de la propiedad Prestamo
     */
    function setPrestamo($Prestamo) {
        $this->Prestamo = $Prestamo;
    }

    /**
     * Retorna el valor de la propiedad Num_Lugar
     */
    function setNum_Lugar($Num_Lugar) {
        $this->Num_Lugar = $Num_Lugar;
    }

    /**
     * Retorna el valor de la propiedad Es_Externo
     */
    function setEs_Externo($Es_Externo) {
        $this->Es_Externo = $Es_Externo;
    }

    /**
     * Retorna el valor de la propiedad Cedula
     */
    function setCedula($Cedula) {
        $this->Cedula = $Cedula;
    }

    /**
     * Retorna el valor de la propiedad Placa
     */
    function setPlaca($Placa) {
        $this->Placa = $Placa;
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
     * Constructor: inicializa las variables de la clase cls_recepcion_parqueo
     */
    public function __construct() {
        $this->ID_RecepcionParqueo="";
        $this->ID_Recepcion_Apertura="";
        $this->ID_Persona="";
        $this->ID_Ubicacion="";
        $this->ID_Tipo_Vehiculo="";
        $this->Nombre="";
        $this->Es_Prestamo="";
        $this->Prestamo="";
        $this->Num_Lugar="";
        $this->Es_Externo="";
        $this->Cedula="";
        $this->Placa="";
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
    public function obtener_recepcion_parqueo() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_parqueo p inner join t_recepcion_ubicacion u on p.ID_Ubicacion = u.ID_Ubicacion ".
                    "inner join t_recepcion_tipovehiculo t on p.ID_Tipo_Vehiculo = t.ID_Tipo_Vehiculo ORDER BY p.Num_Lugar asc", 
                    "p.ID_RecepcionParqueo, p.ID_Recepcion_Apertura, p.ID_Persona, p.Es_Prestamo, ".
                    "p.ID_Ubicacion, p.ID_Tipo_Vehiculo, p.Nombre, ".
                    "p.Prestamo, p.Num_Lugar, p.Es_Externo, ".
                    "p.Cedula, p.Placa, p.Fecha_Entrada, ".
                    "p.Hora_Entrada, p.Fecha_Salida, p.Hora_Salida, ".
                    "p.Estado_Uso, p.Estado, u.Nombre Ubicacion, t.Descripcion, ".
                    "CASE WHEN p.Estado_Uso = 'D' THEN 'DISPONIBLE' WHEN p.Estado_Uso = 'O' THEN 'OCUPADO' ELSE p.Estado_Uso END EstadoUso ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_recepcion_parqueo p inner join t_recepcion_ubicacion u on p.ID_Ubicacion = u.ID_Ubicacion ".
                    "inner join t_recepcion_tipovehiculo t on p.ID_Tipo_Vehiculo = t.ID_Tipo_Vehiculo ", 
                    "p.ID_RecepcionParqueo, p.ID_Recepcion_Apertura, p.ID_Persona, p.Es_Prestamo, ".
                    "p.ID_Ubicacion, p.ID_Tipo_Vehiculo, p.Nombre, ".
                    "p.Prestamo, p.Num_Lugar, p.Es_Externo, ".
                    "p.Cedula, p.Placa, p.Fecha_Entrada, ".
                    "p.Hora_Entrada, p.Fecha_Salida, p.Hora_Salida, ".
                    "p.Estado_Uso, p.Estado, u.Nombre Ubicacion, t.Descripcion, ".
                    "CASE WHEN p.Estado_Uso = 'D' THEN 'DISPONIBLE' WHEN p.Estado_Uso = 'O' THEN 'OCUPADO' ELSE p.Estado_Uso END EstadoUso ", $this->condicion." ORDER BY p.Num_Lugar asc");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_recepcion_parqueo() {
        $this->obj_data_provider->conectar();
        if ($this->ID_RecepcionParqueo==0){
            $this->obj_data_provider->inserta_datos("t_recepcion_parqueo","ID_Recepcion_Apertura, ID_Persona, ID_Ubicacion, ID_Tipo_Vehiculo, Nombre, Es_Prestamo, Prestamo, Num_Lugar, Es_Externo, Cedula, Placa, Fecha_Entrada, Hora_Entrada, Fecha_Salida, Hora_Salida, Estado_Uso, Estado","'".$this->ID_Recepcion_Apertura."','".$this->ID_Persona."','".$this->ID_Ubicacion."','".$this->ID_Tipo_Vehiculo."','".$this->Nombre."','".$this->Es_Prestamo."','".$this->Prestamo."','".$this->Num_Lugar."','".$this->Es_Externo."','".$this->Cedula."','".$this->Placa."','".$this->Fecha_Entrada."','".$this->Hora_Entrada."','".$this->Fecha_Salida."','".$this->Hora_Salida."','".$this->Estado_Uso."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_recepcion_parqueo","ID_Recepcion_Apertura='".$this->ID_Recepcion_Apertura."',ID_Persona='".$this->ID_Persona."',ID_Ubicacion='".$this->ID_Ubicacion."',ID_Tipo_Vehiculo='".$this->ID_Tipo_Vehiculo."',Nombre='".$this->Nombre."',Es_Prestamo='".$this->Es_Prestamo."',Prestamo='".$this->Prestamo."',Num_Lugar='".$this->Num_Lugar."',Es_Externo='".$this->Es_Externo."',Cedula='".$this->Cedula."',Placa='".$this->Placa."',Fecha_Entrada='".$this->Fecha_Entrada."',Hora_Entrada='".$this->Hora_Entrada."',Fecha_Salida='".$this->Fecha_Salida."',Hora_Salida='".$this->Hora_Salida."',Estado_Uso='".$this->Estado_Uso."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_recepcion_parqueo(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_parqueo","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_parqueo_reservar() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_recepcion_parqueo","ID_Recepcion_Apertura='".$this->ID_Recepcion_Apertura."',Es_Prestamo='".$this->Es_Prestamo."',Prestamo='".$this->Prestamo."',Cedula='".$this->Cedula."',Placa='".$this->Placa."',Fecha_Entrada='".$this->Fecha_Entrada."',Hora_Entrada='".$this->Hora_Entrada."',Estado_Uso='".$this->Estado_Uso."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}