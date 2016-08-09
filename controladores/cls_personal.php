<?php
class cls_personal{
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $id;
    public $id2;
    public $cedula;
    public $apellidonombre;
    public $direccion;
    public $linkfoto;
    public $observaciones;
    public $estado;
    
    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getApellidonombre() {
        return $this->apellidonombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getLinkfoto() {
        return $this->linkfoto;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
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

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setApellidonombre($apellidonombre) {
        $this->apellidonombre = $apellidonombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setLinkfoto($linkfoto) {
        $this->linkfoto = $linkfoto;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        
    public function __construct() {
       
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->id="";
        $this->id2="";
        $this->cedula="";
        $this->apellidonombre="";
        $this->direccion="";
        $this->linkfoto;
        $this->observaciones="";
        $this->estado="";
        $this->arreglo;
    }
    
    public function obtiene_todo_el_personal(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Personal
			LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
			LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
			LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                    "T_Personal.ID_Persona, T_Personal.Cedula, T_Personal.Apellido_Nombre, T_Personal.Direccion,
			T_Personal.Link_Foto, T_Personal.Observaciones, T_Personal.Estado,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_TipoTelefono.Tipo_Telefono, 
			T_Telefono.Numero,
			T_Puesto.ID_Puesto, T_Puesto.Puesto",
                    "(T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '4')");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Personal
			LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
			LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
			LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                    "T_Personal.ID_Persona, T_Personal.Cedula, T_Personal.Apellido_Nombre, T_Personal.Direccion,
			T_Personal.Link_Foto, T_Personal.Observaciones, T_Personal.Estado,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_TipoTelefono.Tipo_Telefono, 
			T_Telefono.Numero,
			T_Puesto.ID_Puesto, T_Puesto.Puesto",
                    "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '4') ORDER BY T_Personal.Apellido_Nombre");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
}?>