<?php
class cls_unidad_video{
    public $obj_data_provider;
    public $id_unidad_video;
    public $id_punto_bcr;
    public $arreglo;
    private $condicion;
    public $descripcion;
    public $promedio_dias;
    public $capacidad_disco_duro;
    public $version_software;
    public $mac_address;
    public $serie;
    public $regulacion;
    public $estado;
    public $campos_valores;
    public $cantidad_entradas_video;
    public $camaras_habilitadas;
    public $cuadros_por_segundo;
    public $resolucion;
    public $calidad;
    public $nombre_punto_bcr;
    public $observaciones;
    public $arranque_automatico;
        
    function getCampos_valores() {
        return $this->campos_valores;
    }

    function setCampos_valores($campos_valores) {
        $this->campos_valores = $campos_valores;
    }

    
    function getId_unidad_video() {
    return $this->id_unidad_video;
    }

    function getId_punto_bcr() {
        return $this->id_punto_bcr;
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

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPromedio_dias() {
        return $this->promedio_dias;
    }

    function getCapacidad_disco_duro() {
        return $this->capacidad_disco_duro;
    }

    function getVersion_software() {
        return $this->version_software;
    }

    function getMac_address() {
        return $this->mac_address;
    }

    function getSerie() {
        return $this->serie;
    }

    function getRegulacion() {
        return $this->regulacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCantidad_entradas_video() {
        return $this->cantidad_entradas_video;
    }

    function getCamaras_habilitadas() {
        return $this->camaras_habilitadas;
    }

    function getCuadros_por_segundo() {
        return $this->cuadros_por_segundo;
    }

    function getResolucion() {
        return $this->resolucion;
    }

    function getCalidad() {
        return $this->calidad;
    }

    function getNombre_punto_bcr() {
        return $this->nombre_punto_bcr;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getArranque_automatico() {
        return $this->arranque_automatico;
    }

    function setId_unidad_video($id_unidad_video) {
        $this->id_unidad_video = $id_unidad_video;
    }

    function setId_punto_bcr($id_punto_bcr) {
        $this->id_punto_bcr = $id_punto_bcr;
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

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPromedio_dias($promedio_dias) {
        $this->promedio_dias = $promedio_dias;
    }

    function setCapacidad_disco_duro($capacidad_disco_duro) {
        $this->capacidad_disco_duro = $capacidad_disco_duro;
    }

    function setVersion_software($version_software) {
        $this->version_software = $version_software;
    }

    function setMac_address($mac_address) {
        $this->mac_address = $mac_address;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    function setRegulacion($regulacion) {
        $this->regulacion = $regulacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCantidad_entradas_video($cantidad_entradas_video) {
        $this->cantidad_entradas_video = $cantidad_entradas_video;
    }

    function setCamaras_habilitadas($camaras_habilitadas) {
        $this->camaras_habilitadas = $camaras_habilitadas;
    }

    function setCuadros_por_segundo($cuadros_por_segundo) {
        $this->cuadros_por_segundo = $cuadros_por_segundo;
    }

    function setResolucion($resolucion) {
        $this->resolucion = $resolucion;
    }

    function setCalidad($calidad) {
        $this->calidad = $calidad;
    }

    function setNombre_punto_bcr($nombre_punto_bcr) {
        $this->nombre_punto_bcr = $nombre_punto_bcr;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setArranque_automatico($arranque_automatico) {
        $this->arranque_automatico = $arranque_automatico;
    }

    public function __construct() {
    $this->id_punto_bcr="";
    $this->id_unidad_video="";
    $this->obj_data_provider=new Data_Provider();
    $this->condicion="";
    $this->arreglo;
    $this->descripcion="";
    $this->promedio_dias="";
    $this->capacidad_disco_duro="";
    $this->version_software="";
    $this->mac_address="";
    $this->serie="";
    $this->observaciones="";
    $this->estado="";
    $this->regulacion="";
    $this->cantidad_entradas_video="";
    $this->camaras_habilitadas="";
    $this->cuadros_por_segundo="";
    $this->resolucion="";
    $this->calidad="";
    $this->nombre_punto_bcr="";
    $this->arranque_automatico="";
   }
   
   //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    
    function existe_este_dato_en_la_tabla_unidades_video(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_UnidadVideo","*",$this->condicion);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
  }
    
   public function obtiene_todas_las_unidades_de_video(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_unidadvideo left join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR", 
                    "*,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "t_unidadvideo left join t_puntoBCR on t_unidadvideo.ID_PuntoBCR=t_puntoBCR.ID_PuntoBCR", 
                    "*,t_unidadvideo.Estado as Estad,t_unidadvideo.Observaciones as Obser,t_puntoBCR.Nombre",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        } 
    }
   
    public function actualizar_campo_unidades_de_video(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("t_unidadvideo", $this->campos_valores ,$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
 
    }
   
    
    public function obtiene_todos_los_puntos_bcr(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuntoBCR
			LEFT OUTER JOIN T_Horario ON T_PuntoBCR.ID_Horario= T_Horario.ID_Horario
			LEFT OUTER JOIN T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
			LEFT OUTER JOIN T_Empresa ON T_PuntoBCR.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Distrito ON T_PuntoBCR.ID_Distrito = T_Distrito.ID_Distrito
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
			LEFT OUTER JOIN T_PuntoBCREnlace ON T_PuntoBCREnlace.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_EnlaceTelecomunicaciones ON T_EnlaceTelecomunicaciones.ID_Enlace = T_PuntoBCREnlace.ID_Enlace
			LEFT OUTER JOIN T_PuntoBCRDireccionIP ON T_PuntoBCRDireccionIP.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_DireccionIP ON T_DireccionIP.ID_Direccion_IP = T_PuntoBCRDireccionIP.ID_Direccion_IP
			GROUP by T_PuntoBCR.ID_PuntoBCR", 
                    "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Direccion, T_PuntoBCR.Codigo, 
			T_PuntoBCR.Cuenta_SIS, T_PuntoBCR.Observaciones as Observaciones_Punto, 
                        T_PuntoBCR.Estado as Estado_Punto, T_PuntoBCR.ID_Gerente_Zona, T_PuntoBCR.ID_Supervisor_Zona,
			T_Horario.*, 
			T_TipoPuntoBCR.ID_Tipo_Punto, T_TipoPuntoBCR.Tipo_Punto,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_Distrito.ID_Distrito, T_Distrito.Nombre_Distrito,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			GROUP_CONCAT(char(10),T_EnlaceTelecomunicaciones.Numero_Linea) as Numero_Linea,
                        GROUP_CONCAT(char(10),T_DireccionIP.Direccion_IP) as Direccion_IP",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuntoBCR
			LEFT OUTER JOIN T_Horario ON T_PuntoBCR.ID_Horario= T_Horario.ID_Horario
			LEFT OUTER JOIN T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
			LEFT OUTER JOIN T_Empresa ON T_PuntoBCR.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Distrito ON T_PuntoBCR.ID_Distrito = T_Distrito.ID_Distrito
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
			LEFT OUTER JOIN T_PuntoBCREnlace ON T_PuntoBCREnlace.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_EnlaceTelecomunicaciones ON T_EnlaceTelecomunicaciones.ID_Enlace = T_PuntoBCREnlace.ID_Enlace", 
                    "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Direccion, T_PuntoBCR.Codigo, 
			T_PuntoBCR.Cuenta_SIS, T_PuntoBCR.Observaciones as Observaciones_Punto, 
                        T_PuntoBCR.Estado as Estado_Punto, T_PuntoBCR.ID_Gerente_Zona, T_PuntoBCR.ID_Supervisor_Zona,
			T_Horario.*, 
			T_TipoPuntoBCR.ID_Tipo_Punto, T_TipoPuntoBCR.Tipo_Punto,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_Distrito.ID_Distrito, T_Distrito.Nombre_Distrito,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_EnlaceTelecomunicaciones.Numero_Linea",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_los_tipo_puntos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoPuntoBCR", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_TipoPuntoBCR", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } 
    }
    
    public function obtiene_unidades_ejecutoras(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_UnidadEjecutora
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;  
    }
    
    public function obtiene_distritos(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Distrito", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "distrito x2";
    }
    
    public function obtiene_cantones(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Canton", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "canton x2";
    }
    
    public function obtiene_provincias(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
            "T_Provincia", 
            "*",
            $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true; 
        //echo "provincia x2";
    }
    
    public function actualizar_ubicacion_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Distrito='".$this->id."', ". "Direccion='".$this->direccion."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_informacion_general_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("T_PuntoBCR", "Codigo='".$this->codigo."', ". "Cuenta_SIS='".$this->cuentasis."', "."Nombre='".$this->nombre."', "."ID_Tipo_Punto='".$this->id."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    
    
    public function guardar_punto_bcr(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_PuntoBCR", "`ID_PuntoBCR`, `Nombre`, `Direccion`, `Codigo`, `Cuenta_SIS`, `ID_Horario`, `ID_Tipo_Punto`, `ID_Empresa`, `ID_Gerente_Zona`, `ID_Supervisor_Zona`, `ID_Distrito`, `Observaciones`, `Estado`", "'".$this->id."','".$this->nombre."','".$this->direccion."','".$this->codigo."','".$this->cuentasis."','".$this->horaslaborales."','".$this->tipo_punto."','".$this->empresa."','"."1"."','"."1"."','".$this->distrito."','".$this->observaciones."','".$this->estado."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_informacion_adicional_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Empresa='".$this->empresa."', Observaciones='".$this->observaciones."', ID_Gerente_Zona='".$this->gerente."', ID_Supervisor_Zona='".$this->supervisor."'",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_estado_puntobcr(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_PuntoBCR", "Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtiene_todos_los_puntos_bcr_publico(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_PuntoBCR
			LEFT OUTER JOIN T_Horario ON T_PuntoBCR.ID_Horario= T_Horario.ID_Horario
			LEFT OUTER JOIN T_TipoPuntoBCR ON T_PuntoBCR.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
			LEFT OUTER JOIN T_UE_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR= T_UE_PuntoBCR.ID_PuntoBCR
			LEFT OUTER JOIN T_UnidadEjecutora ON T_UE_PuntoBCR.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                        LEFT OUTER JOIN T_Telefono on T_PuntoBCR.ID_PuntoBCR = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                    "T_PuntoBCR.ID_PuntoBCR, T_PuntoBCR.Nombre, T_PuntoBCR.Direccion,
			T_Horario.*,
			T_TipoPuntoBCR.ID_Tipo_Punto, T_TipoPuntoBCR.Tipo_Punto,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
                        GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                    "(T_TipoTelefono.ID_Tipo_Telefono = '1') AND 
                        (T_TipoPuntoBCR.ID_Tipo_Punto='1' OR T_TipoPuntoBCR.ID_Tipo_Punto='5' OR T_TipoPuntoBCR.ID_Tipo_Punto='9'
                        OR T_TipoPuntoBCR.ID_Tipo_Punto='10' OR T_TipoPuntoBCR.ID_Tipo_Punto='11') AND (T_PuntoBCR.Estado='1') 
                        group by T_PuntoBCR.ID_PuntoBCR");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}?>