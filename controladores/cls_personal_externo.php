<?php
class cls_personal_externo{
    public $obj_data_provider;
    public $arreglo;
    public $arreglo2;
    private $condicion;
    public $id;
    public $id2;
    public $identificacion;
    public $apellido;
    public $nombre;
    public $fecha_nacimiento;
    public $fecha_residencia;
    public $fecha_portacion;
    public $fecha_ingreso;
    public $fecha_salida;
    public $correo;
    public $genero;
    public $direccion;
    public $distrito;
    public $estado_civil;
    public $nacionalidad;
    public $nivel_academico;
    public $empresa;
    public $estado_persona;
    public $validado;
    public $observaciones;
    public $ocupacion;
    
    
    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getArreglo2() {
        return $this->arreglo2;
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

    function getIdentificacion() {
        return $this->identificacion;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    function getFecha_residencia() {
        return $this->fecha_residencia;
    }

    function getFecha_portacion() {
        return $this->fecha_portacion;
    }

    function getFecha_ingreso() {
        return $this->fecha_ingreso;
    }

    function getFecha_salida() {
        return $this->fecha_salida;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getGenero() {
        return $this->genero;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function getNivel_academico() {
        return $this->nivel_academico;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getEstado_persona() {
        return $this->estado_persona;
    }

    function getValidado() {
        return $this->validado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setArreglo2($arreglo2) {
        $this->arreglo2 = $arreglo2;
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

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    function setFecha_residencia($fecha_residencia) {
        $this->fecha_residencia = $fecha_residencia;
    }

    function setFecha_portacion($fecha_portacion) {
        $this->fecha_portacion = $fecha_portacion;
    }

    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    function setFecha_salida($fecha_salida) {
        $this->fecha_salida = $fecha_salida;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    function setNivel_academico($nivel_academico) {
        $this->nivel_academico = $nivel_academico;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setEstado_persona($estado_persona) {
        $this->estado_persona = $estado_persona;
    }

    function setValidado($validado) {
        $this->validado = $validado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

        
    
        
    public function __construct() {
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo="";
        $this->arreglo2="";
        $this->condicion="";
        $this->id="";
        $this->id2="";
        $this->identificacion="";
        $this->apellido="";
        $this->nombre="";
        $this->fecha_nacimiento="";
        $this->fecha_residencia="";
        $this->fecha_portacion="";
        $this->fecha_ingreso="";
        $this->fecha_salida="";
        $this->correo="";
        $this->genero="";
        $this->direccion="";
        $this->distrito="";
        $this->estado_civil="";
        $this->nacionalidad="";
        $this->nivel_academico="";
        $this->empresa="";
        $this->estado_persona="";
        $this->validado="";
        $this->observaciones="";
        $this->ocupacion="";
    }
    
    //Funcion para obtener personal externo 
    public function obtiene_todo_el_personal_externo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PersonalExterno
                        LEFT OUTER JOIN T_Empresa ON T_Empresa.ID_Empresa = T_PersonalExterno.ID_Empresa
                        LEFT OUTER JOIN T_EstadoPersona ON T_EstadoPersona.ID_Estado_Persona = T_PersonalExterno.ID_Estado_Persona", 
                    "T_PersonalExterno.*,T_EstadoPersona.*,
                        T_Empresa.ID_Empresa, T_Empresa.Empresa",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PersonalExterno
                        LEFT OUTER JOIN T_Empresa ON T_Empresa.ID_Empresa = T_PersonalExterno.ID_Empresa
                        LEFT OUTER JOIN T_EstadoPersona ON T_EstadoPersona.ID_Estado_Persona = T_PersonalExterno.ID_Estado_Persona", 
                    "T_PersonalExterno.*,T_EstadoPersona.*,
                        T_Empresa.ID_Empresa, T_Empresa.Empresa",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    /*
    public function agregar_nueva_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_personal", "Cedula,Apellido_Nombre,ID_Unidad_Ejecutora,ID_Puesto,Direccion,Link_Foto,ID_Empresa,Observaciones,Estado", "'".$this->cedula."','".$this->apellidonombre."',".$this->id_unidad_ejecutora.",".$this->id_puesto.",'".$this->direccion."','".$this->linkfoto."',".$this->id_empresa.",'".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }   
       
    
  
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultima_persona_ingresada(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_personal","max(ID_Persona) ID_Persona","");
        $this->arreglo2=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        if (count($this->arreglo2)>0){
            $this->setId_ultima_persona_ingresada($this->arreglo2[0]['ID_Persona']);
        }else{
            $this->setId_ultima_persona_ingresada(0);
        }   
    }
    
    public function actualizar_estado_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }*/
    
    function guardar_informacion_persona_externa(){
        //Valida si el formulario tiene condición, enviada desde el controlador
        //Si tiene condición editará una persona
        //Si no, creará una persona nueva
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PersonalExterno", "`ID_Persona_Externa`, `Identificacion`, `Apellido`, `Nombre`, `Fecha_Nacimiento`, `Fecha_Vencimiento_Residencia`, `Fecha_Vencimiento_Portacion`, `Fecha_Ingreso`, `Fecha_Salida`, `Correo`, `Genero`, `Direccion`, `ID_Distrito`, `ID_Estado_Civil`, `ID_Nacionalidad`, `ID_Nivel_Academico`, `ID_Empresa`, `ID_Estado_Persona`, `Validado`, `Observaciones`, `Ocupacion`", 
                                                "null,'".$this->identificacion."','".$this->apellido."','".$this->nombre."','".$this->fecha_nacimiento."','".$this->fecha_residencia."','".$this->fecha_portacion."','".$this->fecha_ingreso."','".$this->fecha_salida."','".$this->correo."','".$this->genero."','".$this->direccion."','".$this->distrito."','".$this->estado_civil."','".$this->nacionalidad."','".$this->nivel_academico."','".$this->empresa."','".$this->estado_persona."','".$this->validado."','".$this->observaciones."','".$this->ocupacion."'");
            $this->obj_data_provider->trae_datos("T_PersonalExterno","max(ID_Persona_Externa) ID_Persona_Externa","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PersonalExterno","Identificacion='".$this->identificacion."',Apellido='".$this->apellido."',Nombre='".$this->nombre."',Fecha_Nacimiento='".$this->fecha_nacimiento."',Fecha_Vencimiento_Residencia='".$this->fecha_residencia."',Fecha_Vencimiento_Portacion='".$this->fecha_portacion."',Fecha_Ingreso='".$this->fecha_ingreso."',Fecha_Salida='".$this->fecha_salida."',Correo='".$this->correo."', Genero='".$this->genero.
                    "', Direccion='".$this->direccion."', ID_Distrito='".$this->distrito."', ID_Estado_Civil='".$this->estado_civil."', ID_Nacionalidad='".$this->nacionalidad."', ID_Nivel_Academico='".$this->nivel_academico."', ID_Empresa='".$this->empresa."', ID_Estado_Persona='".$this->estado_persona."', Validado='".$this->validado."', Observaciones='".$this->observaciones."', Ocupacion='".$this->ocupacion."'",$this->condicion);
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
}?>