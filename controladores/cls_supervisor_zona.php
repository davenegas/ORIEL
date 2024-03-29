<?php
class cls_supervisor_zona{
    public $id;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $nombre;
    public $zona;
    public $observaciones;
    public $estado;
    
    function getId() {
        return $this->id;
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

    function getZona() {
        return $this->zona;
    }

    function setZona($zona) {
        $this->zona = $zona;
    }
 
    function setId($id) {
        $this->id = $id;
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
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function setNumero($numero) {
        $this->numero = $numero;
    }

    public function __construct() {
        $this->id="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
        $this->nombre="";
        $this->numero="";
       
    }
    
    public function obtiene_supervisor_zona(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_SupervisorZona LEFT OUTER JOIN T_PersonalExterno ON T_SupervisorZona.ID_Persona_Externa = T_PersonalExterno.ID_Persona_Externa", 
                "DISTINCT T_SupervisorZona.*, T_PersonalExterno.Nombre, T_PersonalExterno.Apellido ","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_SupervisorZona LEFT OUTER JOIN T_PersonalExterno ON T_SupervisorZona.ID_Persona_Externa = T_PersonalExterno.ID_Persona_Externa", 
            "DISTINCT T_SupervisorZona.*, T_PersonalExterno.Nombre, T_PersonalExterno.Apellido ",$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_supervisor_zona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_SupervisorZona","ID_Supervisor_Zona,ID_Persona_Externa,Zona_Supervisor,Observaciones,Estado","null,'".$this->nombre."','".$this->zona."','".$this->observaciones."','".$this->estado."'");
        $this->arreglo= $this->obj_data_provider->trae_datos("T_supervisorzona ORDER BY `ID_Supervisor_Zona` ASC LIMIT 1", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function editar_supervisor_zona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_SupervisorZona","ID_Persona_Externa='".$this->nombre."',Zona_Supervisor='".$this->zona."',Observaciones='".$this->observaciones."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }  
     
    public function obtener_nombre_supervisor_zona(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_PersonalExterno ORDER BY Apellido ASC","*",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    } 
    
    public function cambiar_estado_supervisorzona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_SupervisorZona","Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    public function obtiene_supervisores(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("t_supervisorzona s INNER JOIN t_personalexterno p ON s.ID_Persona_Externa = p.ID_Persona_Externa AND s.Estado = 1 ORDER BY p.apellido", 
                "s.ID_Supervisor_Zona, p.ID_Persona_Externa, CONCAT( p.Apellido,' ',p.Nombre) Nombre ","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos("t_supervisorzona s INNER JOIN t_personalexterno p ON s.ID_Persona_Externa = p.ID_Persona_Externa ORDER BY p.apellido", 
                "p.ID_Persona_Externa, CONCAT( p.Apellido,' ',p.Nombre) Nombre ","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}?>
