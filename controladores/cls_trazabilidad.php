<?php

class cls_trazabilidad{
        
  // Definicion de atributos de la clase
    private $id_traza;
    private $fecha;
    private $hora;
    private $id_usuario;
    private $nombre_usuario;
    private $apellido_usuario;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;
    private $tabla_afectada;
    private $dato_anterior;
    private $dato_actualizado;
      
    function getId_traza() {
        return $this->id_traza;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    function getApellido_usuario() {
        return $this->apellido_usuario;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    
    function getCondicion() {
        return $this->condicion;
    }

    function getResultado_operacion() {
        return $this->resultado_operacion;
    }

    function getTabla_afectada() {
        return $this->tabla_afectada;
    }

    function getDato_anterior() {
        return $this->dato_anterior;
    }

    function getDato_actualizado() {
        return $this->dato_actualizado;
    }

    function setId_traza($id_traza) {
        $this->id_traza = $id_traza;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setNombre_usuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    function setApellido_usuario($apellido_usuario) {
        $this->apellido_usuario = $apellido_usuario;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setResultado_operacion($resultado_operacion) {
        $this->resultado_operacion = $resultado_operacion;
    }

    function setTabla_afectada($tabla_afectada) {
        $this->tabla_afectada = $tabla_afectada;
    }

    function setDato_anterior($dato_anterior) {
        $this->dato_anterior = $dato_anterior;
    }

    function setDato_actualizado($dato_actualizado) {
        $this->dato_actualizado = $dato_actualizado;
    }

    
    public function __construct(){
        $this->id_traza="";
        $this->id_usuario="";
        $this->fecha="";
        $this->hora="";
        $this->tabla_afectada="";
        $this->dato_anterior="";
        $this->dato_actualizado="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->resultado_operacion="";
        $this->nombre_usuario="";
        $this->apellido_usuario="";
        
    }

    public function obtiene_trazabilidad() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza left outer join t_usuario on t_traza.ID_Usuario=t_usuario.ID_usuario", 
                    "t_traza.*,t_usuario.Nombre,t_usuario.Apellido",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza left outer join t_usuario on t_traza.ID_Usuario=t_usuario.ID_usuario", 
                    "t_traza.*,t_usuario.Nombre,t_usuario.Apellido",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
    }
    
    public function obtiene_lista_usuarios_que_han_modificado_base_de_datos() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza left outer join t_usuario on t_traza.ID_Usuario=t_usuario.ID_usuario order by Nombre_Completo", 
                    "distinct(t_traza.ID_Usuario),concat(t_usuario.Nombre,' ',t_usuario.Apellido) as Nombre_Completo",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza left outer join t_usuario on t_traza.ID_Usuario=t_usuario.ID_usuario", 
                    "distinct(t_traza.ID_Usuario),concat(t_usuario.Nombre,' ',t_usuario.Apellido) as Nombre_Completo",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
        
    }
        public function obtiene_lista_tablas_afectadas_en_el_sistema() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza order by t_traza.Tabla_Afectada", 
                    "distinct(t_traza.Tabla_Afectada)",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_traza", 
                    "distinct(t_traza.Tabla_Afectada)",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
        }
    
}
  
  
