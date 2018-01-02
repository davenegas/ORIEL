<?php 
class cls_botones {
    public $id_boton;
    public $tipo_panel;
    public $id_puntobcr;
    public $id_persona; 
    public $numero_zona;
    public $tipo_respuesta;     
    public $tipo_entrada;
    public $numero_serie;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
        
    function getID_Boton() {
        return $this->id_boton;
    }
    function getTipo_Panel() {
        return $this->tipo_panel;
    }
      
    function getID_PuntoBCR() {
        return $this->id_puntobcr;
    }
    
    function getID_Persona() {
        return $this->id_persona;
    }
    
    function getNumero_Zona() {
        return $this->numero_zona;
    }
    
    function getTipo_Respuesta() {
        return $this->tipo_respuesta;
    }
    
    function getTipo_Entrada() {
        return $this->tipo_entrada;
    }
    
    function getNumero_Serie() {
        return $this->numero_serie;
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
    
    function setID_Boton($id_boton) {
        $this->id_boton = $id_boton;
    }
    
    function setTipo_Panel($tipo_panel) {
        $this->tipo_panel = $tipo_panel;
    }
    
    function setID_PuntoBCR($id_puntobcr) {
        $this->id_puntobcr = $id_puntobcr;
    }
    
    function setID_Persona($id_persona) {
        $this->id_persona = $id_persona;
    }
    
    function setNumero_Zona($numero_zona) {
        $this->numero_zona = $numero_zona;
    }
    
    function setTipo_Respuesta($tipo_respuesta) {
        $this->tipo_respuesta = $tipo_respuesta;
    }
     
    function setTipo_Entrada($tipo_entrada) {
        $this->tipo_entrada = $tipo_entrada;
    }
    
    function setNumero_Serie($nuemro_serie) {
        $this->numero_serie = $nuemro_serie;
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
        $this->id_boton=""; 
        $this->tipo_panel="";
        $this->id_puntobcr="";
        $this->id_persona="";
        $this->numero_zona="";
        $this->tipo_respuesta="";
        $this->tipo_entrada="";
        $this->numero_serie="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    public function obtener_botones_listar(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la insercion a la bd
            $this->obj_data_provider->trae_datos("T_Botones LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Botones.ID_PuntoBCR
            LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Botones.ID_Persona", "T_Botones.*, T_Personal.Apellido_Nombre , T_PuntoBCR.Nombre , T_PuntoBCR.Tipo_Panel", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            //Metodo de la clase data provider que desconecta la sesion con la base de datos 
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la insercion a la bd
            $this->obj_data_provider->trae_datos("T_Botones LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_Botones.ID_PuntoBCR
            LEFT OUTER JOIN T_Personal ON T_Personal.ID_Persona = T_Botones.ID_Persona", "T_Botones.*, T_Personal.Apellido_Nombre , T_PuntoBCR.Nombre , T_PuntoBCR.Tipo_Panel",$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            //Metodo de la clase data provider que desconecta la sesion con la base de datos 
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    } 
    public function obtener_responsable_boton(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la insercion a la bd
            $this->obj_data_provider->trae_datos("T_Personal","*","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            //Metodo de la clase data provider que desconecta la sesion con la base de datos 
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la insercion a la bd
            $this->obj_data_provider->trae_datos("T_Personal","*",$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            //Metodo de la clase data provider que desconecta la sesion con la base de datos 
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    } 
    public function obtener_puntobcr(){
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la insercion a la bd
        $this->arreglo= $this->obj_data_provider->trae_datos("T_PuntoBCR","*",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        //Metodo de la clase data provider que desconecta la sesion con la base de datos 
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;    
    }
    public function botones_guardar() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la insercion a la bd
            $this->obj_data_provider->inserta_datos("T_Botones","ID_Boton,ID_PuntoBCR,ID_Persona,Numero_Zona,Tipo_Respuesta,Tipo_Entrada,Numero_Serie,Observaciones,Estado", 
            "null,'".$this->id_puntobcr."','".$this->id_persona."','".$this->numero_zona."','".$this->tipo_respuesta."','".$this->tipo_entrada."','".$this->numero_serie."','".$this->observaciones."','".$this->estado."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos           
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
    }   
    public function editar_botones() {
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la insercion a la bd
        $this->obj_data_provider->edita_datos("T_Botones","ID_PuntoBCR='".$this->id_puntobcr."',ID_Persona='".$this->id_persona."',Numero_Zona='".$this->numero_zona."',Tipo_Respuesta='".$this->tipo_respuesta."',Tipo_Entrada='".$this->tipo_entrada."',Numero_Serie='".$this->numero_serie."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);        
        //Metodo de la clase data provider que desconecta la sesión con la base de datos           
        $this->obj_data_provider->desconectar(); 
    } 
}
?>

