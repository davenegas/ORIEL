<?php
 class cls_tipo_telefono{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    public $arreglo2;
    private$condicion;
    public $estado;
    public $observaciones;
    public $tipo;
    public $numero_tt; 
    public $id_ultima_tt_ingresada;
    
    
    function getArreglo2() {
        return $this->arreglo2;
    }

    function setArreglo2($arreglo2) {
        $this->arreglo2 = $arreglo2;
    }

    function getId_ultima_tt_ingresada() {
        return $this->id_ultima_tt_ingresada;
    }

    function setId_ultima_tt_ingresada($id_ultima_tt_ingresada) {
        $this->id_ultima_tt_ingresada = $id_ultima_tt_ingresada;
    }
    
    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
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

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getTipo_Telefono() {
        return $this->tipo;
    }

    function getID_Tipo_Telefono() {
        return $this->numero_tt;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
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

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setTipo_Telefono($tipo) {
        $this->tipo = $tipo;
    }

    function setID_Tipo_Telefono($numero_tt) {
        $this->numero_tt = $numero_tt;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->observaciones="";
        $this->estado="";
        $this->tipo="";
        $this->numero_tt=""; 
    }
    
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_tt_por_nombre(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_tipotelefono","ID_Tipo_Telefono","Tipo_Telefono='".$this->tipo."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();

        if (count($this->arreglo)>0){
            $this->setId($this->arreglo[0]['ID_Tipo_Telefono']);
        }else {
            $this->setId(0);
        }   
    }
    
    public function obtener_tipo_telefono() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_TipoTelefono", 
                "*",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_TipoTelefono", 
                "*",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function agregar_puntobcr_tt(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_TT_PuntoBCR", "ID_PuntoBCR, ID_Tipo_Telefono", "'".$this->id2."','".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function eliminar_relacion_puntobcr_tt(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_TT_PuntoBCR", "ID_PuntoBCR='".$this->id2."' AND ID_Tipo_Telefono='".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nueva_tt(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_tipotelefono", "ID_Tipo_Telefono, Tipo_Telefono, Observaciones,Estado", "null,'".$this->tipo."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nueva_tt_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos_para_prontuario("t_tipotelefono", "ID_Tipo_Telefono, Tipo_Telefono, Observaciones,Estado", "null,'".$this->tipo."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_tipotelefono","Tipo_Telefono='".$this->tipo."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_tipotelefono","ID_Tipo_Telefono='".$this->numero_tt."',Tipo='".$this->tipo."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }

     //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultima_tt_ingresada(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_tipotelefono","max(ID_Tipo_Telefono) ID_Tipo_Telefono","");
        $this->arreglo2=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();

        if (count($this->arreglo2)>0){
            $this->setId_ultima_tt_ingresada($this->arreglo2[0]['ID_Tipo_Telefono']);
        }else {
            $this->setId_ultima_tt_ingresada(0);
        }   
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt_de_personas(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_personal","ID_Tipo_Telefono=".$this->id_ultima_tt_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt_de_personas_para_prontuario(){
        $this->obj_data_provider->conectar();   
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_personal","ID_Tipo_Telefono=".$this->id_ultima_tt_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt_de_sitios_bcr(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_tt_puntobcr","ID_Tipo_Telefono=".$this->id_ultima_tt_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_tt_de_sitios_bcr_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_tt_puntobcr","ID_Tipo_Telefono=".$this->id_ultima_tt_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_tt_sobrantes_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_tipotelefono", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_tt_sobrantes(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_tipotelefono", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function cambiar_estado_tt(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_tipotelefono","Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
 }?>