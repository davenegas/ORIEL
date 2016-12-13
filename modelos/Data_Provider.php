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
            $this->mvc_bd_clave    = "eda198319871983oriel";
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
   //Este metodo recibe el nombre de la tabla, campos de la misma y la condición de búsqueda en caso de que exista
    public function trae_datos($table,$campos,$condicion){
       
        //echo "select ".$campos." from ".$table." where ".$condicion.";";
        // Elimina la instancia del arreglo
        unset($this->arreglo);
       
        // Verifica si la consulta SQL tiene una condición de búsqueda
        if ($condicion==""){
            //En caso de no tener condición, agrega campos y nombre de la tabla solamente
            $consulta=$this->conexion->query("select ".$campos." from ".$table.";");
            //echo ("select ".$campos." from ".$table.";");
        }else{
            //De lo contrario asigna la condición a la consulta SQL
            $consulta=$this->conexion->query("select ".$campos." from ".$table." where ".$condicion.";");
            //echo ("select ".$campos." from ".$table." where ".$condicion.";");
        } 
        
        //echo "select ".$campos." from ".$table." where ".$condicion.";";
        
        // Una vez ejecutada la consulta verifica si trae resultados,
        if ($consulta!=null){
            // De tener resultados, agrega cada registro dentro del vector arreglo
            while($filas=$consulta->fetch_assoc()){
                //Crea una nueva fila por cada registro encontrado en la consulta
                $this->arreglo[]=$filas;   
            }

            // Si el arreglo no está establecido, lo inicializa en null
            if (!(isset($this->arreglo))){
                //Inicializa en null
                $this->arreglo=null;
                //Establece la variable de control en falso
                $this->resultado_operacion=false;
            }else{
                // De lo contrario establece la variable de control a true
                $this->resultado_operacion=true;
            }
        }else{
            //Establece el arreglo a null, para que pueda ser validado cuando hay cero resultados en la consulta
              $arreglo=null;
        
        }
   }
   
   // Método ABC SQL que permite ingresar información en las tablas de la bd
   public function inserta_datos($table,$campos,$valores){
            
        // Gestión de insercion del metodo de la clase
       //Arma el insert SQL, de acuerdo a los parámetros recibidos por usuario
       // echo "insert into ".$table."(".$campos.") values(".$valores.");";
        $consulta=$this->conexion->query("insert into ".$table."(".$campos.") values(".$valores.");");
        //echo ("insert into ".$table."(".$campos.") values(".$valores.");");
        //Establece a true el resultado de operación
        $this->resultado_operacion=true;
        
        
         //Registro de la trazabilidad del sistema
        // Define una variable cadena que almacenará la consulta SQL, Quita mediante la función replace las comas (coloca guiones en su lugar), para no tener conflictos en el momeno de insertar la variable al campo de la tabla traza
        $cadena_sql=str_replace(","," - ","insert into ".$table."(".$campos.") values(".$valores.");");
        //Reemplaza las comillas con espacios en blanco
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        // Reemplaza los paréntesis redondos con cuadrados
        $cadena_sql = str_replace("(","[",$cadena_sql);
        //Reemplaza los paréntesis redondos con cuadradps
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        //Inserta el registro de traza en la tabla con los datos correspondientes, de usuario, consulta, etc. En este caso no hay valor antiguo, debido a que es una inserción de datos.
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','Insercion - Sin Valores Anteriores','".$cadena_sql."');");
        
   }    
   
   // Método ABC SQL que permite ingresar información en las tablas de la bd
   public function inserta_datos_para_prontuario($table,$campos,$valores){
            
        // Gestión de insercion del metodo de la clase
       //Arma el insert SQL, de acuerdo a los parámetros recibidos por usuario
       
        $consulta=$this->conexion->query("insert into ".$table."(".$campos.") values(".$valores.");");
        //echo ("insert into ".$table."(".$campos.") values(".$valores.");");
        //Establece a true el resultado de operación
        $this->resultado_operacion=true;
  
   }    
   
    // Método ABC SQL que permite ingresar información en las tablas de la bd
   public function inserta_datos_para_prontuario_especial($table,$campos,$valores){
            
        // Gestión de insercion del metodo de la clase
       //Arma el insert SQL, de acuerdo a los parámetros recibidos por usuario
       
        $consulta=$this->conexion->query("insert into ".$table."(".$campos.") ".$valores.";");
        //echo ("insert into ".$table."(".$campos.") values(".$valores.");");
        //Establece a true el resultado de operación
        $this->resultado_operacion=true;
  
   }    
   
   //Método utilizado para insertar datos en la tabla traza, para consultas ABC mediante procedimientos almacenados
   public function inserta_datos_para_uso_de_trazabilidad($detalle_sql){
            
        // Gestión de insercion del metodo de la clase, recibe el string SQL completo a ejecutar
        $consulta=$this->conexion->query($detalle_sql);
        //echo ($detalle_sql);
        //estable la variable de control a true
        $this->resultado_operacion=true;       
   }    
   
   //Método utilizado para ejecutar procedimiento almacenado que inserta datos en la BD
   public function insertar_datos_con_phpmyadmin($sql){
       //Ejecuta la sentencia SQL
       $consulta=$this->conexion->query($sql);
       //estable la variable de control a true
       $this->resultado_operacion=true;
       //echo($sql);
   }

   //Metodo de la clase que permite editar datos en la bd, administrado también por trazabilidad
   // Recibe información de la tabla, los campos y la condición para encontrar el registro
   public function edita_datos($table,$campos_valores,$condicion){
       
        //Primero trae los datos actuales del registro a modificar para guardarlos en la tabla traza como valor antiguo o anterior
        $this->trae_datos($table, "*", $condicion);
        //Define una variable que se llama valores iniciales para armar el campo de la tabla traza
        $valores_iniciales="Edicion - Valores anteriores de la tabla formato SELECT:\n ";
        //Valida que la consulta haya traido algún dato
        if (count($this->getArreglo())>0){
            //Mediante la función implode, convierte a string el valor del registro traido por la consulta
            // Implode tambien muesta la estructura del vector, con los nombres de los campos
            $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->getArreglo()[0]);
        }
        // Agrega también los valores del vector sin los nombres de los campos
        $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
        // la función serialize trae los valores del vector
        $valores_iniciales=$valores_iniciales . serialize($this->getArreglo()[0]);
        
        // Ejecuta la edición de datos en la tabla correspondiente.
        $consulta=$this->conexion->query("update ".$table." set ".$campos_valores." where ".$condicion.";");
        //echo("update ".$table." set ".$campos_valores." where ".$condicion.";");
        //Estable a true la variable de control
        $this->resultado_operacion=true;
        
        
         //Registro de la trazabilidad del sistema
        // Define una variable cadena que almacenará la consulta SQL, Quita mediante la función replace las comas (coloca guiones en su lugar), para no tener conflictos en el momeno de insertar la variable al campo de la tabla traza
        $cadena_sql=str_replace(","," - ","update ".$table." set ".$campos_valores." where ".$condicion.";");
        //Reemplaza las comillas con espacios en blanco
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        // Reemplaza los paréntesis redondos con cuadrados
        $cadena_sql = str_replace("(","[",$cadena_sql);
        // Reemplaza los paréntesis redondos con cuadrados
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        //Inserta el registro de trazabilidad del sistema con el id de usuario, fecha, hora, valores nuevos y antiguos, etc.
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','".$valores_iniciales. "','".$cadena_sql."');");       
        
   }
   
    //Metodo de la clase que permite editar datos en la bd, administrado también por trazabilidad
   // Recibe información de la tabla, los campos y la condición para encontrar el registro
   public function edita_datos_para_prontuario($table,$campos_valores,$condicion){
       
        // Ejecuta la edición de datos en la tabla correspondiente.
        $consulta=$this->conexion->query("update ".$table." set ".$campos_valores." where ".$condicion.";");
        //echo("update ".$table." set ".$campos_valores." where ".$condicion.";");
        //Estable a true la variable de control
        $this->resultado_operacion=true;

   }
   
   //Método que permite eliminar registros de la BD
   public function eliminar_datos($table,$condicion){

       //echo "delete from ".$table." where ".$condicion.";";
       // Trae los datos de la bd que se van a eliminar, mediante la condición, nombre de la tabla, y todos los registros
       $this->trae_datos($table, "*", $condicion);
       //Establece una variable cadena para armar los datos iniciales que se encuentran en la base de datos
        $valores_iniciales="Eliminacion - Valores anteriores de la tabla formato SELECT:\n ";
        //Verifica que haya sido encontrado el registro a eliminar
        if (count($this->getArreglo())>0){
            // Agrega a la varaible valores iniciales la estructura completa del vector convertida a string
            $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->getArreglo()[0]);
        }
        // Agrega parte de la presentación para el campo correspondiente de la traza
        $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
        //Agrega a la variable los valores de cada uno de los campos del registro en cuestión
        $valores_iniciales=$valores_iniciales . serialize($this->getArreglo()[0]);
       
        //Verifica si existe alguna condición de búsqueda
       if ($condicion==""){
           //En caso de no haber condición realiza el borrado completo de la tabla
            $consulta=$this->conexion->query("delete from ".$table.";");
            //Reemplaza en la consulta SQL las comillas con guiones para efecto de insertar la consulta en la tabla traza
            $cadena_sql=str_replace(","," - ","delete from ".$table.";");
            //echo("delete from ".$table.";");
       }else{
           //Caso contrario asigna la condiciónd de búsqueda al SQL y procede a eliminar en la tabla
            $consulta=$this->conexion->query("delete from ".$table." where ".$condicion.";");
            //Reemplaza en la consulta SQL, las comillas con guiones para efecto de insertar la consulta en la tabla traza
            $cadena_sql=str_replace(","," - ","delete from ".$table." where ".$condicion.";");
            //echo("delete from ".$table." where ".$condicion.";");
       }    
       //echo $consulta;
        //Registro de la trazabilidad del sistema
        
       //Reemplaza las comillas con espacios en blanco
        $cadena_sql=str_replace("'"," ",$cadena_sql);
        //Remplaza los paréntesis con paréntesis cuadrados
        $cadena_sql = str_replace("(","[",$cadena_sql);
        //Remplaza los paréntesis con paréntesis cuadrados
        $cadena_sql = str_replace(")","]",$cadena_sql);
        
        //Inserta el registro en la tabla traza con los datos requeridos, usuario, fecha, hora, datos anteriores, etc.
        $consulta=$this->conexion->query("insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'".$table."','".$valores_iniciales. "','".$cadena_sql."');");       
   }
   
   //Método que permite eliminar registros de la BD
   public function eliminar_datos_para_prontuario($table,$condicion){

       // Trae los datos de la bd que se van a eliminar, mediante la condición, nombre de la tabla, y todos los registros
       $this->trae_datos($table, "*", $condicion);
              
        //Verifica si existe alguna condición de búsqueda
       if ($condicion==""){
           //En caso de no haber condición realiza el borrado completo de la tabla
            $consulta=$this->conexion->query("delete from ".$table.";");
            //Reemplaza en la consulta SQL las comillas con guiones para efecto de insertar la consulta en la tabla traza
           
       }else{
           //Caso contrario asigna la condiciónd de búsqueda al SQL y procede a eliminar en la tabla
            $consulta=$this->conexion->query("delete from ".$table." where ".$condicion.";");
            //Reemplaza en la consulta SQL, las comillas con guiones para efecto de insertar la consulta en la tabla traza
           
       }    
      
   }
}


