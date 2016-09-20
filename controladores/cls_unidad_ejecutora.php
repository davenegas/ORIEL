<?php
 class cls_unidad_ejecutora{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    public $arreglo2;
    private $condicion;
    public $estado;
    public $observaciones;
    public $departamento;
    public $numero_ue; 
    public $id_ultima_ue_ingresada;
    
    
    function getArreglo2() {
        return $this->arreglo2;
    }

    function setArreglo2($arreglo2) {
        $this->arreglo2 = $arreglo2;
    }

        function getId_ultima_ue_ingresada() {
        return $this->id_ultima_ue_ingresada;
    }

    function setId_ultima_ue_ingresada($id_ultima_ue_ingresada) {
        $this->id_ultima_ue_ingresada = $id_ultima_ue_ingresada;
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

    function getDepartamento() {
        return $this->departamento;
    }

    function getNumero_ue() {
        return $this->numero_ue;
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

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setNumero_ue($numero_ue) {
        $this->numero_ue = $numero_ue;
    }

    public function __construct() {
        $this->id="";
        $this->id2="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->observaciones="";
        $this->estado="";
        $this->departamento="";
        $this->numero_ue=""; 
    }
    
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ue_por_nombre(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      
      $this->obj_data_provider->trae_datos("t_unidadejecutora","ID_Unidad_Ejecutora","Departamento='".$this->departamento."'");
      
      $this->arreglo=$this->obj_data_provider->getArreglo();
     
      $this->obj_data_provider->desconectar();
      
      if (count($this->arreglo)>0){
          $this->setId($this->arreglo[0]['ID_Unidad_Ejecutora']);
         
      }else
      {
          $this->setId(0);
      }   
  }
    
    public function obtener_unidades_ejecutoras() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_UnidadEjecutora", 
                    "*",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_UnidadEjecutora", 
                    "*",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function agregar_puntobcr_ue(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_UE_PuntoBCR", "ID_PuntoBCR, ID_Unidad_Ejecutora", "'".$this->id2."','".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    public function eliminar_relacion_puntobcr_ue(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_UE_PuntoBCR", "ID_PuntoBCR='".$this->id2."' AND ID_Unidad_Ejecutora='".$this->id."'");
        $this->obj_data_provider->desconectar();
    }
    
     public function agregar_nueva_ue(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_unidadejecutora", "Numero_UE, Departamento, Observaciones,Estado", "'".$this->numero_ue."','".$this->departamento."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nueva_ue_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos_para_prontuario("t_unidadejecutora", "Numero_UE, Departamento, Observaciones,Estado", "'".$this->numero_ue."','".$this->departamento."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_unidadejecutora","Numero_UE='".$this->numero_ue."',Departamento='".$this->departamento."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue_para_prontuario(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_unidadejecutora","Numero_UE='".$this->numero_ue."',Departamento='".$this->departamento."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'",$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }

     //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultima_ue_ingresada(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      
      $this->obj_data_provider->trae_datos("t_unidadejecutora","max(ID_Unidad_Ejecutora) ID_Unidad_Ejecutora","");
      
      $this->arreglo2=$this->obj_data_provider->getArreglo();
     
      $this->obj_data_provider->desconectar();
      
      if (count($this->arreglo2)>0){
          $this->setId_ultima_ue_ingresada($this->arreglo2[0]['ID_Unidad_Ejecutora']);
         
      }else
      {
          $this->setId_ultima_ue_ingresada(0);
      }   
  }
     //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue_de_personas(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_personal","ID_Unidad_Ejecutora=".$this->id_ultima_ue_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
     //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue_de_personas_para_prontuario(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_personal","ID_Unidad_Ejecutora=".$this->id_ultima_ue_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
      //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue_de_sitios_bcr(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_ue_puntobcr","ID_Unidad_Ejecutora=".$this->id_ultima_ue_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
      //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_ue_de_sitios_bcr_para_prontuario(){
        $this->obj_data_provider->conectar();
        
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_ue_puntobcr","ID_Unidad_Ejecutora=".$this->id_ultima_ue_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
     function eliminar_ue_sobrantes_para_prontuario(){
          
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_unidadejecutora", $this->condicion);
        $this->obj_data_provider->desconectar();
  
    }
    function eliminar_ue_sobrantes(){
          
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_unidadejecutora", $this->condicion);
        $this->obj_data_provider->desconectar();
  
    }
 }?>