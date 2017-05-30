<?php
class cls_gerente_zona{
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

    function getNombre() {
        return $this->nombre;
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
    
    function getZona() {
        return $this->zona;
    }

    function setZona($zona) {
        $this->zona = $zona;
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
    
    public function obtiene_gerente_zona(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_GerenteZonaBCR LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona", 
            "DISTINCT T_GerenteZonaBCR.*, T_Personal.ID_Persona, T_Personal.Apellido_Nombre ","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_GerenteZonaBCR LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona", 
            "DISTINCT T_GerenteZonaBCR.*, T_Personal.ID_Persona, T_Personal.Apellido_Nombre ",$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_gerente_zona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_GerenteZonaBCR","ID_Gerente_Zona,ID_Persona,Zona_Gerencia_BCR,Observaciones,Estado","null,'".$this->nombre."','".$this->zona."','".$this->observaciones."','".$this->estado."'");
        $this->arreglo= $this->obj_data_provider->trae_datos("T_GerenteZonaBCR ORDER BY `ID_Gerente_Zona` DESC LIMIT 1", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function editar_gerente_zona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_GerenteZonaBCR","ID_Persona='".$this->nombre."',Zona_Gerencia_BCR='".$this->zona."',Observaciones='".$this->observaciones."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    } 
    
    public function obtener_nombre_gerente_zona(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Personal ORDER BY Apellido_Nombre DESC","*",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    } 
    
    public function cambiar_estado_gerente_zona(){ 
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_GerenteZonaBCR","Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    } 
}?>
