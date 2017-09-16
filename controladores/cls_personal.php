<?php
class cls_personal{
    public $obj_data_provider;
    public $arreglo;
    public $arreglo2;
    public $arreglo3;
    private $condicion;
    public $id;
    public $id2;
    public $cedula;
    public $apellidonombre;
    public $empresa;
    public $gafete;
    public $correo;
    public $direccion;
    public $linkfoto;
    public $observaciones;
    public $estado;
    public $id_unidad_ejecutora;
    public $unidad_ejecutora;
    public $puesto;
    public $id_puesto;
    public $id_empresa;
    public $id_ultima_persona_ingresada;
    
    function getArreglo3() {
        return $this->arreglo3;
    }

    function setArreglo3($arreglo3) {
        $this->arreglo3 = $arreglo3;
    }

    function getArreglo2() {
        return $this->arreglo2;
    }

    function getId_unidad_ejecutora() {
        return $this->id_unidad_ejecutora;
    }

    function getUnidad_ejecutora() {
        return $this->unidad_ejecutora;
    }

    function getPuesto() {
        return $this->puesto;
    }

    function getId_puesto() {
        return $this->id_puesto;
    }

    function getGafete() {
        return $this->gafete;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setGafete($gafete) {
        $this->gafete = $gafete;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }
    
    function getEmpresa() {
        return $this->empresa;
    }

    function getId_empresa() {
        return $this->id_empresa;
    }

    function getId_ultima_persona_ingresada() {
        return $this->id_ultima_persona_ingresada;
    }

    function setArreglo2($arreglo2) {
        $this->arreglo2 = $arreglo2;
    }

    function setId_unidad_ejecutora($id_unidad_ejecutora) {
        $this->id_unidad_ejecutora = $id_unidad_ejecutora;
    }

    function setUnidad_ejecutora($unidad_ejecutora) {
        $this->unidad_ejecutora = $unidad_ejecutora;
    }

    function setPuesto($puesto) {
        $this->puesto = $puesto;
    }

    function setId_puesto($id_puesto) {
        $this->id_puesto = $id_puesto;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    function setId_ultima_persona_ingresada($id_ultima_persona_ingresada) {
        $this->id_ultima_persona_ingresada = $id_ultima_persona_ingresada;
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

    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getApellidonombre() {
        return $this->apellidonombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getLinkfoto() {
        return $this->linkfoto;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getEstado() {
        return $this->estado;
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

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setApellidonombre($apellidonombre) {
        $this->apellidonombre = $apellidonombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setLinkfoto($linkfoto) {
        $this->linkfoto = $linkfoto;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
 
    public function __construct() {
        $this->obj_data_provider=new Data_Provider();
        $this->condicion="";
        $this->id="";
        $this->id2="";
        $this->cedula="";
        $this->apellidonombre="";
        $this->direccion="";
        $this->linkfoto;
        $this->observaciones="";
        $this->estado="";
        $this->empresa="";
        $this->gafete="";
        $this->correo="";
        $this->arreglo;
        $this->arreglo2;
        $this->arreglo3;
        $this->unidad_ejecutora="";
        $this->id_unidad_ejecutora="";
        $this->empresa="";
        $this->id_empresa="";
        $this->puesto="";
        $this->id_puesto="";
    }
    
    public function obtiene_todo_el_personal(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Personal
                    LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                    LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
                    LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
                    LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                " T_Personal.*,
                    T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
                    T_Empresa.ID_Empresa, T_Empresa.Empresa,
                    T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero,
                    T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
                    T_Puesto.ID_Puesto, T_Puesto.Puesto",
                "(T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '4'OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '27') GROUP by T_Personal.ID_Persona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Personal
                    LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                    LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
                    LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
                    LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                "T_Personal.*,
                    T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
                    T_Empresa.ID_Empresa, T_Empresa.Empresa,
                    T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero,
                    T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
                    T_Puesto.ID_Puesto, T_Puesto.Puesto",
                "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '4' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '27') GROUP by T_Personal.ID_Persona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_gerentes_zona_bcr(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_GerenteZonaBCR
                    LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona
                    LEFT OUTER JOIN T_Telefono ON T_GerenteZonaBCR.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                "T_GerenteZonaBCR.*, 
                    T_Personal.Apellido_Nombre,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                "(T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
                      T_TipoTelefono.ID_Tipo_Telefono = '4') 
                      GROUP BY T_GerenteZonaBCR.ID_Gerente_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_GerenteZonaBCR
                    LEFT OUTER JOIN T_Personal ON T_GerenteZonaBCR.ID_Persona = T_Personal.ID_Persona
                    LEFT OUTER JOIN T_Telefono ON T_GerenteZonaBCR.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                "T_GerenteZonaBCR.*, 
                    T_Personal.Apellido_Nombre,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
                      T_TipoTelefono.ID_Tipo_Telefono = '4') 
                      GROUP BY T_GerenteZonaBCR.ID_Gerente_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_supervisor_zona(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_SupervisorZona
                    LEFT OUTER JOIN T_PersonalExterno ON T_SupervisorZona.ID_Persona_Externa = T_PersonalExterno.ID_Persona_Externa
                    LEFT OUTER JOIN T_Telefono ON T_PersonalExterno.ID_Persona_Externa = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                "T_SupervisorZona.*, 
                    T_PersonalExterno.Apellido,T_PersonalExterno.Nombre,
                    GROUP_CONCAT(T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                "(T_TipoTelefono.ID_Tipo_Telefono = '28' OR T_TipoTelefono.ID_Tipo_Telefono = '29')
                    GROUP BY T_SupervisorZona.ID_Supervisor_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_SupervisorZona
                    LEFT OUTER JOIN T_Personal ON T_SupervisorZona.ID_Persona = T_Personal.ID_Persona
                    LEFT OUTER JOIN T_Telefono ON T_Personal.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono", 
                "T_SupervisorZona.*, 
                    T_Personal.Apellido_Nombre,
                    GROUP_CONCAT(T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero",
                "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '3')
                    GROUP BY T_SupervisorZona.ID_Supervisor_Zona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_personas_prontuario() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_personal", 
                "*",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_personal", 
                "*",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtener_personas_con_numeros_en_cero_para_prontuario() {
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_personal", 
                "Apellido_Nombre,Cedula,ID_Persona",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_personal", 
                "Apellido_Nombre,Cedula,ID_Persona",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function agregar_nueva_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("t_personal", "Cedula,Apellido_Nombre,ID_Unidad_Ejecutora,ID_Puesto,Direccion,Link_Foto,ID_Empresa,Observaciones,Estado", "'".$this->cedula."','".$this->apellidonombre."',".$this->id_unidad_ejecutora.",".$this->id_puesto.",'".$this->direccion."','".$this->linkfoto."',".$this->id_empresa.",'".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
    }
    
    public function agregar_nueva_persona_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos_para_prontuario("t_personal", "Cedula,Apellido_Nombre,ID_Unidad_Ejecutora,ID_Puesto,Direccion,Link_Foto,ID_Empresa,Estado,Correo", "'".$this->cedula."','".$this->apellidonombre."',".$this->id_unidad_ejecutora.",".$this->id_puesto.",'".$this->direccion."','".$this->linkfoto."',".$this->id_empresa.",'".$this->estado."','".$this->correo."'");
        $this->obj_data_provider->desconectar();
    }
    
    function edita_persona(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_personal",
            "Cedula='".$this->cedula."',Apellido_Nombre='".$this->apellidonombre."',ID_Unidad_Ejecutora=".$this->id_unidad_ejecutora.
                ",ID_Puesto=".$this->id_puesto.",Direccion='".$this->direccion."',Link_Foto='".$this->linkfoto.
                "',ID_Empresa=".$this->id_empresa.",Observaciones='".$this->observaciones."',Estado='".$this->estado."'",
            $this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    function edita_persona_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_personal",
            "Cedula='".$this->cedula."',Apellido_Nombre='".$this->apellidonombre.
                "',ID_Unidad_Ejecutora=".$this->id_unidad_ejecutora.",ID_Puesto=".$this->id_puesto.
                ",Direccion='".$this->direccion."',Link_Foto='".$this->linkfoto.
                "',ID_Empresa=".$this->id_empresa.",Correo='".$this->correo."',Estado='".$this->estado."'",
            $this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
       
    }
    
    function iniciar_transaccion_sql(){
        $this->obj_data_provider->iniciar_transaccion_sql();
    }
    
    function agregar_edicion_de_persona_a_transaccion(){

        $this->obj_data_provider->agregar_edicion_de_datos_a_la_transaccion("t_personal","Cedula='".$this->cedula."',Apellido_Nombre='".$this->apellidonombre."',ID_Unidad_Ejecutora=".$this->id_unidad_ejecutora.",ID_Puesto=".$this->id_puesto.",Direccion='".$this->direccion."',Link_Foto='".$this->linkfoto."',ID_Empresa=".$this->id_empresa.",Correo='".$this->correo."',Estado='".$this->estado."'",$this->condicion);
        //$this->obj_data_provider->agrega_edicion_de_datos_a_la_transaccion("t_personal","Apellido_Nombre='VENEGAS MONGE DIEGO ALBERTOs'","Cedula='01-1310-0038'");
    }
     
    function agregar_inclusion_persona_a_transaccion(){
        //$this->obj_data_provider->conectar();
        $this->obj_data_provider->agregar_inclusion_de_datos_a_la_transaccion("t_personal", "Cedula,Apellido_Nombre,ID_Unidad_Ejecutora,ID_Puesto,Direccion,Link_Foto,ID_Empresa,Estado,Correo", "'".$this->cedula."','".$this->apellidonombre."',".$this->id_unidad_ejecutora.",".$this->id_puesto.",'".$this->direccion."','".$this->linkfoto."',".$this->id_empresa.",'".$this->estado."','".$this->correo."'");
        //$this->obj_data_provider->inserta_datos_para_prontuario();
        //$this->obj_data_provider->desconectar();
    }
     
    function ejecutar_transaccion_sql(){     
        $this->obj_data_provider->ejecutar_transaccion_sql();   
    }
      
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultima_persona_ingresada(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_personal","max(ID_Persona) ID_Persona","");
        $this->arreglo2=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        if (count($this->arreglo2)>0){
            $this->setId_ultima_persona_ingresada($this->arreglo2[0]['ID_Persona']);
        }else {
            $this->setId_ultima_persona_ingresada(0);
        }   
    }
  
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_de_persona_para_prontuario(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_personal","ID_Persona",$this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();

        if (count($this->arreglo)>0){
            $this->setId($this->arreglo[0]['ID_Persona']);
        }else {
            $this->setId(0);
        }   
    }
  
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_id_persona_en_tabla_telefonos(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_telefono","ID=".$this->id_ultima_persona_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_id_persona_en_tabla_telefonos_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_telefono","ID=".$this->id_ultima_persona_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_id_persona_en_tabla_gerente_zona_bcr(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos("t_gerentezonabcr","ID_Persona=".$this->id_ultima_persona_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_id_persona_en_tabla_gerente_zona_bcr_para_prontuario(){
        $this->obj_data_provider->conectar();
        //Llama al metodo para editar los datos correspondientes
        $this->obj_data_provider->edita_datos_para_prontuario("t_gerentezonabcr","ID_Persona=".$this->id_ultima_persona_ingresada,$this->condicion);
        //Metodo de la clase data provider que desconecta la sesión con la base de datos
        $this->obj_data_provider->desconectar();
    }
        
    function eliminar_telefonos_personas_bcr_fuera_de_prontuario_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_telefono", "(".$this->condicion.") AND (ID_Tipo_Telefono=2 OR ID_Tipo_Telefono=3 OR ID_Tipo_Telefono=4 OR ID_Tipo_Telefono=27)");
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_personas_bcr_fuera_de_prontuario_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_personal", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_telefonos_personas_bcr_fuera_de_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_telefono", "(".$this->condicion.") AND (ID_Tipo_Telefono=2 OR ID_Tipo_Telefono=3 OR ID_Tipo_Telefono=4 OR ID_Tipo_Telefono=27)");
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_personas_bcr_fuera_de_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_personal", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    //Obtener el último id de evento para saber que se debe ingresar
    function verifica_si_la_persona_es_gerente_zona_bcr(){
        //Establece la conexión con la bd
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->trae_datos("t_gerentezonabcr","*",$this->condicion);
        $this->arreglo3=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        if (count($this->arreglo3)>0){
            return true;
        }else {
            return false;
        }   
    }
  
    function eliminar_personas_sobrantes(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos("t_personal", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    function eliminar_personas_sobrantes_para_prontuario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->eliminar_datos_para_prontuario("t_personal", $this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function actualizar_estado_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtener_todos_puestos(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("T_Puesto", "*", "");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function cambiar_ue_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "ID_Unidad_Ejecutora='".$this->id2."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function cambiar_puesto_persona(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "ID_Puesto='".$this->id2."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function actualizar_informacion_general_persona() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Personal", "Cedula='".$this->cedula."', Apellido_Nombre='".$this->apellidonombre."', Correo='".$this->correo."', Numero_Gafete='".$this->gafete."', Direccion='".$this->direccion."', Observaciones='".$this->observaciones."'",$this->condicion);
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function obtiene_todo_el_personal_filtrado(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Personal
                    LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                    LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
                    LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
                    LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                " T_Personal.*,
                    T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento, T_UnidadEjecutora.Observaciones as Observaciones_UE,
                    T_Empresa.ID_Empresa, T_Empresa.Empresa,
                    T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero,
                    T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
                    T_Puesto.ID_Puesto, T_Puesto.Puesto",
                "(T_TipoTelefono.ID_Tipo_Telefono = '4'OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '27') AND (T_Empresa.ID_Empresa='1') AND (T_Personal.Estado='1') group by T_Personal.ID_Persona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_todo_el_personal_modulo_personas(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Personal
                    LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                    LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
                    LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
                    LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
                    LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                " T_Personal.ID_Persona, T_Personal.Cedula, T_Personal.Apellido_Nombre,T_Personal.Estado,T_Personal.Observaciones,
                    T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
                    T_Empresa.ID_Empresa, T_Empresa.Empresa,
                    T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
                    GROUP_CONCAT(char(10),T_TipoTelefono.Tipo_Telefono,': ',T_Telefono.Numero) as Numero,
                    T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
                    T_Puesto.ID_Puesto, T_Puesto.Puesto",
                "(T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '4'OR 
                    T_TipoTelefono.ID_Tipo_Telefono = '27') group by T_Personal.ID_Persona");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Personal
			LEFT OUTER JOIN	T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
			LEFT OUTER JOIN T_Empresa ON T_Personal.ID_Empresa = T_Empresa.ID_Empresa
			LEFT OUTER JOIN T_Telefono on T_Personal.ID_Persona = T_Telefono.ID
			LEFT OUTER JOIN T_TipoTelefono ON T_Telefono.ID_Tipo_Telefono = T_TipoTelefono.ID_Tipo_Telefono
			LEFT OUTER JOIN T_Puesto ON T_Personal.ID_Puesto = T_Puesto.ID_Puesto", 
                    "T_Personal.*,
			T_UnidadEjecutora.ID_Unidad_Ejecutora, T_UnidadEjecutora.Departamento,
			T_Empresa.ID_Empresa, T_Empresa.Empresa,
			T_TipoTelefono.Tipo_Telefono, T_TipoTelefono.ID_Tipo_Telefono,
			T_Telefono.Numero,T_Telefono.ID_Telefono,T_Telefono.Observaciones as Observaciones_Tel,
			T_Puesto.ID_Puesto, T_Puesto.Puesto",
                    "(".$this->condicion.") AND (T_TipoTelefono.ID_Tipo_Telefono = '2' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '3' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '4' OR 
			T_TipoTelefono.ID_Tipo_Telefono = '27') ORDER BY T_Personal.Apellido_Nombre");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    public function obtiene_todo_el_personal_pruebas_alarma(){
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Personal
                    LEFT OUTER JOIN T_UnidadEjecutora ON T_Personal.ID_Unidad_Ejecutora = T_UnidadEjecutora.ID_Unidad_Ejecutora
                    LEFT OUTER JOIN T_Empresa ON T_Empresa.ID_Empresa = T_Personal.ID_Empresa", 
                " T_Personal.ID_Persona, T_Personal.Cedula, T_Personal.ID_Empresa, T_Personal.Apellido_Nombre,
                    T_UnidadEjecutora.Departamento, T_Empresa.Empresa",
                "T_Personal.Estado='1'");
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
}?>