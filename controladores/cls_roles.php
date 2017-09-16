<?php

class cls_roles{
        
    private $id;
    private $descripcion;
    private $estado;
    //private $arreglo_modulos;
    private $arreglo_roles;
    //Objeto de tipo data provider, que entrega y recibe información para interacturar con la bd
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;
    private $id_ultimo_rol_ingresado;

    function getId_ultimo_rol_ingresado() {
        return $this->id_ultimo_rol_ingresado;
    }

    function setId_ultimo_rol_ingresado($id_ultimo_rol_ingresado) {
        $this->id_ultimo_rol_ingresado = $id_ultimo_rol_ingresado;
    }

    
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
        return $this->arreglo_roles;
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
        $this->arreglo_roles = $arreglo;
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
        $this->arreglo_roles;
        $this->id_ultimo_rol_ingresado=0;
        //Instancia el objeto de la clase data provider
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
    }  
  
    function obtiene_todos_los_roles(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Rol", "*", "ID_Rol<>1 ORDER BY Descripcion");
            $this->arreglo_roles=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        } else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Rol", "*", $this->condicion." and ID_Rol<>1 ORDER BY Descripcion");
            $this->arreglo_roles=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
  
    function edita_estado_rol(){
        $this->obj_data_provider->conectar();
        if ($this->estado==1){
            $estado_temp=0;
            $this->obj_data_provider->edita_datos("T_Usuario","Estado=0","ID_Rol=".$this->id);
        } else {
            $estado_temp=1;
        }
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("T_Rol","Estado=".$estado_temp,"ID_Rol=".$this->id);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
  
    function inserta_rol(){
        $this->obj_data_provider->conectar();
        //Verifica el valor de estado, para ingresarlo en el sistema
        if ($this->estado=="Activo"){
            $this->estado="1";
        } else {
            $this->estado="0";
        }
        //Llama al metodo que inserta la información
        $this->obj_data_provider->inserta_datos("T_Rol","Descripcion,Estado","'".$this->descripcion."',".$this->estado);
        $this->obj_data_provider->desconectar();
        //Esta variable registra y valida el resultado de la ejecución de la consulta, para ver si fue valida
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
  
    function edita_rol(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        //Verifica el estado del modulo de seguridad
        if ($this->estado=="Activo"){
            $this->estado="1";
        } else {
            $this->estado="0";
        }
        //Llama al metodo de edición de la clase data provider y envía los parámetros respectivos
        $this->obj_data_provider->edita_datos("T_Rol",
            "Estado=".$this->estado.",Descripcion='".$this->descripcion."'",
            "ID_Rol=".$this->id);
        //Desconecta la bd
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    }
  
    function obtiene_id_ultimo_rol_ingresado(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("T_Rol","Max(ID_Rol) as ID_Rol","");
        $this->arreglo_roles=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;

        if (count($this->arreglo_roles)>0){
            $this->setId_ultimo_rol_ingresado($this->arreglo_roles[0]['ID_Rol']);
        }else {
            $this->setId_ultimo_rol_ingresado(0);
        }    
    }
  
    function insertar_rolesModulo($id_Rol,$listaModulos){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("T_RolSubModulo", "ID_Rol=".$id_Rol);
        for ($index = 0; $index < count($listaModulos); $index++) {
            $this->obj_data_provider->inserta_datos("T_RolSubModulo", "ID_Rol,ID_Modulo", $id_Rol.",".$listaModulos[$index]);
        }
       $this->obj_data_provider->desconectar();
       $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
    } 
    
    
    function obtiene_todos_los_modulos_por_rol($idRol) {
        $this->obj_data_provider->conectar();
        //Llama al metodo que realiza la consulta a la bd

        $this->obj_data_provider->trae_datos("T_RolSubModulo", "ID_Modulo", "ID_Rol=".$idRol);
        $this->arreglo_roles=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    function desactivar_usuario_rol_inactivo(){
        // $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Usuario","Estado=0","ID_Rol=".$this->id);
        // $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}