<?php

class cls_reporteria{
    public $id;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId() {
        return $this->id;
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
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
    }
    
    public function seguimientos_por_operador(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->trae_datos("t_detalleevento 
			LEFT OUTER JOIN T_Usuario on T_Usuario.ID_Usuario = t_detalleevento.ID_Usuario", 
                        "t_detalleevento.`ID_Usuario`, count(t_detalleevento.`ID_Usuario`) TOTAL, T_Usuario.Nombre, T_Usuario.Apellido", 
                        $this->condicion." group by t_detalleevento.`ID_Usuario`
		having count(t_detalleevento.`ID_Usuario`)
		ORDER BY TOTAL desc");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function eventos_por_provincia(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->trae_datos("t_evento
			LEFT OUTER JOIN t_provincia on t_provincia.ID_Provincia = t_evento.ID_Provincia
			LEFT OUTER JOIN t_tipoevento On t_tipoevento.ID_Tipo_Evento = t_evento.ID_Tipo_Evento", 
                        "t_provincia.Nombre_Provincia, t_tipoevento.Evento, COUNT(t_evento.ID_Tipo_Evento) Total_evento, t_evento.ID_Tipo_Evento, t_evento.ID_Provincia", 
                        $this->condicion." GROUP BY t_evento.ID_Provincia, t_evento.ID_Tipo_Evento");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}?>
