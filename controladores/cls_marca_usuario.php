<?php
class cls_marca_usuario {
    public $id;
    public $id2;
    public $usuario;
    public $entrada;
    public $salida;
    public $tipo;
    public $estado;
    public $tiempo;
    public $detalle;
    public $observaciones;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEntrada() {
        return $this->entrada;
    }

    function getSalida() {
        return $this->salida;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEntrada($entrada) {
        $this->entrada = $entrada;
    }

    function setSalida($salida) {
        $this->salida = $salida;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }
    
    function getTiempo() {
        return $this->tiempo;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->usuario="";
        $this->entrada="";
        $this->salida="";
        $this->tipo="";
        $this->estado="";
        $this->tiempo="";
        $this->detalle="";
        $this->observaciones="";
        $this->obj_data_provider= new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    ///////////FUNCIONES PARA MARCAS//////////////////
    public function guardar_marca_entrada(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_Marca", "ID_Usuario, Marca_Entrada, Tipo_Marca, Estado_Marca", 
            "'".$this->usuario."','".$this->entrada."','".$this->tipo."','".$this->estado."'");
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Marca","max(ID_Marca) ID_Marca","");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
    
    public function guardar_marca_salida(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_Marca","Marca_Salida='".$this->salida."',Tipo_Marca='".$this->tipo."', Estado_Marca='".$this->estado."'",
            "T_Marca.ID_Marca='".$this->id."'");
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    public function obtener_marcas(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Marca LEFT OUTER JOIN T_Usuario ON T_Usuario.ID_Usuario = T_Marca.ID_Usuario", 
                    "T_Marca.*, T_Usuario.Nombre, T_Usuario.Apellido", 
                    "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Marca LEFT OUTER JOIN T_Usuario ON T_Usuario.ID_Usuario = T_Marca.ID_Usuario", 
                    "T_Marca.*, T_Usuario.Nombre, T_Usuario.Apellido",
                    $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    ///////////FUNCIONES PARA DESCANSOS//////////////////
    public function obtener_descansos(){
       $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_AjusteDescanso", 
                    "*", 
                    "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_AjusteDescanso", 
                    "*",
                    $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
    }
    
    public function guardar_ajuste_descanso_usuario(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->obj_data_provider->inserta_datos("T_AjusteDescanso", "ID_Usuario, Tiempo, Detalle, Estado", 
                "'".$this->usuario."','".$this->tiempo."','".$this->detalle."','".$this->estado."'");
        } else {
            $this->obj_data_provider->edita_datos("T_AjusteDescanso", "Tiempo='".$this->tiempo."', Detalle='".$this->detalle."'", $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar(); 
    }
    
    public function eliminar_descanso_usuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_AjusteDescanso", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
    
    ///////////FUNCIONES PARA INCONSISTENCIAS//////////////////
    public function obtener_inconsistencias_marcas(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_InconsistenciaMarca 
                LEFT OUTER JOIN t_tipoinconsistencia  ON t_tipoinconsistencia.ID_Tipo_Inconsistencia = t_inconsistenciamarca.ID_Tipo_Inconsistencia
                LEFT OUTER JOIN T_EstadoInconsistencia  ON T_EstadoInconsistencia.ID_Estado_Inconsistencia = t_inconsistencia_marca.ID_Estado_Inconsistencia
                LEFT OUTER JOIN T_Usuario ON T_Usuario.ID_Usuario = T_InconsistenciaMarca.ID_Usuario", 
                    "T_InconsistenciaMarca.*, t_tipoinconsistencia.*, T_EstadoInconsistencia.*, T_Usuario.Nombre, T_Usuario.Apellido", 
                    "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_InconsistenciaMarca 
                LEFT OUTER JOIN t_tipoinconsistencia ON t_tipoinconsistencia.ID_Tipo_Inconsistencia = t_inconsistenciamarca.ID_Tipo_Inconsistencia
                LEFT OUTER JOIN T_EstadoInconsistencia ON T_EstadoInconsistencia.ID_Estado_Inconsistencia = t_inconsistenciamarca.ID_Estado_Inconsistencia
                LEFT OUTER JOIN T_Usuario ON T_Usuario.ID_Usuario = T_InconsistenciaMarca.ID_Usuario", 
                    "T_InconsistenciaMarca.*, t_tipoinconsistencia.*, T_EstadoInconsistencia.*, T_Usuario.Nombre, T_Usuario.Apellido",
                    $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
    }
    
    public function guardar_inconsistencia(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_InconsistenciaMarca ", "ID_Usuario, ID_Marca, Fecha_Inconsistencia, ID_Tipo_Inconsistencia, ID_Estado_Inconsistencia", 
            "'".$this->usuario."','".$this->id."','".$this->entrada."','".$this->tipo."','".$this->estado."'");
        $this->obj_data_provider->trae_datos("T_InconsistenciaMarca","max(ID_Inconsistencia_Marca) ID_Inconsistencia_Marca","");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
}
