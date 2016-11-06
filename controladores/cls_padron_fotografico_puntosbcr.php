<?php

class cls_padron_fotografico_puntosbcr{
    public $id_padron_fotografico;
    public $id_puntobcr;
    public $nombre_imagen;
    public $categoria;
    public $descripcion;
    public $nombre_ruta;
    public $obj_data_provider;
    public $arreglo;
    public $formato;
    private $condicion;
    
    function getFormato() {
        return $this->formato;
    }

    function setFormato($formato) {
        $this->formato = $formato;
    }

    function getId_padron_fotografico() {
        return $this->id_padron_fotografico;
    }

    function getId_puntobcr() {
        return $this->id_puntobcr;
    }

    function getNombre_imagen() {
        return $this->nombre_imagen;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNombre_ruta() {
        return $this->nombre_ruta;
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

    function setId_padron_fotografico($id_padron_fotografico) {
        $this->id_padron_fotografico = $id_padron_fotografico;
    }

    function setId_puntobcr($id_puntobcr) {
        $this->id_puntobcr = $id_puntobcr;
    }

    function setNombre_imagen($nombre_imagen) {
        $this->nombre_imagen = $nombre_imagen;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setNombre_ruta($nombre_ruta) {
        $this->nombre_ruta = $nombre_ruta;
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
        $this->id_padron_fotografico="";
        $this->id_puntobcr="";
        $this->nombre_imagen="";
        $this->nombre_ruta="";
        $this->descripcion="";
        $this->categoria="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->formato="";
        $this->condicion="";
    }
    
    public function obtener_imagenes_puntosbcr(){
        
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_padron_fotografico_puntobcr", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_padron_fotografico_puntobcr", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function guardar_imagen_puntobcr(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->inserta_datos("t_padron_fotografico_puntobcr", "ID_padron_puntobcr,ID_PuntoBCR, nombre_ruta, nombre_imagen, descripcion,categoria,formato", 
                    "null,".$this->id_puntobcr.",'".$this->nombre_ruta."','".$this->nombre_imagen."','".$this->descripcion."','".$this->categoria."','".$this->formato."'");
            $this->obj_data_provider->desconectar();
         
        }   else    {
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->edita_datos("t_padron_fotografico_puntobcr", "ID_PuntoBCR=".$this->id_puntobcr.", nombre_ruta='".$this->nombre_ruta."', nombre_imagen='".$this->nombre_imagen."', descripcion='".$this->descripcion."', categoria='".$this->categoria."', formato='".$this->formato."'", $this->condicion);
            $this->obj_data_provider->desconectar();
           
        }
    }
    
   public function eliminar_imagen_puntobcr() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->eliminar_datos("t_padron_fotografico_puntobcr", $this->condicion);
        $this->obj_data_provider->desconectar();
       
    }
}
?>

