<?php

class cls_prueba_alarma{
    public $id_prueba;
    public $id_punto;
    public $codigo;
    public $id_persona;
    public $empresa;
    public $tipo_prueba;
    public $revision;
    public $id_usuario;
    public $fecha;
    public $hora1;
    public $hora2;
    public $zona;
    public $observaciones;
    public $cierre;
    public $cuenta_secundaria;
    public $cuenta_principal;
    public $seguimiento;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId_prueba() {
        return $this->id_prueba;
    }

    function getId_punto() {
        return $this->id_punto;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getId_persona() {
        return $this->id_persona;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getTipo_prueba() {
        return $this->tipo_prueba;
    }

    function getRevision() {
        return $this->revision;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora1() {
        return $this->hora1;
    }

    function getHora2() {
        return $this->hora2;
    }

    function getZona() {
        return $this->zona;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getCierre() {
        return $this->cierre;
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

    function setId_prueba($id_prueba) {
        $this->id_prueba = $id_prueba;
    }

    function setId_punto($id_punto) {
        $this->id_punto = $id_punto;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setId_persona($id_persona) {
        $this->id_persona = $id_persona;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setTipo_prueba($tipo_prueba) {
        $this->tipo_prueba = $tipo_prueba;
    }

    function setRevision($revision) {
        $this->revision = $revision;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora1($hora1) {
        $this->hora1 = $hora1;
    }

    function setHora2($hora2) {
        $this->hora2 = $hora2;
    }

    function setZona($zona) {
        $this->zona = $zona;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setCierre($cierre) {
        $this->cierre = $cierre;
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

    function getCuenta_secundaria() {
        return $this->cuenta_secundaria;
    }

    function getCuenta_principal() {
        return $this->cuenta_principal;
    }

    function setCuenta_secundaria($cuenta_secundaria) {
        $this->cuenta_secundaria = $cuenta_secundaria;
    }

    function setCuenta_principal($cuenta_principal) {
        $this->cuenta_principal = $cuenta_principal;
    }
  
    function getSeguimiento() {
        return $this->seguimiento;
    }

    function setSeguimiento($seguimiento) {
        $this->seguimiento = $seguimiento;
    }

    public function __construct() {
        $this->id_prueba="";
        $this->id_punto="";
        $this->codigo="";
        $this->id_persona="";
        $this->empresa="";
        $this->tipo_prueba="";
        $this->revision="";
        $this->id_usuario="";
        $this->fecha="";
        $this->hora1="";
        $this->hora2="";
        $this->zona="";
        $this->observaciones="";
        $this->cierre="";
        $this->estado="";
        $this->cuenta_secundaria="";
        $this->cuenta_principal="";
        $this->seguimiento="";
        $this->obj_data_provider= new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    public function obtener_prueba_alarma(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_PruebaAlarma 
                    LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_PruebaAlarma.ID_PuntoBCR 
                    LEFT OUTER JOIN T_Empresa ON T_Empresa.ID_Empresa = T_PruebaAlarma.ID_Empresa_Persona_Apertura", 
                    "T_PruebaAlarma.*, T_PuntoBCR.Nombre, T_PuntoBCR.Codigo,T_Empresa.Empresa", 
                    "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_PruebaAlarma 
                    LEFT OUTER JOIN T_PuntoBCR ON T_PuntoBCR.ID_PuntoBCR = T_PruebaAlarma.ID_PuntoBCR 
                    LEFT OUTER JOIN T_Empresa ON T_Empresa.ID_Empresa = T_PruebaAlarma.ID_Empresa_Persona_Apertura", 
                    "T_PruebaAlarma.*, T_PuntoBCR.Nombre, T_PuntoBCR.Codigo,T_Empresa.Empresa",
                    $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function guardar_reporte_prueba(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, ID_Persona_Reporta_Apertura, ID_Empresa_Persona_Apertura, Tipo_Prueba, Revision_cajero, ID_Usuario_reporte", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->id_persona."','".$this->empresa."','".$this->tipo_prueba."','".$this->revision."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma","ID_Persona_Reporta_Apertura='".$this->id_persona."',ID_Empresa_Persona_Apertura='".$this->empresa."', Tipo_Prueba='".$this->tipo_prueba."',Revision_cajero='".$this->revision."', ID_Usuario_reporte='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function guardar_reporte_tipo_prueba(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Tipo_Prueba, Revision_cajero, ID_Usuario_reporte", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->tipo_prueba."','".$this->revision."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma","Tipo_Prueba='".$this->tipo_prueba."',Revision_cajero='".$this->revision."',ID_Usuario_reporte='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
    public function guardar_apertura_alarma(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Hora_Apertura_Alarma, ID_Usuario_Prueba", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->hora1."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma","Hora_Apertura_Alarma='".$this->hora1."', ID_Usuario_Prueba='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar(); 
        }
    }
    
    public function guardar_prueba_alarma(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_PruebaAlarma","Hora_Prueba_Alarma='".$this->hora2."',Numero_Zona_Prueba='".$this->zona."', ID_Usuario_Prueba='".$this->id_usuario."'",
            "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    public function guardar_reporte_cierre(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, ID_Persona_Reporta_Cierre, ID_Empresa_Persona_Cierra, ID_Usuario_Reporte_Cierre", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->id_persona."','".$this->empresa."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma","ID_Persona_Reporta_Cierre='".$this->id_persona."',ID_Empresa_Persona_Cierra='".$this->empresa."', ID_Usuario_Reporte_Cierre='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function guarda_informacion_cierres(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Particion_Secundaria_Cierre, Particion_Principal_Cierre, ID_Usuario_Reporte_Cierre", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->cuenta_secundaria."','".$this->cuenta_principal."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma", "Particion_Secundaria_Cierre='".$this->cuenta_secundaria."', Particion_Principal_Cierre='".$this->cuenta_principal."', ID_Usuario_Reporte_Cierre='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function guardar_cierre(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Hora_Cierre_Alarma, ID_Usuario_Cierra", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->cierre."','".$this->id_usuario."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            //Llama al metodo para editar los datos correspondientes
            $this->obj_data_provider->edita_datos("T_PruebaAlarma", "Hora_Cierre_Alarma='".$this->cierre."', ID_Usuario_Cierra='".$this->id_usuario."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            //Metodo de la clase data provider que desconecta la sesión con la base de datos
            $this->obj_data_provider->desconectar();
        }
    }
    public function guardar_observaciones(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Observaciones", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->observaciones."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->edita_datos("T_PruebaAlarma", "Observaciones='".$this->observaciones."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            $this->obj_data_provider->desconectar();
        }
    }
    
    public function eliminar_registro_prueba_alarma() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->eliminar_datos("T_PruebaAlarma", $this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function guardar_seguimiento(){
        if($this->id_prueba==0){
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->inserta_datos("T_PruebaAlarma", "ID_PuntoBCR, Fecha, Seguimiento", 
                "'".$this->id_punto."','".date('Y-m-d')."','".$this->seguimiento."'");
            $this->obj_data_provider->trae_datos("T_PruebaAlarma","max(ID_Prueba_Alarma) ID_Prueba_Alarma","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }   else {
            $this->obj_data_provider->conectar();
            $this->obj_data_provider->edita_datos("T_PruebaAlarma", "Seguimiento='".$this->seguimiento."'",
                "T_PruebaAlarma.ID_Prueba_Alarma='".$this->id_prueba."'");
            $this->obj_data_provider->desconectar();
        }
    }
    
} ?>

