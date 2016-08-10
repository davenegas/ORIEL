<?php

/*
 * Clase DataProvider, parte de la capa modelo de acceso a los datos
 */
class Data_Provider{
    /*
     * Variables publicas, que determinan los parametros de conexión a la base de datos,
     * así como el uso de variables propias de la clase para gestión de la información
     */
   private $mvc_bd_hostname="";
   private $mvc_bd_nombre="";
   private $mvc_bd_usuario;
   private $mvc_bd_clave;
   private $conexion;
   private $arreglo;
   private $consulta;
   private $resultado_operacion;
   private $ultimo_id_ingresado;
   
   function getUltimo_id_ingresado() {
       return $this->ultimo_id_ingresado;
   }

   function setUltimo_id_ingresado($ultimo_id_ingresado) {
       $this->ultimo_id_ingresado = $ultimo_id_ingresado;
   }

      
   function getResultado_operacion() {
       return $this->resultado_operacion;
   }

   function setResultado_operacion($resultado_operacion) {
       $this->resultado_operacion = $resultado_operacion;
   }
    
   function getMvc_bd_hostname() {
       return $this->mvc_bd_hostname;
   }

   function getMvc_bd_nombre() {
       return $this->mvc_bd_nombre;
   }

   function getMvc_bd_usuario() {
       return $this->mvc_bd_usuario;
   }

   function getMvc_bd_clave() {
       return $this->mvc_bd_clave;
   }

   function getConexion() {
       return $this->conexion;
   }

   function getArreglo() {
       return $this->arreglo;
   }

   function getConsulta() {
       return $this->consulta;
   }

   function setMvc_bd_hostname($mvc_bd_hostname) {
       $this->mvc_bd_hostname = $mvc_bd_hostname;
   }

   function setMvc_bd_nombre($mvc_bd_nombre) {
       $this->mvc_bd_nombre = $mvc_bd_nombre;
   }

   function setMvc_bd_usuario($mvc_bd_usuario) {
       $this->mvc_bd_usuario = $mvc_bd_usuario;
   }

   function setMvc_bd_clave($mvc_bd_clave) {
       $this->mvc_bd_clave = $mvc_bd_clave;
   }

   function setConexion($conexion) {
       $this->conexion = $conexion;
   }

   function setArreglo($arreglo) {
       $this->arreglo = $arreglo;
   }

   function setConsulta($consulta) {
       $this->consulta = $consulta;
   }

   //Constructor que inicializa las variables 
   public function __construct(){
   
       //Controlador de excepciones
       try{
           
            $this->mvc_bd_hostname = "localhost";
            $this->mvc_bd_nombre   = "bd_Gerencia_Seguridad";
            $this->mvc_bd_usuario  = "root";
            $this->mvc_bd_clave    = "";
            $this->consulta="SET NAMES 'utf8'";
          
            
            //Acapara los errores que se puedan presentar y muestra en pantalla lo correspondiente
       }catch (Exception $e){
           echo 'Hubo un problema al inicializar las variables de conexión';
           $this->resultado_operacion=false;
       }
       
   }

   //Metodo de conexión a la base de datos, 
   public function conectar(){
    try{
       $this->conexion=new mysqli($this->mvc_bd_hostname,$this->mvc_bd_usuario,$this->mvc_bd_clave, $this->mvc_bd_nombre);
       $this->conexion->query($this->consulta);
       $this->resultado_operacion=true;
    }catch (Exception $e){
           echo 'Hubo un problema al realizar la conexión a la base de datos';
            $this->resultado_operacion=false;
       }
   }
   
   public function desconectar(){
       
       mysqli_close($this->conexion);
       $this->resultado_operacion=true;
   }
   
    public function trae_datos($table,$campos,$condicion){
       
        unset($this->arreglo);
       
        if ($condicion==""){
            $consulta=$this->conexion->query("select ".$campos." from ".$table.";");
            //echo ("select ".$campos." from ".$table.";");
        }else{
            $consulta=$this->conexion->query("select ".$campos." from ".$table." where ".$condicion.";");
            //echo ("select ".$campos." from ".$table." where ".$condicion.";");
        } 
        
        while($filas=$consulta->fetch_assoc()){
            $this->arreglo[]=$filas;   
        }
        
        if (!(isset($this->arreglo))){
            $this->arreglo=null;
            $this->resultado_operacion=false;
        }else{
            $this->resultado_operacion=true;
        }
       
   }
   
   public function inserta_datos($table,$campos,$valores){
       
        $consulta=$this->conexion->query("insert into ".$table."(".$campos.") values(".$valores.");");
        $this->resultado_operacion=true;
        
   }    
   public function insertar_datos_con_phpmyadmin($sql){
       $consulta=$this->conexion->query($sql);
       $this->resultado_operacion=true;
       echo($sql);
   }

   public function edita_datos($table,$campos_valores,$condicion){
        $consulta=$this->conexion->query("update ".$table." set ".$campos_valores." where ".$condicion.";");
        $this->resultado_operacion=true;
        
   }
   
   public function eliminar_datos($table,$condicion){

       if ($condicion==""){
           $consulta=$this->conexion->query("delete from ".$table.";");
       }else{
           $consulta=$this->conexion->query("delete from ".$table." where ".$condicion.";");
       }   
   }
}


