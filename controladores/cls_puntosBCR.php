<?php
class cls_puntosBCR{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $nombre;
    public $direccion;
    public $codigo;
    public $cuentasis;
    public $diaslaborales;
    public $horaslaborales;
    public $observaciones;
    public $estado;
    public $tipo_punto;
    public $distrito;
    public $empresa;
    
    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function getTipo_punto() {
        return $this->tipo_punto;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function setTipo_punto($tipo_punto) {
        $this->tipo_punto = $tipo_punto;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }
    
    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
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

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getCuentasis() {
        return $this->cuentasis;
    }

    function getDiaslaborales() {
        return $this->diaslaborales;
    }

    function getHoraslaborales() {
        return $this->horaslaborales;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setCuentasis($cuentasis) {
        $this->cuentasis = $cuentasis;
    }

    function setDiaslaborales($diaslaborales) {
        $this->diaslaborales = $diaslaborales;
    }

    function setHoraslaborales($horaslaborales) {
        $this->horaslaborales = $horaslaborales;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->arreglo;
        $this->nombre="";
        $this->direccion="";
        $this->codigo="";
        $this->cuentasis="";
        $this->diaslaborales="";
        $this->horaslaborales="";
        $this->observaciones="";
        $this->estado="";
        $this->tipo_punto="";
        $this->distrito="";
        $this->empresa="";
    }
    
    public function obtiene_todos_los_puntos_bcr(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuntoBCR
			LEFT OUTER JOIN T_Horario ON T_PuntoBCR.ID_Horario= T_Horario.ID_Horario
			LEFT OUTER JOIN T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
			LEFT OUTER JOIN T_Empresa ON T_PuntoBCR.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Distrito ON T_PuntoBCR.ID_Distrito = T_Distrito.ID_Distrito
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora", 
                    "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Direccion, T_PuntoBCR.Codigo, 
			T_PuntoBCR.Cuenta_SIS, T_PuntoBCR.Observaciones, T_PuntoBCR.Estado, 
                        T_PuntoBCR.ID_Gerente_Zona, T_PuntoBCR.ID_Supervisor_Zona,
			T_Horario.ID_Horario, T_Horario.Dia_Laboral, T_Horario.Hora_Laboral,
			T_TipoPuntoBCR.ID_Tipo_Punto, T_TipoPuntoBCR.Tipo_Punto,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_Distrito.ID_Distrito, T_Distrito.Nombre_Distrito,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuntoBCR
			LEFT OUTER JOIN T_Horario ON T_PuntoBCR.ID_Horario= T_Horario.ID_Horario
			LEFT OUTER JOIN T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
			LEFT OUTER JOIN T_Empresa ON T_PuntoBCR.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Distrito ON T_PuntoBCR.ID_Distrito = T_Distrito.ID_Distrito
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora", 
                    "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Direccion, T_PuntoBCR.Codigo, 
			T_PuntoBCR.Cuenta_SIS, T_PuntoBCR.Observaciones, T_PuntoBCR.Estado,
                        T_PuntoBCR.ID_Gerente_Zona, T_PuntoBCR.ID_Supervisor_Zona,
			T_Horario.ID_Horario, T_Horario.Dia_Laboral, T_Horario.Hora_Laboral,
			T_TipoPuntoBCR.ID_Tipo_Punto, T_TipoPuntoBCR.Tipo_Punto,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_Distrito.ID_Distrito, T_Distrito.Nombre_Distrito,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_los_tipo_puntos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoPuntoBCR", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoPuntoBCR", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } 
    }
    
    
    
    public function obtiene_unidades_ejecutoras(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_UnidadEjecutora
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;  
    }
    
    public function obtiene_distritos(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Distrito", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "distrito x2";
    }
    
    public function obtiene_cantones(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Canton", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "canton x2";
    }
    
    public function obtiene_provincias(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Provincia", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "provincia x2";
    }
    
    public function actualizar_ubicacion_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Distrito='".$this->id."', ". "Direccion='".$this->direccion."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_informacion_general_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("T_PuntoBCR", "Codigo='".$this->codigo."', ". "Cuenta_SIS='".$this->cuentasis."', "."Nombre='".$this->nombre."', "."ID_Tipo_Punto='".$this->id."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    
    
    public function guardar_punto_bcr(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_PuntoBCR", "`ID_PuntoBCR`, `Nombre`, `Direccion`, `Codigo`, `Cuenta_SIS`, `ID_Horario`, `ID_Tipo_Punto`, `ID_Empresa`, `ID_Gerente_Zona`, `ID_Supervisor_Zona`, `ID_Distrito`, `Observaciones`, `Estado`", "'".$this->id."','".$this->nombre."','".$this->direccion."','".$this->codigo."','".$this->cuentasis."','".$this->horaslaborales."','".$this->tipo_punto."','".$this->empresa."','"."1"."','"."1"."','".$this->distrito."','".$this->observaciones."','".$this->estado."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}?>