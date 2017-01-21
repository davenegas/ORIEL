<?php
class cls_cencon {
    public $id;
    public $id2;
    public $cedula;
    public $empresa;
    public $fecha;
    public $hora;
    public $usuario;
    public $observaciones;
    public $obj_data_provider;
    public $arreglo;
    private $condicion; 

    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
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

    function setCedula($cedula) {
        $this->cedula = $cedula;
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
    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->cedula="";
        $this->empresa="";
        $this->fecha="";
        $this->hora="";
        $this->usuario="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        
    }
        
    public function agregar_relacion(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_Cencon", "ID_PuntoBCR, ID_Persona, ID_Empresa, Cedula_Cencon","'".$this->id."','".$this->id2."', '".$this->empresa."','".$this->cedula."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_todas_relaciones(){
        $this->obj_data_provider->conectar();
        if($this->empresa==1){
            //Obtiene informacion del personal del BCR
            if($this->condicion==""){
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon
                        LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Cencon.ID_PuntoBCR
                        LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Cencon.ID_Persona", 
                        "*, T_Cencon.Observaciones as Observaciones_Cencon, T_PuntoBCR.Nombre as Nombre_Punto", 
                        "");
            }
            else{
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon 
                        LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Cencon.ID_PuntoBCR
                        LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Cencon.ID_Persona", 
                        "*, T_Cencon.Observaciones as Observaciones_Cencon, T_PuntoBCR.Nombre as Nombre_Punto",
                        $this->condicion);
            }
        }
        //Obtiene informacion del personal externo
        if($this->empresa<>1) {
            if($this->condicion==""){
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon
                        LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Cencon.ID_PuntoBCR
                        LEFT OUTER JOIN T_PersonalExterno ON T_PersonalExterno.ID_Persona_Externa = T_Cencon.ID_Persona", 
                        "*, T_Cencon.Observaciones as Observaciones_Cencon, T_PuntoBCR.Nombre as Nombre_Punto", 
                        "");
            }
            else{
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon 
                        LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Cencon.ID_PuntoBCR
                        LEFT OUTER JOIN T_PersonalExterno ON T_PersonalExterno.ID_Persona_Externa = T_Cencon.ID_Persona", 
                        "*, T_Cencon.Observaciones as Observaciones_Cencon, T_PuntoBCR.Nombre as Nombre_Punto",
                        $this->condicion);
            }
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function eliminar_relacion_persona_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_Cencon", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
    
    public function buscar_persona_cencon(){
       $this->obj_data_provider->conectar();
            if($this->condicion==""){
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon", 
                        "*", 
                        "");
            }else{
                $this->arreglo=$this->obj_data_provider->trae_datos("T_Cencon", 
                        "*",
                        $this->condicion);
            }
             $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
    }
    
    public function agregar_evento_cencon(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_EventoCencon", "Fecha_Apertura, Hora_Apertura, ID_PuntoBCR, ID_Persona, ID_Empresa, ID_Usuario, Observaciones","'".$this->fecha."','".$this->hora."', '".$this->id."','".$this->id2."','".$this->empresa."','".$this->usuario."','".$this->observaciones."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_todos_eventos_cencon(){
        $this->obj_data_provider->conectar();
            if($this->condicion==""){
                $this->arreglo=$this->obj_data_provider->trae_datos("T_EventoCencon "
                        . "LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_EventoCencon.ID_PuntoBCR", 
                        "T_EventoCencon.*, T_PuntoBCR.Nombre, T_PuntoBCR.Codigo", 
                        "");
            }else{
                $this->arreglo=$this->obj_data_provider->trae_datos("T_EventoCencon "
                        . "LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_EventoCencon.ID_PuntoBCR", 
                        "T_EventoCencon.*, T_PuntoBCR.Nombre, T_PuntoBCR.Codigo",
                        $this->condicion);
            }
             $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
    }
    
    public function cerrar_evento_cencon(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_EventoCencon", "Fecha_Cierre='".$this->fecha."', Hora_Cierre='".$this->hora."'", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}?>
