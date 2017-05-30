<?php

class cls_padron_fotografico_unidades_de_video{
    public $id_padron_fotografico;
    public $id_unidad_video;
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

    function getId_unidad_video() {
        return $this->id_unidad_video;
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

    function setId_unidad_video($id_unidad_video) {
        $this->id_unidad_video = $id_unidad_video;
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
        $this->id_unidad_video="";
        $this->nombre_imagen="";
        $this->nombre_ruta="";
        $this->descripcion="";
        $this->categoria="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->formato="";
        $this->condicion="";
    }
    
    public function obtener_imagenes_unidades_de_video(){
        
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_PadronFotograficoUnidadVideo", "*,IF(Categoria = 0, 'Día', 'Noche') Categoria_Nombre", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_PadronFotograficoUnidadVideo", "*,IF(Categoria = 0, 'Día', 'Noche') Categoria_Nombre", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function obtener_imagenes_unidades_de_video_desde_punto_bcr(){
        
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_puntobcr 
                inner join t_unidadvideo on t_unidadvideo.ID_PuntoBCR=t_Puntobcr.ID_PuntoBCR
                inner join t_padronfotograficounidadvideo on t_padronfotograficounidadvideo.ID_Unidad_Video=t_unidadvideo.ID_Unidad_Video order by t_padronfotograficounidadvideo.Categoria", "t_padronfotograficounidadvideo.*,IF(t_padronfotograficounidadvideo.Categoria = 0, 'Día', 'Noche') Categoria_Nombre", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("t_puntobcr 
                inner join t_unidadvideo on t_unidadvideo.ID_PuntoBCR=t_Puntobcr.ID_PuntoBCR
                inner join t_padronfotograficounidadvideo on t_padronfotograficounidadvideo.ID_Unidad_Video=t_unidadvideo.ID_Unidad_Video", "t_padronfotograficounidadvideo.*,IF(t_padronfotograficounidadvideo.Categoria = 0, 'Día', 'Noche') Categoria_Nombre", $this->condicion." order by t_padronfotograficounidadvideo.Categoria");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function guardar_imagen_unidad_de_video(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->inserta_datos("T_PadronFotograficoUnidadVideo", "ID_Padron_Unidad_Video,ID_Unidad_Video, Nombre_Ruta, Nombre_Imagen, Descripcion,Categoria,Formato", 
                    "null,".$this->id_unidad_video.",'".$this->nombre_ruta."','".$this->nombre_imagen."','".$this->descripcion."',".$this->categoria.",'".$this->formato."'");
            $this->obj_data_provider->desconectar();
         
        }   else    {
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->edita_datos("T_PadronFotograficoUnidadVideo", "ID_Unidad_Video=".$this->id_unidad_video.", Nombre_Ruta='".$this->nombre_ruta."', Nombre_Imagen='".$this->nombre_imagen."', Descripcion='".$this->descripcion."', Categoria=".$this->categoria.", Formato='".$this->formato."'", $this->condicion);
            $this->obj_data_provider->desconectar();
           
        }
    }
    
    public function eliminar_imagen_unidad_de_video() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->eliminar_datos("T_PadronFotograficoUnidadVideo", $this->condicion);
        $this->obj_data_provider->desconectar();
       
    }
   
}
?>

