<?php
class cls_personal{
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $id;
    public $id2;
    public $cedula;
    public $apellidonombre;
    public $empresa;
    public $gafete;
    public $correo;
    public $direccion;
    public $linkfoto;
    public $observaciones;
    public $estado;
    
    function getGafete() {
        return $this->gafete;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setGafete($gafete) {
        $this->gafete = $gafete;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }
    
    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
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
        $this->empresa="";
        $this->gafete="";
        $this->correo="";
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
                    " T_Personal.*,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
			GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero,
                        T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
			T_Puesto.ID_Puesto, T_Puesto.Puesto",
                    "(T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '4'OR 
			T_TipoTelefono.ID_Tipo_Telefono = '27') group by T_Personal.ID_Persona");
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
                    "T_Personal.*,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
			T_Telefono.Numero,T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
			T_Puesto.ID_Puesto, T_Puesto.Puesto",
                    "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '4' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '27') ORDER BY T_Personal.Apellido_Nombre");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_gerentes_zona_bcr(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_GerenteZonaBCR
			LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona
			LEFT OUTER JOIN T_Telefono ON T_GerenteZonaBCR.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                    "T_GerenteZonaBCR.*, 
			T_Personal.Apellido_Nombre,
			GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                    "(T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			  T_TipoTelefono.ID_Tipo_Telefono = '4') 
			  GROUP BY T_GerenteZonaBCR.ID_Gerente_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_GerenteZonaBCR
			LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona
			LEFT OUTER JOIN T_Telefono ON T_GerenteZonaBCR.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                    "T_GerenteZonaBCR.*, 
			T_Personal.Apellido_Nombre,
			GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                    "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			  T_TipoTelefono.ID_Tipo_Telefono = '4') 
			  GROUP BY T_GerenteZonaBCR.ID_Gerente_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_supervisor_zona(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_SupervisorZona
			LEFT OUTER JOIN T_Personal ON T_SupervisorZona.ID_Persona = T_Personal.ID_Persona
			LEFT OUTER JOIN T_Telefono ON T_Personal.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                    "T_SupervisorZona.*, 
			T_Personal.Apellido_Nombre,
			GROUP_CONCAT(T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                    "(T_TipoTelefono.ID_Tipo_Telefono = '3')
			GROUP BY T_SupervisorZona.ID_Supervisor_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_SupervisorZona
			LEFT OUTER JOIN T_Personal ON T_SupervisorZona.ID_Persona = T_Personal.ID_Persona
			LEFT OUTER JOIN T_Telefono ON T_Personal.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                    "T_SupervisorZona.*, 
			T_Personal.Apellido_Nombre,
			GROUP_CONCAT(T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                    "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '3')
			GROUP BY T_SupervisorZona.ID_Supervisor_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function actualizar_estado_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_todos_puestos(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Puesto", "*", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function cambiar_ue_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "ID_Unidad_Ejecutora='".$this->id2."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function cambiar_puesto_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "ID_Puesto='".$this->id2."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_informacion_general_persona() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "Cedula='".$this->cedula."', Apellido_Nombre='".$this->apellidonombre."', Correo='".$this->correo."', Numero_Gafete='".$this->gafete."', Direccion='".$this->direccion."', Observaciones='".$this->observaciones."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}?>