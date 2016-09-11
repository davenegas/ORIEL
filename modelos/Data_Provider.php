<?php

/*
 * Clase DataProvider, parte de la capa modelo de acceso a los datos
 * Clase principal para interactuar con la base de datos BD_Gerencia_Seguridad de MySQL
 */
class Data_Provider{
    /*
     * Variables publicas, que determinan los parametros de conexión a la base de datos,
     * así como el uso de variables propias de la clase para gestión de la información
     */
   //Nombre del hospedaje de la base de datos
   private $mvc_bd_hostname="";
   //Nombre de la base de datos a usar
   private $mvc_bd_nombre="";
   //Nombre de usuario del motor de base de datos
   private $mvc_bd_usuario;
   //Clave del usuario
   private $mvc_bd_clave;
   //Variable contenedora de los parámetros de la conexión con la bd
   private $conexion;
   //Variable contenedora de resultados de tipo SELECT en SQL, almacenadora de registros de datos
   private $arreglo;
   //Variable que almacena el string SQL que se va a utilizar
   private $consulta;
   // Variable controladora del resultado de la operación, si se ejecutó con éxito o no
   private $resultado_operacion;
   // Variable que almacena el ID de la última inserción realizada en una tabla en específico
   private $ultimo_id_ingresado;
   
   //Método que retorna el valor del último ID ingresado
   function getUltimo_id_ingresado() {
       //Referencia al atributo propio de la clase
       return $this->ultimo_id_ingresado;
   }

   // Metodo que inicializa el último valor ingresado
   function setUltimo_id_ingresado($ultimo_id_ingresado) {
       //Referencia al atributo propio de la clase
       $this->ultimo_id_ingresado = $ultimo_id_ingresado;
   }

   // Metodo que retorna el valor de la variable resultado operación   
   function getResultado_operacion() {
       //Referencia al atributo propio de la clase
       return $this->resultado_operacion;
   }

   // Método que establece un valor a la variable resultado operación
   function setResultado_operacion($resultado_operacion) {
       //Referencia al atributo propio de la clase
       $this->resultado_operacion = $resultado_operacion;
   }
    
   // Método que retorna el nombre del servidor que hospeda la bd
   function getMvc_bd_hostname() {
       //Referencia al atributo propio de la clase
       return $this->mvc_bd_hostname;
   }

   //Método que retorna el nombre de la base de datos
   function getMvc_bd_nombre() {
       //Referencia al atributo propio de la clase
       return $this->mvc_bd_nombre;
   }

   // Método que retorna el nombre del usuario con acceso a la base de datos
   function getMvc_bd_usuario() {
       //Referencia al atributo propio de la clase
       return $this->mvc_bd_usuario;
   }

   //Método que retorna la clae del usuario
   function getMvc_bd_clave() {
       //Referencia al atributo propio de la clase
       return $this->mvc_bd_clave;
   }

   //Método que retorna el objeto conexión a la base de datos
   function getConexion() {
       //Referencia al atributo propio de la clase
       return $this->conexion;
   }

   // Método que devuelve el arreglo de resultados propios de la consulta a la base de datos
   function getArreglo() {
       //Referencia al atributo propio de la clase
       return $this->arreglo;
   }

   //Método que retorna el string SQL que se ejecuta en la base de datos
   function getConsulta() {
       //Referencia al atributo propio de la clase
       return $this->consulta;
   }

   // Método que establece el nombre del servidor que hospeda la base de datos
   function setMvc_bd_hostname($mvc_bd_hostname) {
       //Referencia al atributo propio de la clase
       $this->mvc_bd_hostname = $mvc_bd_hostname;
   }

   //Método que estable el nombre de la base de datos a utilizar
   function setMvc_bd_nombre($mvc_bd_nombre) {
       //Referencia al atributo propio de la clase
       $this->mvc_bd_nombre = $mvc_bd_nombre;
   }

   //Métod que establece el nombre del usuario que se conectará a la base de datos
   function setMvc_bd_usuario($mvc_bd_usuario) {
       //Referencia al atributo propio de la clase
       $this->mvc_bd_usuario = $mvc_bd_usuario;
   }

   //Método que establece la clave del usuario que se conecta con la base de datos
   function setMvc_bd_clave($mvc_bd_clave) {
       //Referencia al atributo propio de la clase
       $this->mvc_bd_clave = $mvc_bd_clave;
   }

   // Metodo que establece el objeto conexión con la base de datos
   function setConexion($conexion) {
       //Referencia al atributo propio de la clase
       $this->conexion = $conexion;
   }

   // Método que establece e inicializa la estructura que almacena los resultados de consulta a la base de datos
   function setArreglo($arreglo) {
       //Referencia al atributo propio de la clase
       $this->arreglo = $arreglo;
   }

   //Establece el string SQL que se ejecutará sobre la base de datos.
   function setConsulta($consulta) {
       //Referencia al atributo propio de la clase
       $this->consulta = $consulta;
   }

   //Constructor que inicializa las variables 
   public function __construct(){
   
       //Controlador de excepciones
       try{
           
            //Inicializa el nombre del servidor contenedor de la base de datos
            $this->mvc_bd_hostname = "localhost";
            //Inicializa el nombre de la base de datos
            $this->mvc_bd_nombre   = "bd_Gerencia_Seguridad";
            //Inicializa el nombre del usuario que puede acceder la base de datos
            $this->mvc_bd_usuario  = "root";
            //Inicializa la clave de acceso a la base de datos
            $this->mvc_bd_clave    = "";
            //Es capaz de representar cualquier carácter Unicode a nivel de base de datos
            $this->consulta="SET NAMES 'utf8'";

            
            //Acapara los errores que se puedan presentar y muestra en pantalla lo correspondiente
       }catch (Exception $e){
           //Muestra en pantalla un mensaje de error
           echo 'Hubo un problema al inicializar las variables de conexión';
           //Asigna a falso el valor de la variable resultado de la operación.
           $this->resultado_operacion=false;
       }
       
   }

   //Metodo de conexión a la base de datos, 
   public function conectar(){
    try{
       // Crea un objeto conexión con los parámetros necesarios de enlace a la base de datos Gerencia_Seguridad 
       $this->conexion=new mysqli($this->mvc_bd_hostname,$this->mvc_bd_usuario,$this->mvc_bd_clave, $this->mvc_bd_nombre);
       //Permite ejecutar una consulta debntro de la base de datos
       $this->conexion->query($this->consulta);
       // Lleva el control del resultado de la operación ejecuta en la bd
       $this->resultado_operacion=true;
    }catch (Exception $e){
           //Notifica de un error al conectarse a la base de datos
           echo 'Hubo un problema al realizar la conexión a la base de datos';
           //Asigna a falso el valor de la variable resultado de la operación.
            $this->resultado_operacion=false;
       }
   }
   
   // Método que permite destruir la conexión establecida con la base de datos
   public function desconectar(){
       //Cierra la conexión
       mysqli_close($this->conexion);
       // Asigna verdadero al resultado de la operación
       $this->resultado_operacion=true;
   }
   
   //Método que permite traer información de la base de datos mediante consultas SQL
    public function trae_datos($table,$campos,$condicion){
       
        // Elimina la instancia del arreglo
        unset($this->arreglo);
       
        // Verifica si la consulta SQL tiene una condición de búsqueda
        if ($condicion==""){
            $consulta=$this->conexion->query("select ".$campos." from ".$table.";");
            //echo ("select ".$campos." from ".$table.";");
        }else{
            $consulta=$this->conexion->query("select ".$campos." from ".$table." where ".$condicion.";");
            //echo ("select ".$campos." from ".$table." where ".$condicion.";");
        } 
        
        //echo "select ".$campos." from ".$table." where ".$condicion.";";
        
        if ($consulta!=null){
            while($filas=$consulta->fetch_assoc()){
                $this->arreglo[]=$filas;   
            }

            if (!(isset($this->arreglo))){
                $this->arreglo=null;
                $this->resultado_operacion=false;
            }else{
                $this->resultado_operacion=true;
            }
        }else{
              $arreglo=null;
        
        }
   }
   
   public function inserta_datos($table,$campos,$valores){
            
        // Gestión de insercion del metodo de la clase
        $consulta=$this->conexion->query("insert into ".$table."(".$campos.") values(".$valores.");");
        //echo ("insert into ".$table."(".$campos.") values(".$valores.");");
        $this->resultado_operacion=true;
        
        
         //Registro de la trazabilidad del sistema
        $cadena_sql=str_replace(","," - ","insert into ".$table."(".$campos.") values(".$valores.");");
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        $cadena_sql = str_replace("(","[",$cadena_sql);
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','Insercion - Sin Valores Anteriores','".$cadena_sql."');");
        
   }    
   
   public function inserta_datos_para_uso_de_trazabilidad($detalle_sql){
            
        // Gestión de insercion del metodo de la clase
        $consulta=$this->conexion->query($detalle_sql);
        //echo ("insert into ".$table."(".$campos.") values(".$valores.");");
        $this->resultado_operacion=true;
          
   }    
   public function insertar_datos_con_phpmyadmin($sql){
       $consulta=$this->conexion->query($sql);
       $this->resultado_operacion=true;
       //echo($sql);
   }

   public function edita_datos($table,$campos_valores,$condicion){
       
        $this->trae_datos($table, "*", $condicion);
        $valores_iniciales="Edicion - Valores anteriores de la tabla formato SELECT:\n ";
        if (count($this->getArreglo())>0){
            $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->getArreglo()[0]);
        }
        $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
        $valores_iniciales=$valores_iniciales . serialize($this->getArreglo()[0]);
        
        $consulta=$this->conexion->query("update ".$table." set ".$campos_valores." where ".$condicion.";");
        //echo("update ".$table." set ".$campos_valores." where ".$condicion.";");
        $this->resultado_operacion=true;
        
        
         //Registro de la trazabilidad del sistema
        $cadena_sql=str_replace(","," - ","update ".$table." set ".$campos_valores." where ".$condicion.";");
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        $cadena_sql = str_replace("(","[",$cadena_sql);
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','".$valores_iniciales. "','".$cadena_sql."');");       
        
   }
   
   public function eliminar_datos($table,$condicion){

       $this->trae_datos($table, "*", $condicion);
        $valores_iniciales="Eliminacion - Valores anteriores de la tabla formato SELECT:\n ";
        if (count($this->getArreglo())>0){
            $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->getArreglo()[0]);
        }
        $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
        $valores_iniciales=$valores_iniciales . serialize($this->getArreglo()[0]);
       
       if ($condicion==""){
            $consulta=$this->conexion->query("delete from ".$table.";");
            $cadena_sql=str_replace(","," - ","delete from ".$table.";");
            //echo("delete from ".$table.";");
       }else{
            $consulta=$this->conexion->query("delete from ".$table." where ".$condicion.";");
            $cadena_sql=str_replace(","," - ","delete from ".$table." where ".$condicion.";");
            //echo("delete from ".$table." where ".$condicion.";");
       }    
       
        //Registro de la trazabilidad del sistema
        
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        $cadena_sql = str_replace("(","[",$cadena_sql);
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','".$valores_iniciales. "','".$cadena_sql."');");       
   }
}


