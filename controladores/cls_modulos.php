<?php

/*
 * Clase Modulos perteneciente a la capa controlador, la cual permite realizar gestiones
 * en la tabla módulos de seguridad del sistema
 * 
 */

class cls_modulos{
        
    // Definicion de atributos de la clase
    private $id;
    private $descripcion;
    private $estado;
    private $arreglo_modulos;
    //Objeto de tipo data provider, que entrega y recibe información para interacturar con la bd
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getResultado_operacion() {
        return $this->resultado_operacion;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setResultado_operacion($resultado_operacion) {
        $this->resultado_operacion = $resultado_operacion;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getId() {
        return $this->id;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getDescripcion() {
        return $this->descripcion;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getEstado() {
        return $this->estado;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getArreglo() {
        return $this->arreglo_modulos;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function getCondicion() {
        return $this->condicion;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setId($id) {
        $this->id = $id;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setEstado($estado) {
        $this->estado = $estado;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setArreglo($arreglo) {
        $this->arreglo_modulos = $arreglo;
    }

    // Funciones Set y Get para administrar cada uno de los atributos de la clase
    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    //Constructor de la clase, permite inicializar atributos de la clase
    public function __construct() {
        $this->id="";
        $this->descripcion="";
        $this->estado="";
        $this->arreglo_modulos;
        //Instancia el objeto de la clase data provider
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";

    }

    //Metodo que utiliza el objeto data provider, para traer el listado completo de modulos de seguridad del sistema
    function obtiene_todos_los_modulos(){
        if ($this->condicion==""){
          $this->obj_data_provider->conectar();
          //Llama al metodo que realiza la consulta a la bd
          $this->obj_data_provider->trae_datos("T_Modulo ORDER BY Descripcion", "*", "");
          $this->arreglo_modulos=$this->obj_data_provider->getArreglo();
          $this->obj_data_provider->desconectar();
          $this->resultado_operacion=true;
        }
        else 
        {
          $this->obj_data_provider->conectar();
          //Llama al metodo que realiza la consulta a la bd
          $this->obj_data_provider->trae_datos("T_Modulo", "*", $this->condicion." ORDER BY Descripcion");
          $this->arreglo_modulos=$this->obj_data_provider->getArreglo();
          $this->obj_data_provider->desconectar();
          $this->resultado_operacion=true;
        }
    }  

    public function obtiene_lista_de_modulos_por_rol($rol){

          $this->obj_data_provider->conectar();
          $this->arreglo=$this->obj_data_provider->trae_datos("T_RolSubModulo inner join T_Rol on T_RolSubModulo.ID_Rol=T_Rol.ID_Rol inner join T_Modulo on T_RolSubModulo.ID_Modulo=T_Modulo.ID_Modulo", "T_Modulo.Descripcion", "T_Rol.ID_Rol=".$rol);
          $this->arreglo_modulos=$this->obj_data_provider->getArreglo();
          $this->obj_data_provider->desconectar();
          $this->resultado_operacion=true;

    }  

    //Metodo que inserta un nuevo modulo del sistema en la bd mediante el objeto data provider
    function inserta_modulo(){
        $this->obj_data_provider->conectar();
        //Verifica el valor de estado, para ingresarlo en el sistema
        if ($this->estado=="Activo"){
            $this->estado="1";
        }  else {
             $this->estado="0";
        }
        //Llama al metodo que inserta la información
        $this->obj_data_provider->inserta_datos("T_Modulo","Descripcion,Estado","'".$this->descripcion."',".$this->estado);
        $this->arreglo_modulos= $this->obj_data_provider->trae_datos("T_Modulo ORDER BY `ID_Modulo` DESC LIMIT 1", "*", $this->condicion);
        $this->arreglo_modulos=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        //Esta variable registra y valida el resultado de la ejecución de la consulta, para ver si fue valida
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }

    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_estado_modulo(){
        $this->obj_data_provider->conectar();
        if ($this->estado==1){
            $estado_temp=0;
        }  else {
            $estado_temp=1;
        }
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_Modulo","Estado=".$estado_temp,"ID_Modulo=".$this->id);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }

    //Este metodo realiza la tarea de actualizar la información de un módulo de seguridad en específico en la bd
    function edita_modulo(){

        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();

        //Verifica el estado del modulo de seguridad
         if ($this->estado=="Activo"){
            $this->estado="1";
        }  else {
             $this->estado="0";
        }


        //Llama al metodo de edición de la clase data provider y envía los parámetros respectivos
        $this->obj_data_provider->
                edita_datos("T_Modulo",
                        "Estado=".$this->estado.",Descripcion='".$this->descripcion."'",
                "ID_Modulo=".$this->id);

        //Desconecta la bd
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }

    //Metodo que verifica si ya existe un nombre de módulo en la bd
    function existe_modulo($nombre_de_modulo){
      
      //Conecta con la bd
      $this->obj_data_provider->conectar();
      //Ejecuta el metodo que busca en la bd
      $this->arreglo_modulos=$this->obj_data_provider->trae_datos("T_Modulo", "*", "Descripcion='".$nombre_de_modulo."'");
      //Desconecta el enlace
      $this->obj_data_provider->desconectar();
      
      //Obtiene el numero de filas contenidas en el arreglo, producto de la consulta.
      $contador=  count($this->arreglo_modulos);
      
      //Verifica si hay filas, para determinar si existe o no el modulo de seguridad.
      if ($contador>0){
          return true;
      }else{
          return false;
      }
      
  }  
  
    function eliminar_modulos_roles($id){
          
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_RolSubModulo", "ID_Modulo=".$id);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
    
    function insertar_rolesModulo($id_Rol,$modulo){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_RolSubModulo", "ID_Rol,ID_Modulo", $id_Rol.",".$modulo);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    } 
}
