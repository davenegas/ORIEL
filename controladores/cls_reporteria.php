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
    
    
     public function revisiones_de_video_todos_los_operadores_todos_los_puestos(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo LEFT OUTER JOIN T_Usuario on T_Usuario.ID_Usuario = t_bitacorarevisionesvideo.ID_Usuario", 
                        "t_bitacorarevisionesvideo.`ID_Usuario`, count(t_bitacorarevisionesvideo.`ID_Usuario`) TOTAL, T_Usuario.Nombre, T_Usuario.Apellido", 
                        $this->condicion." group by t_bitacorarevisionesvideo.`ID_Usuario`
		having count(t_bitacorarevisionesvideo.`ID_Usuario`)
		ORDER BY TOTAL desc");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    
    public function revisiones_de_video_por_operador(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->ejecuta_instruccion_sql("SET lc_time_names = 'es_CR';");
        $this->arreglo= $this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo LEFT OUTER JOIN T_Usuario ON T_Usuario.ID_Usuario = t_bitacorarevisionesvideo.ID_Usuario", 
                        "YEAR( Fecha_Inicia_Revision ) AS y, MONTH( Fecha_Inicia_Revision ) AS m, CONCAT( UPPER( LEFT( MONTHNAME( Fecha_Inicia_Revision ) , 1 ) ) , SUBSTR( MONTHNAME( Fecha_Inicia_Revision ) , 2 ) ) AS mes, COUNT( * ) AS numFilas, t_bitacorarevisionesvideo.`ID_Usuario` , T_Usuario.Nombre, T_Usuario.Apellido", 
                        $this->condicion." GROUP BY mes ORDER BY y, m");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function inconsistencias_en_revisiones_de_video(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo", 
                        "count(*) Total", 
                        $this->condicion);
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
    
    public function eventos_por_sitio(){
    $this->obj_data_provider->conectar();
    $this->arreglo= $this->obj_data_provider->trae_datos("T_Evento 
                    LEFT OUTER JOIN t_puntobcr on t_puntobcr.ID_PuntoBCR = t_evento.ID_PuntoBCR", 
                    "count(t_evento.ID_PuntoBCR) TOTAL, t_puntobcr.Nombre", 
                    $this->condicion." group by t_evento.ID_PuntoBCR
                    having count(T_Evento.ID_PuntoBCR)
                    ORDER BY TOTAL DESC LIMIT 10");
    $this->arreglo=$this->obj_data_provider->getArreglo();
    $this->obj_data_provider->desconectar();
    $this->resultado_operacion=true;    
    }
    
    public function obtiene_reporte_puntos_bcr_con_tl300(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->trae_datos("t_puntobcr p INNER JOIN t_puntobcrdireccionip pd ON pd.ID_PuntoBCR = p.ID_PuntoBCR INNER JOIN t_direccionip d ON d.ID_Direccion_IP = pd.ID_Direccion_IP INNER JOIN t_tipoip t ON t.ID_Tipo_IP = d.ID_Tipo_IP", 
                        "p.Nombre,p.Direccion,p.Cuenta_SIS,p.Codigo,d.Direccion_IP", 
                        "t.ID_Tipo_IP =3");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;    
    }
    
    public function obtiene_bitacora_puestos_de_monitoreo_completo(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacorarevisionesvideo
                    LEFT OUTER JOIN T_Usuario on T_Usuario.ID_Usuario = t_bitacorarevisionesvideo.ID_Usuario
                    LEFT OUTER JOIN t_unidadvideo on t_unidadvideo.ID_Unidad_Video = t_bitacorarevisionesvideo.ID_Unidad_Video
                    LEFT OUTER JOIN t_puestomonitoreo on t_puestomonitoreo.ID_Puesto_Monitoreo = t_bitacorarevisionesvideo.ID_Puesto_Monitoreo", 
                    "t_bitacorarevisionesvideo.*, t_unidadvideo.Descripcion, t_puestomonitoreo.Nombre, concat(concat(t_usuario.Nombre,' '),t_usuario.Apellido) Nombre_Completo",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_bitacorarevisionesvideo
                    LEFT OUTER JOIN T_Usuario on T_Usuario.ID_Usuario = t_bitacorarevisionesvideo.ID_Usuario
                    LEFT OUTER JOIN t_unidadvideo on t_unidadvideo.ID_Unidad_Video = t_bitacorarevisionesvideo.ID_Unidad_Video
                    LEFT OUTER JOIN t_puestomonitoreo on t_puestomonitoreo.ID_Puesto_Monitoreo = t_bitacorarevisionesvideo.ID_Puesto_Monitoreo", 
                    "t_bitacorarevisionesvideo.*, t_unidadvideo.Descripcion, t_puestomonitoreo.Nombre, concat(concat(t_usuario.Nombre,' '),t_usuario.Apellido) Nombre_Completo",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
    
    public function ultima_revision_por_unidad_video(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_bitacorarevisionesvideo
            LEFT OUTER JOIN t_unidadvideo on t_unidadvideo.ID_Unidad_Video = t_bitacorarevisionesvideo.ID_Unidad_Video",
            "t_bitacorarevisionesvideo.`ID_Unidad_Video`, MAX(concat(`Fecha_Termina_Revision`,' ',`Hora_Termina_Revision`)) Fecha_Hora ,
            t_unidadvideo.Descripcion",
            "t_unidadvideo.Estado=0
            GROUP by t_bitacorarevisionesvideo.`ID_Unidad_Video` ORDER BY Fecha_Hora ASC");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
    }
    
}?>
