<?php
class cls_biblioteca {
    public $ID_Biblioteca;
    public $Nombre;
    public $Tipo_Documento;
    public $Archivo;
    public $Link;
    public $Fecha_Hora;
    public $ID_Usuario;
    public $Descripcion;
    public $Seguridad;
    public $Estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;

    function getID_Biblioteca() {
        return $this->ID_Biblioteca;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getTipo_Documento() {
        return $this->Tipo_Documento;
    }

    function getArchivo() {
        return $this->Archivo;
    }

    function getLink() {
        return $this->Link;
    }

    function getFecha_Hora() {
        return $this->Fecha_Hora;
    }

    function getID_Usuario() {
        return $this->ID_Usuario;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getSeguridad() {
        return $this->Seguridad;
    }

    function getEstado() {
        return $this->Estado;
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

    function setID_Biblioteca($ID_Biblioteca) {
        $this->ID_Biblioteca = $ID_Biblioteca;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setTipo_Documento($Tipo_Documento) {
        $this->Tipo_Documento = $Tipo_Documento;
    }

    function setArchivo($Archivo) {
        $this->Archivo = $Archivo;
    }

    function setLink($Link) {
        $this->Link = $Link;
    }

    function setFecha_Hora($Fecha_Hora) {
        $this->Fecha_Hora = $Fecha_Hora;
    }

    function setID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    function setSeguridad($Seguridad) {
        $this->Seguridad = $Seguridad;
    }

    function setEstado($Estado) {
        $this->Estado = $Estado;
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

        
    public function __construct() {
        $this->ID_Biblioteca="";
        $this->Nombre="";
        $this->Tipo_Documento="";
        $this->Archivo="";
        $this->Link="";
        $this->Fecha_Hora="";
        $this->ID_Usuario="";
        $this->Descripcion="";
        $this->Seguridad="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }
    
    public function obtener_estado_Biblioteca_Todos(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Biblioteca", "ID_Biblioteca,(CASE Seguridad WHEN 1 THEN 'Privado' WHEN 2 THEN 'Coordinador BCR' WHEN 3 THEN 'Coordinador Empresa' WHEN 4 THEN 'General' END) AS 'SeguridadDes' ,(CASE Tipo_Documento WHEN 1 THEN 'Normativa' WHEN 2 THEN 'Manuales' WHEN 3 THEN 'Noticias' WHEN 4 THEN 'Otros' END) AS 'Tipo_DocumentoDes' ,Nombre, Tipo_Documento, Archivo, Link, Fecha_Hora, ID_Usuario, Descripcion, Seguridad, Estado", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Biblioteca", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_Biblioteca() {
        $this->obj_data_provider->conectar();        
        if ($this->ID_Biblioteca==0){
            $this->obj_data_provider->inserta_datos("T_Biblioteca","Nombre, Tipo_Documento, Archivo, Link, Fecha_Hora, ID_Usuario, Descripcion, Seguridad, Estado",
                    "'".$this->Nombre."','".$this->Tipo_Documento."','".$this->Archivo."','".$this->Link."','".$this->Fecha_Hora."','".$this->ID_Usuario."','".$this->Descripcion."','".$this->Seguridad."','".$this->Estado."'");
        }else{            
            $this->obj_data_provider->edita_datos("T_Biblioteca", "Nombre='".$this->Nombre."', Tipo_Documento='".$this->Tipo_Documento
                ."', Archivo='".$this->Archivo."', Link='".$this->Link."', Fecha_Hora='".$this->Fecha_Hora.
                "', ID_Usuario='".$this->ID_Usuario."', Descripcion='".$this->Descripcion."', Seguridad='".$this->Seguridad.
                "', Estado='".$this->Estado."'", $this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    /*Método actualiza el Estado */
    public function cambiar_estado_biblioteca(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_biblioteca","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
}
?>