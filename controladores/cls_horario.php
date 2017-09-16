<?php

class cls_horario{
    
    private $id;
    private $id2;
    private $descripcion;
    private $observaciones;
    private $estado;
    private $arreglo;
    private $obj_data_provider;
    private $condicion;
    private $resultado_operacion;
    private $hora_apertura_domingo;
    private $hora_cierre_domingo;
    private $hora_apertura_lunes;
    private $hora_cierre_lunes;
    private $hora_apertura_martes;
    private $hora_cierre_martes;
    private $hora_apertura_miercoles;
    private $hora_cierre_miercoles;
    private $hora_apertura_jueves;
    private $hora_cierre_jueves;
    private $hora_apertura_viernes;
    private $hora_cierre_viernes;
    private $hora_apertura_sabado;
    private $hora_cierre_sabado;
    private $tipo_horario;

    function getId() {
        return $this->id;
    }

    function getId2() {
        return $this->id2;
    }
    
    function getId_horario() {
        return $this->id_horario;
    }

    function getHorario() {
        return $this->horario;
    }

    function getHoras_laboradas() {
        return $this->horas_laboradas;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
    
    function getObservaciones() {
        return $this->observaciones;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function getEstado() {
        return $this->estado;
    }

    function getArreglo() {
        return $this->arreglo;
    }

    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function getResultado_operacion() {
        return $this->resultado_operacion;
    }

    function getHora_apertura_domingo() {
        return $this->hora_apertura_domingo;
    }

    function getHora_cierre_domingo() {
        return $this->hora_cierre_domingo;
    }

    function getHora_apertura_lunes() {
        return $this->hora_apertura_lunes;
    }

    function getHora_cierre_lunes() {
        return $this->hora_cierre_lunes;
    }

    function getHora_apertura_martes() {
        return $this->hora_apertura_martes;
    }

    function getHora_cierre_martes() {
        return $this->hora_cierre_martes;
    }

    function getHora_apertura_miercoles() {
        return $this->hora_apertura_miercoles;
    }

    function getHora_cierre_miercoles() {
        return $this->hora_cierre_miercoles;
    }

    function getHora_apertura_jueves() {
        return $this->hora_apertura_jueves;
    }

    function getHora_cierre_jueves() {
        return $this->hora_cierre_jueves;
    }

    function getHora_apertura_viernes() {
        return $this->hora_apertura_viernes;
    }

    function getHora_cierre_viernes() {
        return $this->hora_cierre_viernes;
    }

    function getHora_apertura_sabado() {
        return $this->hora_apertura_sabado;
    }

    function getHora_cierre_sabado() {
        return $this->hora_cierre_sabado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setId_horario($id_horario) {
        $this->id_horario = $id_horario;
    }

    function setHorario($horario) {
        $this->horario = $horario;
    }

    function setHoras_laboradas($horas_laboradas) {
        $this->horas_laboradas = $horas_laboradas;
   }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setObj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    function setResultado_operacion($resultado_operacion) {
        $this->resultado_operacion = $resultado_operacion;
    }

    function setHora_apertura_domingo($hora_apertura_domingo) {
        $this->hora_apertura_domingo = $hora_apertura_domingo;
    }

    function setHora_cierre_domingo($hora_cierre_domingo) {
        $this->hora_cierre_domingo = $hora_cierre_domingo;
    }

    function setHora_apertura_lunes($hora_apertura_lunes) {
        $this->hora_apertura_lunes = $hora_apertura_lunes;
    }

    function setHora_cierre_lunes($hora_cierre_lunes) {
        $this->hora_cierre_lunes = $hora_cierre_lunes;
    }

    function setHora_apertura_martes($hora_apertura_martes) {
        $this->hora_apertura_martes = $hora_apertura_martes;
    }

    function setHora_cierre_martes($hora_cierre_martes) {
        $this->hora_cierre_martes = $hora_cierre_martes;
    }

    function setHora_apertura_miercoles($hora_apertura_miercoles) {
        $this->hora_apertura_miercoles = $hora_apertura_miercoles;
    }

    function setHora_cierre_miercoles($hora_cierre_miercoles) {
        $this->hora_cierre_miercoles = $hora_cierre_miercoles;
    }

    function setHora_apertura_jueves($hora_apertura_jueves) {
        $this->hora_apertura_jueves = $hora_apertura_jueves;
    }

    function setHora_cierre_jueves($hora_cierre_jueves) {
        $this->hora_cierre_jueves = $hora_cierre_jueves;
    }

    function setHora_apertura_viernes($hora_apertura_viernes) {
        $this->hora_apertura_viernes = $hora_apertura_viernes;
    }

    function setHora_cierre_viernes($hora_cierre_viernes) {
        $this->hora_cierre_viernes = $hora_cierre_viernes;
    }

    function setHora_apertura_sabado($hora_apertura_sabado) {
        $this->hora_apertura_sabado = $hora_apertura_sabado;
    }

    function setHora_cierre_sabado($hora_cierre_sabado) {
        $this->hora_cierre_sabado = $hora_cierre_sabado;
    }
    
    function getTipo_horario() {
        return $this->tipo_horario;
    }

    function setTipo_horario($tipo_horario) {
        $this->tipo_horario = $tipo_horario;
    }

    public function __construct() {
       $this->id="";
       $this->id2="";
       $this->id_horario ="";
       $this->horario ="";
       $this->horas_laboradas ="" ;
       $this->descripcion="";
       $this->estado="";
       $this->dias_laborados="";
       $this->horas_laboradas="";
       $this->arreglo;
       $this->obj_data_provider=new Data_Provider();
       $this->condicion="";
       $this->observaciones="";
       $this->hora_apertura_domingo="";
       $this->hora_cierre_domingo="";
       $this->hora_apertura_lunes="";
       $this->hora_cierre_lunes="";
       $this->hora_apertura_martes="";
       $this->hora_cierre_martes="";
       $this->hora_apertura_miercoles="";
       $this->hora_cierre_miercoles="";
       $this->hora_apertura_jueves="";
       $this->hora_cierre_jueves="";
       $this->hora_apertura_viernes="";
       $this->hora_cierre_viernes="";
       $this->hora_apertura_sabado="";
       $this->hora_cierre_sabado="";
       $this->tipo_horario="";
    }
    
    public function obtiene_todos_los_horarios(){
       $this->obj_data_provider->conectar();
        if($this->condicion==""){
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Horario", 
                "*",
                "");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else{
            $this->arreglo=$this->obj_data_provider->trae_datos(
                "T_Horario", 
                "*",
                $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }  
    }
    
    public function agregar_horario(){
        $this->obj_data_provider->conectar();
        $this->arreglo= $this->obj_data_provider->inserta_datos("T_Horario", "ID_Horario, Hora_Apertura_Domingo, Hora_Cierre_Domingo, Hora_Apertura_Lunes, Hora_Cierre_Lunes, Hora_Apertura_Martes, Hora_Cierre_Martes,Hora_Apertura_Miercoles, Hora_Cierre_Miercoles, "
            . "Hora_Apertura_Jueves, Hora_Cierre_Jueves, Hora_Apertura_Viernes, Hora_Cierre_Viernes, Hora_Apertura_Sabado, Hora_Cierre_Sabado, Tipo_Horario, Observaciones, Estado",
            "null,'".$this->hora_apertura_domingo."','".$this->hora_cierre_domingo."','".$this->hora_apertura_lunes."','".$this->hora_cierre_lunes."','".$this->hora_apertura_martes."','".$this->hora_cierre_martes."','".$this->hora_apertura_miercoles."','".$this->hora_cierre_miercoles."','"
            .$this->hora_apertura_jueves."','".$this->hora_cierre_jueves."','".$this->hora_apertura_viernes."','".$this->hora_cierre_viernes."','".$this->hora_apertura_sabado."','".$this->hora_cierre_sabado."','".$this->tipo_horario."','".$this->observaciones."','".$this->estado."'");
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    
    public function asignar_horario_puntobcr(){
        $this->obj_data_provider->conectar();
        if($this->estado=="0"){
            $this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Horario='".$this->id."'", $this->condicion);
        } else {
            $this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Horario_Apertura='".$this->id."'", $this->condicion);
        }
        $this->obj_data_provider->desconectar();
    }
    
    public function actualizar_horario() {
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("T_Horario", "Hora_Apertura_Domingo='".$this->hora_apertura_domingo."', Hora_Cierre_Domingo='".$this->hora_cierre_domingo."',Hora_Apertura_Lunes='".$this->hora_apertura_lunes."', Hora_Cierre_Lunes='".$this->hora_cierre_lunes.
            "', Hora_Apertura_Martes='".$this->hora_apertura_martes."', Hora_Cierre_Martes='".$this->hora_cierre_martes."', Hora_Apertura_Miercoles='".$this->hora_apertura_miercoles."', Hora_Cierre_Miercoles='".$this->hora_cierre_miercoles.
            "', Hora_Apertura_Jueves='".$this->hora_apertura_jueves."', Hora_Cierre_Jueves='".$this->hora_cierre_jueves."', Hora_Apertura_Viernes='".$this->hora_apertura_viernes."', Hora_Cierre_Viernes='".$this->hora_cierre_viernes."', Hora_Apertura_Sabado='".$this->hora_apertura_sabado."', Hora_Cierre_Sabado='".$this->hora_cierre_sabado.
            "', Tipo_Horario='".$this->tipo_horario."', Observaciones='".$this->observaciones."', Estado='".$this->estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    
    public function eliminar_horario_puntobcr(){
        $this->obj_data_provider->conectar();
        if($this->estado=="0"){
            $this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Horario=null", $this->condicion);
        } else {
            $this->obj_data_provider->edita_datos("T_PuntoBCR", "ID_Horario_Apertura=null", $this->condicion);
        }
        $this->obj_data_provider->desconectar();
    }
    
    public function guardar_horario() {
        if($this->id_horario=="0"){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->inserta_datos("T_horario", "ID_Horario,Horario,Observaciones,Estado", "null,'".$this->horario."','".$this->observaciones."','".$this->estado."'");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }else{
           $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->edita_datos("T_horario", "Horario='".$this->horario."',Observaciones='".$this->observaciones."',Estado='".$this->estado."'", "ID_Horario=".$this->id_horario);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
        }
    }

}