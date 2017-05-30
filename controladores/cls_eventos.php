<?php

class cls_eventos{
    public $id;
    public $id2;
    public $obj_data_provider;
    public $arreglo;
    private $condicion;
    public $fecha;
    public $hora;
    public $provincia;
    public $tipo_punto;
    public $punto_bcr;
    public $tipo_evento;
    public $estado;
    public $estado_evento;
    public $detalle;
    public $seguimiento;
    public $id_ultimo_evento_ingresado;
    public $id_usuario;
    public $observaciones;
    public $prioridad;
    public $adjunto;
    public $referencia_mezcla;
    public $observaciones_supervision;
    public $fecha_notas_supervision;
    
    function getReferencia_mezcla() {
        return $this->referencia_mezcla;
    }

    function setReferencia_mezcla($referencia_mezcla) {
        $this->referencia_mezcla = $referencia_mezcla;
    }

    function getObservaciones_supervision() {
        return $this->observaciones_supervision;
    }

    function setObservaciones_supervision($observaciones_supervision) {
        $this->observaciones_supervision = $observaciones_supervision;
    }

    function getFecha_notas_supervision() {
        return $this->fecha_notas_supervision;
    }

    function setFecha_notas_supervision($fecha_notas_supervision) {
        $this->fecha_notas_supervision = $fecha_notas_supervision;
    }

    function getAdjunto() {
        return $this->adjunto;
    }

    function setAdjunto($adjunto) {
        $this->adjunto = $adjunto;
    }

    function getPrioridad() {
        return $this->prioridad;
    }

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function getId_ultimo_evento_ingresado() {
        return $this->id_ultimo_evento_ingresado;
    }

    function setId_ultimo_evento_ingresado($id_ultimo_evento_ingresado) {
        $this->id_ultimo_evento_ingresado = $id_ultimo_evento_ingresado;
    }

    function getEstado_evento() {
        return $this->estado_evento;
    }

    function getSeguimiento() {
        return $this->seguimiento;
    }

    function setEstado_evento($estado_evento) {
        $this->estado_evento = $estado_evento;
    }

    function setSeguimiento($seguimiento) {
        $this->seguimiento = $seguimiento;
    }

    function getId2() {
        return $this->id2;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function getTipo_punto() {
        return $this->tipo_punto;
    }

    function setTipo_punto($tipo_punto) {
        $this->tipo_punto = $tipo_punto;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getPunto_bcr() {
        return $this->punto_bcr;
    }

    function getTipo_evento() {
        return $this->tipo_evento;
    }

    function getEstado() {
        return $this->estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setPunto_bcr($punto_bcr) {
        $this->punto_bcr = $punto_bcr;
    }

    function setTipo_evento($tipo_evento) {
        $this->tipo_evento = $tipo_evento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function getId() {
        return $this->id;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    public function __construct() {
        $this->id="";
        $this->condicion="";
        $this->arreglo;
        $this->obj_data_provider=new Data_Provider();
        $this->fecha="";
        $this->hora="";
        $this->provincia="";
        $this->tipo_punto="";
        $this->punto_bcr="";
        $this->tipo_evento="";
        $this->estado="";
        $this->detalle="";
        $this->observaciones="";
        $this->prioridad="";
        $this->adjunto="";
        $this->observaciones_supervision="";
        $this->referencia_mezcla="";
        $this->fecha_notas_supervision="";
        ;
    }
    
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_estado_evento($nuevo_estado){
      $this->obj_data_provider->conectar();
      //Llama al metodo para editar los datos correspondientes
      $this->obj_data_provider->edita_datos("T_Evento","ID_EstadoEvento=".$nuevo_estado,"ID_Evento=".$this->id);
      //Metodo de la clase data provider que desconecta la sesión con la base de datos
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
  }
  
    //Este metodo realiza la modificación del estado del modulo, de activo a inactivo o viceversa en la bd
    function edita_notas_supervision_evento(){
      $this->obj_data_provider->conectar();
      //Llama al metodo para editar los datos correspondientes
      $this->obj_data_provider->edita_datos("T_Evento","Observaciones_Evento='".$this->observaciones_supervision."',Fecha_Observaciones='".$this->fecha_notas_supervision."'","ID_Evento=".$this->id);
      //Metodo de la clase data provider que desconecta la sesión con la base de datos
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=$this->obj_data_provider->getResultado_operacion();
  }
    
    //Obtener el último id de evento para saber que se debe ingresar
    function obtiene_id_ultimo_evento_ingresado(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_Evento","max(ID_Evento) ID_Evento","ID_Usuario=".$this->id_usuario." AND ID_Tipo_Evento=".$this->tipo_evento." AND ID_PuntoBCR=".$this->punto_bcr);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;

      if (count($this->arreglo)>0){
        $this->setId_ultimo_evento_ingresado($this->arreglo[0]['ID_Evento']);
      }else
      {
        $this->setId_ultimo_evento_ingresado(1);
      }    
  }
  
    //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function existe_abierto_este_tipo_de_evento_en_este_sitio(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_Evento","*","ID_Tipo_Evento=".$this->tipo_evento." AND ID_PuntoBCR=".$this->punto_bcr." AND ID_EstadoEvento<>3"." AND ID_EstadoEvento<>5");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
  }
  
    //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function eliminar_mezcla_del_sistema(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->eliminar_datos("T_MezclaEvento",$this->condicion);
      $this->obj_data_provider->desconectar();
     
  }
  
    //Valida que no se ingrese la misma mezcla de eventos en el sistema
    function existe_esta_mezcla_de_eventos_en_el_sistema(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_MezclaEvento","*","Referencia_Mezcla='".$this->referencia_mezcla."'");
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
  }
  
    //Valida que no se ingrese la misma mezcla de eventos en el sistema
    function existe_este_evento_en_otra_mezcla(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_MezclaEvento","*","ID_Evento=".$this->id);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return true;
      }else
      {
        return false;
      }    
  }
  
    //Valida que no se ingrese el mismo tipo de evento en un sitio, si ya hay uno pendiente
    function obtiene_prioridad_de_tipo_de_evento(){
      //Establece la conexión con la bd
      $this->obj_data_provider->conectar();
      $this->obj_data_provider->trae_datos("T_TipoEvento","*","ID_Tipo_Evento=".$this->tipo_evento);
      $this->arreglo=$this->obj_data_provider->getArreglo();
      $this->obj_data_provider->desconectar();
      $this->resultado_operacion=true;
      
      if (count($this->arreglo)>0){
        return $this->arreglo[0]['Prioridad'];
         
      }else
      {
        return 0;
      }    
  }
    
    //Eventos de Bitacora
    public function obtiene_todos_los_eventos(){
        $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Evento 
                        LEFT OUTER JOIN T_Provincia ON T_Evento.ID_Provincia = T_Provincia.ID_Provincia
                        LEFT OUTER JOIN T_TipoPuntoBCR ON T_Evento.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
                        LEFT OUTER JOIN T_PuntoBCR ON T_Evento.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
                        LEFT OUTER JOIN T_Usuario ON T_Evento.ID_Usuario = T_Usuario.ID_Usuario
                        LEFT OUTER JOIN T_TipoEvento ON T_Evento.ID_Tipo_Evento = T_TipoEvento.ID_Tipo_Evento
                        LEFT OUTER JOIN T_EstadoEvento ON T_Evento.ID_EstadoEvento = T_EstadoEvento.ID_EstadoEvento", 
                    "T_Evento.ID_Evento, T_Evento.Fecha, T_Evento.Hora, T_Evento.Observaciones_Evento, T_Evento.Fecha_Observaciones,
                        T_Provincia.Nombre_Provincia, T_Provincia.ID_Provincia,
                        T_TipoPuntoBCR.Tipo_Punto, T_TipoPuntoBCR.ID_Tipo_Punto ,
                        T_PuntoBCR.Nombre, T_PuntoBCR.ID_PuntoBCR,T_PuntoBCR.Codigo,
                        T_TipoEvento.Evento, T_TipoEvento.ID_Tipo_Evento,
                        T_EstadoEvento.ID_EstadoEvento, T_EstadoEvento.Estado_Evento, T_Usuario.ID_Usuario,
                        T_Usuario.Nombre Nombre_Usuario,T_Usuario.Apellido",
                    "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                    "T_Evento 
                        LEFT OUTER JOIN T_Provincia ON T_Evento.ID_Provincia = T_Provincia.ID_Provincia
                        LEFT OUTER JOIN T_TipoPuntoBCR ON T_Evento.ID_Tipo_Punto = T_TipoPuntoBCR.ID_Tipo_Punto
                        LEFT OUTER JOIN T_PuntoBCR ON T_Evento.ID_PuntoBCR = T_PuntoBCR.ID_PuntoBCR
                        LEFT OUTER JOIN T_Usuario ON T_Evento.ID_Usuario = T_Usuario.ID_Usuario
                        LEFT OUTER JOIN T_TipoEvento ON T_Evento.ID_Tipo_Evento = T_TipoEvento.ID_Tipo_Evento
                        LEFT OUTER JOIN T_EstadoEvento ON T_Evento.ID_EstadoEvento = T_EstadoEvento.ID_EstadoEvento", 
                    "T_Evento.ID_Evento, T_Evento.Fecha, T_Evento.Hora, T_Evento.Observaciones_Evento, T_Evento.Fecha_Observaciones,
                        T_Provincia.Nombre_Provincia, T_Provincia.ID_Provincia,
                        T_TipoPuntoBCR.Tipo_Punto, T_TipoPuntoBCR.ID_Tipo_Punto ,
                        T_PuntoBCR.Nombre, T_PuntoBCR.ID_PuntoBCR,T_PuntoBCR.Codigo,
                        T_TipoEvento.Evento, T_TipoEvento.ID_Tipo_Evento,
                        T_EstadoEvento.ID_EstadoEvento, T_EstadoEvento.Estado_Evento, T_Usuario.ID_Usuario,
                        T_Usuario.Nombre Nombre_Usuario,T_Usuario.Apellido",
                    $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
    
    //Detalles de bitacora
    public function obtiene_detalle_evento(){
        try{
        $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_DetalleEvento left outer join T_Usuario on T_DetalleEvento.ID_Usuario=T_Usuario.ID_Usuario inner join T_Evento on T_Evento.ID_Evento=T_DetalleEvento.ID_Evento inner join T_PuntoBCR on T_PuntoBCR.ID_PuntoBCR=T_Evento.ID_PuntoBCR inner join T_TipoEvento on T_TipoEvento.ID_Tipo_Evento=T_Evento.ID_Tipo_Evento", 
                "T_DetalleEvento.*,T_Usuario.Nombre Nombre_Usuario,T_Usuario.Apellido,concat(concat(concat(T_PuntoBCR.Nombre,' ['),T_TipoEvento.Evento),']') as PuntoBCR_TipoEvento",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
        }   catch (Exception $e){
        }
    }
    
    //Metodo utilizado en el momento que escogen algun tipo de punto o provincia en específico (actualizacione en vivo, en pantalla)
    public function filtra_sitios_bcr_bitacora(){
        try{
        $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "t_puntobcr INNER JOIN t_Distrito ON t_PuntoBCR.ID_Distrito=t_Distrito.ID_Distrito INNER JOIN t_Canton ON t_Distrito.ID_Canton=t_Canton.ID_Canton INNER JOIN t_Provincia ON t_Canton.ID_Provincia=t_Provincia.ID_Provincia", 
                "t_PuntoBCR.ID_PuntoBCR, t_PuntoBCR.Nombre",
                $this->condicion." ORDER BY t_PuntoBCR.Nombre ASC");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
        }   catch (Exception $e){
        }
    }
    
    public function ingresar_seguimiento_evento(){
        try{
            $this->obj_data_provider->conectar();
            
            if ($this->id2==0){
                //Registro de la trazabilidad del sistema
               $cadena_sql=str_replace(","," - ","call sp_set_detalleEvento(Inserta datos en T_detalleEvento ID_Seguimiento='".$this->id2."',ID_Evento='".$this->id."',Fecha='".$this->fecha."',Hora='".$this->hora."',Detalle='".$this->detalle."',Usuario='".$this->id_usuario."',Adjunto='".$this->adjunto."')");
               $cadena_sql=str_replace("'"," ",$cadena_sql);
               $cadena_sql = str_replace("(","[",$cadena_sql);
               $cadena_sql = str_replace(")","]",$cadena_sql);

               $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_detalleEvento"."','Insercion - Sin Valores Anteriores','".$cadena_sql."');";
               $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
            }else{
                $this->obj_data_provider->trae_datos("T_detalleEvento", "*", "ID_Detalle_Evento=".$this->id2);
                $valores_iniciales="Edicion - Valores anteriores de la tabla formato SELECT:\n ";
                if (count($this->obj_data_provider->getArreglo())>0){
                    $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->obj_data_provider->getArreglo());
                }
            $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
            $temp=$this->obj_data_provider->getArreglo();
            $valores_iniciales=$valores_iniciales . serialize($temp(0));

             //Registro de la trazabilidad del sistema
            $cadena_sql=str_replace(","," - ","call sp_set_detalleEvento(Modifica datos en T_detalleEvento ID_Seguimiento='".$this->id2."',ID_Evento='".$this->id."',Fecha='".$this->fecha."',Hora='".$this->hora."',Detalle='".$this->detalle."',Usuario='".$this->id_usuario."',Adjunto='".$this->adjunto."')");
            $cadena_sql=str_replace("'"," ",$cadena_sql);
            $cadena_sql = str_replace("(","[",$cadena_sql);
            $cadena_sql = str_replace(")","]",$cadena_sql);
            
            $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_detalleEvento"."','".$valores_iniciales. "','".$cadena_sql."');";       
            $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
            }
      
             // Llamada al procedimiento almacenado de mysql para gestión de seguimiento de evento
      
            $sql=("call sp_set_detalleEvento('".$this->id2."','".$this->id."','".$this->fecha."','".$this->hora."','".$this->detalle."','".$this->id_usuario."','".$this->adjunto."')");
            $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
            //echo $sql;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function ingresar_evento(){
        try{
            $this->obj_data_provider->conectar();
            
            //Registro de la trazabilidad del sistema
           $cadena_sql=str_replace(","," - ","call sp_set_Evento(Inserta datos en T_Evento ID_Evento='"."0"."',Fecha='".$this->fecha."',Hora='".$this->hora."',Usuario='".$this->id_usuario."',Provincia='".$this->provincia."',Tipo de Punto='".$this->tipo_punto."',Punto BCR='".$this->punto_bcr."',Tipo de Evento='".$this->tipo_evento."',Estado del Evento='".$this->estado_evento."')");
           $cadena_sql=str_replace("'"," ",$cadena_sql);
           $cadena_sql = str_replace("(","[",$cadena_sql);
           $cadena_sql = str_replace(")","]",$cadena_sql);

           $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_Evento"."','Insercion - Sin Valores Anteriores','".$cadena_sql."');";
           $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
      
             // Llamada al procedimiento almacenado de mysql para gestión de eventos
            
            
            $sql=("call sp_set_Evento('"."0"."','".$this->fecha."','".$this->hora."','".$this->id_usuario."','".$this->provincia."','".$this->tipo_punto."','".$this->punto_bcr."','".$this->tipo_evento."','".$this->estado_evento."')");
            $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
            //echo $sql;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_seguimientos(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_EstadoEvento", "*", "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    //Tipos de eventos
    public function obtener_todos_los_tipos_eventos(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_TipoEvento", "*", "Estado=1 order by Evento");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function guardar_tipo_evento() {
        $this->obj_data_provider->conectar();
        
        if ($this->id==0){
                //Registro de la trazabilidad del sistema
               $cadena_sql=str_replace(","," - ","call sp_set_tipoEvento(Inserta datos en T_tipoevento Id_tipo_evento='".$this->id."',Evento='".$this->tipo_evento."',Prioridad='".$this->prioridad."',Observaciones='".$this->observaciones."',Estado='".$this->estado."')");
               $cadena_sql=str_replace("'"," ",$cadena_sql);
               $cadena_sql = str_replace("(","[",$cadena_sql);
               $cadena_sql = str_replace(")","]",$cadena_sql);

               $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_tipoevento"."','Insercion - Sin Valores Anteriores','".$cadena_sql."');";
               $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
        }else{
                $this->obj_data_provider->trae_datos("T_tipoevento", "*", "ID_Tipo_Evento=".$this->id);
                $valores_iniciales="Edicion - Valores anteriores de la tabla formato SELECT:\n ";
                if (count($this->obj_data_provider->getArreglo())>0){
                    $valores_iniciales= $valores_iniciales ." ". implode(" - ",$this->obj_data_provider->getArreglo());
                }
                $valores_iniciales=$valores_iniciales . "\nA continuacion valores anteriores de la tabla formato arreglo:\n ";
                $temp=$this->obj_data_provider->getArreglo();
                $valores_iniciales=$valores_iniciales . serialize($temp(0));

                 //Registro de la trazabilidad del sistema
                $cadena_sql=str_replace(","," - ","call sp_set_tipoEvento(Modifica datos en T_tipoevento Id_tipo_evento='".$this->id."',Evento='".$this->tipo_evento."',Prioridad='".$this->prioridad."',Observaciones='".$this->observaciones."',Estado='".$this->estado."')");
                $cadena_sql=str_replace("'"," ",$cadena_sql);
                $cadena_sql = str_replace("(","[",$cadena_sql);
                $cadena_sql = str_replace(")","]",$cadena_sql);

                $detalle_sql="insert into t_traza (ID_Traza,Fecha,Hora,ID_Usuario,Tabla_Afectada,Dato_Anterior,Dato_Actualizado) values(null,'".date("Y-m-d")."','".date("H:i:s", time())."',".$_SESSION['id'].",'"."T_tipoevento"."','".$valores_iniciales. "','".$cadena_sql."');";       
                $this->obj_data_provider->inserta_datos_para_uso_de_trazabilidad($detalle_sql);
        }
      
        // Llamada al procedimiento almacenado de mysql para gestión de seguimiento de evento
        
        //Verifica el valor de estado, para ingresarlo en el sistema
        if ($this->estado=="Activo"){
            $this->estado="1";
        } if($this->estado=="Inactivo") {
             $this->estado="0";
        }
        
        $sql=("call sp_set_tipoEvento('".$this->id."','".$this->tipo_evento."','".$this->prioridad."','".$this->observaciones."','".$this->estado."')");
        $this->obj_data_provider->insertar_datos_con_phpmyadmin($sql);
    }
    
    public function obtener_todas_las_provincias(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_Provincia", "*", "Estado=1");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_puntos_bcr_por_provincia_y_tipo_de_punto(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_PuntoBCR", "ID_PuntoBCR,Nombre", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_todos_los_tipos_de_puntos_BCR(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_TipoPuntoBCR", "*", "Estado=1");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_puntos_BCR_filtrados(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("T_PuntoBCR", "*", "Estado=1 AND ".$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_los_tipos_de_eventos(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo= $this->obj_data_provider->trae_datos("T_TipoEvento","*","");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function guardar_registro_en_mezcla_de_eventos(){
         
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->inserta_datos("T_MezclaEvento","ID_Mezcla_Evento,Referencia_Mezcla,ID_Evento,ID_Usuario,Fecha,Hora","null,'".$this->referencia_mezcla."',".$this->id.",".$this->id_usuario.",'".$this->fecha."','".$this->hora."'");     
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
     }
     
    public function obtener_informacion_general_de_la_mezcla(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo= $this->obj_data_provider->trae_datos("T_MezclaEvento inner join T_Usuario on T_Usuario.ID_Usuario=T_MezclaEvento.ID_Usuario","T_MezclaEvento.*,concat(concat(T_Usuario.Nombre,' '),T_Usuario.Apellido) as Nombre_Completo",$this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    public function obtener_listado_de_eventos_de_una_mezcla(){
        try{
            $this->obj_data_provider->conectar();
            $this->arreglo= $this->obj_data_provider->trae_datos("T_MezclaEvento inner join T_Evento on T_Evento.ID_Evento=T_MezclaEvento.ID_Evento inner join T_PuntoBCR on T_PuntoBCR.ID_PuntoBCR=T_Evento.ID_PuntoBCR inner join T_TipoEvento on T_TipoEvento.ID_Tipo_Evento=T_Evento.ID_Tipo_Evento","ID_Mezcla_Evento,Referencia_Mezcla,T_MezclaEvento.ID_Evento,concat(concat(concat(T_PuntoBCR.Nombre,' ('),T_TipoEvento.Evento),')') as PuntoBCR_TipoEvento,T_Evento.Fecha,T_Evento.Hora",$this->condicion." order by T_Evento.Fecha,T_Evento.Hora");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
}

