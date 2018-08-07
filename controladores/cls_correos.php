<?php

class cls_correos{
    public $ID_correo;
    public $ID_Cuenta;
    public $Para;
    public $CCopia;
    public $CCOculta;
    public $Asunto;
    public $Adjunto;
    public $Cuerpo;
    public $OrielHead;
    public $Enviado;
    public $Estado;
    public $Fecha_Creado;
    public $Fecha_Actualiza;
    public $Usuario_Crea;
    public $Usuario_Actualiza;
    public $obj_data_provider;
    public $arreglo;
    public $condicion;
    public $dblc;

    function getID_correo() {
        return $this->ID_correo;
    }

    function getID_Cuenta() {
        return $this->ID_Cuenta;
    }

    function getPara() {
        return $this->Para;
    }

    function getCCopia() {
        return $this->CCopia;
    }

    function getCCOculta() {
        return $this->CCOculta;
    }

    function getAsunto() {
        return $this->Asunto;
    }

    function getAdjunto() {
        return $this->Adjunto;
    }

    function getCuerpo() {
        return $this->Cuerpo;
    }

    function getOrielHead() {
        return $this->OrielHead;
    }

    function getEnviado() {
        return $this->Enviado;
    }

    function getEstado() {
        return $this->Estado;
    }

    function getFecha_Creado() {
        return $this->Fecha_Creado;
    }

    function getFecha_Actualiza() {
        return $this->Fecha_Actualiza;
    }

    function getUsuario_Crea() {
        return $this->Usuario_Crea;
    }

    function getUsuario_Actualiza() {
        return $this->Usuario_Actualiza;
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

    function setID_correo($ID_correo) {
        $this->ID_correo = $ID_correo;
    }

    function setID_Cuenta($ID_Cuenta) {
        $this->ID_Cuenta = $ID_Cuenta;
    }

    function setPara($Para) {
        $this->Para = $Para;
    }

    function setCCopia($CCopia) {
        $this->CCopia = $CCopia;
    }

    function setCCOculta($CCOculta) {
        $this->CCOculta = $CCOculta;
    }

    function setAsunto($Asunto) {
        $this->Asunto = $Asunto;
    }

    function setAdjunto($Adjunto) {
        $this->Adjunto = $Adjunto;
    }

    function setCuerpo($Cuerpo) {
        $this->Cuerpo = $Cuerpo;
    }

    function setOrielHead($OrielHead) {
        $this->OrielHead = $OrielHead;
    }

    function setEnviado($Enviado) {
        $this->Enviado = $Enviado;
    }

    function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    function setFecha_Creado($Fecha_Creado) {
        $this->Fecha_Creado = $Fecha_Creado;
    }

    function setFecha_Actualiza($Fecha_Actualiza) {
        $this->Fecha_Actualiza = $Fecha_Actualiza;
    }

    function setUsuario_Crea($Usuario_Crea) {
        $this->Usuario_Crea = $Usuario_Crea;
    }

    function setUsuario_Actualiza($Usuario_Actualiza) {
        $this->Usuario_Actualiza = $Usuario_Actualiza;
    }

    function setobj_data_provider($obj_data_provider) {
        $this->obj_data_provider = $obj_data_provider;
    }

    function setArreglo($arreglo) {
        $this->arreglo = $arreglo;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    public function __construct() {
        $this->ID_correo="";
        $this->ID_Cuenta="1";
        $this->Para="";
        $this->CCopia="";
        $this->CCOculta="";
        $this->Asunto="";
        $this->Adjunto="";
        $this->Cuerpo="";
        $this->OrielHead="1";
        $this->Enviado="C";
        $this->Estado="1";
        $this->Fecha_Creado="";
        $this->Fecha_Actualiza="";
        $this->Usuario_Crea="";
        $this->Usuario_Actualiza="";
        $this->arreglo="";
        $this->condicion="";
        $this->obj_data_provider=new Data_Provider();
        $this->dblc = "\"";
    }
    
    public function guardar_correos() {
        $this->Fecha_Creado= date('Y/m/d H:i');
        $this->Fecha_Actualiza= date('Y/m/d H:i');
        $this->obj_data_provider->conectar();
        if ($this->ID_correo==0){
            $this->obj_data_provider->inserta_datos_para_correos("t_correos","ID_Cuenta, Para, CCopia, CCOculta, Asunto, Adjunto, Cuerpo, OrielHead, Enviado, Estado, Fecha_Creado, Fecha_Actualiza, Usuario_Crea, Usuario_Actualiza","'".$this->ID_Cuenta."','".$this->Para."','".$this->CCopia."','".$this->CCOculta."','".$this->Asunto."','".$this->Adjunto."','".$this->Cuerpo."','".$this->OrielHead."','".$this->Enviado."','".$this->Estado."','".$this->Fecha_Creado."','".$this->Fecha_Actualiza."','".$this->Usuario_Crea."','".$this->Usuario_Actualiza."'");
        }else{
            //$this->obj_data_provider->edita_datos("t_correos","ID_Cuenta='".$this->ID_Cuenta."',Para='".$this->Para."',CCopia='".$this->CCopia."',CCOculta='".$this->CCOculta."',Asunto='".$this->Asunto."',Adjunto='".$this->Adjunto."',Cuerpo='".$this->Cuerpo."',OrielHead='".$this->OrielHead."',Enviado='".$this->Enviado."',Estado='".$this->Estado."',Fecha_Creado='".$this->Fecha_Creado."',Fecha_Actualiza='".$this->Fecha_Actualiza."',Usuario_Crea='".$this->Usuario_Crea."',Usuario_Actualiza='".$this->Usuario_Actualiza."'",$this->condicion);
        }
        $this->obj_data_provider->desconectar();
        $this->resultado_operacion=true;
    }
    /*******************************************************************/
    /**Ingrese los nuevos metodos debajo de este comentario**/
    /*******************************************************************/
    /*
     * Función que se encarga de retornar el cuerpo del html
     * $pTitulo es el titulo dentro del html
     * $pMensaje es el texto dentro del html, describe el correo
     * $pCuerpo es el body puedes ser un table con toda la información
     */
    public function generar_cuerpo($pTitulo,$pMensaje){
        
        $vEncabezado  ="<style>table, tr {border: 1px solid #4b6b9e;}td{border: 1px solid #4b6b9e;}</style><table style=".$this->dblc."width: 100%;".$this->dblc."><tr><td style=".$this->dblc." border: none".$this->dblc."><table style=".$this->dblc."width: 100%;".$this->dblc."><tr><td style=".$this->dblc."text-align: center;".$this->dblc."><h2 style=".$this->dblc."color: #4b6b9e".$this->dblc.">";
        $vEncabezado .="[OrielImg]";
        $vEncabezado .="<a style=".$this->dblc."text-decoration: none;color: #4b6b9e".$this->dblc." href=".$this->dblc."http://oriel".$this->dblc.">";
        $vEncabezado .="Oriel <br>Centro de Control</a></h2></td></tr><tr>";
        $vEncabezado .="<td style=".$this->dblc."text-align: center; color: white;background-color: #4b6b9e".$this->dblc.">@titulo</td></tr><tr><td><p></p></td></tr><tr><td style=".$this->dblc."text-align: center; color: white;background-color: #4b6b9e".$this->dblc.">Gracias por utilizar Oriel</td></tr><tr>";
        $vEncabezado .="<td>@mensaje</td></tr></table></td></tr><tr><td style=".$this->dblc." border: none;".$this->dblc.">";
        $vPie ="</td></tr><tr><table style=".$this->dblc."width: 100%;".$this->dblc."><tr><td><p></p></td></tr><tr><td style=".$this->dblc."text-align: center; color: white;background-color: #4b6b9e".$this->dblc.">Este es un mensaje automático, por favor no responderlo. Sí requiere ayuda, comuníquese con el Centro de Control. Ext: 79066.</td></tr></table></tr></table>";
        $vEncabezado= str_replace("@titulo", $pTitulo, $vEncabezado);
        $vEncabezado= str_replace("@mensaje", $pMensaje, $vEncabezado);
        $this->Cuerpo= $vEncabezado . $this->Cuerpo . $vPie;
    }
    /********************Funciones para construir un html***********/
    // Método que retorna la etiqueta de apertura <table> en html
    public function setTexto($pTexto){
        $this->Cuerpo .= $pTexto;
    }
    public function ATable()
    {
        $this->Cuerpo .= "<table style=".$this->dblc."width: 100%;".$this->dblc.">";
    }
    
    // Método que retorna la etiqueta el cierre <table> en html        
    public function CTable()
    {
        $this->Cuerpo .= "</table>";
    }
    
    // Método que retorna la etiqueta de apertura <tr> en html       
     public function ATr()
     {
         $this->Cuerpo .= "<tr>";
     }
    
    // Método que retorna la etiqueta de cierre <tr> en html
    public function CTr()
    {
        $this->Cuerpo .= "</tr>";
    }
          
    // Método que retorna la etiqueta de apertura <td> con atributos de style en html
    public function ATdHead()
    {
        $this->Cuerpo .= "<td style=".$this->dblc."text-align: center; color: white;background-color: #4b6b9e".$this->dblc.">";
    }
    
    /*
     * Método que crea todos los encabezados con el parametro de entrada
     * cada columna debe ir separado por *
     */
    public function ATdAddHeads($pEncabezados)
    {
        $strHtml="";
        $ArrayEncabezados = explode("*",$pEncabezados);
        $tam = count($ArrayEncabezados);        
        if ($tam>0){
            $this->ATr();
            for($i=0; $i<$tam;$i++){
                $this->ATdHead();
                $this->setTexto($ArrayEncabezados[i]);
                $this->CTd();
            }
            $this->CTd();
        }
    }

    // Método que retorna la etiqueta de cierre <td> en html        
    public function ATd()
    {
        $this->Cuerpo .= "<td>";
    }

    /// Método que retorna la etiqueta de apertura <td> con style parametro en html
    public function ATdStyle($pStyle)
    {
        $vtd = "<td style=".$this->dblc."@x".$this->dblc.">";
        $vtd = str_replace("@x", pStyle, $subject);
        $vtd = vtd.Replace("@x", $pStyle,$vtd);        
    }
    
    /// Método que retorna la etiqueta de apertura <td> con centrado en html
    public function ATdCenter()
    {
        $this->Cuerpo .= "<td style=".$this->dblc."text-align: center;".$this->dblc.">";
    }
    
    /// Método que retorna la etiqueta de apertura <td> alineado a la izquierda en html
    public function ATdLeft()
    {
        $this->Cuerpo .= "<td style=".$this->dblc."text-align: left;".$this->dblc.">";
    }

    // Método que retorna la etiqueta de cierre <td> en html
    public function CTd()
    {
        $this->Cuerpo .= "</td>";
    }
    
/*
//ejemplo de como crear un correo con una tabla html
$MailGen = new cls_correos();
$MailGen->setUsuario_Crea($_SESSION['id']);
$MailGen->setUsuario_Actualiza($_SESSION['id']);
 //limpio la variable y creo los encabezados de la tabla
$MailGen->setCuerpo("");
$MailGen->ATable();
$MailGen->Atr();
$MailGen->ATdHead();
$MailGen->setTexto("Nombre");
$MailGen->CTd();
$MailGen->ATdHead();
$MailGen->setTexto("Identificación");
$MailGen->CTd();
$MailGen->ATdHead();
$MailGen->setTexto("Vencimiento portación");
$MailGen->CTd();
$MailGen->CTr();
//Agrego el cuerpo de la tabla
$MailGen->ATr();
$MailGen->ATd();
$MailGen->setTexto("Jean Carlo Benavides P.");
$MailGen->CTd();
$MailGen->ATd();
$MailGen->setTexto("112087790");
$MailGen->CTd();
$MailGen->ATd();
$MailGen->setTexto("2018-12-12");
$MailGen->CTd();
$MailGen->CTr();
 //cierro la tabla y agrego los destinarios
$MailGen->CTable();
$MailGen->setPara("Operaciones de Seguridad|PER_0150@bancobcr.com;");
$MailGen->setCCopia("Coordinacion Centro Control|Coordinacion_Centro_de_Control@bancobcr.com;");
$MailGen->setPara("Diego Venegas|davenegas@bancobcr.com;");
$MailGen->setAsunto("Información personal externo");
//para crear el cuerpo final del correo invoco la siguiente funcion que agrega el encabezado y pie de pagina
$MailGen->generar_cuerpo("Información personal externo", "Las siguientes personas han sido deshabilitas del sistema: ");
//inserto el correo en la base de datos de correos
$MailGen->guardar_correos();
*/
    
}