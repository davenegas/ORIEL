   <?php

/** 
 * Esta clase maneja todos los métodos relacionados con t_andru_categoria
 * Clase generada automáticamente el 2018-08-09 15:31
 * Base de datos: bd_gerencia_seguridad
 * Generada por: Jean Carlo Benavides Pérez
 */ 
class cls_andru_categoria {
    /**
     * Columna [ID_Categoria] de la tabla [t_andru_categoria] en la clase [cls_andru_categoria] 
     * Llave primaria de la tabla 
     */
    public $ID_Categoria;
    /**
     * Columna [Descripcion] de la tabla [t_andru_categoria] en la clase [cls_andru_categoria] 
     * Descripción de las categorias (Infraestructura, Estado de Sistemas, etc) 
     */
    public $Descripcion;
    /**
     * Columna [Estado] de la tabla [t_andru_categoria] en la clase [cls_andru_categoria] 
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
     *Retorna el valor de la propiedad ID_Categoria
     */
    function getID_Categoria() {
        return $this->ID_Categoria;
    }

    /**
     *Retorna el valor de la propiedad Descripcion
     */
    function getDescripcion() {
        return $this->Descripcion;
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
     * Retorna el valor de la propiedad ID_Categoria
     */
    function setID_Categoria($ID_Categoria) {
        $this->ID_Categoria = $ID_Categoria;
    }

    /**
     * Retorna el valor de la propiedad Descripcion
     */
    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
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
     * Constructor: inicializa las variables de la clase cls_andru_categoria
     */
    public function __construct() {
        $this->ID_Categoria="";
        $this->Descripcion="";
        $this->Estado="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
    }

    /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtener_andru_categoria() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_categoria", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_categoria", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }

    /**
     * Método que Inserta o actualiza en base de datos,
     * Cuando el campo llave es cero inserta caso contrario actualiza
     */
    public function guardar_andru_categoria() {
        $this->obj_data_provider->conectar();
        if ($this->ID_Categoria==0){
            $this->obj_data_provider->inserta_datos("t_andru_categoria","Descripcion, Estado","'".$this->Descripcion."','".$this->Estado."'");
        }else{
            $this->obj_data_provider->edita_datos("t_andru_categoria","Descripcion='".$this->Descripcion."',Estado='".$this->Estado."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /**
     * Método actualiza el Estado
     */
    public function cambiar_estado_andru_categoria(){
        $this->obj_data_provider->conectar();
        $this->obj_data_provider->edita_datos("t_andru_categoria","Estado='".$this->Estado."'",$this->condicion);
        $this->obj_data_provider->desconectar();
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
        /**
     * Método que almacena en la propiedad arreglo el resultado de la consulta, 
     * utiliza la propiedad condicion para filtrar en el WHERE 
     */
    public function obtene_preguntas_totales() {
        if($this->condicion==""){
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos("t_andru_categoria", "*", $this->condicion);
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
        else
        {
            $this->obj_data_provider->conectar();
            $this->arreglo=$this->obj_data_provider->trae_datos(" t_andru_cuestionario c "
                    . " INNER JOIN t_andru_cuestionario_respuestas cr ON c.ID_Cuestionario = cr.ID_Cuestionario "
                    . " INNER JOIN t_puntobcr bcr ON c.ID_PuntoBCR = bcr.ID_PuntoBCR "
                    . " INNER JOIN t_andru_preguntas_respuestas pr ON cr.ID_Pregunta = pr.ID_Pregunta AND cr.ID_Respuesta = pr.ID_Respuesta "
                    . " INNER JOIN t_andru_preguntas_porcentajes pp ON cr.ID_Pregunta = pp.ID_Pregunta "
                    . " INNER JOIN t_andru_tipos_porcentajes tp ON pp.ID_Tipo_Porcentaje = tp.ID_Tipo_Porcentaje "
                    . " INNER JOIN ( "
                    . " SELECT ID_Fase,COUNT(1) TotalPreguntas "
                    . " FROM t_andru_preguntas "
                    . " WHERE Estado = 1 "
                    . " GROUP BY ID_Fase "
                    . " ) t ON t.ID_Fase = c.ID_Fase "
                    . " INNER JOIN ( "
                    . " SELECT ID_Cuestionario,	count(ID_Respuesta) TotalRespuestas "
                    . " FROM t_andru_cuestionario_respuestas "
                    . " WHERE Estado = 1 "
                    . " GROUP BY ID_Cuestionario "
                    . " ) resp ON resp.ID_Cuestionario = c.ID_Cuestionario ",
                    
                    " cr.ID_Cuestionario,bcr.Nombre,pp.ID_Tipo_Porcentaje, "
                    ." tp.Descripcion,CONVERT(SUM((pr.Nivel * pp.Valor)/100)/t.TotalPreguntas,DECIMAL(6,2)) Promedio, "
                    ." t.TotalPreguntas,resp.TotalRespuestas ",
                    $this->condicion . " GROUP BY cr.ID_Cuestionario,pp.ID_Tipo_Porcentaje ");
            $this->arreglo=$this->obj_data_provider->getArreglo();
            $this->obj_data_provider->desconectar();
            $this->resultado_operacion=true;
        }
    }
}
