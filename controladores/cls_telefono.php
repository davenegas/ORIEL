<?php
class cls_telefono{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $estado;
    public $observaciones;
    public $tipo_telefono;
    public $numero;

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

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getTipo_telefono() {
        return $this->tipo_telefono;
    }

    function getNumero() {
        return $this->numero;
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

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setTipo_telefono($tipo_telefono) {
        $this->tipo_telefono = $tipo_telefono;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->observaciones="";
        $this->estado="";
        $this->tipo_telefono="";
        $this->numero="";
        
    }
    
    public function obtiene_tipo_telefonos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoTelefono", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "*", 
                    "T_TipoTelefono",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_telefonos_por_criterio_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Telefono", 
                "Numero",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
    
    public function guardar_telefono(){
        
        $this->obj_data_provider->conectar();
        $this->estado="1";
         $this->obj_data_provider->inserta_datos("T_Telefono","Numero,ID_Tipo_Telefono, ID, Observaciones, Estado","'".$this->numero."','".$this->tipo_telefono."','".$this->id2."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();  
    }
    
    
     public function guardar_telefono_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->estado="1";
         $this->obj_data_provider->inserta_datos_para_prontuario("T_Telefono","Numero,ID_Tipo_Telefono, ID, Observaciones, Estado","'".$this->numero."','".$this->tipo_telefono."','".$this->id2."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();  
    }
    
    public function eliminar_telefono() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->eliminar_datos("T_Telefono", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function eliminar_telefonos_para_prontuario() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->eliminar_datos_para_prontuario("T_Telefono", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function obtiene_telefonos_puntoBCR(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Telefono
		LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
            "T_Telefono.*, T_TipoTelefono.ID_Tipo_Telefono, T_TipoTelefono.Tipo_Telefono",
            $this->condicion. "AND (T_TipoTelefono.ID_Tipo_Telefono = '1' OR 
		T_TipoTelefono.ID_Tipo_Telefono = '5' OR 
		T_TipoTelefono.ID_Tipo_Telefono = '6' OR
		T_TipoTelefono.ID_Tipo_Telefono = '7' OR 
		T_TipoTelefono.ID_Tipo_Telefono = '8' OR 
		T_TipoTelefono.ID_Tipo_Telefono = '9')");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;  
    }
    
    public function actualizar_telefono(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Telefono", "Numero='".$this->numero."', ID_Tipo_Telefono='".$this->tipo_telefono."', Observaciones='".$this->observaciones."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}?>
