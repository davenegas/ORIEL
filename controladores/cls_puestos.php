<?php
 class cls_puestos{
    public $id;
    public $obj_data_provider;
    public $arreglo;
    public $arreglo2;
    public $condicion;
    public $estado;
    public $observaciones;
    public $puesto;
    public $id_ultimo_puesto_ingresado;
    
    function getObservaciones() {
        return $this->observaciones;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

        function getId() {
        return $this->id;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getArreglo2() {
        return $this->arreglo2;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPuesto() {
        return $this->puesto;
    }

    function getId_ultimo_puesto_ingresado() {
        return $this->id_ultimo_puesto_ingresado;
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

    function setArreglo2($arreglo2) {
        $this->arreglo2 = $arreglo2;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPuesto($puesto) {
        $this->puesto = $puesto;
    }

    function setId_ultimo_puesto_ingresado($id_ultimo_puesto_ingresado) {
        $this->id_ultimo_puesto_ingresado = $id_ultimo_puesto_ingresado;
    }

    public function __construct() {
        $this->id="";
        $this->condicion="";
        $this->arreglo;
        $this->arreglo2;
        $this->obj_data_provider=new Data_Provider();
        $this->observaciones="";
        $this->estado="";
        $this->puesto="";
    }
    
    public function obtener_puestos() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_puesto", 
                "*",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_puesto", 
                "*",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
       
     public function agregar_nuevo_puesto(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_puesto", "Puesto,Observaciones,Estado", "'".$this->puesto."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nuevo_puesto_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos_para_prontuario("t_puesto", "Puesto,Observaciones,Estado", "'".$this->puesto."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    function edita_puesto(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_puesto","Puesto='".$this->puesto."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    function edita_puesto_para_prontuario(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_puesto","Puesto='".$this->puesto."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }

     //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultimo_puesto_ingresado(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_puesto","max(ID_Puesto) ID_Puesto","");
        $this->arreglo2=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();

        if (count($this->arreglo2)>0){
            $this->setId_ultimo_puesto_ingresado($this->arreglo2[0]['ID_Puesto']);
        }else {
            $this->setId_ultimo_puesto_ingresado(0);
        }   
    }
  
  //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_puesto_por_nombre(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_puesto","ID_Puesto","Puesto='".$this->puesto."'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();

        if (count($this->arreglo)>0){
            $this->setId($this->arreglo[0]['ID_Puesto']);
        }else {
            $this->setId(0);
        }   
    }
     //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_puesto_de_personas(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_personal","ID_Puesto=".$this->id_ultimo_puesto_ingresado,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
     //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_puesto_de_personas_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_personal","ID_Puesto=".$this->id_ultimo_puesto_ingresado,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
     function eliminar_puestos_sobrantes(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_puesto", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_puestos_sobrantes_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_puesto", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    
 }