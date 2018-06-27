<?php
class cls_empresa{
    public $id;
    public $empresa;
    public $observaciones;
    public $estado;
    public $cedula_juridica;
    public $id_externo;
    public $telefono;
    public $direccion;
    public $tipo_empresa;
    public $id_ue;
    public $id_persona;
    public $fecha_inicio;
    public $fecha_final;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getCedula_juridica() {
        return $this->cedula_juridica;
    }

    function getId_externo() {
        return $this->id_externo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTipo_empresa() {
        return $this->tipo_empresa;
    }

    function getId_ue() {
        return $this->id_ue;
    }

    function getId_persona() {
        return $this->id_persona;
    }

    function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    function getFecha_final() {
        return $this->fecha_final;
    }

    function setCedula_juridica($cedula_juridica) {
        $this->cedula_juridica = $cedula_juridica;
    }

    function setId_externo($id_externo) {
        $this->id_externo = $id_externo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTipo_empresa($tipo_empresa) {
        $this->tipo_empresa = $tipo_empresa;
    }

    function setId_ue($id_ue) {
        $this->id_ue = $id_ue;
    }

    function setId_persona($id_persona) {
        $this->id_persona = $id_persona;
    }

    function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    function setFecha_final($fecha_final) {
        $this->fecha_final = $fecha_final;
    }
 
    function getId() {
        return $this->id;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
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

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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
        $this->id="";
        $this->empresa="";
        $this->observaciones="";
        $this->estado="";
        $this->cedula_juridica;
        $this->id_externo="";
        $this->telefono="";
        $this->direccion="";
        $this->tipo_empresa="";
        $this->id_ue="";
        $this->id_persona="";
        $this->fecha_inicio="";
        $this->fecha_final="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    function obtiene_todas_las_empresas(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Empresa 
                LEFT OUTER JOIN T_PersonalExterno ON T_PersonalExterno.ID_Persona_Externa = T_Empresa.ID_Persona_Externa
                LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Empresa.ID_Persona
                LEFT OUTER JOIN T_UnidadEjecutora ON T_UnidadEjecutora.ID_Unidad_Ejecutora = T_Empresa.ID_Unidad_Ejecutora", 
                "T_Empresa.*, T_PersonalExterno.Nombre as Nombre_Externo, T_PersonalExterno.Apellido as Apellido_Externo, 
                T_Personal.Apellido_Nombre, T_UnidadEjecutora.Departamento", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
       
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Empresa LEFT OUTER JOIN T_PersonalExterno ON T_PersonalExterno.ID_Persona_Externa = T_Empresa.ID_Persona_Externa
                LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Empresa.ID_Persona
                LEFT OUTER JOIN T_UnidadEjecutora ON T_UnidadEjecutora.ID_Unidad_Ejecutora = T_Empresa.ID_Unidad_Ejecutora", 
                "T_Empresa.*, T_PersonalExterno.Nombre as Nombre_Externo, T_PersonalExterno.Apellido as Apellido_Externo,
                T_Personal.Apellido_Nombre, T_UnidadEjecutora.Departamento", 
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_empresa() {
        $this->obj_data_provider->conectar();
        if ($this->id==0){
            $this->obj_data_provider->inserta_datos("T_Empresa","Empresa, Observaciones, Estado, Cedula_Juridica, ID_Persona_Externa, Telefono_Empresa, Direccion, Tipo_Empresa, ID_Unidad_Ejecutora, ID_Persona, Fecha_Inicio, Fecha_Final",
                    "'".$this->empresa."','".$this->observaciones."','".$this->estado."','".$this->cedula_juridica."','".$this->id_externo."','".$this->telefono."','".$this->direccion."','".$this->tipo_empresa."','".$this->id_ue."','".$this->id_persona."','".$this->fecha_inicio."','".$this->fecha_final."'");
        }else{
            $this->obj_data_provider->edita_datos("T_Empresa", "Empresa='".$this->empresa."', Observaciones='".$this->observaciones
                ."', Estado='".$this->estado."', Cedula_Juridica='".$this->cedula_juridica."', ID_Persona_Externa='".$this->id_externo.
                "', Telefono_Empresa='".$this->telefono."', Direccion='".$this->direccion."', Tipo_Empresa='".$this->tipo_empresa.
                "', ID_Unidad_Ejecutora='".$this->id_ue."', ID_Persona='".$this->id_persona."', Fecha_Inicio='".$this->fecha_inicio.
                "', Fecha_Final='".$this->fecha_final."'",
                "ID_Empresa=".$this->id);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
} ?>
