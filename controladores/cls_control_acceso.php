<?php
class cls_control_acceso {
    public $id;
    public $owner;
    public $name;
    public $networkid;
    public $ipaddress;
    public $commstatus;
    public $createtime;
    public $createby;
    public $versionnum;
    public $serialnum;
    public $subnetmask;
    public $model;
    public $state;
    public $doorswitch;
    public $value;
    public $iou;
    public $moduloid;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion; 
    
    function getSerialnum() {
        return $this->serialnum;
    }

    function setSerialnum($serialnum) {
        $this->serialnum = $serialnum;
    }

    function getId() {
        return $this->id;
    }

    function getOwner() {
        return $this->owner;
    }

    function getName() {
        return $this->name;
    }

    function getNetworkid() {
        return $this->networkid;
    }

    function getIpaddress() {
        return $this->ipaddress;
    }

    function getCommstatus() {
        return $this->commstatus;
    }

    function getCreatetime() {
        return $this->createtime;
    }

    function getCreateby() {
        return $this->createby;
    }

    function getVersionnum() {
        return $this->versionnum;
    }

    function getSubnetmask() {
        return $this->subnetmask;
    }

    function getModel() {
        return $this->model;
    }

    function getState() {
        return $this->state;
    }

    function getDoorswitch() {
        return $this->doorswitch;
    }

    function getValue() {
        return $this->value;
    }

    function getIou() {
        return $this->iou;
    }

    function getModuloid() {
        return $this->moduloid;
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

    function setOwner($owner) {
        $this->owner = $owner;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setNetworkid($networkid) {
        $this->networkid = $networkid;
    }

    function setIpaddress($ipaddress) {
        $this->ipaddress = $ipaddress;
    }

    function setCommstatus($commstatus) {
        $this->commstatus = $commstatus;
    }

    function setCreatetime($createtime) {
        $this->createtime = $createtime;
    }

    function setCreateby($createby) {
        $this->createby = $createby;
    }

    function setVersionnum($versionnum) {
        $this->versionnum = $versionnum;
    }

    function setSubnetmask($subnetmask) {
        $this->subnetmask = $subnetmask;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setDoorswitch($doorswitch) {
        $this->doorswitch = $doorswitch;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function setIou($iou) {
        $this->iou = $iou;
    }

    function setModuloid($moduloid) {
        $this->moduloid = $moduloid;
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
        $this->owner="";
        $this->name="";
        $this->networkid="";
        $this->ipaddress="";
        $this->commstatus="";
        $this->createtime="";
        $this->createby="";
        $this->versionnum="";
        $this->subnetmask="";
        $this->model="";
        $this->state="";
        $this->doorswitch="";
        $this->value="";
        $this->iou="";
        $this->moduloid="";
        $this->estado="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
    }
    /////////////////////////
    public function obtener_controladores_completos(){
       $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Control_Acceso", 
                "*", 
                "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Control_Acceso", 
                "*",
                $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_puertas_controladas_completos(){
       $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Puerta_Controlada", 
                "*", 
                "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Puerta_Controlada", 
                "*",
                $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_modulos_controlados_completos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Modulo_Puerta_Controlada", 
                "*", 
                "");
        }else{
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Modulo_Puerta_Controlada", 
                "*",
                $this->condicion);
        }
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    function iniciar_transaccion_sql(){
        $this->obj_data_provider->iniciar_transaccion_sql();
    }
    
    function ejecutar_transaccion_sql(){     
        $this->obj_data_provider->ejecutar_transaccion_sql();   
    }
    
    function edicion_de_controlador_a_transaccion(){
        $this->obj_data_provider->agregar_edicion_de_datos_a_la_transaccion("T_Control_Acceso",
            "Owner='".$this->owner."',Name='".$this->name."',NetworkId='".$this->networkid.
            "',IPAddress='".$this->ipaddress."',CommStatus='".$this->commstatus."',CreateTime='".$this->createtime."',CreateBy='".$this->createby.
            "',VersionNum='".$this->versionnum."',SerialNum='".$this->serialnum."',SubnetMask='".$this->subnetmask.
            "',Model='".$this->model."',Estado='".$this->estado."'",
            $this->condicion);
    }
     
    function agregar_controlador_a_transaccion(){
        $this->obj_data_provider->agregar_inclusion_de_datos_a_la_transaccion("T_Control_Acceso", 
            "ID_Control_Acceso, Owner, Name, NetworkId, IPAddress, CommStatus, CreateTime, CreateBy, VersionNum, SerialNum, SubnetMask, Model, Estado", 
            "'".$this->id."','".$this->owner."','".$this->name."','".$this->networkid."','".$this->ipaddress."','".$this->commstatus."','".$this->createtime.
            "','".$this->createby."','".$this->versionnum."','".$this->serialnum."','".$this->subnetmask."','".$this->model."','".$this->estado."'");
    }
    
    function editar_estado_controlador_a_transaccion(){
        $this->obj_data_provider->agregar_edicion_de_datos_a_la_transaccion("T_Control_Acceso","Estado='".$this->estado."'",$this->condicion);
    }
    
}
