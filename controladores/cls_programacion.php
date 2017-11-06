<?php

class cls_programacion{
    private $id;
    private $fecha;
    private $hora;
    private $usuario;
    private $persona;
    private $autoriza;
    private $ue;
    private $tipo;
    private $vencimiento;
    private $confirmacion;
    private $detalle;
    private $seguimiento;
    private $adjunto;
    private $gafete;
    private $empresa;
    private $condicion; 
    public $obj_data_provider;
    public $arreglo;
    
    //Constructor de la clase, permite inicializar atributos de la clase
    public function __construct(){
        $this->id="";
        $this->fecha="";
        $this->hora="";
        $this->usuario="";
        $this->persona="";
        $this->autoriza="";
        $this->ue="";
        $this->tipo="";
        $this->vencimiento="";
        $this->confirmacion="";
        $this->detalle="";
        $this->seguimiento="";
        $this->adjunto="";
        $this->gafete="";
        $this->empresa="";
        $this->condicion=""; 
        $this->arreglo="";
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
    }  
  
    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPersona() {
        return $this->persona;
    }

    function getAutoriza() {
        return $this->autoriza;
    }

    function getUe() {
        return $this->ue;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getVencimiento() {
        return $this->vencimiento;
    }

    function getConfirmacion() {
        return $this->confirmacion;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function getSeguimiento() {
        return $this->seguimiento;
    }

    function getAdjunto() {
        return $this->adjunto;
    }

    function getGafete() {
        return $this->gafete;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPersona($persona) {
        $this->persona = $persona;
    }

    function setAutoriza($autoriza) {
        $this->autoriza = $autoriza;
    }

    function setUe($ue) {
        $this->ue = $ue;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;
    }

    function setConfirmacion($confirmacion) {
        $this->confirmacion = $confirmacion;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function setSeguimiento($seguimiento) {
        $this->seguimiento = $seguimiento;
    }

    function setAdjunto($adjunto) {
        $this->adjunto = $adjunto;
    }

    function setGafete($gafete) {
        $this->gafete = $gafete;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

        
    function obtiene_programaciones(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_programacion 
                INNER JOIN t_usuario on t_usuario.ID_Usuario = t_programacion.ID_Usuario
                INNER JOIN t_personal on t_personal.ID_Persona = t_programacion.ID_Persona_Autoriza
                INNER JOIN t_unidadejecutora ON t_unidadejecutora.ID_Unidad_Ejecutora = t_programacion.ID_Unidad_Ejecutora", 
                    "t_programacion.*,t_usuario.Nombre, t_usuario.Apellido, 
                    t_unidadejecutora.Departamento, T_Personal.Apellido_Nombre",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_programacion 
                INNER JOIN t_usuario on t_usuario.ID_Usuario = t_programacion.ID_Usuario
                INNER JOIN t_personal on t_personal.ID_Persona = t_programacion.ID_Persona_Autoriza
                INNER JOIN t_unidadejecutora ON t_unidadejecutora.ID_Unidad_Ejecutora = t_programacion.ID_Unidad_Ejecutora", 
                    "t_programacion.*,t_usuario.Nombre, t_usuario.Apellido, 
                    t_unidadejecutora.Departamento, T_Personal.Apellido_Nombre",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    function obtiene_programaciones_externos(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Programacion", "*", "");
            $this->arreglo_roles=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Programacion", "*", $this->condicion);
            $this->arreglo_roles=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    function guardar_programacion(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_Programacion", "Fecha,Hora, ID_Usuario, ID_Persona, ID_Empresa, ID_Persona_Autoriza,
                ID_Unidad_Ejecutora, Tipo_Solicitud, Numero_Gafete, Fecha_Vencimiento, Detalle, Confirmacion, Adjunto, Seguimiento", 
                "'".$this->fecha."','".$this->hora."','".$this->usuario."','".$this->persona."','".$this->empresa."','".$this->autoriza."','".
                $this->ue."','".$this->tipo."','".$this->gafete."','".$this->vencimiento."','".$this->detalle."','".$this->confirmacion."','".$this->adjunto."','".$this->seguimiento."'");
        $this->obj_data_provider->trae_datos("T_Programacion","Max(ID_Programacion) as ID_Programacion","");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
    
  
    function guardar_programacion_modulo($id,$listaModulos){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_ProgramacionModulo", "ID_Programacion=".$id);
        for ($i = 0; $i< count($listaModulos); $i++) {
            $this->obj_data_provider->inserta_datos("T_ProgramacionModulo", "ID_Programacion,ID_Modulo_Puerta_Controlada", $id.",'".$listaModulos[$i]."'");
        }
       $this->obj_data_provider->desconectar();
       $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    } 

    function obtiene_modulos_programados(){
         $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la consulta a la bd
        $this->obj_data_provider->trae_datos("t_programacionModulo
            INNER JOIN t_modulopuertacontrolada ON t_modulopuertacontrolada.ID_Modulo_Puerta_Controlada = t_programacionModulo.ID_Modulo_Puerta_Controlada", 
                "*",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
}