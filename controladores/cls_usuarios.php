<?php

class cls_usuarios{
        
  public $id;
  public $nombre;
  public $apellido;
  public $correo;
  public $clave;
  public $arreglo;
  public $obj_data_provider;
  public $condicion;
  public $cedula;
  public $observaciones;
  public $estado;
  public $rol;

  
  function getId() {
      return $this->id;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getApellido() {
      return $this->apellido;
  }

  function getCorreo() {
      return $this->correo;
  }

  function getClave() {
      return $this->clave;
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

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setApellido($apellido) {
      $this->apellido = $apellido;
  }

  function setCorreo($email) {
      $this->correo = $email;
  }

  function setClave($clave) {
      $this->clave = $clave;
  }

  function setArreglo($arreglo) {
      $this->arreglo = $arreglo;
  }

  function setCondicion($condicion) {
      $this->condicion = $condicion;
  }
  function getCedula() {
      return $this->cedula;
  }

  function getObservaciones() {
      return $this->observaciones;
  }

  function getEstado() {
      return $this->estado;
  }

  function getRol() {
      return $this->rol;
  }

  function setCedula($cedula) {
      $this->cedula = $cedula;
  }

  function setObservaciones($observaciones) {
      $this->observaciones = $observaciones;
  }

  function setEstado($estado) {
      $this->estado = $estado;
  }

  function setRol($rol) {
      $this->rol = $rol;
  }

      
  public function __construct() {
      $this->nombre="";
      $this->apellido="";
      $this->email="";
      $this->clave="";
      $this->arreglo;
      $this->obj_data_provider=new Data_Provider();
      $this->condicion="";
      $this->cedula="";
      $this->observaciones="";
      $this->estado="";
      $this->rol="";
      
  }
  
  public function obtiene_todos_los_usuarios(){
      if($this->condicion==""){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Usuario left outer join T_Rol on T_Usuario.ID_Rol = T_Rol.ID_Rol", "T_Usuario.*,T_Rol.ID_Rol,T_Rol.Descripcion", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
      else
      {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Usuario", "*", $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
      }
  }  
  
   
  
  public function existe_usuario($nombre_de_usuario){
      

      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_Usuario", "*", "Cedula='".$nombre_de_usuario."'");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      
      $contador=  count($this->arreglo);
      
      if ($contador>0){
          return true;
      }else{
          return false;
      }
    
  }  

  public function tiene_clave_por_defecto($usuario,$clave){
      
      if ($clave===$usuario){
          return true;
      }else{
          return false;
      }
    
  }  
  
  public function valida_password_de_usuario($nombre_de_usuario,$clave){
      

      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_Usuario", "*", "Cedula='".$nombre_de_usuario."' AND "."Clave='".Encrypter::encrypt($clave)."'");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      
      $contador=  count($this->arreglo);
      
      if ($contador>0){
          return true;
      }else{
          return false;
      }
    
  }  
  
  public function el_usuario_esta_activo($nombre_de_usuario,$clave){
      

      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_Usuario", "*", "Cedula='".$nombre_de_usuario."' AND "."Clave='".Encrypter::encrypt($clave)."' AND Estado=1");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      
      $contador=  count($this->arreglo);
      
      if ($contador>0){
          return true;
      }else{
          return false;
      }
    
  }  
  
  public function guardar_usuario(){
      $this->obj_data_provider->conectar();
      $sql=("call sp_set_usuario('".$this->id."','".$this->nombre."','".$this->apellido."','".$this->cedula."','".$this->correo."','".$this->rol."','".$this->observaciones."','".$this->estado."','".Encrypter::encrypt($this->cedula)."')");
      $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
  }
  //Este metodo realiza la tarea de actualizar la información de un módulo de seguridad en específico en la bd
  function edita_passsword(){
      
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
          
      //Llama al metodo de edición de la clase data provider y envía los parámetros respectivos
      $this->obj_data_provider->
              edita_datos("T_Usuario",
                      "Clave='".  Encrypter::encrypt($this->clave)."'",
              "Cedula='".$this->nombre."'");
      
      //Desconecta la bd
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
  }
  
  public function edita_estado_usuario(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      if($this->estado==1){
        $this->estado=0;}
      else {
          $this->estado=1;} 
      
      //Llama al metodo de edición de la clase data provider y envía los parámetros respectivos
      $this->obj_data_provider->edita_datos("T_Usuario","Estado='".$this->estado."'", "ID_Usuario=".$this->id);
      
      //Desconecta la bd
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
  }
  
  public function reset_password_usuario(){
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->edita_datos("T_Usuario","Clave='".Encrypter::encrypt($this->clave)."'","ID_Usuario=".$this->id);
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
  }
  
  
  function obtiene_rol_nombre_apellido_de_usuario($usuario){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      
      $this->obj_data_provider->trae_datos("T_Usuario","*","Cedula='".$usuario."'");
      
      $this->arreglo_roles=$this->obj_data_provider->getArreglo();
     
      $this->obj_data_provider->desconectar();
      
      $this->resultado_operacion=true;
      
      if (count($this->arreglo_roles)>0){
          $this->setRol($this->arreglo_roles[0]['ID_Rol']);
          $this->setNombre($this->arreglo_roles[0]['Nombre']);
          $this->setApellido($this->arreglo_roles[0]['Apellido']);
      }else
      {
          $this->setRol(0);
      }    
  }
  
   function obtiene_correo_y_password_de_usuario($usuario){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      
      $this->obj_data_provider->trae_datos("T_Usuario","*","Cedula='".$usuario."'");
      
      $this->arreglo=$this->obj_data_provider->getArreglo();
     
      $this->obj_data_provider->desconectar();
      
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
          $this->setCorreo($this->arreglo[0]['Correo']);
          $this->setClave(Encrypter::decrypt($this->arreglo[0]['Clave']));

      }
  }
}
