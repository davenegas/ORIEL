<?php
class cls_empresa{
    public $id;
    public $empresa;
    public $observaciones;
    public $estado;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    
    function getId() {
        return $this->id;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
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

    function setId($id) {
        $this->id = $id;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
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

    public function __construct() {
        $this->id="";
        $this->empresa="";
        $this->observaciones="";
        $this->estado="";
        $this->obj_data_provider=new Data_Provider();
        $this->arreglo;
        $this->condicion="";
    }
    
    function obtiene_todas_las_empresas(){
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Empresa", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
       
            $this->resultado_operacion=true;
        }
        else{
            $this->obj_data_provider->conectar();
            //Llama al metodo que realiza la consulta a la bd
            $this->obj_data_provider->trae_datos("T_Empresa", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function guardar_empresa() {
        $this->obj_data_provider->conectar();
        
        if ($this->id==0){
             //Registro de la trazabilidad del sistema
            $cadena_sql=str_replace(","," - ","call sp_set_empresa(Inserta Datos en T_Empresa ID_Empresa='".$this->id."',Empresa='".$this->empresa."',Observaciones='".$this->observaciones."',Estado='".$this->estado."')");
            $cadena_sql=str_replace("'"," ",$cadena_sql);
            $cadena_sql = str_replace("(","[",$cadena_sql);
            $cadena_sql = str_replace(")","]",$cadena_sql);

            $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_Empresa"."','Insercion - Sin Valores Anteriores','".$cadena_sql."');";
            $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
        }else{
            $this->obj_data_provider->trae_datos("T_Empresa", "*", "ID_Empresa=".$this->id);
            $valores_iniciales="Edicion - Valores anteriores de la tabla formato SELECT:\n ";
            if (count($this->obj_data_provider->getArreglo())>0){
                $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->obj_data_provider->getArreglo()[0]);
            }
            $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
            $valores_iniciales=$valores_iniciales . serialize($this->obj_data_provider->getArreglo());

             //Registro de la trazabilidad del sistema
            $cadena_sql=str_replace(","," - ","call sp_set_empresa(Modifica Datos en T_Empresa donde ID_Empresa='".$this->id."','Empresa=".$this->empresa."',Observaciones='".$this->observaciones."',Estado='".$this->estado."')");
            $cadena_sql=str_replace("'"," ",$cadena_sql);
            $cadena_sql = str_replace("(","[",$cadena_sql);
            $cadena_sql = str_replace(")","]",$cadena_sql);
            
            $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_Empresa"."','".$valores_iniciales. "','".$cadena_sql."');";       
            $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
            }

        // Llamada al procedimiento almacenado de mysql para gestión de la empresa 
            
        //Verifica el valor de estado, para ingresarlo en el sistema
        if ($this->estado=="Activo"){
            $this->estado="1";
        }  if ($this->estado=="Inactivo") {
             $this->estado="0";
        }
        $sql=("call sp_set_empresa('".$this->id."','".$this->empresa."','".$this->observaciones."','".$this->estado."')");
        $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
    }
} ?>
