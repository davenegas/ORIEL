<?php

class cls_rapid_eye_db{
        
    private $ruta;
    private $nombre_db;
    private $usuario;
    private $clave;
    private $arreglo;

    //Objeto de tipo data provider, que entrega y recibe información para interacturar con la bd
    private $obj_access_provider;
    private $condicion;

    function getArreglo() {
        return $this->arreglo;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

      function getRuta() {
        return $this->ruta;
    }

    function getNombre_db() {
        return $this->nombre_db;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getObj_access_provider() {
        return $this->obj_access_provider;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setNombre_db($nombre_db) {
        $this->nombre_db = $nombre_db;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setObj_access_provider($obj_access_provider) {
        $this->obj_access_provider = $obj_access_provider;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

  
    //Constructor de la clase, permite inicializar atributos de la clase
    public function __construct() {
        $this->ruta="";
        $this->nombre_db="";
        $this->usuario="";
        $this->arreglo="";
        $this->clave="";
        $raiz=$_SERVER['DOCUMENT_ROOT'];

        //Formatea la ruta para verificar si tiene la cantidad adecuada de /
        if (substr($raiz,-1)!="/"){
            $raiz.="/";
        }
        $ruta=  $raiz."ORIEL/temp/";

        $this->obj_access_provider=new Access_Provider("REMCentral4","","Rach2Ros",$ruta);
        $this->condicion="";
    }  
  
    
    function obtiene_todos_los_sitios_de_rapid_eye(){
        if($this->condicion==""){
            $this->obj_access_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_access_provider->trae_datos("tbSites", "*", "");
            $this->arreglo=$this->obj_access_provider->getArreglo();
            //$this->obj_data_provider->desconectar();
        } else {
            
           $this->obj_access_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
           $this->obj_access_provider->trae_datos("tbSites", "*", $this->condicion);
           $this->arreglo=$this->obj_access_provider->getArreglo();
           //$this->obj_data_provider->desconectar();
        }
    }
  
    function edita_estado_rol(){
        $this->obj_data_provider->conectar();
        if ($this->estado==1){
            $estado_temp=0;
            $this->obj_data_provider->edita_datos("T_Usuario","Estado=0","ID_Rol=".$this->id);
        }  else {
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
        }  else {
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