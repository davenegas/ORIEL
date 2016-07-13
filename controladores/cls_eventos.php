<?php

class cls_eventos{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $fecha;
    public $hora;
    public $provincia;
    public $tipo_punto;
    public $punto_bcr;
    public $tipo_evento;
    public $estado;
    public $detalle;
    
    function getId2() {
        return $this->id2;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

        function getDetalle() {
        return $this->detalle;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

        function getTipo_punto() {
        return $this->tipo_punto;
    }

    function setTipo_punto($tipo_punto) {
        $this->tipo_punto = $tipo_punto;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getPunto_bcr() {
        return $this->punto_bcr;
    }

    function getTipo_evento() {
        return $this->tipo_evento;
    }

    function getEstado() {
        return $this->estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setPunto_bcr($punto_bcr) {
        $this->punto_bcr = $punto_bcr;
    }

    function setTipo_evento($tipo_evento) {
        $this->tipo_evento = $tipo_evento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        function getCondicion() {
        return $this->condicion;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

        function getArreglo() {
        return $this->arreglo;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function getId() {
        return $this->id;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    public function __construct() {
            $this->id="";
            $this->condicion="";
            $this->arreglo;
            $this->obj_data_provider=new Data_Provider();
            $this->fecha="";
            $this->hora="";
            $this->provincia="";
            $this->tipo_punto="";
            $this->punto_bcr="";
            $this->tipo_evento="";
            $this->estado="";
            $this->detalle="";
        ;
    }
    
    public function obtiene_todos_los_eventos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Evento 
                        LEFT OUTER JOIN T_Provincia ON T_Evento.ID_Provincia = T_Provincia.ID_Provincia
                        LEFT OUTER JOIN T_TipoPuntoBCR ON T_Evento.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
                        LEFT OUTER JOIN T_PuntoBCR ON T_Evento.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
                        LEFT OUTER JOIN T_TipoEvento ON T_Evento.ID_Tipo_Evento = T_TipoEvento.ID_Tipo_Evento
                        LEFT OUTER JOIN T_Seguimiento ON T_Evento.ID_Seguimiento = T_Seguimiento.ID_Seguimiento", 
                    "T_Evento.ID_Evento, T_Evento.Fecha, T_Evento.Hora, 
                        T_Provincia.Nombre_Provincia, T_Provincia.ID_Provincia,
                        T_TipoPuntoBCR.Tipo_Punto, T_TipoPuntoBCR.ID_Tipo_Punto ,
                        T_PuntoBCR.Nombre, T_PuntoBCR.ID_PuntoBCR,
                        T_TipoEvento.Evento, T_TipoEvento.ID_Tipo_Evento,
                        T_Seguimiento.Seguimiento, T_Seguimiento.ID_Seguimiento",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Evento 
                        LEFT OUTER JOIN T_Provincia ON T_Evento.ID_Provincia = T_Provincia.ID_Provincia
                        LEFT OUTER JOIN T_TipoPuntoBCR ON T_Evento.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
                        LEFT OUTER JOIN T_PuntoBCR ON T_Evento.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
                        LEFT OUTER JOIN T_TipoEvento ON T_Evento.ID_Tipo_Evento = T_TipoEvento.ID_Tipo_Evento
                        LEFT OUTER JOIN T_Seguimiento ON T_Evento.ID_Seguimiento = T_Seguimiento.ID_Seguimiento", 
                    "T_Evento.ID_Evento, T_Evento.Fecha, T_Evento.Hora, 
                        T_Provincia.Nombre_Provincia, T_Provincia.ID_Provincia,
                        T_TipoPuntoBCR.Tipo_Punto, T_TipoPuntoBCR.ID_Tipo_Punto ,
                        T_PuntoBCR.Nombre, T_PuntoBCR.ID_PuntoBCR,
                        T_TipoEvento.Evento, T_TipoEvento.ID_Tipo_Evento,
                        T_Seguimiento.Seguimiento, T_Seguimiento.ID_Seguimiento",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_detalle_evento(){
        try{
        $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_DetalleEvento", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
        }   catch (Exception $e){
        }
    }
    
    public function ingresar_seguimiento_evento(){
        try{
             $this->obj_data_provider->conectar();
             $sql=("call sp_set_detalleEvento('".$this->id2."','".$this->id."','".$this->fecha."','".$this->hora."','".$this->detalle."')");
            $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
            echo $sql;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_seguimientos(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Seguimiento", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_todos_los_tipos_eventos(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_TipoEvento", "*", "Estado=1");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
     public function obtener_todas_las_provincias(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Provincia", "*", "Estado=1");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_todos_los_tipos_de_puntos_BCR(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_TipoPuntoBCR", "*", "Estado=1");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_puntos_BCR_filtrados(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_PuntoBCR", "*", "Estado=1 AND ".$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
}

