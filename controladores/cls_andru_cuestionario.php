<?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_cuestionario
 * Clase generada automáticamente el 2018-08-24 15:27
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_andru_cuestionario {
    /**
     * Columna [ID_Cuestionario] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Llave primaria de la tabla 
     */
    public $ID_Cuestionario;
    /**
     * Columna [ID_PuntoBCR] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Llave foranea con la tabla t_puntosbcr 
     */
    public $ID_PuntoBCR;
    /**
     * Columna [ID_Fase] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Llave foranea con la tabla t_andru_fases 
     */
    public $ID_Fase;
    /**
     * Columna [Usuario_Crea] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Usuario que crea el cuestionario 
     */
    public $Usuario_Crea;
    /**
     * Columna [Fecha_Crea] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Fecha de creación 
     */
    public $Fecha_Crea;
    /**
     * Columna [Usuario_Modifica] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Último usuario que modifica el cuestionario 
     */
    public $Usuario_Modifica;
    /**
     * Columna [Fecha_Modifica] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Última fecha en que se modifica el cuestionario 
     */
    public $Fecha_Modifica;
    /**
     * Columna [Estado] de la tabla [t_andru_cuestionario] en la clase [cls_andru_cuestionario] 
     * Estado de la columna 1= Activo 0= Negativo 
     */
    public $Estado;
    /**
     *Propiedad encargada del manejo de conexión 
     */
    public $obj_data_provider;
    /**
     *Propiedad que almacena los arreglos de las consultas 
     */
    public $arreglo;
    /**
     *Propiedad que almacena el where de las peticiones a la BD 
     */
    public $condicion;

    /**
     *Retorna el valor de la propiedad ID_Cuestionario
     */
    function getID_Cuestionario() {
        return $this->ID_Cuestionario;
    }

    /**
     *Retorna el valor de la propiedad ID_PuntoBCR
     */
    function getID_PuntoBCR() {
        return $this->ID_PuntoBCR;
    }

    /**
     *Retorna el valor de la propiedad ID_Fase
     */
    function getID_Fase() {
        return $this->ID_Fase;
    }

    /**
     *Retorna el valor de la propiedad Usuario_Crea
     */
    function getUsuario_Crea() {
        return $this->Usuario_Crea;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Crea
     */
    function getFecha_Crea() {
        return $this->Fecha_Crea;
    }

    /**
     *Retorna el valor de la propiedad Usuario_Modifica
     */
    function getUsuario_Modifica() {
        return $this->Usuario_Modifica;
    }

    /**
     *Retorna el valor de la propiedad Fecha_Modifica
     */
    function getFecha_Modifica() {
        return $this->Fecha_Modifica;
    }

    /**
     *Retorna el valor de la propiedad Estado
     */
    function getEstado() {
        return $this->Estado;
    }

    /**
     * Retorna el valor de la propiedad Obj_data_provider
     */
    function getObj_data_provider() {
        return $this->obj_data_provider;
    }

    /**
     * Retorna el valor de la propiedad Arreglo
     */
    function getArreglo() {
        return $this->arreglo;
    }

    /**
     * Retorna el valor de la propiedad Condicion
     */
    function getCondicion() {
        return $this->condicion;
    }

    /**
     * Retorna el valor de la propiedad ID_Cuestionario
     */
    function setID_Cuestionario($ID_Cuestionario) {
        $this->ID_Cuestionario = $ID_Cuestionario;
    }

    /**
     * Retorna el valor de la propiedad ID_PuntoBCR
     */
    function setID_PuntoBCR($ID_PuntoBCR) {
        $this->ID_PuntoBCR = $ID_PuntoBCR;
    }

    /**
     * Retorna el valor de la propiedad ID_Fase
     */
    function setID_Fase($ID_Fase) {
        $this->ID_Fase = $ID_Fase;
    }

    /**
     * Retorna el valor de la propiedad Usuario_Crea
     */
    function setUsuario_Crea($Usuario_Crea) {
        $this->Usuario_Crea = $Usuario_Crea;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Crea
     */
    function setFecha_Crea($Fecha_Crea) {
        $this->Fecha_Crea = $Fecha_Crea;
    }

    /**
     * Retorna el valor de la propiedad Usuario_Modifica
     */
    function setUsuario_Modifica($Usuario_Modifica) {
        $this->Usuario_Modifica = $Usuario_Modifica;
    }

    /**
     * Retorna el valor de la propiedad Fecha_Modifica
     */
    function setFecha_Modifica($Fecha_Modifica) {
        $this->Fecha_Modifica = $Fecha_Modifica;
    }

    /**
     * Retorna el valor de la propiedad Estado
     */
    function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    /**
     * Retorna el valor de la propiedad obj_data_provider
     */
    function setobj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    /**
     * Retorna el valor de la propiedad Arreglo
     */
    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    /**
     * Retorna el valor de la propiedad Condicion
     */
    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    /**
     * Constructor: inicializa las variables de la clase cls_andru_cuestionario
     */
    public function __construct() {
        $this->ID_Cuestionario="";
        $this->ID_PuntoBCR="";
        $this->ID_Fase="";
        $this->Usuario_Crea="";
        $this->Fecha_Crea="";
        $this->Usuario_Modifica="";
        $this->Fecha_Modifica="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_andru_cuestionario() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_cuestionario c INNER JOIN t_puntobcr p ON c.ID_PuntoBCR = p.ID_PuntoBCR "
                    . " INNER JOIN t_andru_fases f ON f.ID_Fase = c.ID_Fase INNER JOIN t_usuario uc ON uc.ID_Usuario = c.Usuario_Crea "
                    ." INNER JOIN t_usuario um ON um.ID_Usuario = c.Usuario_Modifica "
                    ." LEFT JOIN ( "
                    ." SELECT c2.id_cuestionario,  "
                    ." IF(SUM(IF(r.ID_Pregunta IS NOT NULL,1,0)) <> SUM(IF(p.ID_Pregunta IS NOT NULL,1,0)) ,0,1) Color "
                    ." FROM t_andru_preguntas p "
                    ." INNER JOIN t_andru_cuestionario  c2 ON c2.ID_Fase = p.ID_Fase "
                    ." LEFT JOIN t_andru_cuestionario_respuestas r ON r.ID_Pregunta = p.ID_Pregunta "
                    ." AND c2.ID_Cuestionario = r.ID_Cuestionario WHERE p.estado =1 "
                    ." GROUP BY c2.id_cuestionario ) t  ON t.id_cuestionario = c.id_cuestionario Order by  p.Nombre ",                    
                    " c.ID_Cuestionario,c.ID_PuntoBCR,c.ID_Fase,c.Usuario_Crea,c.Fecha_Crea,c.Usuario_Modifica,c.Fecha_Modifica,c.Estado,p.Nombre,f.Descripcion,CONCAT(uc.Nombre,' ',uc.Apellido) Crea,CONCAT(um.Nombre,' ',um.Apellido) Modifica,T.Color ", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_cuestionario", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_cuestionario() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Cuestionario==0){
            $this->obj_data_provider->inserta_datos("t_andru_cuestionario","ID_PuntoBCR, ID_Fase, Usuario_Crea, Fecha_Crea, Usuario_Modifica, Fecha_Modifica, Estado","'".$this->ID_PuntoBCR."','".$this->ID_Fase."','".$this->Usuario_Crea."','".$this->Fecha_Crea."','".$this->Usuario_Modifica."','".$this->Fecha_Modifica."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_cuestionario","ID_PuntoBCR='".$this->ID_PuntoBCR."',ID_Fase='".$this->ID_Fase."',Usuario_Crea='".$this->Usuario_Crea."',Fecha_Crea='".$this->Fecha_Crea."',Usuario_Modifica='".$this->Usuario_Modifica."',Fecha_Modifica='".$this->Fecha_Modifica."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_andru_cuestionario(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_andru_cuestionario","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /**
     * Método trae todas las preguntas con su respuesta, es necesario asignar un valor a la
     * propiedad setID_Cuestionario, si no se conoce cual es el ID_Cuestionario se asigna cero
     * a la propiedad setID_Cuestionario
     */
    public function obtener_andru_cuestionario_respuesta() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p INNER JOIN t_andru_preguntas_respuestas r ON p.ID_Pregunta = r.ID_Pregunta "
                . "LEFT JOIN t_andru_cuestionario_respuestas re ON r.ID_Pregunta = re.ID_Pregunta AND r.ID_Respuesta = re.ID_Respuesta AND re.Estado =1 AND re.ID_Cuestionario = ". $this->ID_Cuestionario
                ." LEFT JOIN t_usuario u ON re.ID_Usuario_Upd = u.ID_Usuario ", 
                "p.ID_Pregunta,r.ID_Respuesta ,r.Descripcion Respuesta,r.Nivel, CASE WHEN IFNULL(re.ID_Respuesta,0) >0 THEN 1 ELSE 0 END IdSelec,CONCAT(u.nombre,' ',u.Apellido) Nombre,re.Fecha_Actualiza ",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;      
    }
    /**
     * Método trae todas las posibles respuestas por pregunta
     */
    public function obtener_andru_cuestionario_fase() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p INNER JOIN t_andru_categoria c ON p.ID_Categoria = c.ID_Categoria", 
                "p.ID_Pregunta,p.Descripcion Pregunta,c.Descripcion Fase,-1 ID_Respuesta",
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método trae todas las preguntas y el porcentaje asignado
     */
    public function obtener_andru_cuestionario_porcentaje() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_preguntas p  INNER JOIN t_andru_preguntas_porcentajes por ON por.ID_Pregunta = p.ID_Pregunta", 
                "p.ID_Pregunta,por.ID_Tipo_Porcentaje,CONVERT(por.Valor,DECIMAL(6,2)) Valor ", 
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método trae todas las preguntas y el porcentaje asignado según la respuesta, es necesario asignar un valor a la
     * propiedad setID_Cuestionario, si no se conoce cual es el ID_Cuestionario se asigna cero
     * a la propiedad setID_Cuestionario
     */
    public function obtener_andru_respuesta_porcentaje() {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_tipos_porcentajes tp INNER JOIN t_andru_preguntas_porcentajes pp ON tp.ID_Tipo_Porcentaje = pp.ID_Tipo_Porcentaje"
                ." LEFT JOIN t_andru_cuestionario_respuestas cr on pp.ID_Pregunta = cr.ID_Pregunta AND cr.Estado = 1 AND cr.ID_Cuestionario = ". $this->ID_Cuestionario
                ." LEFT JOIN t_andru_preguntas_respuestas pr on cr.ID_Pregunta = pr.ID_Pregunta AND cr.ID_Respuesta = pr.ID_Respuesta AND pr.Estado = 1 ", 
                "pp.ID_Pregunta, tp.ID_Tipo_Porcentaje, CONVERT((pp.Valor * ifnull(pr.Nivel,0)/100),DECIMAL(6,2)) Calculo ", 
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método trae el promedio por cada tipo de porcentaje
     */
    public function obtener_andru_cuestionario_promedios($cant_preguntas) {
        $this->obj_data_provider->conectar();
        $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_cuestionario_respuestas cr INNER JOIN t_andru_preguntas_respuestas pr ON cr.ID_Pregunta = pr.ID_Pregunta AND cr.ID_Respuesta = pr.ID_Respuesta "
                . "INNER JOIN t_andru_preguntas_porcentajes pp ON cr.ID_Pregunta = pp.ID_Pregunta "
                . "INNER JOIN t_andru_tipos_porcentajes tp ON pp.ID_Tipo_Porcentaje = tp.ID_Tipo_Porcentaje ",
                "cr.ID_Cuestionario,pp.ID_Tipo_Porcentaje, tp.Descripcion, CONVERT(SUM((pr.Nivel * pp.Valor)/100)/".$cant_preguntas.",DECIMAL(6,2)) Promedio ", 
                $this->condicion);
        $this->arreglo=$this->obj_data_provider->getArreglo();
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
}
