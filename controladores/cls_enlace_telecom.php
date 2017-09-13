<?php

class cls_enlace_telecom{
    public $id;
    public $id2;
    public $proveedor;
    public $tipo_enlace;
    public $medio_enlace;
    public $enlace;
    public $interface;
    public $linea;
    public $bandwidth;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId2() {
        return $this->id2;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function getId() {
        return $this->id;
    }

    function getProveedor() {
        return $this->proveedor;
    }

    function getTipo_enlace() {
        return $this->tipo_enlace;
    }

    function getMedio_enlace() {
        return $this->medio_enlace;
    }

    function getEnlace() {
        return $this->enlace;
    }

    function getInterface() {
        return $this->interface;
    }

    function getLinea() {
        return $this->linea;
    }

    function getBandwidth() {
        return $this->bandwidth;
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

    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    function setTipo_enlace($tipo_enlace) {
        $this->tipo_enlace = $tipo_enlace;
    }

    function setMedio_enlace($medio_enlace) {
        $this->medio_enlace = $medio_enlace;
    }

    function setEnlace($enlace) {
        $this->enlace = $enlace;
    }

    function setInterface($interface) {
        $this->interface = $interface;
    }

    function setLinea($linea) {
        $this->linea = $linea;
    }

    function setBandwidth($bandwidth) {
        $this->bandwidth = $bandwidth;
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
        $this->id2="";
        $this->proveedor="";
        $this->tipo_enlace="";
        $this->medio_enlace="";
        $this->enlace="";
        $this->interface="";
        $this->linea="";
        $this->bandwidth;
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    //Función para obtener los enlaces de telecomunicaciones e id de PuntoBCR
    // Se obtienen todos los enlaces o alguno en especifico enviando condición
    public function obtener_todos_enlaces(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_EnlaceTelecomunicaciones 
                LEFT OUTER JOIN T_PuntoBCREnlace ON T_PuntoBCREnlace.ID_Enlace = T_EnlaceTelecomunicaciones.ID_Enlace
                LEFT OUTER JOIN T_MedioEnlace ON T_MedioEnlace.ID_Medio_Enlace = T_EnlaceTelecomunicaciones.ID_Medio_Enlace
                LEFT OUTER JOIN T_Proveedor ON T_Proveedor.ID_Proveedor = T_EnlaceTelecomunicaciones.ID_Proveedor
                LEFT OUTER JOIN T_TipoEnlace ON T_TipoEnlace.ID_Tipo_Enlace = T_EnlaceTelecomunicaciones.ID_Tipo_Enlace", 
                "T_EnlaceTelecomunicaciones.*, 
                T_PuntoBCREnlace.*, 
                T_MedioEnlace.ID_Medio_Enlace, T_MedioEnlace.Medio_Enlace, T_MedioEnlace.Observaciones as Obser_medio,
                T_Proveedor.ID_Proveedor, T_Proveedor.Nombre_Proveedor, T_Proveedor.Observaciones as Obser_proveedor,
                T_TipoEnlace.ID_Tipo_Enlace, T_TipoEnlace.Tipo_Enlace, T_TipoEnlace.Observaciones as Obser_tipo",   
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_EnlaceTelecomunicaciones 
                LEFT OUTER JOIN T_PuntoBCREnlace ON T_PuntoBCREnlace.ID_Enlace = T_EnlaceTelecomunicaciones.ID_Enlace
                LEFT OUTER JOIN T_MedioEnlace ON T_MedioEnlace.ID_Medio_Enlace = T_EnlaceTelecomunicaciones.ID_Medio_Enlace
                LEFT OUTER JOIN T_Proveedor ON T_Proveedor.ID_Proveedor = T_EnlaceTelecomunicaciones.ID_Proveedor
                LEFT OUTER JOIN T_TipoEnlace ON T_TipoEnlace.ID_Tipo_Enlace = T_EnlaceTelecomunicaciones.ID_Tipo_Enlace", 
                "T_EnlaceTelecomunicaciones.*, 
                T_PuntoBCREnlace.*, 
                T_MedioEnlace.ID_Medio_Enlace, T_MedioEnlace.Medio_Enlace, T_MedioEnlace.Observaciones as Obser_medio,
                T_Proveedor.ID_Proveedor, T_Proveedor.Nombre_Proveedor, T_Proveedor.Observaciones as Obser_proveedor,
                T_TipoEnlace.ID_Tipo_Enlace, T_TipoEnlace.Tipo_Enlace, T_TipoEnlace.Observaciones as Obser_tipo", 
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_enlaces_telecomunicaciones(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->inserta_datos("T_EnlaceTelecomunicaciones", "ID_Enlace, Enlace, Interface_Enlace, Numero_Linea,Bandwidth,	ID_Proveedor, ID_Tipo_Enlace, ID_Medio_Enlace, Observaciones, Estado", 
                "null,'".$this->enlace."','".$this->interface."','".$this->linea."','".$this->bandwidth."','".$this->proveedor."','".$this->tipo_enlace."','".$this->medio_enlace."','".$this->observaciones."','".$this->estado."'");
            $this->obj_data_provider->trae_datos("T_EnlaceTelecomunicaciones ORDER BY ID_Enlace DESC LIMIT 1","ID_Enlace","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }   else    {
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->edita_datos("T_EnlaceTelecomunicaciones", "Enlace='".$this->enlace."', Interface_Enlace='".$this->interface."', Numero_Linea='".$this->linea."', Bandwidth='".$this->bandwidth."', ID_Proveedor='".$this->proveedor."', ID_Tipo_Enlace='".$this->tipo_enlace."', ID_Medio_Enlace='".$this->medio_enlace."', Observaciones='".$this->observaciones."'", $this->condicion);
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_puntobcr_enlace() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_PuntoBCREnlace", "ID_PuntoBCR, ID_Enlace", $this->id2.",".$this->id);
        $this->obj_data_provider->trae_datos("T_EnlaceTelecomunicaciones ORDER BY ID_Enlace DESC LIMIT 1","ID_Enlace","");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function cambiar_estado_medio_enlace(){
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la consulta a la bd
        $this->obj_data_provider->edita_datos("T_MedioEnlace", "Estado='".$this->estado."'", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function eliminar_enlace_entre_puntobcr_telecom(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_PuntoBCREnlace", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function eliminar_enlace_telecomunicaciones(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_EnlaceTelecomunicaciones", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function enlaces_reporte(){
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la consulta a la bd
        $this->obj_data_provider->trae_datos("T_EnlaceTelecomunicaciones
            LEFT OUTER JOIN T_PuntoBCREnlace ON T_PuntoBCREnlace.ID_Enlace = T_EnlaceTelecomunicaciones.ID_Enlace
            LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_PuntoBCREnlace.ID_PuntoBCR
            LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
            LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
            LEFT OUTER JOIN T_MedioEnlace ON T_MedioEnlace.ID_Medio_Enlace = T_EnlaceTelecomunicaciones.ID_Medio_Enlace
            LEFT OUTER JOIN T_Proveedor ON T_Proveedor.ID_Proveedor = T_EnlaceTelecomunicaciones.ID_Proveedor
            LEFT OUTER JOIN T_TipoEnlace ON T_TipoEnlace.ID_Tipo_Enlace = T_EnlaceTelecomunicaciones.ID_Tipo_Enlace
            ORDER BY  T_PuntoBCR.Nombre, T_EnlaceTelecomunicaciones.Enlace", 

                "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Codigo, T_PuntoBCR.Estado Estado_Oficina,
            T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento, T_UnidadEjecutora.Numero_UE,
            T_EnlaceTelecomunicaciones.*,
            T_MedioEnlace.ID_Medio_Enlace, T_MedioEnlace.Medio_Enlace,
            T_Proveedor.ID_Proveedor, T_Proveedor.Nombre_Proveedor,
            T_TipoEnlace.ID_Tipo_Enlace, T_TipoEnlace.Tipo_Enlace",   
            "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}
?>

