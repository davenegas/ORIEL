<?php

//Definición de la clase Controller. Componente principal de la lógica del negocio. 
 class Controller{
     
     //Declaración de métodos que envuelven toda la funcionalidad del sistema
     /*
      * A través del componente index se llaman cada uno de los eventos de la clase 
      * controller para que sean ejecutados según sea necesario.
      */
     
    /*Inicio del sitio web, llamada a la pantalla principal para inicio de sesion*/
    public function inicio(){
        //Variables que muestran tipos de adventencia en pantalla según sea necesario
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_principal_publica.php';
    }

    ////////////////////////////////////////////////////////////////////////////
    //////////////Metodos de Acceso publico/////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    //Lista el personal con nombre, extensión, teléfono BCR y departamento
    public function personal_listar_publico(){
        //Creación del objeto personal
        $obj_personal=new cls_personal();
        //Trae de la base de datos la lista de personas disponibles
        $obj_personal->obtiene_todo_el_personal_filtrado();
        //Inicializa un vector con el total de registros de la base de datos
        $personas= $obj_personal->getArreglo();
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_personal_listar_publico.php';
    }
    //Lista de puntos BCR con información general y pública para vista de todo el conglomerado BCR
    public function puntobcr_listar_publico(){
        //Creación del objeto puntos BCR
        $obj_puntobcr= new cls_puntosBCR();
        //Trae de la base de datos la lista de puntos BCR disponibles
        $obj_puntobcr->obtiene_todos_los_puntos_bcr_publico();
        //Inicializa un vector con el total de registros de la base de datos
        $puntosbcr = $obj_puntobcr->getArreglo();
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_puntobcr_listar_publico.php';
    }
    
    //Muestra formulario de los números de contacto de la Gerencia de Seguridad
    public function frm_contacto_publico(){
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_contacto_publico.php';
    }
    //////////////////////////
    /*Metodos relacionados del area de Modulos de Seguridad del Sistema*/
    //////////////////////////
     
    // Metodo que llama al formulario correspondiente para validación de credenciales por parte del usuario
    public function iniciar_sesion(){
        //Variables que muestran tipos de adventencia en pantalla según sea necesario
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
    }
    // Obtiene lista completa de roles del sistema
    
    //Metodo que muestra el listado general de roles de seguridad establecidos en el sistema. Pantalla principal del mantenimiento.
    public function listar_roles(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Creación del objeto roles
            $obj_roles= new cls_roles();
            //Trae de la base de datos la lista de roles disponibles
            $obj_roles->obtiene_todos_los_roles();
            //Inicializa un vector con el total de registros de la base de datos
            $params = $obj_roles->getArreglo();
            require __DIR__.'/../vistas/plantillas/lista_de_roles.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    

    // Metodo que realiza la llamada al formulario principal del sistema ORIEL
    public function principal(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_principal.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    

     ////////////////////////////////////////////////////////////////////////////
    ///Serie de metodos que permiten crear un utilitario de importación de personal BCR ////////
    ////////////////////////////////////////////////////////////////////////////
    
    /*
     * 
     */
    /*
     * Paso del utilitario, pantalla de bienvendida, desde esta pantalla es posible 
     * seleccionar el archivo csv correspondiente con el listado total de personas
     * que pertenecen al conglomerado BCR. Este archivo es enviado de manera semanal
     * por parte de personal de capital humano.
     */
    public function frm_importar_prontuario_paso_1(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_1.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    
    
    /*
     * Este metodo, el cual constituye el paso 2 de la importación del prontuario, permite
     * leer el contenido del archivo correspondiente (una vez sea validado) y pasarlo directamente a 
     * un vector como estructura propia de PHP. Una vez hecho esto será posible manipular la información
     * en los pasos siguientes del asistente.
     */
    public function frm_importar_prontuario_paso_2(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
               
            /*
             * En la variable recepcion de archivo, recibe el estado en el que fue recibido el archivo desde el formulario anterior
             */
            $recepcion_archivo=$_FILES['seleccionar_archivo']['error'];
            
            //Valida que el tipo de archivo suministrado por el usuario sea del tipo CSV, delimitado por comas
            if (!($_FILES['seleccionar_archivo']['type']==="application/vnd.ms-excel")){
                //En caso de que sea diferente, muestra una advertencia en pantalla para el usario y se sale del paso
                echo "<script type=\"text/javascript\">alert('Debe Importar un archivo tipo CSV!!!!');history.go(-1);</script>";;
                exit();
            }

            //Asigna a la variable el archivo abierto en modo lectura para recorrer la información contenida en el.
            $handle= fopen ($_FILES['seleccionar_archivo']['tmp_name'],"r");
            
            //Contiene en las variables params y record, el total de regsitros del archivo mediante la funcion fgetcsv
            $params=$record = fgetcsv($handle);
                
            //Declara un vector, el cual contendrá de manera oficial toda la información del documento.
            $prontuario =array();
            
            //Variable contador del ciclo
            $i=0;
            
            //Almacena en la variable record, cada registro mientras handle tenga lineas disponibles que recorrer
            while ($record = fgetcsv($handle,0,";")){
                // a prontuario le va asignando cada uno de los registros del documento
                $prontuario[]=$record;
                // Va incrementado el contador
                $i++;
            }
            
           //Define una variable de sesión, que contiene el vector completo con la información completa del personal
            //Esto permitirá usar el vector leido en cada una de las pantallas del asistente de importación para tenerlo disponible
           $_SESSION['prontuario']=$prontuario;    
           
           //Mediante el contador definido en el ciclo anterior, se envia una variable a la capa de presentación
           // Que notifica cuantas personas fueron recibidas mediante el prontuario
           $mensaje="Fue recibida la información correspondiente a ".$i." personas."; 
            
           //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_2.php';
                          
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de unidades ejecutoras en el sistema
    public function frm_importar_prontuario_paso_3(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo unidad ejecutora para administración de la tabla
            $obj_unidades_ejecutoras = new cls_unidad_ejecutora();
 
            // Crea vector para almacenar las unidades ejecutoras que vienen en el prontuario pero en modo disctinct
            $unidades_ejecutoras=array();
            
            /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de las unidades ejecutoras. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */
            
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
            /*
             * El vector de inconsistencias, por lo general dentro de los pasos del prontuario, almacenará cada
             * uno de los registros o situaciones que valgan la pena recordar una vez se procese la información.
             */
            //Se agrega un título al vector de inconsistencias, el cual posteriormente se transformará en un documento de excel
            $vector_inconsistencias=array(array("Resumen general de actualizacion de unidades ejecutoras",$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs"));
            //Agrega línea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            // Agrega nombres a las columnas principales del documento
            $vector_inconsistencias[]=array ("Valor Prontuario:","Valor en Base de Datos:");
            //Agrega línea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            
            // Lee las unidades ejecutoras que se encuentran en el prontuario y las pasa a un vector separado en modo distinct
            /*
             * Para este proceso se utiliza el vector original de la sesión de usuario y un nuevo vector qu almacena las unidades ejecutoras
             * y la información relevante e indispensable para procesar y actualizar en base de datos.           */
            
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                if (count($unidades_ejecutoras)>0){
                    $bandera=0;
                    for ($x = 0; $x < count($unidades_ejecutoras); $x++) {
                        if ($_SESSION['prontuario'][$i][7]==$unidades_ejecutoras[$x]){
                            $bandera=1;
                        }
                    }
                    if ($bandera==0){
                        $unidades_ejecutoras[]=$_SESSION['prontuario'][$i][7];
                    }else{
                        $bandera=0;
                    }
                }else{
                    $unidades_ejecutoras[]=$_SESSION['prontuario'][$i][7];
                }
            }
            
            // Mediante este ciclo se edita la tabla de unidades ejecutoras completamente, nuevas, duplicadas, modificadas
            
            $nuevas=0;
            $editadas=0;
            
            /*
             * Este proceso permite unificar las unidades ejecutoras, ya que en ocasiones se encuentran duplicadas, omisas o con un nombre erroneo
             */
            
            for ($i = 0; $i < count($unidades_ejecutoras); $i++){
                //Realiza una busqueda a nivel de base de datos, lo que permite traer registros de ue con nombre parecido al del vector de trabajo
                $obj_unidades_ejecutoras->setCondicion("Departamento Like '".substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")+1)."%'");
                //Ejecuta la sentencia SQL
                $obj_unidades_ejecutoras->obtener_unidades_ejecutoras();
            
                //Verifica si la consulta ha traido resultados
                if (count($obj_unidades_ejecutoras->getArreglo())>1){
                    
                    //Variable temporal que va almacenando información de unidades duplicadas
                    $temporal_inconsistencias="UNIDADES DUPLICADAS:";
                    //Establece el numero de la unidad ejecutora al objeto correspondiente
                    $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                    //Establece el nombre de la unidad ejecutora
                    $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                    //Establece las observaciones
                    $obj_unidades_ejecutoras->setObservaciones("");
                    //Establece el estado a 1, el cual es activo
                    $obj_unidades_ejecutoras->setEstado("1");
                    //Agregar unidad ejecutora a la base de datos, en caso requerido se edita la información en lugar de agregarla
                    $obj_unidades_ejecutoras->agregar_nueva_ue_para_prontuario();
                    //Obtiene el id de la unidad ejecutora recien ingresada
                    $obj_unidades_ejecutoras->obtiene_id_ultima_ue_ingresada();
                    
                    /*
                     * El siguiente ciclo edita la unidad ejecutora de las personas y sitios que 
                     * corresponden.
                     */
                    for ($x = 0; $x < count($obj_unidades_ejecutoras->getArreglo()); $x++) {
                        $obj_unidades_ejecutoras->setCondicion("ID_Unidad_Ejecutora=".$obj_unidades_ejecutoras->getArreglo()[$x]['ID_Unidad_Ejecutora']);
                        $obj_unidades_ejecutoras->edita_ue_de_personas_para_prontuario();
                        $obj_unidades_ejecutoras->edita_ue_de_sitios_bcr_para_prontuario();
                        $obj_unidades_ejecutoras->eliminar_ue_sobrantes_para_prontuario();
                        $unidades_ejecutoras_duplicadas=$obj_unidades_ejecutoras->getArreglo()[$x].",";
                        $temporal_inconsistencias.=Encrypter::quitar_tildes($unidades_ejecutoras_duplicadas);
                    }
                    //Variable que cuenta cuantas unidades ejecutoras son editadas.
                    $editadas++;
                    $unidad_prontuario=$unidades_ejecutoras[$i];
                    // Inserta una línea en el vector de inconsistencias con información de las unidades duplicadas
                    $vector_inconsistencias[]=array ("UE DUPLICADAS, Modificacion: ".Encrypter::quitar_tildes($unidad_prontuario),$temporal_inconsistencias);
                    //Inserta una línea en el vector
                    $vector_inconsistencias[]=array ("","");
                }
                //En caso de que el resultado de la consulta arroje solo un registro, se procede a editar la información de la unidad en la base de datos
                if (count($obj_unidades_ejecutoras->getArreglo())==1){
                    if (!($obj_unidades_ejecutoras->getArreglo()[0]['Departamento']==$unidades_ejecutoras[$i])){
                        /*
                         * Agrega la información respectiva a la unidad ejecutora en el objeto correspondiente
                         */
                        $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                        $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                        $obj_unidades_ejecutoras->setObservaciones("");
                        $obj_unidades_ejecutoras->setEstado("1");
                        $obj_unidades_ejecutoras->setCondicion("ID_Unidad_Ejecutora=".$obj_unidades_ejecutoras->getArreglo()[0]['ID_Unidad_Ejecutora']);
                        $obj_unidades_ejecutoras->edita_ue_para_prontuario();
                        $unidad_prontuario=$unidades_ejecutoras[$i];
                        $unidad_base_datos=$obj_unidades_ejecutoras->getArreglo()[0]['Departamento'];
                        /*
                         * Agrega el registro al arreglo que exportará en el archivo de excel la información correspondiente.
                         */
                        $vector_inconsistencias[]=array ("EDICION, se identifica informacion distinta de unidad ejecutora: ".Encrypter::quitar_tildes($unidad_prontuario),Encrypter::quitar_tildes($unidad_base_datos));
                        $vector_inconsistencias[]=array ("","");
                        //Variable que cuenta cuantas unidades ejecutoras son editadas.
                        $editadas++;
                    }
                }
                /*
                 * Si la consulta no arroja resultados, se procede a ingresar como una nueva unidad ejecutora.
                 */
                if ($obj_unidades_ejecutoras->getArreglo()==null){
                    //Asigna la información respectiva a la nueva unidad ejecutora
                    $obj_unidades_ejecutoras->setNumero_ue(substr($unidades_ejecutoras[$i],0,strpos($unidades_ejecutoras[$i],"-")-1));
                    $obj_unidades_ejecutoras->setDepartamento($unidades_ejecutoras[$i]);
                    $obj_unidades_ejecutoras->setObservaciones("");
                    $obj_unidades_ejecutoras->setEstado("1");
                    $obj_unidades_ejecutoras->agregar_nueva_ue_para_prontuario();
                    $unidad_prontuario=$unidades_ejecutoras[$i];
                    $unidad_base_datos=$obj_unidades_ejecutoras->getArreglo()[0]['Departamento'];
                    //Detalla la información de la inserción en el vector que exporta excel.
                    $vector_inconsistencias[]=array ("INSERCION, se identifica nueva unidad ejecutora: ".Encrypter::quitar_tildes($unidad_prontuario),"Se ingresa a la Base de Datos de Oriel");
                    //Nueva linea en el vector que exporta a excel
                    $vector_inconsistencias[]=array ("","");
                    //Variable que cuenta cuantas unidades ejecutoras son agregadas.
                    $nuevas++;
                }    
            }
            //Consulta para verificar cuantas unidades ejecutoras no son utilizadas ni en personal ni en sitios BCR.
            $obj_unidades_ejecutoras->setCondicion("Not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_personal)and not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_ue_puntobcr)");
            //Obtiene el resultado
            $obj_unidades_ejecutoras->obtener_unidades_ejecutoras();
            // Valida el resultado
            if (count($obj_unidades_ejecutoras->getArreglo())==null){
                $cuenta_ue_inactivas=0;
            }else{
                $cuenta_ue_inactivas=count($obj_unidades_ejecutoras->getArreglo());
            }
           
            // Variables para pintar resultados en pantalla al usuarios
            /*
             * Resumen de total de UE, nuevas UE, unidades inactivas y editadas.
             */
            $total_unidades_ejecutoras="Se identificaron un total de ".count($unidades_ejecutoras)." unidades ejecutoras en el prontuario adjunto.";
            $nuevas_unidades_ejecutoras="Se agregaron un total de ".$nuevas." unidades ejecutoras nuevas al sistema.";
            $unidades_inactivas="Se identificaron un total de ".$cuenta_ue_inactivas." unidades ejecutoras no ligadas a ninguna persona ni punto BCR (probablemente estan en desuso o inactivas).";
            $unidades_editadas="Se editaron un total de ".$editadas." unidades ejecutoras";
            
            /*
             * Termina de cerrar el vector con la información correspondiente.
             */
            $vector_inconsistencias[]=array ("","");
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($total_unidades_ejecutoras),"");
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($nuevas_unidades_ejecutoras),"");
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($unidades_inactivas),"");
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($unidades_editadas),"");
                 
            //Llamada al formulario correspondiente para mostrar el resultado del paso.
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_3.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
     
    //Paso de importación del prontuario que permite actualizar la tabla de puestos en el sistema
    public function frm_importar_prontuario_paso_4(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo puestos para administración de la tabla
            $obj_puestos = new cls_puestos();
 
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_puestos=array();
            
            // Lee los puestos que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                if (count($arreglo_puestos)>0){
                    $bandera=0;
                    for ($x = 0; $x < count($arreglo_puestos); $x++) {
                        if ($_SESSION['prontuario'][$i][3]==$arreglo_puestos[$x]){
                            $bandera=1;
                        }
                    }
                    if ($bandera==0){
                        $arreglo_puestos[]=$_SESSION['prontuario'][$i][3];
                    }else{
                        $bandera=0;
                    }
                }else{
                    $arreglo_puestos[]=$_SESSION['prontuario'][$i][3];
                }
            }
            
            // Mediante este ciclo se edita la tabla puestos completamente, nuevos, duplicados, modificados
            
            $nuevos=0;
            $editados=0;
            
            //Vector que permite comparar los puestos del documento suministrado, con la información de la base de datos
            for ($i = 0; $i < count($arreglo_puestos); $i++){
                //Busca el puesto en específico en la base de datos
                $obj_puestos->setCondicion("Puesto='".$arreglo_puestos[$i]."'");
                //Ejecuta la consulta
                $obj_puestos->obtener_puestos();
            
                //Establece el valor del puesto en cuestion
                 $obj_puestos->setPuesto($arreglo_puestos[$i]);
                 //Establece las observaciones
                 $obj_puestos->setObservaciones("");
                 //Establece el estado, 1 como activo
                 $obj_puestos->setEstado("1");
                    
                // Verifica que la consulta haya devuelto algún resultado, en caso de haber varios 
                //registros, se procede a agregar uno nuevo y borrar los duplicados, además reasigna personas al puesto nuevo
                if (count($obj_puestos->getArreglo())>1){
                   
                    //Agrega el puesto en cuestión
                    $obj_puestos->agregar_nuevo_puesto_para_prontuario();
                    //Obtiene el id del puesto agregado
                    $obj_puestos->obtiene_id_ultimo_puesto_ingresado();
                    
                    //Recorre cada uno de los puestos duplicados para editar las personas asignadas al nuevo puesto ingresado
                    for ($x = 0; $x < count($obj_puestos->getArreglo()); $x++) {
                        //Realiza la busqueda del puesto respectivo
                        $obj_puestos->setCondicion("ID_Puesto=".$obj_puestos->getArreglo()[$x]['ID_Puesto']);
                        // Edita las personas asignadas al puesto a eliminar
                        $obj_puestos->edita_puesto_de_personas_para_prontuario();
                        //Elimina los puestos duplicados
                        $obj_puestos->eliminar_puestos_sobrantes_para_prontuario();
                    }
                    //Lleva el conteo de registros editados
                    $editados++;
                }
                //Si el resultado de la consulta inicial = 1, procede a editar los datos del puesto
                if (count($obj_puestos->getArreglo())==1){
                    //Si el nombre del puesto varia en el nombre, procede a editarlo
                    if (!($obj_puestos->getArreglo()[0]['Puesto']==$arreglo_puestos[$i])){
                        
                        //Establece la condicion y edita el nombre con el que tiene el documento actual
                        $obj_puestos->setCondicion("ID_Puesto=".$obj_puestos->getArreglo()[0]['ID_Puesto']);
                        
                        //Procede a editarlo
                        $obj_puestos->edita_puesto_para_prontuario();
                        //Contabiliza la variable de puestos editados
                        $editados++;
                    }
                }
                //En caso de que la consulta no retorne resultados, procede a agregar un puesto nuevo en la bd.
                if ($obj_puestos->getArreglo()==null){
                    
                    //Inserción mediante el objeto de clase
                    $obj_puestos->agregar_nuevo_puesto_para_prontuario();
                    //Contabiliza los nuevos registros.
                    $nuevos++;
                }
                
            }
            //Verifica cuantos puestos quedaron sin relación de personas.
            $obj_puestos->setCondicion("Not ID_Puesto In (Select ID_Puesto From t_personal)");
            //Obtiene el resultado de la consulta
            $obj_puestos->obtener_puestos();
            
            //Verifica si existen resultados.
            if (count($obj_puestos->getArreglo())==null){
                $cuenta_puestos_inactivos=0;
            }else{
                $cuenta_puestos_inactivos=count($obj_puestos->getArreglo());
            }
            
             // Variables para pintar resultados en pantalla al usuarios
            /*
             * Resumen de total de puestos, nuevos puestos, puestos inactivos y editados.
             */
            $total_puestos="Se identificaron un total de ".count($arreglo_puestos)." puestos en el prontuario adjunto.";
            $nuevos_puestos="Se agregaron un total de ".$nuevos." puestos nuevos al sistema.";
            $puestos_inactivos="Se identificaron un total de ".$cuenta_puestos_inactivos." puestos no ligados a ninguna persona.";
            $puestos_editados="Se editaron un total de ".$editados." puestos.";
            //Llamada al formulario correspondiente para mostrar el resultado del paso.
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_4.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente para mostrar el resultado del paso.
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
        
    // Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema
    public function frm_importar_prontuario_paso_5(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){

            //Crea objeto de tipo personal para administración de la tabla
            $obj_personal = new cls_personal();
            //Crea objeto de tipo puesto para administración de la tabla
            $obj_puesto = new cls_puestos();
            //Crea objeto de tipo ue para administración de la tabla
            $obj_ue = new cls_unidad_ejecutora();
            
             /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de inconsistencias en personal. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
            // Arreglo que almacena las personas que cambian de puesto en el sistema
            $vector_cambios_de_puesto=array();
            //Variable contenedora de la fecha en el formato requerido
            $fecha_completa=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs";
            
            /*
             * vector que almacena el registro de inconsistencias a nivel de personal y permite
             * exportarlo en un excel desde la interfaz de usuario correspondiente.
             */
            //Título del documento
            $vector_cambios_de_puesto[]=array("Resumen general de cambios de puesto en personal",$fecha_completa,"","","");
            //Línea  en blanco en el vector
            $vector_cambios_de_puesto[]=array ("","","","","");
            //Titulos de las columnas del documento
            $vector_cambios_de_puesto[]=array ("Nombre Persona:","Cedula:","Puesto Anterior:","Puesto Nuevo:","Unidad Ejecutora:");
            //Línea  en blanco en el vector
            $vector_cambios_de_puesto[]=array ("","","","","");
            
             // Arreglo que almacena las personas que cambian de unidad ejecutora en el sistema
            $vector_cambios_de_ue=array();
            //Titulos de las columnas del documento
            $vector_cambios_de_ue[]=array("Resumen general de cambios de unidad ejecutora en personal",$fecha_completa,"","","");
            //Línea  en blanco en el vector
            $vector_cambios_de_ue[]=array ("","","","","");
            //Titulos de las columnas del documento
            $vector_cambios_de_ue[]=array ("Nombre Persona:","Cedula:","Unidad Ejecutora Anterior:","Nueva Unidad Ejecutora","");
            //Línea  en blanco en el vector
            $vector_cambios_de_ue[]=array ("","","","","");
            
            // Crea vector para almacenar las personas que vienen en el prontuario pero en modo disctinct
            $arreglo_personal=array();
            
            // Lee las personas que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                    //Va agregando cada línea a la estructura correspondiente
                    $arreglo_personal[]=array($_SESSION['prontuario'][$i][0],$_SESSION['prontuario'][$i][1],$_SESSION['prontuario'][$i][3],$_SESSION['prontuario'][$i][4],$_SESSION['prontuario'][$i][7],$_SESSION['prontuario'][$i][8]);
               
            }
            
           
            // Variables de control para mostrar en pantalla un informe final de los resultados posterior al proceso en ejecución
            $nuevos=0;
            $editados=0;
            $eliminadas=0;
            $cambios_de_puesto=0;
            $cambios_de_ue=0;
            
            
             // Mediante este ciclo se edita la tabla personal, se revisa contra el documento de trabajo, si la persona existe 
            //no existe o si hubiera que editarla
            for ($i = 0; $i < count($arreglo_personal); $i++){

                //Establece el criterio de busqueda por numero de cedula del empleado BCR
                $obj_personal->setCondicion("Cedula='".$arreglo_personal[$i][1]."' and ID_Empresa=1");
                //Ejecuta la consulta
                $obj_personal->obtener_personas_prontuario();
            
                //Establece el apellido de la persona en cuestión
                $obj_personal->setApellidonombre($arreglo_personal[$i][0]);
                    
                //Estable el puesto
                $obj_puesto->setPuesto($arreglo_personal[$i][2]);
                //Busca el id del puesto asignado
                $obj_puesto->obtiene_id_puesto_por_nombre();
                //Establece la llave foranea del puesto
                $obj_personal->setId_puesto($obj_puesto->getId());
                
                //Verifica si la consulta devolvió resultados, en este caso si es iguala uno, quiere decir que la persona si existe en la bd
                if (count($obj_personal->getArreglo())==1){  
                    
                    //Compara si tiene el mismo puesto asignado

                   if (!(strcmp($obj_puesto->getId(), $obj_personal->getArreglo()[0]['ID_Puesto']))==0){
                       //En caso de que la comparación se de con puestos diferentes procede a buscar la información del puesto a actualizar
                        $obj_puesto->setCondicion("ID_Puesto=".$obj_personal->getArreglo()[0]['ID_Puesto']);
                        //Obtiene los puestos por medio de la consulta sql
                        $obj_puesto->obtener_puestos();
                        //Registra en el vector correspondiente, el cambio para respaldarlo posteriormente por medio de excel
                        $vector_cambios_de_puesto[]=array ($arreglo_personal[$i][0],$arreglo_personal[$i][1],$obj_puesto->getArreglo()[0]['Puesto'],$arreglo_personal[$i][2],$arreglo_personal[$i][4]);
                        //Agrega un espacio en blanco en el vector
                        $vector_cambios_de_puesto[]=array ("","","","","");
                        //Incrementa la variable de control
                        $cambios_de_puesto++;
                   }
                    
                }
                
                //Establece el numero de cedula al objeto

                $obj_personal->setCedula($arreglo_personal[$i][1]);

                //Establece el nombre de la ue
                $obj_ue->setDepartamento($arreglo_personal[$i][4]);
                //Busca el id de la ue
                $obj_ue->obtiene_id_ue_por_nombre();
                //Establece el id de la ue
                $obj_personal->setId_unidad_ejecutora($obj_ue->getId());
                
                //Verifica si la consulta arrojó algun registro
                if (count($obj_personal->getArreglo())==1){  

                    //Compara las unidades ejecutoras (tanto la del documento de trabajo, como la que se encuentra en la bd)
                   if (!(strcmp($obj_ue->getId(), $obj_personal->getArreglo()[0]['ID_Unidad_Ejecutora']))==0){
                       
                       //define una condicion de busqueda en caso de que la ue del empleado sea diferente a la que trae el documento
                        $obj_ue->setCondicion("ID_Unidad_Ejecutora=".$obj_personal->getArreglo()[0]['ID_Unidad_Ejecutora']);
                        //Ejecuta la consulta SQL
                         $obj_ue->obtener_unidades_ejecutoras();
                         //Registra el cambio en el vector correspondiente para exportación a excel
                        $vector_cambios_de_ue[]=array ($arreglo_personal[$i][0],$arreglo_personal[$i][1],$obj_ue->getArreglo()[0]['Departamento'],$arreglo_personal[$i][4],"");
                        //Agrega un espacio en blanco en el vector
                        $vector_cambios_de_ue[]=array ("","","","","");
                        //Incrementa la variable de control 
                        $cambios_de_ue++;
                   }
                    
                }
                
                //Estable el correo electrónico en el objeto personal
                $obj_personal->setCorreo($arreglo_personal[$i][3]);
                //Establece la dirección suministrada por el documento
                $obj_personal->setDireccion($arreglo_personal[$i][5]);
                
                //Establece el link de la foto

                $obj_personal->setLinkfoto("http://bcr0157uco01/foto/".$arreglo_personal[$i][1].".jpg?rnd=7055");
                
                //Establece la empresa, que en este caso 1 es para BCR
                $obj_personal->setId_empresa("1");

                //Observaciones lo establece vacio
                $obj_personal->setObservaciones("");
                //Estado activo
                $obj_personal->setEstado("1");
                
                /*
                 * En caso de que el arreglo arroje más de un resultado, lo cual es atípico, procede a eliminar los registros correspondientes
                 * y a agregar nuevamente a la persona con la información que viene del documento.
                 */
                if (count($obj_personal->getArreglo())>1){
                   
                    //Agrega la persona con la información que ha venido incluyendo dentro de todo este metodo
                    $obj_personal->agregar_nueva_persona_para_prontuario();
                    //Obtiene el id de la ultima persona ingresada
                    $obj_personal->obtiene_id_ultima_persona_ingresada();
                    
                    //Este ciclo procede a cambiar los telefonos asociados a las personas repetidas, con el nuevo y unico id de la persona ingresada
                    for ($x = 0; $x < count($obj_personal->getArreglo()); $x++) {
                        //Busca telefonos de cada persona repetida
                        $obj_personal->setCondicion("(ID=".$obj_personal->getArreglo()[$x]['ID_Persona'].") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27)");
                        //Edita el id de estos telefonos
                        $obj_personal->edita_id_persona_en_tabla_telefonos_para_prontuario();
                        // Edita ID en la tabla de gerentes de zona
                        $obj_personal->setCondicion("ID_Persona=".$obj_personal->getArreglo()[$x]['ID_Persona']);
                        //Procede editar la información
                        $obj_personal->edita_id_persona_en_tabla_gerente_zona_bcr_para_prontuario();
                        //Elimina las personas repetidas
                        $obj_personal->eliminar_personas_sobrantes_para_prontuario();
                    }
                    //Incrementa la variable de control
                    $editados++;
                }
                //Si la consulta inicial arroja un solo resultado, edita la información de la persona
                if (count($obj_personal->getArreglo())==1){

                    $obj_personal->edita_persona_para_prontuario();
                    //Incrementa la variable de control
                    $editados++;
                    
                }
                
                //En caso de que la consulta no tenga resultados, agrega una persona nueva a la bd
                if ($obj_personal->getArreglo()==null){
                    
                    $obj_personal->agregar_nueva_persona_para_prontuario();
                    $nuevos++;
                }
                
            }
          
            //Agrega una linea nueva en el vector de registro de cambios
            $vector_cambios_de_puesto[]=array ("","","","","");
            //Informe final en el vector
            $vector_cambios_de_puesto[]=array ("Se identificaron un total de ".$cambios_de_puesto." personas que cambiaron de puesto en el sistema","","","","");
            //Agrega una linea nueva en el vector de registro de cambios
            $vector_cambios_de_ue[]=array ("","","","","");
            //Informe final en el vector
            $vector_cambios_de_ue[]=array ("Se identificaron un total de ".$cambios_de_ue." personas que cambiaron de unidad ejecutora en el sistema","","","","");
            
            //Informe final en la variable de control
            $total_personas="Se identificaron un total de ".count($arreglo_personal)." personas en el prontuario adjunto.";
            //Informe final en la variable de control
            $nuevas_personas="Se agregaron un total de ".$nuevos." personas nuevas al sistema.";
            //Informe final en la variable de control
            $personas_editadas="Se revisó a nivel general la información de ".$editados." personas. Fue actualizado solo lo pertinente.";
            
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_5.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema, elimina personas que no pertenecen ya al BCR
    public function frm_importar_prontuario_paso_6(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            
            //Define el vector que lleva el registro de personas eliminadas de la base de datos, como respaldo del proceso a realizar
            $vector_personas_eliminadas=array();
            
            //Crea objeto de tipo personal para administración de la tabla
            $obj_personal = new cls_personal();
            
             /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de inconsistencias en personal. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
            // Arreglo que almacena las personas eliminadas del sistema
            $vector_personas_eliminadas=array();
            //Variable que arma la fecha en el formato requerido
            $fecha_completa=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs";
            
            //Agrega al vector los futuros titulos y columnas del documento
            $vector_personas_eliminadas[][]=array("ID_Persona" => "Resumen general de funcionarios BCR eliminados de la Base de Datos","Cedula" => $fecha_completa,"Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
            $vector_personas_eliminadas[][]=array("ID_Persona" => "","Cedula" => "","Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
            $vector_personas_eliminadas[][]=array("ID_Persona" => "ID Persona:","Cedula" => "Cedula:","Apellido_Nombre" => "Nombre:","ID_Unidad_Ejecutora" => "ID_UE:","ID_Puesto" => "ID_Puesto:","Correo" => "Correo:","Numero_Gafete" => "Gafete:","Direccion" => "Direccion:","Link_Foto" => "Link_Foto:","ID_Empresa" => "ID_Empresa:","Observaciones" => "Observaciones:","Estado" => "Estado:","Departamento" => "Departamento:","Empresa" => "Empresa:","Tipo_Telefono" => "Tipo Telefono:","ID_Tipo_Telefono" => "ID Tipo Telefono:","Numero" => "Numero:","ID_Telefono" => "ID_Telefono:","Observaciones_Tel" => "Observaciones_Tel:","Puesto" => "Puesto:");
            $vector_personas_eliminadas[][]=array("ID_Persona" => "","Cedula" => "","Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
             
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_personal=array();
            
            // Lee las personas que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                
                    $arreglo_personal[]=array($_SESSION['prontuario'][$i][0],$_SESSION['prontuario'][$i][1],$_SESSION['prontuario'][$i][3],$_SESSION['prontuario'][$i][7],$_SESSION['prontuario'][$i][8]);
               
            }
            
            //Variables de control del proceso
            $personas_eliminadas=0;
            $excepciones="";
            
            //Trae de la base de datos, las personas que trabajan para el BCR
            $obj_personal->setCondicion("ID_Empresa=1");
            //Ejecuta la consulta SQL
            $obj_personal->obtener_personas_prontuario();
            //Obtiene el resultado de la consulta en un arreglo
            $params=$obj_personal->getArreglo();

            //Ciclo principal del proceso que permite encontrar las personas que salieron del BCR según la ultima actualización del prontuario.
            for ($i = 0; $i < count($params); $i++){
                    
                //Variable bandera que permite controlar si se encuentra la persona trabajando para el BCR o si no
                $bandera=0;
                
                //Si encuentra la persona y coincide en ambos vectores, asigna 1 a la variable bandera de control
                for ($x = 0; $x < count($arreglo_personal); $x++) {
                    
                    //Busca por numero de cedula
                    if ($params[$i]['Cedula']==$arreglo_personal[$x][1]){
                       $bandera=1;
                    }   
                }
                //Si la persona no es encontrada y no coincide en ambas fuentes, empieza el proceso de borrado correspondiente.
                if ($bandera==0){                   
                    $obj_personal->setCondicion("ID_Persona=".$params[$i]['ID_Persona']);
                    //Antes de eliminar al funcionario es importante validar si tiene función de Gerente de Zona, de ser así no podria eliminarse de la base de datos
                    if ($obj_personal->verifica_si_la_persona_es_gerente_zona_bcr()) {
                        //Registra la excepción para notificar al usuario mediante el resultado del asistente
                       $excepciones.="La persona con nombre:". $params[$i]['Apellido_Nombre']." y número de cédula: ".$params[$i]['Cedula']." no pudo ser borrada de la base de datos, ya que está asignada como Gerente de Zona BCR. Proceda antes a actualizar este cargo con otro miembro del personal. <br>";
                    }else{
                        //Incrementa la variable de control
                        $personas_eliminadas++;
                        //Establece la condición de borrado
                        $obj_personal->setCondicion("T_Personal.ID_Persona=".$params[$i]['ID_Persona']);
                        //Crea una consulta con los datos completo de la persona, para registrarlo antes de eliminarlo
                        $obj_personal->obtiene_todo_el_personal_modulo_personas();
                        //Agrega la información de la persona en el vector de personas que se exportará a excel antes de ser eliminada de la base de datos, así queda respaldada.
                        $vector_personas_eliminadas[]=$obj_personal->getArreglo();
                        //Agrega un espacio en blanco en el vector de datos
                        $vector_personas_eliminadas[][]=array("ID_Persona" => "","Cedula" => "","Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
                        //Establece una condicion para proceder a eliminar telefonos de la persona
                        $obj_personal->setCondicion("ID=".$params[$i]['ID_Persona']);
                        //Llama al procedimiento que elimina la persona
                        $obj_personal->eliminar_telefonos_personas_bcr_fuera_de_prontuario_para_prontuario();
                        $obj_personal->setCondicion("ID_Persona=".$params[$i]['ID_Persona']);
                        $obj_personal->eliminar_personas_bcr_fuera_de_prontuario_para_prontuario();
                    }
                }
                
            }                
            //Construye las variables para mostrar el resultado del paso en pantalla
            $personas_fuera="Se eliminaron un total de ".$personas_eliminadas." personas de la base de datos.";
            //Agrega espacios en blanco en el vector
            $vector_personas_eliminadas[][]=array("ID_Persona" => "","Cedula" => "","Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
            $vector_personas_eliminadas[][]=array("ID_Persona" => $personas_fuera,"Cedula" => "","Apellido_Nombre" => "","ID_Unidad_Ejecutora" => "","ID_Puesto" => "","Correo" => "","Numero_Gafete" => "","Direccion" => "","Link_Foto" => "","ID_Empresa" => "","Observaciones" => "","Estado" => "","Departamento" => "","Empresa" => "","Tipo_Telefono" => "","ID_Tipo_Telefono" => "","Numero" => "","ID_Telefono" => "","Observaciones_Tel" => "","Puesto" => "");
           
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_6.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }

     // Paso de importación del prontuario que permite actualizar la tabla de celulares en el sistema
    public function frm_importar_prontuario_paso_7(){
        
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo puestos para administración de la tabla
            $obj_personal = new cls_personal();
            $obj_telefono= new cls_telefono();
             
            // Crea vector para almacenar los puestos que vienen en el prontuario pero en modo disctinct
            $arreglo_telefonos_celulares=array();
            
            $numeros_actualizados=0;
            
            /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de inconsistencias en personal. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */
            
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            
            // Vector que registra las inconsistencias y diferencias entre numeros de celulares encontrados en el prontuario contra la bd.
            $vector_inconsistencias=array(array("Resumen general de inconsistencias al actualizar numeros de celular de personas en el sistema:",$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs"));
            // Agrega linea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            //Agrega columnas al documento
            $vector_inconsistencias[]=array ("Valor Prontuario:","Valor en Base de Datos:");
            // Agrega linea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            
            // Lee el registro total de personas que se encuentran en el prontuario
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                
                    $arreglo_telefonos_celulares[]=array($_SESSION['prontuario'][$i][1],str_replace (" ","",str_replace ("-","",$_SESSION['prontuario'][$i][10])));
                                       
                    $obj_personal->setCondicion("Cedula='".$arreglo_telefonos_celulares[$i][0]."'");
                    $obj_personal->obtiene_id_de_persona_para_prontuario();
                    /*$obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=3) AND (Numero='0')");
                    $obj_telefono->eliminar_telefonos_para_prontuario();*/
                    $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) AND (Numero='0')");
                    $obj_telefono->eliminar_telefonos_para_prontuario();
                    
                    ///////////////////////////Generar inconsistencias del sistema
                    
                    //Esta validación permite comprobar que el numero de telefono a analizar cumpla los estandares minimos para celulares
                    //Por ejemplo 8 digitos, que sean numeros, etc.
                   
                    if ((strlen($arreglo_telefonos_celulares[$i][1])==8)&&(is_numeric($arreglo_telefonos_celulares[$i][1]))){
                                
                        //Verifica si tiene numeros de telefono diferentes en bd al celular que viene en prontuario
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=3 or ID_Tipo_Telefono=27) AND (Numero<>'".$arreglo_telefonos_celulares[$i][1]."')");
                        
                        //Ejecuta la consulta SQL
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        
                        //Esta validación permite verificar si el funcionario tiene un numero de celular distinto al que viene en el prontuario y lo registra para el reporte de excel.
                        if (count($obj_telefono->getArreglo())>0){
                            $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_celulares[$i][0]." tiene el el numero de celular: ".$arreglo_telefonos_celulares[$i][1]." a nivel de prontuario.";
                            //Variable que va armando la cadena de telefonos registrados en base de datos para crear el comparativo
                            $valor_base_datos="Numeros de telefono celular registrados en la base de datos de Oriel: ";
                             for ($x = 0; $x < count($obj_telefono->getArreglo()); $x++) {
                                 
                                 //Acumula cada registro en la variable correspondiente para armar una sola sentencia
                                $valor_base_datos.=$obj_telefono->getArreglo()[$x]['Numero'].", ";
                                
                             }
                             //Agrega el registro de inconsistencias generado para este funcionario al vector general para el reporte de excel
                             $vector_inconsistencias[]=array ($valor_prontuario,$valor_base_datos);
                             //Agrega espacio en blanco en el vector
                             $vector_inconsistencias[]=array ("","");
                        }  
                    }
                                     
                    ///////////////////////////////////////////////////////////////
                    
                    /*
                     * Consulta y criterio que permite traer los numeros de telefonos asignados a un funcionario BCR
                     */
                    $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) ");
                    //ejecuta la sentencia SQL correspondiente según el criterio establecido en la linea anterior
                    $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                    
                    //Establece los atributos del objeto de tipo telefono, id2 se refiere al id de la persona en cuestión
                    $obj_telefono->setid2($obj_personal->getId());
                    //Asigna tipo de telefono 3 = celular 
                    $obj_telefono->setTipo_telefono("3");
                    //Observaciones del campo en vacío
                    $obj_telefono->setObservaciones("");
                    //Establece el estado como activo
                    $obj_telefono->setEstado("1");
                                     
                    //Verifica si la persona tiene numeros de telefono asociados
                    if (count($obj_telefono->getArreglo())>0){
                        //Valida si tiene el mismo numero de telefono registrado en el prontuario
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) AND Numero='".$arreglo_telefonos_celulares[$i][1]."'");
                        //Ejecuta la consulta SQL segun el criterio establecido 
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        // En caso de que el resultado de la consulta sea cero, procede a ingresarlo inmediatamente
                        if (count($obj_telefono->getArreglo())==0){
                            //Valida que el telefono celular a ingresar sea valido 
                            if ((strlen($arreglo_telefonos_celulares[$i][1])==8)&&(is_numeric($arreglo_telefonos_celulares[$i][1]))){
                                //Establece el numero en el atributo del objeto correspondiente
                                $obj_telefono->setNumero($arreglo_telefonos_celulares[$i][1]);
                                //Guarda el numero
                                $obj_telefono->guardar_telefono_para_prontuario();
                                //Incrementa la variable de control de nuevos numeros ingresados
                                $numeros_actualizados++;
                            }
                        }
                    }else{
                        //En caso de que la consulta general no haya devuelto numeros de telefonos asociados al funcionario, procede a guardarlo verificando los estandares minimos
                       if ((strlen($arreglo_telefonos_celulares[$i][1])==8)&&(is_numeric($arreglo_telefonos_celulares[$i][1]))){
                           //Establece el valor de numero al atributo correspondiente
                           $obj_telefono->setNumero($arreglo_telefonos_celulares[$i][1]);
                           //Guardar el registro en la bd
                           $obj_telefono->guardar_telefono_para_prontuario();
                           //Incrementa la variable de control
                           $numeros_actualizados++;
                       }else{
                           //En caso de que el numero no cumpla con los estandares de tamaño y tipo de dato, se procede a guardar un numero cero, para que permita relacionar al menos un registro al funcionario
                           $obj_telefono->setNumero("0");
                           //Tipo de telefono asignado es 3 = celular
                           $obj_telefono->setTipo_telefono("3");
                           //Guarda el telefono en base de datos
                           $obj_telefono->guardar_telefono_para_prontuario();
                           //$numeros_actualizados++;
                       }
                    }
            }
            
            //Define las variables de resultados para mostrar el summary en pantalla
            $resultados= "Fueron actualizados un total de: ".$numeros_actualizados." números de celular.";
            //Agrega espacios en blanco al vector general de cambios
            $vector_inconsistencias[]=array ("","");
            $vector_inconsistencias[]=array ("","");
            //Resumen final agregado al vector
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($resultados),"");  
            
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_7.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de personas y telefonos de extensiones en el sistema
    public function frm_importar_prontuario_paso_8(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo personal para administración de la tabla
            $obj_personal = new cls_personal();
            //Crea objeto de tipo telefono para administración de la tabla
            $obj_telefono= new cls_telefono();
             
            // Crea vector para almacenar las extensiones telefonicas que vienen en el prontuario pero en modo disctinct
            $arreglo_telefonos_extensiones=array();
            
             /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de inconsistencias en personal. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            
            //Empieza a armar el vector general de inconsistencias que se  presentarán en este paso, con el fin de que sea exportada la información mediante excel
            $vector_inconsistencias=array(array("Resumen general de inconsistencias al actualizar numeros de extensiones de personas en el sistema:",$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs"));
            //Agrega espacio en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            //Agrega nombres para las columnas principales del documento
            $vector_inconsistencias[]=array ("Valor Prontuario:","Valor en Base de Datos:");
            //Agrega espacio en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            
            //Variables de control de la actualización
            $numeros_actualizados=0;
            $nuevos_guardados=0;
                        
            // Lee las personas y numeros de extension en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                    // Arma registro por registro el vector de analisis con base en la información que viene en el prontuario
                    $arreglo_telefonos_extensiones[]=array($_SESSION['prontuario'][$i][1],str_replace (" ","",str_replace ("-","",$_SESSION['prontuario'][$i][5])),str_replace (".","",$_SESSION['prontuario'][$i][6]));
                    
                    //Criterio y consulta que permiten obtener el id de la persona con base en la cedula 
                    $obj_personal->setCondicion("Cedula='".$arreglo_telefonos_extensiones[$i][0]."'");
                    $obj_personal->obtiene_id_de_persona_para_prontuario();
                   
                  ///////////////////////////Generar inconsistencias del sistema
                    
                    //variable bandera que permite determinar inconsistencias en los datos
                    $bandera=0;
                    $contador=0;

                    //Valida el formato y tamaño de la extensión telefónica
                    if ((strlen($arreglo_telefonos_extensiones[$i][1])==8)&&(is_numeric($arreglo_telefonos_extensiones[$i][1]))){
                        //Verifica si la extensión esta asociada a los numeros de las centrales del BCR
                                if (($arreglo_telefonos_extensiones[$i][1]=="22111111")||($arreglo_telefonos_extensiones[$i][1]=="22879000")){
                                    //Verifica que la extensión sea valida, es decir, con un numero mayor a 4 digitos de acuerdo al estandar del banco
                                    if (strlen($arreglo_telefonos_extensiones[$i][2])>4){
                                      
                                        //Variable bandera asignada a 1, para verificar mas adelante que entró en esta parte
                                        //En caso de entrar en esta parte se sobre entiende que la extensión es IP de 5 digitos
                                        $bandera=1;
                                       
                                    }
                                }else{
                                    //En caso de entrar en esta parte, se entiende que esta extensión no es IP y que requiere tambien de un numero
                                    // fijo de 8 digitos
                                    if (strlen($arreglo_telefonos_extensiones[$i][2])>0){
                                       
                                        //Asigna a la variable bandera el valor de 2
                                        $bandera=2;
                                       
                                       
                                    }else{
                                        //De lo contrario asigna valor de 3, indicando que la extensión que viene en el documento no es valida
                                        
                                        $bandera=3;
                                       
                                    }
                                }
                            //Si el numero fijo de contacto al funcionario que trae el prontuario no es valido de acuerdo a los estandares   
                                //será necesario verificar solo la extensión sin contemplar numero fijo.
                            }else{
                                //verifica si la extensión tiene 5 digitos, de lo contrario no la contempla para ingresarla en la bd
                                if (strlen($arreglo_telefonos_extensiones[$i][2])==5){
                                    //asigna valor 4 a la bandera
                                    $bandera=4;
                                   
                                }
                    }
                  
                    //De acuerdo a la verificacion anterior, se trabaja con el valor asignado a la bandera
                    //Si el valor de la bandera es igual al de la inicialización, no hace nada
                    if ((!($bandera==0))){
                           
                        //En caso de que la bandera tenga un valor diferente a cero, verifica que la persona ya no tenga registrado el numero del prontuario en la base de datos.
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=4) AND (Numero<>'".$arreglo_telefonos_extensiones[$i][2]."' AND Numero<>'".$arreglo_telefonos_extensiones[$i][1]."' AND Numero<>'".$arreglo_telefonos_extensiones[$i][1]." ext ".$arreglo_telefonos_extensiones[$i][2]."')");
                        //Ejecuta la consulta SQL
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        
                        //Si la persona tiene 2 o más numeros de extensión, se procede a insertar en el reporte de inconsistencias, para su revisión  y correción
                        if (count($obj_telefono->getArreglo())>0){
                            //En caso de ser 1, contempla solamente la extension telefonica
                            if ($bandera==1){
                                $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_extensiones[$i][0]." tiene el numero de oficina o extension: ".$arreglo_telefonos_extensiones[$i][2]." a nivel de prontuario.";
                            }
                            //En caso de ser 2, contempla el numero directo mas la extension telefonica
                            if ($bandera==2){
                                $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_extensiones[$i][0]." tiene el numero de oficina o extension: ".$arreglo_telefonos_extensiones[$i][1]." ext ".$arreglo_telefonos_extensiones[$i][2]." a nivel de prontuario.";
                            }
                            //En caso de ser 3, contempla solamente la extension telefonica
                             if ($bandera==3){
                                $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_extensiones[$i][0]." tiene el numero de oficina o extension: ".$arreglo_telefonos_extensiones[$i][1]." a nivel de prontuario.";
                            }
                            //En caso de ser 4, contempla solamente la extension telefonica
                             if ($bandera==4){
                                $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_extensiones[$i][0]." tiene el numero de oficina o extension: ".$arreglo_telefonos_extensiones[$i][1]." a nivel de prontuario.";
                            }
                            // Aqui agrega en una variable cadena cada una de las extensiones que tiene asignada la persona en bd
                             $valor_base_datos="Numeros de extension registrados en la base de datos de Oriel: ";
                             for ($x = 0; $x < count($obj_telefono->getArreglo()); $x++) {

                                 //variable temporal que va almacenando cada uno de los registros de la bd
                                    $valor_base_datos.=$obj_telefono->getArreglo()[$x]['Numero'].", ";

                             }
                             //Agrega un nuevo registro en el vector de inconsistencias, para que sea exportado a excel.
                             $vector_inconsistencias[]=array ($valor_prontuario,$valor_base_datos);
                             //Agrega un espacio en blanco en el vector
                             $vector_inconsistencias[]=array ("","");
                        }  
                        
                    }
                                 
                    ///////////////////////////////////////////////////////////////
                     
                    /*
                     * Consulta que trae los numeros de telefono de la persona en cuestión
                     */
                    $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) ");
                    //Ejecuta la consulta SQL
                    $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                    
                    //Establece el atributo ID2 con el id de la persona en cuestión
                    $obj_telefono->setid2($obj_personal->getId());
                    //Tipo de telefono establecido como extension personas
                    $obj_telefono->setTipo_telefono("4");
                    //Observaciones se inicializa en vacio
                    $obj_telefono->setObservaciones("");
                    //Estado activo
                    $obj_telefono->setEstado("1");
                          
                    /*
                     * Si la persona ya tiene telefonos procede con la revisión
                     */
                    if (count($obj_telefono->getArreglo())>0){
                        // Vuelve a verificar si alguno de los telefonos que hay en base de datos, coincide con el del prontuario
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) AND (Numero='".$arreglo_telefonos_extensiones[$i][2]."' or Numero='".$arreglo_telefonos_extensiones[$i][1]."' or Numero='".$arreglo_telefonos_extensiones[$i][1]." ext ".$arreglo_telefonos_extensiones[$i][2]."')");
                        //ejecuta la consulta SQL
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        //Si el resultado de la consulta =0, entonces el prontuario trae un numero diferente al de la base de datos, por lo que es necesario validar los estándares y en caso positvo se guarda en bd
                        if (count($obj_telefono->getArreglo())==0){
                            //Valida que el telefono cumpla los estandaresde  tamaño y formato
                            if ((strlen($arreglo_telefonos_extensiones[$i][1])==8)&&(is_numeric($arreglo_telefonos_extensiones[$i][1]))){
                                //En caso de tener de numero fijo la central del BCR, no será tomada en cuenta
                                if (($arreglo_telefonos_extensiones[$i][1]=="22111111")||($arreglo_telefonos_extensiones[$i][1]=="22879000")){
                                    //Valida que la extensión sea mayor a 4 caracteres
                                    if (strlen($arreglo_telefonos_extensiones[$i][2])>4){
                                        //Inicializa el atributo del objeto telefono
                                        $obj_telefono->setNumero($arreglo_telefonos_extensiones[$i][2]);
                                        //Guarda la información en base de datos
                                        $obj_telefono->guardar_telefono_para_prontuario();
                                        // Incrementa variable de control 
                                        $nuevos_guardados++;
                                    }
                                }else{
                                    //En caso de que el numero fijo no sea la central del  banco, procede a valorar tanto la extensión como el numero fijo.
                                    if (strlen($arreglo_telefonos_extensiones[$i][2])>0){
                                        //Establece el numero de extension al objeto de la clase
                                        $obj_telefono->setNumero($arreglo_telefonos_extensiones[$i][1]." ext ".$arreglo_telefonos_extensiones[$i][2]);
                                        // Almacena la información en base de datos
                                        $obj_telefono->guardar_telefono_para_prontuario();
                                        //Incrementa la variable de control
                                        $nuevos_guardados++;
                                    }else{
                                        //Procede a valorar solamente la extensión del prontuario
                                         $obj_telefono->setNumero($arreglo_telefonos_extensiones[$i][1]);
                                        //Almacena en base de datos
                                         $obj_telefono->guardar_telefono_para_prontuario();
                                        //Incrementa la variable de control
                                         $nuevos_guardados++;
                                    }
                                }
                                    
                            }else{
                                //Verifica que la extensión esté compuesta por 5 digitos
                                if (strlen($arreglo_telefonos_extensiones[$i][2])==5){
                                    // Establece el numero al atributo del objeto
                                    $obj_telefono->setNumero($arreglo_telefonos_extensiones[$i][2]);
                                    // Almacena en base de datos
                                    $obj_telefono->guardar_telefono_para_prontuario();
                                    // Incrementa la variable de control
                                    $nuevos_guardados++;
                                }
                            }
                            //Incrementa la variable de control
                            $numeros_actualizados++;
                            
                        }
                        
                    }
            }
  
            //Variable que realiza el summary correspondiente para mostrarlo al usuario final que está corriendo el proceso
            $resultados='Se actualizaron un total de '.$nuevos_guardados.' extensiones telefónicas en la bd.';
            //Asigna espacios en blanco al vector de reporte de inconsistencias
            $vector_inconsistencias[]=array ("","");
            $vector_inconsistencias[]=array ("","");
            //Agrega el summary al vector como una linea nueva
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($resultados),"");  
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_8.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar ls tabla de puestos y unidades ejecutoras
    //Eliminando las que se encuentran solas sin relación con personas o puntos bcr
    public function frm_importar_prontuario_paso_9(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo puestos y unidades ejecutoras para administración de la tabla
            $obj_unidades_ejecutoras = new cls_unidad_ejecutora();
            $obj_puestos= new cls_puestos();
                  
            //Variables de control del proceso inicializadas
            $unidades_eliminadas=0;
            $puestos_eliminados=0;
            
            //Establece condicion para determinar cuantas unidades ejecutoras están sin relaciones
            $obj_unidades_ejecutoras->setCondicion("Not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_personal) and not ID_Unidad_Ejecutora In (Select ID_Unidad_Ejecutora From t_ue_puntobcr)");
            //Ejecuta la sentencia SQL
            $obj_unidades_ejecutoras->obtener_unidades_ejecutoras();
            //Cuenta cuantas unidades ejecutoras serán eliminadas, y las registra en la variable respectiva.
            $unidades_eliminadas= count($obj_unidades_ejecutoras->getArreglo());
            //Procede a eliminar las unidades ejecutoras en cuestión.
            $obj_unidades_ejecutoras->eliminar_ue_sobrantes_para_prontuario();
            
            //Procede a buscar los puestos sin relación en la bd
            $obj_puestos->setCondicion("Not ID_Puesto In (Select ID_Puesto From t_personal)");
            //Ejecuta la sentecia SQL
            $obj_puestos->obtener_puestos();
            //Cuenta cuantos puestos se van a eliminar
            $puestos_eliminados= count($obj_puestos->getArreglo());
            //Procede a eliminar los puestos en cuestión.
            $obj_puestos->eliminar_puestos_sobrantes_para_prontuario();
            
            //Arma el summary para mostrar al usuario el resultado del proceso
            $ue_eliminadas="Fueron eliminadas un total de ".$unidades_eliminadas." unidades ejecutoras sin uso de la base de datos.";
            
            $puestos="Fueron eliminados un total de ".$puestos_eliminados." puestos sin uso de la base de datos.";
                                     
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_9.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de telefonos, con los telefonos de residencia de cada funcionario
    //Información que proviene desde el prontuario de capital humano.
    public function frm_importar_prontuario_paso_10(){
        //Validación para verificar si el usuario está logeado en el sistema
         if(isset($_SESSION['nombre'])){
            
            //Crea objeto de tipo personal y telefono para administración de la tabla
            $obj_personal = new cls_personal();
            $obj_telefono= new cls_telefono();
             
            // Crea vector para almacenar los telefonos de residencia que vienen en el prontuario pero en modo disctinct
            $arreglo_telefonos_casa=array();
            
            //Variable de control de lo que se realiza en el proceso.
            $numeros_actualizados=0;
            
             /*
             * Los siguientes vectores permiten definir un formato específico para la fecha que llevara en el nombre
             * del archivo generado (xls) una vez se procese la información de inconsistencias en personal. El reporte se
             * descarga de manera automática en formato excel, una vez se complete el proceso.
             * Se definen dos vectores, uno para los días de la semana y otro para los meses del año
             */

            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            
            //Declaración del vector de inconsistencias presentadas durante el proceso, esto con el fin de poder exportarlo en modo excel
            // y darle seguimiento por parte de los encargados.
            $vector_inconsistencias=array(array("Resumen general de inconsistencias al actualizar numeros de casa de habitacion de personas en el sistema:",$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs"));
            //Inserta linea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            //Indica los títulos de las columnas en el vector
            $vector_inconsistencias[]=array ("Valor Prontuario:","Valor en Base de Datos:");
            //Inserta linea en blanco en el vector
            $vector_inconsistencias[]=array ("","");
            
            // Lee los telefonos que se encuentran en el prontuario y los pasa a un vector separado en modo distinct
            for ($i = 0; $i < count($_SESSION['prontuario']); $i++) {
                    //Va sasando del prontuario la información que se requiere y la pasa al vector de trabajo.
                    $arreglo_telefonos_casa[]=array($_SESSION['prontuario'][$i][1],str_replace (" ","",str_replace ("-","",$_SESSION['prontuario'][$i][9])));
                         
                    //Establece condicion para obtener el id de la persona que se está trabajando actualmente.
                    $obj_personal->setCondicion("Cedula='".$arreglo_telefonos_casa[$i][0]."'");
                    //Ejecuta la sentencia SQL
                    $obj_personal->obtiene_id_de_persona_para_prontuario();
                                      
                    ///////////////////////////Generar inconsistencias del sistema
                   
                    // Valida que el telefono que trae el prontuario cumpla con los estandares de tamaño y formatos correspondientes.
                    if ((strlen($arreglo_telefonos_casa[$i][1])==8)&&(is_numeric($arreglo_telefonos_casa[$i][1]))){
                                
                        //Busca los telefonos de la persona en bd, que sean diferentes al que trae el prontuario.
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2) AND (Numero<>'".$arreglo_telefonos_casa[$i][1]."')");
                        //Ejecuta la sentencia SQL.
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        
                        //Verifica si la consulta trae algun resultado
                        if (count($obj_telefono->getArreglo())>0){
                            //En caso de que el funcionario tenga telefonos de casa diferentes al que viene en el prontuario, procede a registrarlo como una linea en el vector de inconsistencias.
                            $valor_prontuario="El funcionario (a) con cedula: ".$arreglo_telefonos_casa[$i][0]." tiene el numero de casa de habitacion: ".$arreglo_telefonos_casa[$i][1]." a nivel de prontuario.";
                            $valor_base_datos="Numeros de telefono casa de habitacion registrados en la base de datos de Oriel: ";
                            //Mediante este ciclo recorre todos los telefonos registrados en bd como casa de habitación de este funcionario. 
                            for ($x = 0; $x < count($obj_telefono->getArreglo()); $x++) {
                                 //Variable cadena que se va incrementando paso a paso al recorrer cada registro que devolvió la consulta SQL.
                                $valor_base_datos.=$obj_telefono->getArreglo()[$x]['Numero'].", ";
                                
                             }
                             //Agrega la linea completa al vector de inconsistencias.
                             $vector_inconsistencias[]=array ($valor_prontuario,$valor_base_datos);
                             //Agrega una línea en blanco al vector de inconsistencias.
                             $vector_inconsistencias[]=array ("","");
                        }  
                    }
                                     
                    ///////////////////////////////////////////////////////////////
                    
                    //Estable condición para correr una consulta SQL, en este caso trae todos los telefonos asociados a una persona en específico.
                    $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) ");
                    //Ejecuta la sentencia SQL
                    $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                    
                    //Inicializa el id de la persona en el atributo id del objeto telefono
                    $obj_telefono->setid2($obj_personal->getId());
                    //Define el tipo telefono como 2, que corresponde a casa de habitación.
                    $obj_telefono->setTipo_telefono("2");
                    //Inicializa las observaciones del objeto en vacio.
                    $obj_telefono->setObservaciones("");
                    //Define el estado 1, es decir como activo
                    $obj_telefono->setEstado("1");
                             
                    
                    //En caso de que la consulta traiga resultados, es decir si la persona tiene telefonos asignados procede a entrar al proceso.
                    if (count($obj_telefono->getArreglo())>0){
                        
                        //Busca si la persona ya cuenta en bd con el numero de residencia que viene en el prontuario de capital humano.
                        $obj_telefono->setCondicion("(ID=".$obj_personal->getId().") AND (ID_Tipo_Telefono=2 or ID_Tipo_Telefono=3 or ID_Tipo_Telefono=4 or ID_Tipo_Telefono=27 or ID_Tipo_Telefono=28) AND Numero='".$arreglo_telefonos_casa[$i][1]."'");
                        //Ejecuta la sentecia SQL.
                        $obj_telefono->obtiene_telefonos_por_criterio_para_prontuario();
                        //Si la consulta no tiene resultados, procede a verificar el numero de prontuario de acuerdo a los estandares de formato y tamaño.
                        if (count($obj_telefono->getArreglo())==0){
                            if ((strlen($arreglo_telefonos_casa[$i][1])==8)&&(is_numeric($arreglo_telefonos_casa[$i][1]))){
                                //Agrega el numero de telefono al atributo del objeto respectivo
                                $obj_telefono->setNumero($arreglo_telefonos_casa[$i][1]);
                                //Procede a almacenar en base de datos el numero de telefono
                                $obj_telefono->guardar_telefono_para_prontuario();
                                //Incrementa la variable de control
                                $numeros_actualizados++;
                            }
                        }
                    }else{
                        //Verifica que el numero sea correcto.
                       if ((strlen($arreglo_telefonos_casa[$i][1])==8)&&(is_numeric($arreglo_telefonos_casa[$i][1]))){
                           //Establece el numero al atributo del objeto.
                           $obj_telefono->setNumero($arreglo_telefonos_casa[$i][1]);
                           //Almacena en base de datos la información correspondiente
                           $obj_telefono->guardar_telefono_para_prontuario();
                           //Incrementa la variable de control.
                           $numeros_actualizados++;
                       }else{
                           //En caso de que el numero no cumpla con los estandares, es decir que no sea correcto, procede  a agregar un cero en el numero a guardar
                           $obj_telefono->setNumero("0");
                           //Tipo de telefono cero, es decir de residencia o casa de habitación.
                           $obj_telefono->setTipo_telefono("2");
                           //Almacena en bd
                           $obj_telefono->guardar_telefono_para_prontuario();
                           //Incrementa la variable de control.
                           $numeros_actualizados++;
                       }
                    }
            }
            
            //Arma las variables del summary para mostrar al usuario en pantalla.
            $resultados= "Fueron actualizados un total de: ".$numeros_actualizados." números de residencia.";
            //Agrega lineas en blanco al vector de inconsistencias.
            $vector_inconsistencias[]=array ("","");
            $vector_inconsistencias[]=array ("","");
            //Agrega el summary al vector de inconsistencias.
            $vector_inconsistencias[]=array (Encrypter::quitar_tildes($resultados),"");
            
            //Este proceso agrega extensiones en cero, a todos aquellos funcionarios que no tengan ningun telefono asociado, esto
            //con el fin de que las consultas de personal puedan mostrar el total de personas que se encuentran en la bd.
            $obj_telefono->agrega_extension_cero_en_personas_sin_telefonos_asociados_para_prontuario();
            
            //Consulta que permite saber cuantas personas quedaron con numero de telefono en cero dentro de la bd.
            $obj_personal->setCondicion("ID_Persona In (Select ID From t_telefono where ID_Tipo_Telefono in(2,3,4,27,28) and Numero='0') and ID_Empresa=1");
            //Ejecuta la consulta SQL.
            $obj_personal->obtener_personas_con_numeros_en_cero_para_prontuario();
            
            //Crea un vector para registrar el listado de personas con extensiones en cero.
            $vector_personas_con_numeros_en_cero=array();
            //Formatea la fecha actual en una variable.
            $fecha_completa=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').", ".date("H:i", time()) . " hrs";
            //Agrega título al documento de inconsistencias
            $vector_personas_con_numeros_en_cero[][]=array("Apellido_Nombre" => "Resumen general de funcionarios BCR con numeros de telefono en cero en la BD","Cedula" => $fecha_completa,"ID_Persona" => "");
            //Agrega nombres a las columnas principales del documento.
            $vector_personas_con_numeros_en_cero[][]=array("Apellido_Nombre" => "","Cedula" => "","ID_Persona" => "");
            
            //Obtiene el vector completo de inconsistencias generado por la consulta.
            $vector_personas_con_numeros_en_cero[]=$obj_personal->getArreglo();
            $vector_personas_con_numeros_en_cero[][]=array("Apellido_Nombre" => "","Cedula" => "","ID_Persona" => "");
            
            $numero_personas_cero=count($obj_personal->getArreglo());
            $vector_personas_con_numeros_en_cero[][]=array("Apellido_Nombre" => "Se encontraron un toal de ".$numero_personas_cero. " personas que tienen numeros de telefono en cero.","Cedula" => "","ID_Persona" => "");
              
            //Llamada al formulario correspondiente de la vista
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_10.php';
            
           
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
        
    }
    
    // Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema
    public function frm_importar_prontuario_paso_11(){
        
        if(isset($_SESSION['nombre'])){
                                 
           require __DIR__ . '/../vistas/plantillas/frm_importar_prontuario_paso_11.php';
     
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    // Prepara las variables y el formulario respectivo para cambio de clave
    public function cambiar_password(){   
        $usuario = "";       
        $clave = "";  
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";
        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
    }
 
    public function cambia_clave_usuario_post(){
        $usuario = "";       
        $clave = "";  
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";

        $obj_usuarios= new cls_usuarios();         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usu'];
            $clave= $_POST['password_antiguo'];
            $clave_nueva=$_POST['password_nuevo'];
            $confirmacion_clave=$_POST['confirmacion_password'];
            $obj_modulos = new cls_modulos();
            
            if (strlen($usuario)>0){
                if ($obj_usuarios->existe_usuario($usuario)){
                    if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                        if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                            if ((strlen($clave_nueva)>0) && (strlen($confirmacion_clave)>0)){
                                if ($clave_nueva===$confirmacion_clave){
                                    if ($clave_nueva!=$clave){
                                        $_SESSION['nombre']=$usuario;
                                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                                        $_SESSION['rol']=$obj_usuarios->getRol();
                                        $_SESSION['name']=$obj_usuarios->getNombre();
                                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                                        $_SESSION['id']=$obj_usuarios->getId();
                                        $obj_usuarios->setNombre($usuario);
                                        $obj_usuarios->setClave($clave_nueva);
                                        $obj_usuarios->edita_passsword();
                                        $_SESSION['modulos']=array();
                                        
                                        $obj_modulos->obtiene_todos_los_modulos();
                                        $modulos= $obj_modulos->getArreglo();
                                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                                        $roles = $obj_modulos->getArreglo();
                                        $tam = count($modulos);
                                        $tam2 = count($roles);
                                        $estado=0;
                                        for($i=0; $i<$tam;$i++){
                                            for($c=0;$c<$tam2;$c++){
                                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                                    $estado = 1;
                                                    break;
                                                }
                                            }
                                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                            $estado= 0;
                                        }
                                        
                                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';

                                    }else{
                                        $validacion="La nueva contraseña debe ser diferente a la contraseña actual. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                    }else{
                                        $validacion="La nueva contraseña y confirmación no coinciden. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                   
                                }else{
                                    $validacion="Recuerde que los espacios para nueva clave y confirmación, no pueden quedar vacíos";
                                    $tipo_de_alerta="alert alert-danger";
                                    require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                }
                            }else{
                                $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                                $tipo_de_alerta="alert alert-danger";
                                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                            }
                        }else{
                            $validacion="La Contraseña actual del usuario no es correcta";
                            $tipo_de_alerta="alert alert-danger";
                            $clave="";
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                        }
                    }else{
                        $validacion="El usuario no se encuentra registrado en la base de datos";
                        $tipo_de_alerta="alert alert-danger";
                        $usuario="";
                        $clave="";
                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                    }
                }else {
                    $tipo_de_alerta="alert alert-danger";
                    $validacion="Debe completar el espacio de usuario para poder continuar con el proceso";
                    $usuario="";
                    $clave="";
                    require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                }
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
                $tipo_de_alerta="alert alert-danger";
                $validacion="Es necesario completar la infornación requerida para cambiar la contraseña";
                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
            }
    }  

    // Cambia estado del rol (activo/inactivo)
    public function cambiar_estado_rol(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) {
                    $obj_roles=new cls_roles();
                    $obj_roles->setId($_GET['id']);
                    $obj_roles->setEstado($_GET['estado']);
                    $obj_roles->edita_estado_rol();
                    
                    //$obj_roles->desactivar_usuario_rol_inactivo();
                    $obj_roles=new cls_roles();
                    $obj_roles->obtiene_todos_los_roles();
                    $params= $obj_roles->getArreglo();
                    
                    require __DIR__ . '/../vistas/plantillas/lista_de_roles.php';
                }
             }
               
      }else{
            /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
          $tipo_de_alerta="alert alert-warning";
          $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
          require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
      }
    }

    // Metodo que permite cerrar o destruir la sesión actual de usuario, para poder 
     //validar nuevamente el ingreso y validacion de usuario
    public function cerrar_sesion(){
       //Envia un tipo de alerta de información, indicando que el sistema cerró la sesion actual
       $tipo_de_alerta="alert alert-info";
       $validacion="Verificación de Identidad";
       require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
       session_destroy();
    }
    
    public function nota_obtener() {
        if(isset($_SESSION['nombre'])){
            $obj_general = new cls_general();
            $obj_general->obtener_notas();
            $notas= $obj_general->getArreglo(); 
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function nota_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_general = new cls_general();
            $obj_general->setId($_POST['id']);
            $obj_general->setNota($_POST['nota']);
            $obj_general->guardar_nota();            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }    
    }
    
    public function guardar_modulo_rol($id_Rol){
        if(isset($_SESSION['nombre'])){
            if (isset($_POST["lista"])){
                $listaModulos = $_POST["lista"];
                $obj_roles = new cls_roles();
                if($id_Rol!=0){
                    $obj_roles->insertar_rolesModulo($id_Rol,$listaModulos);
                }   else{
                    echo ($id_Rol).'No se ingresaron los modulos';
                    }
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    // Guarda un nuevo Rol del sistema
    public function guardar_rol(){         
        if(isset($_SESSION['nombre'])){
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_roles=new cls_roles();
                $obj_roles->setDescripcion($_POST['descripcion']);
                $obj_roles->setEstado($_POST['estado']);
              
                if ($_GET['id']==0){
                    $obj_roles->obtiene_todos_los_roles();
                    $validacion = $obj_roles->getArreglo();
                    $tam = count($validacion);
                    $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                        $correcto=1;
                        echo '<script>alert("Este Rol ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    if($correcto==0){
                        $obj_roles->inserta_rol();
                        $obj_roles->obtiene_id_ultimo_rol_ingresado();
                        $id_ult_rol=$obj_roles->getId_ultimo_rol_ingresado();
                        $this->guardar_modulo_rol($id_ult_rol);
                    }   else    {
                         header ("location:/ORIEL/index.php?ctl=gestion_roles");
                        //$this->gestion_roles();
                    }
                }   else    {
                    $obj_roles->setId($_GET['id']);
                    $obj_roles->edita_rol();
                    $this->guardar_modulo_rol($_GET['id']);
                }
                $obj_roles->obtiene_todos_los_roles();
                $params = $obj_roles->getArreglo();
        }
        require __DIR__ . '/../vistas/plantillas/lista_de_roles.php';
               
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function gestion_roles(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $desc="";
                $esta=1;
                $ide=$_GET['id'];
                $lista= array();
            }   else   {
                $ide=$_GET['id'];
                $desc=$_GET['descripcion'];
                $esta=$_GET['estado']; 
            
                $obj_roles= new cls_roles();
                $obj_roles->obtiene_todos_los_modulos_por_rol($ide);
                $lista= $obj_roles->getArreglo();
            }
            $obj_modulos=new cls_modulos();
            $obj_modulos->setCondicion("Estado=1");
            $obj_modulos->obtiene_todos_los_modulos();
            $params= $obj_modulos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/gestion_roles.php';
               
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }     
    
    //Trae la lista completa de modulos del sistema
    public function modulos_listar(){      
        if(isset($_SESSION['nombre'])){
            $obj_modulos=new cls_modulos();
            $obj_modulos->obtiene_todos_los_modulos();
            $params= $obj_modulos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
     
    //Ingresa un nuevo módulo de seguridad en la base de datos
    public function modulos_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_modulos=new cls_modulos();
                $obj_modulos->setDescripcion($_POST['descripcion']);
                $obj_modulos->setEstado($_POST['estado']);
              
                if ($_GET['id']==0){
                    $obj_modulos->obtiene_todos_los_modulos();
                    $validacion= $obj_modulos->getArreglo();
                    $tam = count($validacion);
                    $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                        $correcto=1;
                        echo '<script>alert("Este Modulo ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    if($correcto==0){
                        $obj_modulos->inserta_modulo();
                        $ultimo_modulo = $obj_modulos->getArreglo();
                        $obj_modulos->insertar_rolesModulo("1", $ultimo_modulo[0]['ID_Modulo']);
                    }   else    {
                        header ("location:/ORIEL/index.php?ctl=modulos_gestion");
                        //$this->modulos_gestion();
                    }
                }   else   {
                    $obj_modulos->setId($_GET['id']);
                    $obj_modulos->edita_modulo();
                }
                $obj_modulos->obtiene_todos_los_modulos();
                $params= $obj_modulos->getArreglo();
            }
            require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function modulos_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_modulos=new cls_modulos();
                    $obj_modulos->setId($_GET['id']);
                    $obj_modulos->setEstado($_GET['estado']);
                    $obj_modulos->edita_estado_modulo();
              
                    $obj_modulos=new cls_modulos();
                    $obj_modulos->obtiene_todos_los_modulos();
                    $params= $obj_modulos->getArreglo();
                    $obj_modulos->eliminar_modulos_roles($_GET['id']);
                require __DIR__ . '/../vistas/plantillas/lista_de_modulos.php';
                }
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function modulos_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $desc="";
                $esta=1;
                $ide=$_GET['id'];
            }   else   {
                $ide=$_GET['id'];
                $desc=$_GET['descripcion'];
                $esta=$_GET['estado'];
            }
            require __DIR__ . '/../vistas/plantillas/gestion_modulos.php';
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function listar_usuarios(){
        if(isset($_SESSION['nombre'])){
            $obj_usuarios= new cls_usuarios();
            $obj_usuarios ->obtiene_todos_los_usuarios();
            $params= $obj_usuarios->getArreglo();
            require __DIR__.'/../vistas/plantillas/lista_de_usuarios.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function gestion_usuarios(){
        if(isset($_SESSION['nombre'])){
            $params="";
            $obj_roles= new cls_roles();
            $obj_roles->setCondicion("Estado=1");
            $obj_roles->obtiene_todos_los_roles();
            $roles = $obj_roles->getArreglo();
            
            if ($_GET['id']==0){
                $ide=0;
                $params[0]['Nombre']="";
                $params[0]['Apellido']="";
                $params[0]['Cedula']="";
                $params[0]['Correo']="";
                $params[0]['Rol']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']="1";

            }
            if($_GET['id']==-1){
                $ide=0;
                $params[0]['Nombre']=$_POST['Nombre'];
                $params[0]['Apellido']=$_POST['Apellido'];
                $params[0]['Cedula']=$_POST['Cedula'];
                $params[0]['Correo']=$_POST['Correo'];
                $params[0]['Rol']="";
                $params[0]['Observaciones']=$_POST['Observaciones'];
                $params[0]['Estado']="1";
            }
            else    {
                $ide=$_GET['id'];
                $obj_usuario = new cls_usuarios();
                $obj_usuario->setCondicion("ID_Usuario=$ide");
                $obj_usuario->obtiene_todos_los_usuarios();
                $params= $obj_usuario->getArreglo();
            }

            require __DIR__ . '/../vistas/plantillas/gestion_usuarios.php';
        }   else   {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function guardar_usuario(){
        if(isset($_SESSION['nombre'])){
            $obj_usuarios= new cls_usuarios();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Validar información 
                $obj_usuarios->setCondicion("ID_Usuario<>".$_GET['id']);
                $obj_usuarios->obtiene_todos_los_usuarios();
                $validacion = $obj_usuarios->getArreglo();
                $tam = count($validacion);
                $correcto=0;
                    for($i=0; $i<$tam;$i++){
                        if($_POST['Cedula']==$validacion[$i]['Cedula']){
                            $correcto=1;
                            echo '<script>alert("Esta Cedula ya se encuentra registrada en el sistema");</script>';
                            $_POST['Cedula']="";
                            $_GET['id']=-1;
                        }
                        if($_POST['Correo']!="" && $_POST['Correo']==$validacion[$i]['Correo']){
                            $correcto=1;
                            echo '<script>alert("Este correo ya se encuentra registrado en el sistema");</script>';
                            $_POST['Correo']="";
                            $_GET['id']=-1;
                        }
                        if($_POST['Correo']==""){
                            $correcto=0;
                        }
                    }
                if($correcto==0){
                    $obj_usuarios->setId($_GET['id']);
                    $obj_usuarios->setNombre($_POST['Nombre']);
                    $obj_usuarios->setApellido($_POST['Apellido']);
                    $obj_usuarios->setCedula($_POST['Cedula']);
                    $obj_usuarios->setCorreo($_POST['Correo']);
                    $obj_usuarios->setObservaciones($_POST['Observaciones']);
                    $obj_usuarios->setRol($_POST['Rol']);
                    $obj_usuarios->setEstado($_POST['Estado']);
                    $obj_usuarios->guardar_usuario();
                    $obj_usuarios->obtiene_todos_los_usuarios();
                    $params = $obj_usuarios->getArreglo();
                    header ("location:/ORIEL/index.php?ctl=listar_usuarios");
                    //$this->listar_usuarios();
                 }   else    {
                    //header ("location:/ORIEL/index.php?ctl=gestion_usuarios");
                    $this->gestion_usuarios();
                }
            }
            
        } else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function cambiar_estado_usuario(){
        $obj_roles= new cls_roles();
        $obj_usuario= new cls_usuarios(); 
        if(isset($_SESSION['nombre'])){
             
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])){
                    $obj_roles->setCondicion("ID_Rol=".$_GET['rol']);
                    $obj_roles->obtiene_todos_los_roles();
                    $rolusuario=($obj_roles->getArreglo());
                    if($rolusuario[0]['Estado']==1){
                        $obj_usuario->setId($_GET['id']);
                        $obj_usuario->setEstado($_GET['estado']);
                        $obj_usuario->edita_estado_usuario();
                        $obj_usuario->obtiene_todos_los_usuarios();
                        $params= $obj_usuario->getArreglo();
                    }
                    else{
                        echo '<script>alert("Rol Desactivado");</script>';
                        $obj_usuario->obtiene_todos_los_usuarios();
                        $params= $obj_usuario->getArreglo();
                    }
                require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
                }
            }    
        }else   {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function reset_password(){ 
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                $obj_usuario= new cls_usuarios();
                $obj_usuario->setId($_GET['id']);
                $obj_usuario->setClave($_GET['cedula']);
                $obj_usuario->reset_password_usuario();
                $obj_usuario->obtiene_todos_los_usuarios();
                $params= $obj_usuario->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/lista_de_usuarios.php';
            }
        }
        else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function recordar_password(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
        $obj_correo=new Mail_Provider();
         
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $usuario = $_GET['nom'];
                   
             if ($obj_usuarios->existe_usuario($usuario)){
                    $obj_usuarios->obtiene_correo_y_password_de_usuario($usuario);   
                    $correo=$obj_usuarios->getCorreo();
                    $pass=$obj_usuarios->getClave();
                    
                    $obj_correo->agregar_asunto_de_correo("Recordatorio Clave Sistema Oriel");
                    $obj_correo->agregar_detalle_de_correo("Este es un mensaje automático, favor no responderlo.</br> Su clave del sistema Oriel es: ".$pass);
                    $obj_correo->agregar_direccion_de_correo($correo, $usuario);
                    $obj_correo->enviar_correo();
                    $tipo_de_alerta="alert alert-info";
                    $validacion="Se ha enviado un recordatorio de password a su correo electrónico";  
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
             }else
                 {
                   /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
                    $tipo_de_alerta="alert alert-danger";
                    $validacion="Debe digitar un nombre de usuario válido para recordar el password";  
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
                 }
        }
    }
    
    public function listar(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
        $obj_modulos = new cls_modulos();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['nombre'];
            $clave= $_POST['password'];
        
            if ($obj_usuarios->existe_usuario($usuario)){
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){        
                        if (!$obj_usuarios->tiene_clave_por_defecto($usuario,$clave)){
                            $obj_usuarios->obtiene_todos_los_usuarios();
                            $params=$obj_usuarios->getArreglo();
                            $_SESSION['nombre']=$usuario;
                            $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                            $_SESSION['rol']=$obj_usuarios->getRol();
                            $_SESSION['name']=$obj_usuarios->getNombre();
                            $_SESSION['apellido']=$obj_usuarios->getApellido();
                            $_SESSION['id']=$obj_usuarios->getId();
                            
                            $_SESSION['modulos']=array();
                            $obj_modulos->obtiene_todos_los_modulos();
                            $modulos= $obj_modulos->getArreglo();
                            $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                            $roles = $obj_modulos->getArreglo();
                            $tam = count($modulos);
                            $tam2 = count($roles);
                            $estado=0;
                            for($i=0; $i<$tam;$i++){
                                for($c=0;$c<$tam2;$c++){
                                    if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                        $estado = 1;
                                        break;
                                    }
                                }
                                $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                $estado= 0;
                            }
//                            echo "<pre>";
//                            print_r($_SESSION['modulos']);
//                            echo "</pre>";
                            
                            require __DIR__ . '/../vistas/plantillas/frm_principal.php';

                        }else{
                            $tipo_de_alerta="alert alert-info";
                            $validacion="Es necesario cambiar su clave para poder ingresar al sistema";   
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                        }
                        
                    }else{
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        $tipo_de_alerta="alert alert-danger";
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }else {
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    $tipo_de_alerta="alert alert-danger";
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    
            else{
                $validacion="El usuario no se encuentra registrado en la base de datos";
                $tipo_de_alerta="alert alert-danger";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }else
        {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function iniciar_sistema_cambiando_clave(){
        $validacion="";
        $obj_usuarios= new cls_usuarios();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['nombre'];
            $clave= $_POST['password'];
            $obj_modulos =  new cls_modulos();
            if ($obj_usuarios->existe_usuario($usuario)){
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                        $obj_usuarios->obtiene_todos_los_usuarios();
                        $params=$obj_usuarios->getArreglo();
                        $_SESSION['nombre']=$usuario;
                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                        $_SESSION['rol']=$obj_usuarios->getRol();
                        $_SESSION['name']=$obj_usuarios->getNombre();
                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                        $_SESSION['id']=$obj_usuarios->getId();
                        $_SESSION['modulos']=array();
                        $obj_modulos->obtiene_todos_los_modulos();
                        $modulos= $obj_modulos->getArreglo();
                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                        $roles = $obj_modulos->getArreglo();
                        $tam = count($modulos);
                        $tam2 = count($roles);
                        $estado=0;
                        for($i=0; $i<$tam;$i++){
                            for($c=0;$c<$tam2;$c++){
                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                    $estado = 1;
                                    break;
                                }
                            }
                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                            $estado= 0;
                        }    
                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';
                    }   else{
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        $tipo_de_alerta="alert alert-danger";
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }   else   {
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    $tipo_de_alerta="alert alert-danger";
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    else   {
                $validacion="El usuario no se encuentra registrado en la base de datos";
                $tipo_de_alerta="alert alert-danger";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }

        }   else   {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-danger";
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }

    }
    
//FUNCIONES PARA EVENTOS
    public function frm_eventos_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            $puesto_enviado=0;
            //Implementación para obtener el último seguimiento de cada evento, además del último usuario que lo agregó
            
        $tam=count($params);
        if (count($params)>0){
            for ($i = 0; $i <$tam; $i++) {
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();

                if(count($obj_eventos->getArreglo())>0){
                    if ($i==0){
                        $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                    }else{
                        $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());                 
                    }
                }
                
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();

                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));  
                    }
                }else{
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]));
                    }
                }
            }
//            echo '<pre>';
//            print_r($detalle_y_ultimo_usuario);
//            echo '</pre>';
        } 
       
        require __DIR__.'/../vistas/plantillas/frm_eventos_listar.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function eventos_listar_filtrado(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            if($_POST['puesto']==1){
                $puesto_enviado=1;
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Provincia=4 OR T_Evento.ID_Provincia=5 OR T_Evento.ID_Provincia=6) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }
            if($_POST['puesto']==2){
                $puesto_enviado=2;
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND T_Evento.ID_Provincia=1 AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }
            if($_POST['puesto']==3){
                $puesto_enviado=3;
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Tipo_Punto=3 OR T_Evento.ID_Tipo_Punto=4)");
            }
            if($_POST['puesto']==4){
                $puesto_enviado=4;
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Provincia=2 OR T_Evento.ID_Provincia=3 OR T_Evento.ID_Provincia=7) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }if($_POST['puesto']==0){
                $puesto_enviado=0;
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5");
            }
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            
            //Implementación para obtener el último seguimiento de cada evento, además del último usuario que lo agregó
            
        $tam=count($params);
        if (count($params)>0){
            for ($i = 0; $i <$tam; $i++) {
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();

                if(count($obj_eventos->getArreglo())>0){
                    if ($i==0){
                        $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                    }else{
                        $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());                 
                    }
                }
                
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();

                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));  
                    }
                }else{
                    if ($i==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]));
                    }
                }
            }
//            echo '<pre>';
//            print_r($detalle_y_ultimo_usuario);
//            echo '</pre>';
        } 
        require __DIR__.'/../vistas/plantillas/frm_eventos_listar.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_lista_cerrados(){
        
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setCondicion("(T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.Fecha='".date("Y-m-d")."'");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();
            
            $obj_eventos->obtener_todas_las_provincias();
            $lista_provincias=$obj_eventos->getArreglo();
            
            //Obtiene todos lps tipos de puntos BCR que se encuentran activos en la base de datos
            $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
            $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
            
            //Obtiene las oficinas de san jose
                    
            $obj_eventos->setTipo_punto("1");
            $obj_eventos->setProvincia("1");
            
            $obj_eventos->filtra_sitios_bcr_bitacora();
            $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
            
            $tamano=count($params);
            if (count($params)>0){
                        
                for ($x = 0; $x <$tamano; $x++) {

                    $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                    //Obtiene los seguimientos del evento seleccionado, si los hubiere
                    $obj_eventos->obtiene_detalle_evento();


                    if(count($obj_eventos->getArreglo())>0){
                        if ($x==0){
                            $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
    //                     
                        }else{
                            $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
    //                      
                        }
                    }
                    
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();
                
                
                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    if ($x==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
//                     
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
//                      
                    }
                }else{
                    if ($x==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                    }else{
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                    }
                }
                }
            }
            require __DIR__.'/../vistas/plantillas/frm_eventos_lista_cerrados.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_agregar(){
        try {
            if(isset($_SESSION['nombre'])){
                $params="";
                //Vector que almacena la lista completa de tipos de evento para cargarla en el dropdownlistbox correspondiente
                $lista_tipos_de_eventos="";
                //Vector que almacena la lista completa de provincias para cargarla en el dropdownlistbox correspondiente
                $lista_provincias="";
                //Vector que almacena la lista completa de tipos de puntos bcr para cargarla en el dropdownlistbox correspondiente
                $lista_tipos_de_puntos_bcr="";
                
                //Vector que almacena la lista completa de puntos bcr con tipo oficina y de san josé (cuando se agrega un nuevo evento) para cargarla en el dropdownlistbox correspondiente
                $lista_puntos_bcr_oficinas_sj="";
                
                if ($_GET['id']==0){
                  
                    $ide=0;
                    
                    //Crea objeto de tipo eventos para cargar las listas correspondientes
                    $obj_eventos = new cls_eventos();
                    $params[0]['Nombre']=null;
                    //Obtiene todos los tipos de eventos que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    
                    //Obtiene todas las provincias que se encuentran activas en la base de datos
                    $obj_eventos->obtener_todas_las_provincias();
                    $lista_provincias=$obj_eventos->getArreglo();
                    
                    //Obtiene todos lps tipos de puntos BCR que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    //Obtiene los diferentes seguimientos
                    $obj_eventos->obtener_seguimientos();
                    $estadoEventos = $obj_eventos->getArreglo();
                    
                    //Obtiene las oficinas de san jose
                    
                    $obj_eventos->setTipo_punto("1");
                    $obj_eventos->setProvincia("1");

                    $obj_eventos->filtra_sitios_bcr_bitacora();
                    $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
                    
                    /*echo "<pre>";
                    
                    print_r($lista_puntos_bcr_oficinas_sj);
                    
                    echo "</pre>";*/
                    
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    
                }else{   
                    $ide=$_GET['id'];
                    $obj_Puntobcr = new cls_puntosBCR();
                    $obj_eventos = new cls_eventos();

                    $obj_Puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$_GET['id']);
                    $obj_Puntobcr->obtiene_todos_los_puntos_bcr();
                    $params= $obj_Puntobcr->getArreglo();
                    
                    $obj_eventos->setCondicion("");
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    
                    //Obtiene Distrito->Cantón->Provincia
                        //Distritos
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_distritos();
                    $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
                        //Cantones
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_cantones();
                    $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
                        //Provincias
                    $obj_Puntobcr->setCondicion("");
                    $obj_Puntobcr->obtiene_provincias();
                    $lista_provincias = array_merge(array(['ID_Provincia'=>0]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
                    
                    $obj_eventos->setCondicion("");
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$ide);
                    $obj_eventos->obtiene_todos_los_eventos();
                    $eventos_relacionados=$obj_eventos->getArreglo();
                    
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                }
                
            }else
            {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
                $tipo_de_alerta="alert alert-warning";
                $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }  
    }
       
    public function alerta_en_vivo_mismo_punto_bcr_y_evento(){
                
        if(isset($_POST['id_punto_bcr'])&& (isset($_POST['id_tipo_evento']))){
            
            if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
            $obj_eventos->setPunto_bcr($_POST['id_punto_bcr']);
            
                if ($obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    echo "Ya existe abierto este tipo de evento para este punto BCR. Proceda a cerrarlo o ingrese un seguimiento!!!";
                    exit;
                }else
                {
                    //echo "false";
                    exit;
                }
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
           }
        }   else   {
            //echo "false";
            exit;
        }
    }
   
    public function actualiza_en_vivo_reporte_trazabilidad(){
            sleep(2);       
            if(isset($_SESSION['nombre'])){
                
                $fecha_inicial=$_POST['fecha_inicial'];
                $fecha_final=$_POST['fecha_final'];
                $usuario=$_POST['usuario'];
                $tabla_afectada=$_POST['tabla'];
                
                $condicion="t_traza.Fecha between '".$fecha_inicial."' AND '".$fecha_final."' ";
                
                if (!$usuario=="0"){
                    $condicion.="AND t_traza.ID_Usuario=".$usuario." ";
                }
                
                if ($tabla_afectada!="todas"){
                    $condicion.="AND t_traza.Tabla_Afectada='".$tabla_afectada."'";
                }
                  
                $obj_trazabilidad= new cls_trazabilidad();
                $obj_trazabilidad->setCondicion($condicion);
                $obj_trazabilidad->obtiene_trazabilidad();
                $params=$obj_trazabilidad->getArreglo();

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<table id='tabla' class='display2'>";
                    //$html.="<h2 id='titulo'>Movimientos de acuerdo a parámetros:</h2>";
                    $html.="<thead>";   
                    $html.="<tr>";
                    $html.="<th>ID_Traza</th>";
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Antiguedad Dias</th>";
                    $html.="<th>Usuario</th>";
                    $html.="<th>Tabla Afectada</th>";
                    $html.="<th>Dato Actualizado</th>";
                    $html.="<th>Dato Anterior</th>";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody id='cuerpo'>";
                    $tam=count($params);

                    //$html="";
                    
                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        $html.="<td>".$params[$i]['ID_Traza']."</td>";
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre']." ".$params[$i]['Apellido']."</td>";
                        $html.="<td>".$params[$i]['Tabla_Afectada']."</td>";
                        $html.="<td>".$params[$i]['Dato_Actualizado']."</td>";
                        $html.="<td>".$params[$i]['Dato_Anterior']."</td>";
                        
                        $html.="</tr>";
                         }
            
                    $html.="</tbody>";

                    $html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     exit;
                }    
                //require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
                echo $html;
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            } 
        
    }
    
    public function actualiza_en_vivo_reporte_cerrados(){
            sleep(2);       
            if(isset($_SESSION['nombre'])){
                
                $obj_eventos = new cls_eventos();
                
                $fecha_inicial=$_POST['fecha_inicial'];
                $fecha_final=$_POST['fecha_final'];
                $id_punto_bcr=$_POST['id_punto_bcr'];
                               
                $condicion="(T_Evento.Fecha between '".$fecha_inicial."' AND '".$fecha_final."') AND (T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.ID_PuntoBCR=".$id_punto_bcr;
                            
                $obj_eventos->setCondicion($condicion);
                $obj_eventos ->obtiene_todos_los_eventos(); 
                $params= $obj_eventos->getArreglo();
                $todos_los_seguimientos_juntos="";
                
                $tamano=count($params);
                
                if (count($params)>0){

                    for ($x = 0; $x <$tamano; $x++) {

                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();

                        if(count($obj_eventos->getArreglo())>0){
                            if ($x==0){
                                $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
        //                     
                            }else{
                                $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
        //                      
                            }
                        }
                        
                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();
                        $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();


                        //Verifica si existen seguimientos asociados al evento actual
                        if(count($ultimo_seguimiento_asociado)>0){
                            if ($x==0){
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
        //                     
                            }else{
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
        //                      
                            }
                        }else{
                            if ($x==0){
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                            }else{
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                            }
                        }   
                        
                    }
                }

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<table id='tabla' class='display2'>";
                    //$html.="<h2 id='titulo'>Movimientos de acuerdo a parámetros:</h2>";
                    $html.="<thead>";   
                    $html.="<tr>";
                    $html.="<th hidden='true'>ID_Evento</th>";
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Codigo</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Cerrado Por</th>";
                    if ($_SESSION['rol']!=2){  
                        $html.="<th>Gestión</th>";
                    }
                    $html.="<th>Consulta</th>";
                    $html.="<th hidden='true'>Seguimientos</th> ";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody id='cuerpo'>";
                    $tam=count($params);

                    //$html="";
                    
                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr data-toggle='tooltip' title='".$detalle_y_ultimo_usuario[$i]['Detalle']."'>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        
                        $html.="<td hidden='true'>".$params[$i]['ID_Evento']."</td>";
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";   
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Codigo']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";                
                        $html.="<td>".$detalle_y_ultimo_usuario[$i]['Usuario']."</td>";
                        //$html.="<td>".$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']."</td>";
                        
                        if ($_SESSION['rol']!=2){  
                            $html.="<td align='center'><a onclick='recuperar_evento(".$params[$i]['ID_Evento'].",".$params[$i]['ID_PuntoBCR'].",".$params[$i]['ID_Tipo_Evento'].")'>Recuperar Evento</a></td>";
                        }   
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_cerrados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        
//                        $html.="<table id='segunda'>";
//                        $html.="<thead>";
//                        $html.="<tr>";
//                        $html.="<th>Fecha de Seguimiento</th>";
//                        $html.="<th>Detalle del Seguimiento</th>";
//                        $html.="</tr>";
//                        $html.="</thead>";
//                        $html.="<tbody>";
//                        
                        $tama=count($todos_los_seguimientos_juntos);
                        $cadena="";
                        for ($j = 0; $j <$tama; $j++) {
                        
                            //$html.="<tr>";
                            $fecha_evento = date_create($todos_los_seguimientos_juntos[$j]['Fecha']);
                            $fecha_actual = date_create(date("d-m-Y"));
                            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                            if ($params[$i]['ID_Evento']==$todos_los_seguimientos_juntos[$j]['ID_Evento']){
                               $cadena.=date_format($fecha_evento, 'd/m/Y')." ".$todos_los_seguimientos_juntos[$j]['Detalle']."\n";
                            }
                        }
                        $html.="<td hidden='true'>".$cadena."</td>";
//                        $html.="</tbody>";
//                        $html.="</table>";
//                        $html.="</td>";
                        $html.="</tr>";
                    }

                    $html.="</tbody>";

                    $html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     exit;
                }    
                //require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
                echo $html;
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
    }
    
    public function dibuja_tabla_eventos_relacionados_a_punto_bcr(){
                
       if(isset($_POST['id_punto_bcr'])){
            
            if(isset($_SESSION['nombre'])){
                $obj_eventos= new cls_eventos();
                //$obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']." Limit 0,5");
                $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']);
                $obj_eventos->obtiene_todos_los_eventos();
                $params=$obj_eventos->getArreglo();

                if (count($params)>0){
                    
                    //$html="<h2>Listado de Eventos Relacionados a este Punto BCR</h2>";
                    $html="<thead>";   
                    $html.="<tr>";
                    $html.="<th align='center'>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Lapso</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Ingresado Por</th>";
                    $html.="<th>Consulta</th>";
                    $html.="</tr>";
                    $html.="</thead>";
                    
                    $html.="<tbody>";
                    $tam=count($params);

                    for ($i = 0; $i <$tam; $i++) {
           
                        $html.="<tr>";
           
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        $html.="<td align='center'>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']."</td>";
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_relacionados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        $html.="</tr>";
                         }
            
                    $html.="</tbody>";

                    //$html.=" </table>";
                    
                    echo $html;
                    exit;
                }else{
                     $html="<h4>No se encontraron eventos para este sitio.</h4>";
                     echo $html;
                     exit;
                }    

            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }else
        {
            echo "";
            exit;
        }
       
        
    }
    
    
    public function eliminar_imagen_padron_puntobcr(){
        //echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');</script>";
        if(isset($_SESSION['nombre'])){
            $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_padron_fotografico->setCondicion("ID_padron_puntobcr=".$_POST['id_imagen']);
                $obj_padron_fotografico->eliminar_imagen_puntobcr();
                
                $raiz=$_SERVER['DOCUMENT_ROOT'];
    
                if (substr($raiz,-1)!="/"){
                    $raiz.="/";
                }


                //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/20161110111422Entrada Principal.jpg";
               $ruta=  $raiz."Padron_Fotografico_Puntos_BCR/".$_POST['ruta_imagen'];

               // echo $ruta;
                unlink($ruta);
                      
            }
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_recuperar(){
        //echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');</script>";
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $obj_eventos->setFecha(date("Y-m-d")); 
                $obj_eventos->setHora(date("H:i", time()));
                $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
                $obj_eventos->setPunto_bcr($_POST['id_puntobcr']);
                $obj_eventos->setEstado_evento("1");
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
                //echo "1 ingresa";
                
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    //$obj_eventos->ingresar_evento();
                    //echo "2 guarda evento";
                    
                    //echo 'alert("si entro")'; 
                    $obj_eventos->setDetalle("Evento re-abierto (recuperado) por ".$_SESSION['name']." ".$_SESSION['apellido']);
                    $obj_eventos->setId2(0);
                    $obj_eventos->setId($_POST['id_evento']);
                    $obj_eventos->edita_estado_evento("1");
                    $obj_eventos->setAdjunto("N/A");
                    $obj_eventos->ingresar_seguimiento_evento();  
                    
                    //echo "<script type=\"text/javascript\">alert('Evento recuperado con Éxito!!!');history.go(-1);</script>";
                    
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_lista_cerrados");
                    echo "0";
                    //$this->frm_eventos_lista_cerrados();
                }else{
                    //echo '<script>alert("Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!")</script>';
                    //require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    echo "1";
                    exit;
                     
                }
            }
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function guardar_evento(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos= new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha_seguimiento = strtotime($_POST['fecha']);
                $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);

                if ($fecha_seguimiento >  date("Y-m-d")){
                    echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                    exit();
                }if($fecha_seguimiento == date("Y-m-d")){
                     $hora_seguimiento = strtotime($_POST['hora']);
                     $hora_seguimiento = date("H:i", $hora_seguimiento);

                     if ($hora_seguimiento >  date("H:i", time())){
                        echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                        exit();
                     }
                }
                $obj_eventos->setFecha($_POST['fecha']); 
                $obj_eventos->setHora($_POST['hora']);
                $obj_eventos->setTipo_evento($_POST['tipo_evento']);
                $obj_eventos->setProvincia($_POST['nombre_provincia']); 
                $obj_eventos->setTipo_punto($_POST['tipo_punto']); 
                $obj_eventos->setPunto_bcr($_POST['punto_bcr']);
                $obj_eventos->setEstado_evento($_POST['estado_evento']);
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
                //echo "1 ingresa";
                
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    $obj_eventos->ingresar_evento();
                    //echo "2 guarda evento";
                    if(isset($_POST['seguimiento'])&&($_POST['seguimiento']!="")){
                       //echo 'alert("si entro")'; 
                       $obj_eventos->setDetalle($_POST['seguimiento']);
                       $obj_eventos->setId2(0);
                       $obj_eventos->obtiene_id_ultimo_evento_ingresado(); 
                       $obj_eventos->setId($obj_eventos->getId_ultimo_evento_ingresado());
                       $obj_eventos->setAdjunto("N/A");
                       $obj_eventos->ingresar_seguimiento_evento();  
                       //echo "3 guarda seguimiento";
                    }
                    //$this->frm_eventos_listar();
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                }else{
                    //echo '<script>alert("Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!")</script>';
                    //require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    echo "<script type=\"text/javascript\">alert('Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!');history.go(-1);</script>";
                    exit;
                     
                }
            }
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function frm_eventos_editar(){
        if(isset($_SESSION['nombre'])){
            try {
                $ide=$_GET['id'];
                $obj_eventos = new cls_eventos();
                //Obtiene el evento que se muesta en la ventana
                $obj_eventos->setCondicion("ID_Evento=$ide");
                $obj_eventos->obtiene_todos_los_eventos();
                $params= $obj_eventos->getArreglo();
                
                if (count($params)>0){
                     $estado_evento=$params[0]['Estado_Evento']; 
                     //echo $estado_evento;
                     $obj_eventos->setTipo_evento($params[0]['ID_Tipo_Evento']);
                     $prioridad_evento=$obj_eventos->obtiene_prioridad_de_tipo_de_evento();
                     
                }
               
                $obj_eventos->setCondicion("ID_Evento=$ide"." "."order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los detalles del evento seleccionado
                $obj_eventos->obtiene_detalle_evento();
                $detalleEvento= $obj_eventos->getArreglo();
                //Obtiene los diferentes seguimientos
                $obj_eventos->obtener_seguimientos();
                $estadoEventos = $obj_eventos->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/frm_eventos_editar.php';
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
     public function cuenta_visitas_a_puntos_bcr_publico(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Puntos_BCR/".date("Ymd", $time)." Visitas_a_Puntos_BCR_Publico.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
            $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //$cadena_de_direcciones.=$ip.",";
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip.",");
                $total_visitas++;
                fclose($fp);
            }        

            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Puntos_BCR/".date("Ymd", $time)." Total_de_Visitas_Puntos_BCR_Publico.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de consultas a la tabla puntos BCR desde la parte publica ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    public function cuenta_visitas_a_puntos_bcr_privado(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Puntos_BCR/".date("Ymd", $time)." Visitas_a_Puntos_BCR_Privado.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
            $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //$cadena_de_direcciones.=$ip.",";
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip.",");
                $total_visitas++;
                fclose($fp);
            }        

             
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Puntos_BCR/".date("Ymd", $time)." Total_de_Visitas_Puntos_BCR_Privado.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de consultas a la tabla puntos BCR desde la parte privada ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    
    public function cuenta_visitas_a_bitacora_digital(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Bitacora_Digital/".date("Ymd", $time)." Visitas_a_Bitacora_Digital.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
            $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //$cadena_de_direcciones.=$ip.",";
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip.",");
                $total_visitas++;
                fclose($fp);
            }        

             
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Bitacora_Digital/".date("Ymd", $time)." Total_de_Visitas_Bitacora_Digital.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de consultas a la tabla bitacora digital ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    public function cuenta_visitas_a_personal_privado(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Personal/".date("Ymd", $time)." Visitas_a_Personal_Privado.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
           $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //$cadena_de_direcciones.=$ip.",";
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip.",");
                $total_visitas++;
                fclose($fp);
            }        
             
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Personal/".date("Ymd", $time)." Total_de_Visitas_Personal_Privado.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de consultas a la tabla personal desde la parte privada ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    
    public function cuenta_visitas_a_personal_publico(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Personal/".date("Ymd", $time)." Visitas_a_Personal_Publico.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
            $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //$cadena_de_direcciones.=$ip.",";
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip.",");
                $total_visitas++;
                fclose($fp);
            }        
             
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Personal/".date("Ymd", $time)." Total_de_Visitas_Personal_Publico.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de consultas a la tabla personal desde la parte publica ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    public function cuenta_visitas_a_la_pagina(){
        
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
            $time = time();

            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Ingreso_al_Sitio/".date("Ymd", $time)." Visitas_al_Sitio.txt";
            
            $fp = fopen($ruta,"a+");
            fclose($fp);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $ip=$ip."-->".$nombre_host;
            
            $existe = 0;
            $visitas = array();
                       
            $fp = fopen($ruta,"r"); 
            $ips="";
           
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            fclose($fp);
            
            $bandera=0;
            $cadena_de_direcciones="";
            $total_visitas=0;
            if (strlen($ips)>0){
                $total_direcciones=  explode(",", $ips); 
                
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                   
                    if ($ip==$total_direcciones[$i]){
                        $bandera=1;
                    }else{
                        $total_visitas++;
                    }
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
            }else{
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $ip);
                fclose($fp);
            }        
         
            if($bandera == 0){
                $total_visitas++;
                $cadena_de_direcciones.=$ip.",";
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                fwrite($fp, $cadena_de_direcciones);
                fclose($fp);
             }else{
                 $total_visitas++;
             }
             
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Ingreso_al_Sitio/".date("Ymd", $time)." Total_de_Visitas_al_Sitio.txt";
            
            $fp = fopen($ruta,"w+");

            fwrite($fp, "Total de visitas registradas el día ".date("Ymd", $time).":".$total_visitas);
            fclose($fp);

    }
    
    
    public function guardar_seguimiento_evento(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setId($_GET['id']);
            $obj_eventos->setId2(0);
            
            $fecha_seguimiento = strtotime($_POST['Fecha']);
	    $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);
            
            if ($fecha_seguimiento >  date("Y-m-d")){
                echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                exit();
            }if($fecha_seguimiento == date("Y-m-d")){
                $hora_seguimiento = strtotime($_POST['Hora']);
                $hora_seguimiento = date("H:i", $hora_seguimiento);
                
                if ($hora_seguimiento >  date("H:i", time())){
                   echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                   exit();
                }
            }
             
            $obj_eventos->setFecha(($_POST['Fecha']));
            $obj_eventos->setHora(($_POST['Hora']));
            //Validación de informacion en detalle de evento, elimina algunos caracteres especiales
            $detalle = $_POST['DetalleSeguimiento'];
            $detalle= str_replace("'","",$detalle);
            $detalle= str_replace('"','',$detalle);
            $obj_eventos->setDetalle($detalle);
            $obj_eventos->setId_usuario($_SESSION['id']);
            
            //$this->frm_eventos_listar();
            
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
            
            //echo basename($_FILES['archivo_adjunto']['tmp_name']);
            //echo basename($_FILES['archivo_adjunto']['type']);
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');
            //echo $result;
            $krr = explode('-',$result);
            $result = implode("",$krr);
                       
            $raiz=$_SERVER['DOCUMENT_ROOT'];
                       
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  $raiz."Adjuntos_Bitacora/".Encrypter::quitar_tildes($result.$_FILES['archivo_adjunto']['name']);
            //$ruta=  $_SERVER['DOCUMENT_ROOT']."Adjuntos_Bitacora/".$result.$_FILES['archivo_adjunto']['name'];
          
            switch ($recepcion_archivo) {
                case 0:{
                    
                    if (move_uploaded_file($_FILES['archivo_adjunto']['tmp_name'], $ruta)){
                        $obj_eventos->setAdjunto(Encrypter::quitar_tildes($result.$_FILES['archivo_adjunto']['name'])); 
                        $obj_eventos->ingresar_seguimiento_evento();
                        $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                        header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                    }  else {
                        //echo "<script type=\"text/javascript\">alert('Hubo un problema al subir el archivo al servidor!!!');history.go(-1);</script>";;
                        $obj_eventos->setAdjunto("N/A");
                        $obj_eventos->ingresar_seguimiento_evento();
                        $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                        header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                        //echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                    }
                    break;
                }
                    
                case 2:{
                    echo "<script type=\"text/javascript\">alert('El archivo consume mayor espacio del permitido (1 mb) !!!!');history.go(-1);</script>";;
                    break;
                }
                case 4:{ 
                    $obj_eventos->setAdjunto("N/A");
                    $obj_eventos->ingresar_seguimiento_evento();
                    $obj_eventos->edita_estado_evento($_POST['estado_del_evento']);
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                    //echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                    break;
                }
                 case 6:{
                    echo "<script type=\"text/javascript\">alert('El servidor no tiene acceso a la carpeta temporal de almacenamiento!!!!');history.go(-1);</script>";
                    break;
                 } 
                case 7:{
                    echo "<script type=\"text/javascript\">alert('No es posible escribir en el disco duro del servidor!!!!');history.go(-1);</script>";;
                    break;
                }  
                case 8:{
                    echo "<script type=\"text/javascript\">alert('Fue detenida la carga del archivo debido a una extension de PHP!!!!');history.go(-1);</script>";;
                    break;
                }   
            }
            
                   
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    
    
    public function frm_puntos_bcr_padron_fotografico(){
        if(isset($_SESSION['nombre'])){
            
            if (isset($_GET['id'])){
                $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
                $obj_padron_fotografico->setCondicion("ID_PuntoBCR=".$_GET['id']); 
                $obj_padron_fotografico->obtener_imagenes_puntosbcr();
                $params=$obj_padron_fotografico->getArreglo();
                /*echo '<pre>';
                print_r($params);
                echo '</pre>';*/
            }else{
                echo "<script type=\"text/javascript\">alert('Se presentó un error inesperado, por favor vuelva a seleccionar el punto BCR');history.go(-1);</script>";;
                exit();
            }
            
            require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_padron_fotografico.php';
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function guardar_imagen_puntos_bcr(){
        if(isset($_SESSION['nombre'])){
              if (!(isset($_POST['Nombre']))){
                echo "<script type=\"text/javascript\">alert('Es necesario ingresar un nombre de referencia para la imágen!');history.go(-1);</script>";;
                exit();
              }
              
              if (!(isset($_POST['Descripcion']))){
                echo "<script type=\"text/javascript\">alert('Es necesario ingresar una descripción básica para la imágen!');history.go(-1);</script>";;
                exit();
              }
              
               if (!(isset($_POST['Categoria']))){
                echo "<script type=\"text/javascript\">alert('Es necesario elegir una categoría para la imágen!');history.go(-1);</script>";;
                exit();
              }
              
               if (!(isset($_POST['id_punto_bcr']))){
                
                exit();
              }
              
              $nombre_imagen= str_replace('"','',str_replace("'","",$_POST['Nombre']));
              $categoria=$_POST['Categoria'];
              $descripcion=str_replace("'","",$_POST['Descripcion']);
              $id_punto_bcr=$_POST['id_punto_bcr'];
              
              
              //Validación de informacion en detalle de evento, elimina algunos caracteres especiales
              
              $descripcion= str_replace("'","",$descripcion);
              $descripcion= str_replace('"','',$descripcion);

              $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
              
            $obj_padron_fotografico = new cls_padron_fotografico_puntosbcr();
            $obj_padron_fotografico->setId_puntobcr($id_punto_bcr);
            $obj_padron_fotografico->setNombre_imagen($nombre_imagen);
            $obj_padron_fotografico->setDescripcion($descripcion);
            $obj_padron_fotografico->setCategoria($categoria);
                       
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
        
            $date=new DateTime(); //this returns the current date time
            $result = $date->format('Y-m-d-H-i-s');
            //echo $result;
            $krr = explode('-',$result);
            $result = implode("",$krr);
                       
            $raiz=$_SERVER['DOCUMENT_ROOT'];
                       
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            $ruta=  str_replace('"','',str_replace("'","",$raiz."Padron_Fotografico_Puntos_BCR/".Encrypter::quitar_tildes($id_punto_bcr."-".$result."-".$_FILES['archivo_adjunto']['name'])));
                      
            $nombre_ruta=str_replace('"','',str_replace("'","",Encrypter::quitar_tildes($id_punto_bcr."-".$result."-".$_FILES['archivo_adjunto']['name'])));
            
            
            switch ($recepcion_archivo) {
                case 0:{
                    if ((basename($_FILES['archivo_adjunto']['type'])==="jpeg")||(basename($_FILES['archivo_adjunto']['type'])==="gif")||(basename($_FILES['archivo_adjunto']['type'])==="png")||(basename($_FILES['archivo_adjunto']['type'])==="bmp")||(basename($_FILES['archivo_adjunto']['type'])==="tiff")||(basename($_FILES['archivo_adjunto']['type'])==="jpg")){
                        if (move_uploaded_file($_FILES['archivo_adjunto']['tmp_name'], $ruta)){
                            $obj_padron_fotografico->setNombre_ruta(Encrypter::quitar_tildes($nombre_ruta));
                            $obj_padron_fotografico->setFormato(basename($_FILES['archivo_adjunto']['type']));
                            $obj_padron_fotografico->setCondicion("");
                            $obj_padron_fotografico->guardar_imagen_puntobcr();
                            header ("location:/ORIEL/index.php?ctl=frm_puntos_bcr_padron_fotografico&id=".$obj_padron_fotografico->getId_puntobcr());
                        }else{
                            echo "<script type=\"text/javascript\">alert('Hubo un problema al subir el archivo al servidor!!!');history.go(-1);</script>";;
                        }
                    }else{
                        echo "<script type=\"text/javascript\">alert('El archivo no corresponde a un formato valido de imagenes !!!!');history.go(-1);</script>";;
                    }
                    break;
                }
                    
                case 2:{
                    echo "<script type=\"text/javascript\">alert('El archivo consume mayor espacio del permitido (2 mb) !!!!');history.go(-1);</script>";;
                    break;
                }
                case 4:{ 
                    
                    echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                                       
                    break;
                }
                 case 6:{
                    echo "<script type=\"text/javascript\">alert('El servidor no tiene acceso a la carpeta temporal de almacenamiento!!!!');history.go(-1);</script>";
                    break;
                 } 
                case 7:{
                    echo "<script type=\"text/javascript\">alert('No es posible escribir en el disco duro del servidor!!!!');history.go(-1);</script>";;
                    break;
                }  
                case 8:{
                    echo "<script type=\"text/javascript\">alert('Fue detenida la carga del archivo debido a una extension de PHP!!!!');history.go(-1);</script>";;
                    break;
                }   
            }
            
                   
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
         }  
         
    }
    
    
    //////////////////////////
    /*Metodos relacionados del area de Tipos de Evento de Seguridad del Sistema*/
    //////////////////////////
    
    public function tipo_eventos_listar(){      
        if(isset($_SESSION['nombre'])){
            $obj_eventos=new cls_eventos();
            $obj_eventos->obtener_los_tipos_de_eventos();
            $params= $obj_eventos->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_tipo_eventos_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function tipo_eventos_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $observaciones="";
                $estado=1;
                $ide=$_GET['id'];
                $evento="";
            }   else   {
                $ide=$_GET['id'];
                $evento=$_GET['evento'];
                $observaciones=$_GET['observaciones'];
                $prioridad = $_GET['prioridad'];
                $estado=$_GET['estado'];
            }
            require __DIR__ . '/../vistas/plantillas/frm_tipo_eventos_gestion.php';
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function tipo_eventos_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_eventos->setId($_GET['id']);
                $obj_eventos->setTipo_evento($_POST['evento']);
                $obj_eventos->setObservaciones($_POST['observaciones']);
                $obj_eventos->setEstado($_POST['estado']);
                $obj_eventos->setPrioridad($_POST['prioridad']);
                $obj_eventos->guardar_tipo_evento();
                header ("location:/ORIEL/index.php?ctl=tipo_eventos_listar");
                //$this->tipo_eventos_listar();
            }
        } else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }      
    }
    
    public function tipo_eventos_cambiar_estado() {
      if(isset($_SESSION['nombre'])){
            $obj_eventos = new cls_eventos();
            $obj_eventos->setId($_GET['id']);
            $obj_eventos->setTipo_evento($_GET['evento']);
            $obj_eventos->setObservaciones($_GET['observaciones']);
            $obj_eventos->setEstado($_GET['estado']);
            $obj_eventos->setPrioridad($_GET['prioridad']);
            if($_GET['estado']==1){
                $obj_eventos->setEstado("0");
            }   else    {
                $obj_eventos->setEstado("1");
            }
            $obj_eventos->guardar_tipo_evento();
            header ("location:/ORIEL/index.php?ctl=tipo_eventos_listar");
            //$this->tipo_eventos_listar();
        } else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
       
    public function puntos_bcr_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_puntosbcr=new cls_puntosBCR();
            $obj_puntosbcr->obtiene_todos_los_puntos_bcr();
            $params= $obj_puntosbcr->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    //////////////////////////
    /*Metodos relacionados del area de Empresas de Seguridad del Sistema*/
    //////////////////////////

  // Metodo que permite actualizar en tiempo real la lista de estado de evento de bitacora dependiendo
    // de la prioridad del tipo de evento y rol de usuario que esté manipulando la información
    public function actualiza_en_vivo_estado_evento(){
        
        if(isset($_SESSION['nombre'])){
        
             $obj_even = new cls_eventos();
        
             $id_tipo_evento= $_POST['id_tipo_evento'];
             
             $obj_even->setTipo_evento($id_tipo_evento);
             $prioridad_tipo_evento= $obj_even->obtiene_prioridad_de_tipo_de_evento();
             
             $obj_even->obtener_seguimientos();
             $estadoEven = $obj_even->getArreglo(); 
      
             $tam = count($estadoEven);

             for($i=0; $i<$tam;$i++){
                //if($estadoEventos[$i]['Estado_Evento']==$params[0]['Estado_Evento']){
                if ($estadoEven[$i]['Estado_Evento']!="Abierto por Error"){
                    if ($_SESSION['rol']==2){
                      if ($prioridad_tipo_evento!=1){ 
                          if ($estadoEven[$i]['Estado_Evento']!="Cerrado"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }
                      }else{
                          if ($estadoEven[$i]['Estado_Evento']!="Solicitar Cierre"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }                       
                      }
                    }else{
                        if ($estadoEven[$i]['Estado_Evento']!="Solicitar Cierre"){
                            $html .= '<option value="'.$estadoEven[$i]['ID_EstadoEvento'].'">'.$estadoEven[$i]['Estado_Evento'].'</option>';
                          }     
                    }
                 }      
             }
             echo $html;
             
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
       
    }
    
    public function empresas_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_empresas=new cls_empresa();
            $obj_empresas->obtiene_todas_las_empresas();
            $params= $obj_empresas->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_empresas_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function empresa_gestion(){
        if(isset($_SESSION['nombre'])){
            if ($_GET['id']==0){
                $observaciones="";
                $estado=1;
                $ide=$_GET['id'];
                $empresa="";
            }   else   {
                $ide=$_GET['id'];
                $observaciones=$_GET['observaciones'];
                $estado=$_GET['estado'];
                $empresa=$_GET['empresa'];
            }
            require __DIR__ . '/../vistas/plantillas/frm_empresas_editar.php';
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function empresa_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_empresas = new cls_empresa();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_empresas->setId($_GET['id']);
                $obj_empresas->setEmpresa($_POST['empresa']);
                $obj_empresas->setObservaciones($_POST['observaciones']);
                $obj_empresas->setEstado($_POST['estado']);
                $obj_empresas->guardar_empresa();
                header ("location:/ORIEL/index.php?ctl=empresas_listar");
                //$this->empresas_listar();
            }
            
        } else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }      
    }
    
    public function empresa_cambiar_estado() {
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_empresas = new cls_empresa();
                    $obj_empresas->setId($_GET['id']);
                    $obj_empresas->setEmpresa($_GET['empresa']);
                    $obj_empresas->setObservaciones($_GET['observaciones']);
                    if($_GET['estado']==1){
                        $obj_empresas->setEstado("0");
                    }
                    else {
                        $obj_empresas->setEstado("1");
                    }
                    $obj_empresas->guardar_empresa();
                    header ("location:/ORIEL/index.php?ctl=empresas_listar");
                    //$this->empresas_listar();
                }
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Editar Punto BCR, información completa 
    ////////////////////////////////////////////////////////////////////////////
    public function gestion_punto_bcr(){
        if(isset($_SESSION['nombre'])){
            $obj_Puntobcr = new cls_puntosBCR();
            $obj_Personal = new cls_personal();
            $obj_areasapoyo = new cls_areasapoyo();
            $obj_empresa = new cls_empresa();
            $obj_horario = new cls_horario();
            $obj_direccionIP = new cls_direccionIP();
            $obj_telefono = new cls_telefono();
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_enlace_telecom = new cls_enlace_telecom();
            $obj_medio_enlace = new cls_medio_enlace();
            $obj_proveedor_enlace = new cls_proveedor_enlace();
            $obj_tipo_enlace = new cls_tipo_enlace();
            
            if ($_GET['id']==0){
                
                $ide=0;
                $params[0]['Codigo']="";
                $params[0]['Cuenta_SIS']="BCR-";
                $params[0]['Nombre']="";
                $params[0]['Direccion']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']=1;
                
                //Obtiene todos los tipos de puntos BCR para listarlos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_los_tipo_puntos();
                $tipo_puntos = $obj_Puntobcr->getArreglo();
                
                //Obtiene Distrito->Cantón->Provincia
                    //Distritos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_distritos();
                $distritos = $obj_Puntobcr->getArreglo();
                    //Cantones
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_cantones();
                $cantones = $obj_Puntobcr->getArreglo();
                    //Provincias
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_provincias();
                $provincias = $obj_Puntobcr->getArreglo();
                
                //Obtiene empresa remesera
                $obj_empresa->setCondicion("");
                $obj_empresa->obtiene_todas_las_empresas();
                $empresas= $obj_empresa->getArreglo();           
                
                require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_nuevo.php';
            }   else    {
                
                $ide=$_GET['id'];
                //Obtiene la informacion del PuntoBCR
                $ide=$_GET['id'];
                $obj_Puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR='".$_GET['id']."'");
                $obj_Puntobcr->obtiene_todos_los_puntos_bcr();
                $params= $obj_Puntobcr->getArreglo();
                
                //Obtiene todos los tipos de puntos BCR para listarlos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_los_tipo_puntos();
                $tipo_puntos = $obj_Puntobcr->getArreglo();
                
                //Obtiene los telefonos del PuntoBCR
                $obj_telefono->setCondicion("T_Telefono.ID='".$_GET['id']."'");
                $obj_telefono->obtiene_telefonos_puntoBCR();
                $telefonos= $obj_telefono->getArreglo();
                
                //Obtiene Unidades Ejecutoras asignadas al Punto BCR
                $obj_Puntobcr->setCondicion("T_UE_PuntoBCR.ID_PuntoBCR='".$_GET['id']."'");
                $obj_Puntobcr->obtiene_unidades_ejecutoras();
                $unidad_ejecutora= $obj_Puntobcr->getArreglo();
                
                //Obtiene Distrito->Cantón->Provincia
                    //Distritos
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_distritos();
                $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
                    //Cantones
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_cantones();
                $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
                    //Provincias
                $obj_Puntobcr->setCondicion("");
                $obj_Puntobcr->obtiene_provincias();
                $provincias = array_merge(array(['ID_Provincia'=>"0"]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
                
                //obtiene las areas de apoyo del sitio
                $obj_areasapoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_GET['id']."'");
                $obj_areasapoyo->obtiene_todos_las_areas_apoyo();
                $areas_apoyo =$obj_areasapoyo->getArreglo();
                
                //Obtiene la informacion del personal
                $obj_Personal->setCondicion("");
                $condicion="";                
                $tam=count($unidad_ejecutora);
                if($tam>0){
                    for ($i = 0; $i <$tam; $i++) {
                        $condicion=$condicion."T_UnidadEjecutora.Numero_UE='".$unidad_ejecutora[$i]['Numero_UE']."'";
                        if($tam>$i && $tam-1<>$i)
                        {
                            $condicion=$condicion." OR ";
                        }
                    }
                    $obj_Personal->setCondicion($condicion);
                    $obj_Personal->obtiene_todo_el_personal();
                    $personal = $obj_Personal->getArreglo();
                }
                else{
                    $personal=null;
                }
                
                //Obtiene empresa remesera
                $obj_empresa->setCondicion("");
                $obj_empresa->obtiene_todas_las_empresas();
                $empresas= $obj_empresa->getArreglo();
                
                //Obtiene todos los Horarios
                $obj_horario->setCondicion("");
                $obj_horario->obtiene_todos_los_horarios();
                $horarios= $obj_horario->getArreglo();
                
                //Obtiene horario de oficina
                $obj_horario->setCondicion("ID_Horario='".$params[0]['ID_Horario']."'");
                $obj_horario->obtiene_todos_los_horarios();
                $horariopunto= $obj_horario->getArreglo();
                
                //Obtiene Direcciones IP del sitio
                $obj_direccionIP->setCondicion("T_PuntoBCRDireccionIP.ID_PuntoBCR='".$_GET['id']."'");
                $obj_direccionIP->obtiene_direccionesIP();
                $direccionIP = $obj_direccionIP->getArreglo();
                
                //Obtiene los tipos de telefono
                $obj_telefono->setCondicion("");
                $obj_telefono->obtiene_tipo_telefonos();
                $tipo_telefono= $obj_telefono->getArreglo();
                
                //Obtiene Unidades Ejecutoras
                $obj_unidad_ejecutora->setCondicion("");
                $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
                $todas_ue = $obj_unidad_ejecutora->getArreglo();

                //Obtiene los tipos de area de apoyo
                $obj_areasapoyo->setCondicion("");
                $obj_areasapoyo->obtiene_tipo_area_apoyo();
                $tipos_areas_apoyo= $obj_areasapoyo->getArreglo();
                
                //Obtiene todas las areas de apoyo
                $obj_areasapoyo->setCondicion("");
                $obj_areasapoyo->obtiene_todos_las_areas_apoyo();
                $todas_areas_apoyo =$obj_areasapoyo->getArreglo();
                
                //Obtiene todas las direcciones IP
                $obj_direccionIP->setCondicion("");
                $obj_direccionIP->obtiene_direccionesIP();
                $todas_direccionIP=$obj_direccionIP->getArreglo();
                
                //Obtiene todos los tipos de Direcciones IP
                $obj_direccionIP->setCondicion("");
                $obj_direccionIP->obtiene_tipo_direcciones_ip();
                $tipos_direccion_ip= $obj_direccionIP->getArreglo();
                
                //Obtiene todos los gerente de zona del BCR
                $obj_Personal->setCondicion("");
                $obj_Personal->obtener_gerentes_zona_bcr();
                $gerente_zona_bcr= $obj_Personal->getArreglo();
                
                //Obtiene todos los supervisores
                $obj_Personal->setCondicion("");
                $obj_Personal->obtener_supervisor_zona();
                $supervisor_zona_externo = $obj_Personal->getArreglo();
                
                //Obtiene la información de telecom
                $obj_enlace_telecom->setCondicion("T_PuntoBCREnlace.ID_PuntoBCR='".$_GET['id']."'");
                $obj_enlace_telecom->obtener_todos_enlaces();
                $telecom = $obj_enlace_telecom->getArreglo();
                
                //Obtiene la información de medios de enlace
                $obj_medio_enlace->obtener_medio_enlaces();
                $medio_enlace = $obj_medio_enlace->getArreglo();
                
                //Obtiene la informacion de tipos de enlace
                $obj_tipo_enlace->obtener_tipo_enlaces();
                $tipo_enlace =  $obj_tipo_enlace->getArreglo();
                
                //Obtiene la informacion de proveedor de enlaces
                $obj_proveedor_enlace->obtener_proveedores();
                $proveedor_enlace= $obj_proveedor_enlace->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/frm_puntos_bcr_editar.php';
            }
            
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    // Metodo que permite actualizar en tiempo real la lista de cantones
    public function actualiza_en_vivo_canton(){
        if(isset($_SESSION['nombre'])){
            $obj_puntos_bcr = new cls_puntosBCR();
            $id_provincia= $_POST['id_provincia'];
            $obj_puntos_bcr->setCondicion("ID_Provincia=".$id_provincia);
            $obj_puntos_bcr->obtiene_cantones();
            $cantones=$obj_puntos_bcr->getArreglo(); 
            $tam = count($cantones);
            $html .= '<option value="0"></option>';   
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$cantones[$i]['ID_Canton'].'">'.$cantones[$i]['Nombre_Canton'].'</option>';            
            }        
            echo $html;
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function actualiza_en_vivo_distrito(){
        if(isset($_SESSION['nombre'])){
            $obj_puntos_bcr = new cls_puntosBCR();
            $id_canton= $_POST['id_canton'];
            $obj_puntos_bcr->setCondicion("ID_Canton=".$id_canton);
            $obj_puntos_bcr->obtiene_distritos();
            $distritos=$obj_puntos_bcr->getArreglo(); 
            $tam = count($distritos);
            
            //$html .= '<option value="0"></option>';
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$distritos[$i]['ID_Distrito'].'">'.$distritos[$i]['Nombre_Distrito'].'</option>';            
            }        
            echo $html;
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    // Metodo que permite actualizar en tiempo real la lista de puntos bcr
    public function actualiza_en_vivo_punto_bcr(){
        if(isset($_SESSION['nombre'])){
            
            $obj_ev =new cls_eventos();
            $id_tipo_punto_bcr= $_POST['id_tipo_punto_bcr'];
            $id_provincia= $_POST['id_provincia'];
            
            $obj_ev->setTipo_punto($id_tipo_punto_bcr);
            $obj_ev->setProvincia($id_provincia);
            
            $obj_ev->filtra_sitios_bcr_bitacora();
            $sitios=$obj_ev->getArreglo(); 
            $tam = count($sitios);
            
            for($i=0; $i<$tam;$i++){
                $html .= '<option value="'.$sitios[$i]['ID_PuntoBCR'].'">'.$sitios[$i]['Nombre'].'</option>';            
            }        
            echo $html;
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function punto_bcr_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_Puntobcr = new cls_puntosBCR();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                echo ($_GET['id']);
                $obj_Puntobcr->setId($_GET['id']);
                $obj_Puntobcr->setCodigo($_POST['Codigo']);
                $obj_Puntobcr->setCuentasis($_POST['Cuenta_SIS']);
                $obj_Puntobcr->setNombre($_POST['Nombre']);
                $obj_Puntobcr->setDireccion($_POST['Direccion']);
                $obj_Puntobcr->setObservaciones($_POST['Observaciones']);
                $obj_Puntobcr->setEstado($_POST['Estado']);
                $obj_Puntobcr->setTipo_punto($_POST['Tipo_Punto']);
                $obj_Puntobcr->setDistrito($_POST['Distrito']);
                $obj_Puntobcr->setEmpresa($_POST['Empresa']);
                $obj_Puntobcr->sethoraslaborales("1");

                $obj_Puntobcr->guardar_punto_bcr();

            }
            header ("location:/ORIEL/index.php?ctl=puntos_bcr_listar");
            //$this->puntos_bcr_listar();
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function puntobcr_desligar_telefono(){
        if(isset($_SESSION['nombre'])){
            $obj_telefono = new cls_telefono();
            $obj_telefono->setId($_POST['id_telefono']);
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            $obj_telefono->eliminar_telefono();

        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function puntobcr_desligar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->setId($_POST['id_unidad_ejecutora']);
            $obj_unidad_ejecutora->setId2($_POST['id_puntobcr']);
            $obj_unidad_ejecutora->eliminar_relacion_puntobcr_ue();

        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_agregar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->setId($_POST['id_unidad_ejecutora']);
            $obj_unidad_ejecutora->setId2($_POST['id_puntobcr']);
            $obj_unidad_ejecutora->agregar_puntobcr_ue();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function puntoBCR_guardar_informacion_general(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            
            $obj_puntobcr->setCodigo($_POST['codigo']);
            $obj_puntobcr->setCuentasis($_POST['cuenta']);
            $obj_puntobcr->setNombre($_POST['nombre']);
            $obj_puntobcr->setId($_POST['tipo_punto']);
            $obj_puntobcr->actualizar_informacion_general_puntobcr();
            //echo 'Se actualizó la ubicacion del PuntoBCR';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function distrito_PuntoBCR_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            $obj_puntobcr->setId($_POST['id_distrito']);
            $obj_puntobcr->setDireccion($_POST['direccion']);
            $obj_puntobcr->actualizar_ubicacion_puntobcr();
            //echo 'Se actualizó la informacion general del PuntoBCR';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_numero_telefono_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_telefono = new cls_telefono();
                $obj_telefono->setId($_POST['ID_Tipo_Telefono']);
                $obj_telefono->setId2($_POST['ID_PuntoBCR']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setObservaciones($_POST['observaciones']);
                $obj_telefono->guardar_telefono();
                header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
            }
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_asignar_area_apoyo(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($_POST['id_area_apoyo']);
            $obj_area_apoyo->setId2($_POST['id_puntobcr']);
            $obj_area_apoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_PuntoBCRAreaApoyo.ID_Area_Apoyo='".$_POST['id_area_apoyo']."'");
            $obj_area_apoyo->obtiene_todos_las_areas_apoyo();
            $areas_apoyo =$obj_area_apoyo->getArreglo();
            if($areas_apoyo==""){
                $obj_area_apoyo->agregar_PuntoBCR_AreaApoyo();
            }   else    {
                echo "El Area de Apoyo ya se encuentra asignada al PuntoBCR";
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    public function puntobcr_desligar_area_apoyo(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($_POST['id_area_apoyo']);
            $obj_area_apoyo->setId2($_POST['id_puntobcr']);
            $obj_area_apoyo->setCondicion("");
            $obj_area_apoyo->eliminar_puntobcr_area_apoyo();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_desligar_direccion_ip(){
        if(isset($_SESSION['nombre'])){
            $obj_direccion = new cls_direccionIP();
            $obj_direccion->setId($_POST['id_direccion_ip']);
            $obj_direccion->setId2($_POST['id_puntobcr']);
            $obj_direccion->setCondicion("");
            $obj_direccion->eliminar_puntobcr_direccion_ip();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_asignar_direccion_ip(){
        if(isset($_SESSION['nombre'])){
            $obj_direccion = new cls_direccionIP();
            $obj_direccion->setId($_POST['id_direccion_ip']);
            $obj_direccion->setId2($_POST['id_puntobcr']);
            $obj_direccion->setCondicion("T_puntoBCRDireccionIP.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_puntoBCRDireccionIP.ID_Direccion_IP='".$_POST['id_direccion_ip']."'");
            
            $obj_direccion->obtiene_direccionesIP();
            $direcciones_ip =$obj_direccion->getArreglo();
            if($direcciones_ip==""){
                $obj_direccion->agregar_PuntoBCR_direccionIP();
            }   else    {
                echo "La dirección IP ya se encuentra asignada al PuntoBCR";
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function direccionIP_agregar(){
        if(isset($_SESSION['nombre'])){
            //echo "<script>alert('test msgbox')</script>";
            $obj_direccion_ip = new cls_direccionIP();
            //Crea nueva area de apoyo
            $obj_direccion_ip->setId($_POST['ID_Direccion_IP']);
            $obj_direccion_ip->setTipo_IP($_POST['tipo_ip']);
            $obj_direccion_ip->setDireccionIP($_POST['direccion_ip']);
            $obj_direccion_ip->setObservaciones($_POST['observaciones_ip']);
            $obj_direccion_ip->setCondicion("");
            $obj_direccion_ip->agregar_direccion_ip();
            
            $nueva_ip= $obj_direccion_ip->getArreglo();
            
            //Asigna el area de apoyo al puntoBCR
            $obj_direccion_ip->setId($nueva_ip[0]['ID_Direccion_IP']);
            $obj_direccion_ip->setId2($_POST['ID_PuntoBCR']);
            $obj_direccion_ip->setCondicion("T_puntoBCRDireccionIP.ID_PuntoBCR='".$_POST['ID_PuntoBCR']."' AND T_puntoBCRDireccionIP.ID_Direccion_IP='".$nueva_ip[0]['ID_Direccion_IP']."'");
            
            $obj_direccion_ip->obtiene_direccionesIP();
            $direcciones_ip =$obj_direccion_ip->getArreglo();
            if($direcciones_ip==""){
                $obj_direccion_ip->agregar_PuntoBCR_direccionIP();
            }   else    {
                echo "La dirección IP ya se encuentra asignada al PuntoBCR";
            }
            
            header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function PuntoBCR_actualiza_informacion_adicional(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr = new cls_puntosBCR();
            $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            
            $obj_puntobcr->setEmpresa($_POST['id_empresa']);
            $obj_puntobcr->setObservaciones($_POST['observaciones']);
            $obj_puntobcr->setGerente($_POST['id_gerente']);
            $obj_puntobcr->setSupervisor($_POST['id_supervisor']);
            $obj_puntobcr->actualizar_informacion_adicional_puntobcr();
            //echo 'Se actualizó la ubicacion del PuntoBCR';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function punto_bcr_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_puntobcr = new cls_puntosBCR();
                    
                    if($_GET['estado']==1){
                        $obj_puntobcr->setEstado("0");
                    }
                    else {
                        $obj_puntobcr->setEstado("1");
                    }
                    $obj_puntobcr->setCondicion("ID_PuntoBCR='".$_GET['id']."'");
                    $obj_puntobcr->actualizar_estado_puntobcr();
                    header ("location:/ORIEL/index.php?ctl=puntos_bcr_listar");
                }
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_asignar_horario() {
        if(isset($_SESSION['nombre'])){
            $obj_horario = new cls_horario();
            $obj_horario->setId($_POST['id_horario']);
            $obj_horario->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            $obj_horario->asignar_horario_puntobcr();  
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_eliminar_horario() {
        if(isset($_SESSION['nombre'])){
            $obj_horario = new cls_horario();
            $obj_horario->setCondicion("ID_PuntoBCR='".$_POST['id_puntobcr']."'");
            $obj_horario->eliminar_horario_puntobcr(); 
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function enlace_puntobcr_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_enlace = new cls_enlace_telecom();  
            //Obtiene la información enviada por el formulario por POST
            $obj_enlace->setEnlace($_POST['enlace']);
            $obj_enlace->setInterface($_POST['interface']);
            $obj_enlace->setLinea($_POST['linea']);
            $obj_enlace->setBandwidth($_POST['bandwidth']);
            $obj_enlace->setMedio_enlace($_POST['medio_enlace']);
            $obj_enlace->setProveedor($_POST['proveedor_enlace']);
            $obj_enlace->setTipo_enlace($_POST['tipo_enlace']);
            $obj_enlace->setObservaciones($_POST['observaciones_enlace']);
            //Valida si es un enlace nuevo o actualizacion y genera la condicion
            if($_POST['ID_Enlace']=="0"){
                $obj_enlace->setCondicion("");
            }   else    {
                $obj_enlace->setCondicion("ID_Enlace='".$_POST['ID_Enlace']."'");
            }
            //Guarda la informacion del enlace
            $obj_enlace->guardar_enlaces_telecomunicaciones();
            //Obtiene el registro del ultimo enlace guardado
            $ultimo= $obj_enlace->getArreglo();
            $ultimo= $ultimo[0]['ID_Enlace'];
            //Guarda relacion entre enlace y punto
            $obj_enlace->setId($ultimo);
            $obj_enlace->setId2($_POST['ID_PuntoBCR']);
            $obj_enlace->guardar_puntobcr_enlace();
            
            header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function puntobcr_eliminar_enlace(){
        if(isset($_SESSION['nombre'])){
            $obj_enlace = new cls_enlace_telecom();
            //Elimina la relacion entre PuntoBCR y el enlace
            $obj_enlace->setCondicion("ID_PuntoBCR=".$_POST['id_puntobcr']." and ID_Enlace=".$_POST['id_enlace']);
            $obj_enlace->eliminar_enlace_entre_puntobcr_telecom();
            //Elimina el enlace de la base de datos
            $obj_enlace->setCondicion("ID_Enlace=".$_POST['id_enlace']);
            $obj_enlace->eliminar_enlace_telecomunicaciones();
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////////////////MANTENIMIENTO DE PERSONAL//////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function personal_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal();
            $obj_personal->obtiene_todo_el_personal_modulo_personas();
            $personas= $obj_personal->getArreglo();
            require __DIR__ . '/../vistas/plantillas/frm_personal_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
            if (isset($_GET['id'])) {
                if (isset($_GET['estado'])) { 
                    $obj_personal = new cls_personal();
                    
                    if($_GET['estado']==1){
                        $obj_personal->setEstado("0");
                    }
                    else {
                        $obj_personal->setEstado("1");
                    }
                    $obj_personal->setCondicion("ID_Persona='".$_GET['id']."'");
                    $obj_personal->actualizar_estado_persona();
                    header ("location:/ORIEL/index.php?ctl=personal_listar");
                }
            }
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_gestion(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal();
            $obj_empresa = new cls_empresa();
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_telefono = new cls_telefono();
            
            
            $ide=$_GET['id'];
            $obj_personal->setCondicion("T_Personal.ID_Persona='".$_GET['id']."'");
            $obj_personal->obtiene_todo_el_personal_modulo_personas();
            $params= $obj_personal->getArreglo();
            
            //Obtiene empresa remesera
            $obj_empresa->setCondicion("");
            $obj_empresa->obtiene_todas_las_empresas();
            $empresas= $obj_empresa->getArreglo();
				
            //Obtiene Unidades Ejecutoras
            $obj_unidad_ejecutora->setCondicion("");
            $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
            $todas_ue = $obj_unidad_ejecutora->getArreglo();
            
            //Obtiene todos los Puestos
            $obj_personal->setCondicion("");
            $obj_personal->obtener_todos_puestos();
            $puestos= $obj_personal->getArreglo();
            
            //Obtiene los tipos de telefono
            $obj_telefono->setCondicion("");
            $obj_telefono->obtiene_tipo_telefonos();
            $tipo_telefono = $obj_telefono->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/frm_personal_detalle.php';
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_eliminar_telefono(){
       if(isset($_SESSION['nombre'])){
            $obj_telefono = new cls_telefono();
            $obj_telefono->setId($_POST['id_telefono']);
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            $obj_telefono->eliminar_telefono();

        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function personal_numero_telefono_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_telefono = new cls_telefono();
                //echo '<script>alert("Ingresa");</script>';
                $obj_telefono->setId($_POST['ID_Telefono']);
                $obj_telefono->setId2($_POST['ID_Persona']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setObservaciones($_POST['observaciones']);
                if($_POST['ID_Telefono']==0){
                    //echo '<script>alert("Nuevo Numero");</script>';
                    $obj_telefono->guardar_telefono();
                }
                else{
                    //echo '<script>alert("Actualiza Numero");</script>';
                    $obj_telefono->setCondicion("ID_Telefono='".$_POST['ID_Telefono']."'");
                    $obj_telefono->actualizar_telefono();
                }
                header("location:/ORIEL/index.php?ctl=personal_gestion&id=".$_POST['ID_Persona']);
            }
        }   else    {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_cambiar_ue(){
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setId2($_POST['id_unidad_ejecutora']);
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->cambiar_ue_persona();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_cambiar_puesto() {
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setId2($_POST['id_puesto']);
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->cambiar_puesto_persona();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function persona_guardar_informacion_general(){
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            
            $obj_persona->setCedula($_POST['cedula']);
            $obj_persona->setApellidonombre($_POST['nombre']);
            $obj_persona->setEmpresa($_POST['empresa']);
            $obj_persona->setObservaciones($_POST['observaciones']);
            $obj_persona->setGafete($_POST['numero_gafete']);
            $obj_persona->setCorreo($_POST['correo']);
            $obj_persona->setDireccion($_POST['direccion']);
            
            $obj_persona->setCondicion("ID_Persona='".$_POST['id_persona']."'");
            $obj_persona->actualizar_informacion_general_persona();
            
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////Funciones para Areas de Apoyo//////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function areas_apoyo_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_areasApoyo=new cls_areasapoyo();
            $obj_areasApoyo->setCondicion("");
            $obj_areasApoyo->obtiene_todos_las_areas_apoyo();
            $params= $obj_areasApoyo->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/frm_areas_apoyo_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }    

    //Función para agregar area de apoyo nueva desde Formulario de Punto BCR
    public function Area_apoyo_agregar(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo= new cls_areasapoyo();
            $obj_telefono = new cls_telefono();
            //Obtiene la información enviada por el formulario POST
            $obj_area_apoyo->setId(null);
            $obj_area_apoyo->setTipo_area($_POST['Tipo_Area_Apoyo']);
            $obj_area_apoyo->setDistrito($_POST['distrito']);
            $obj_area_apoyo->setNombre_area($_POST['nombre']);
            $obj_area_apoyo->setDireccion($_POST['direccion']);
            $obj_area_apoyo->setObservaciones($_POST['observaciones']);
            //agrega el area de apoyo nueva
            $obj_area_apoyo->setCondicion("");
            $obj_area_apoyo->agregar_area_apoyo();
            //Luego de agregar el area de apoyo devuelve el ID del area agregada
            $area_apoyo = $obj_area_apoyo->getArreglo();
            //Valida que el arreglo tenga información
            if($area_apoyo==""){
                echo 'Error al traer area de apoyo nueva';
            }   else    {
                //Crea el número del area de apoyo nueva
                $obj_telefono->setId(null);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setId2($area_apoyo[0]['ID_Area_Apoyo']); 
                $obj_telefono->setObservaciones("");
                $obj_telefono->guardar_telefono();
            }
            //Asigna el area de apoyo al puntoBCR
            $obj_area_apoyo = new cls_areasapoyo();
            $obj_area_apoyo->setId($area_apoyo[0]['ID_Area_Apoyo']);
            $obj_area_apoyo->setId2($_POST['ID_PuntoBCR']);
            $obj_area_apoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_PuntoBCRAreaApoyo.ID_Area_Apoyo='".$_POST['id_area_apoyo']."'");
            $obj_area_apoyo->obtiene_todos_las_areas_apoyo();
            $areas_apoyo =$obj_area_apoyo->getArreglo();
            if($areas_apoyo==""){
                $obj_area_apoyo->agregar_PuntoBCR_AreaApoyo();
            }   else    {
                echo "El Area de Apoyo ya se encuentra asignada al PuntoBCR";
            }
            
            header("location:/ORIEL/index.php?ctl=gestion_punto_bcr&id=".$_POST['ID_PuntoBCR']);
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Carga información de area seleccionda o formulario en blanco para crear una nueva
    public function area_apoyo_gestion(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo= new cls_areasapoyo();
            $obj_telefono = new cls_telefono();
            $obj_Puntobcr = new cls_puntosBCR();
            
            //Obtiene los tipos de teléfonos
            $obj_area_apoyo->obtiene_tipo_area_apoyo();
            $tipo_area = $obj_area_apoyo->getArreglo();
            
            //Obtiene los tipos de telefono
            $obj_telefono->setCondicion("");
            $obj_telefono->obtiene_tipo_telefonos();
            $tipo_telefono = $obj_telefono->getArreglo();
            
            //Obtiene Distrito->Cantón->Provincia
            //Distritos
            $obj_Puntobcr->setCondicion("");
            $obj_Puntobcr->obtiene_distritos();
            $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
            //Cantones
            $obj_Puntobcr->setCondicion("");
            $obj_Puntobcr->obtiene_cantones();
            $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
            //Provincias
            $obj_Puntobcr->setCondicion("");
            $obj_Puntobcr->obtiene_provincias();
            $provincias = array_merge(array(['ID_Provincia'=>0]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
            
            if($_GET['id']==0){
                $params[0]['ID_Area_Apoyo']=0;
                $params[0]['Nombre_Area']="";
                $params[0]['Direccion']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']=1;
            } else {
                $obj_area_apoyo->setId($_GET['id']);
                $obj_area_apoyo->setCondicion("T_AreasApoyo.ID_Area_Apoyo='".$_GET['id']."'");
                
                $obj_area_apoyo->obtiene_todos_las_areas_apoyo();
                $params = $obj_area_apoyo->getArreglo();
            }
            require __DIR__ . '/../vistas/plantillas/frm_areas_apoyo_gestion.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function area_apoyo_eliminar_telefono(){
        if(isset($_SESSION['nombre'])){
            $obj_telefono = new cls_telefono();
            $obj_telefono->setId($_POST['id_telefono']);
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            $obj_telefono->eliminar_telefono();

        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function area_apoyo_numero_telefono_guardar(){
        if(isset($_SESSION['nombre'])){   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $obj_telefono = new cls_telefono();
                $obj_telefono->setId($_POST['ID_Telefono']);
                $obj_telefono->setId2($_POST['ID_Area_Apoyo']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setObservaciones($_POST['observaciones_tel']);
                if($_POST['ID_Telefono']==0){
                    $obj_telefono->guardar_telefono();
                }
                else{
                    $obj_telefono->setCondicion("ID_Telefono='".$_POST['ID_Telefono']."'");
                    $obj_telefono->actualizar_telefono();
                }
                header("location:/ORIEL/index.php?ctl=area_apoyo_gestion&id=".$_POST['ID_Area_Apoyo']);
            }
        }   else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function Area_apoyo_nueva(){
        if(isset($_SESSION['nombre'])){
            $obj_area_apoyo= new cls_areasapoyo();
            $obj_telefono = new cls_telefono();
            //Obtiene la información enviada por el formulario POST
            $obj_area_apoyo->setId(null);
            $obj_area_apoyo->setTipo_area($_POST['tipo_area']);
            $obj_area_apoyo->setDistrito($_POST['Distrito']);
            $obj_area_apoyo->setNombre_area($_POST['Nombre']);
            $obj_area_apoyo->setDireccion($_POST['direccion']);
            $obj_area_apoyo->setObservaciones($_POST['observaciones']);
            //agrega el area de apoyo nueva
            $obj_area_apoyo->setCondicion("");
            $obj_area_apoyo->agregar_area_apoyo();
            //Luego de agregar el area de apoyo devuelve el ID del area agregada
            $area_apoyo = $obj_area_apoyo->getArreglo();
            //Valida que el arreglo tenga información
            if($area_apoyo==""){
                echo 'Error al traer area de apoyo nueva';
            }   else    {
                //Crea el número del area de apoyo nueva
                $obj_telefono->setId(null);
                $obj_telefono->setNumero($_POST['numero']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setId2($area_apoyo[0]['ID_Area_Apoyo']); 
                $obj_telefono->setObservaciones("");
                $obj_telefono->guardar_telefono();
            }
            
            header("location:/ORIEL/index.php?ctl=areas_apoyo_listar");
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////Funciones para Direeciones IP's////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function direcciones_ip_listar(){
       if(isset($_SESSION['nombre'])){
            $obj_direcciones=new cls_direccionIP();
            $obj_direcciones->setCondicion("");
            $obj_direcciones->obtiene_direccionesIP();
            $params= $obj_direcciones->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/frm_direcciones_ip_listar.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////Funciones para Horarios ///////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function horario_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_horario = new cls_horario();
            
            $obj_horario->obtiene_todos_los_horarios();
            
            $horarios= $obj_horario->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/frm_horario_lista.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function horario_gestion(){
        if(isset($_SESSION['nombre'])){
            $obj_horario = new cls_horario();
            if($_GET['ide']==0){
                $params[0]['ID_Horario']="0";
                $params[0]['Dia_Laboral']="";
                $params[0]['Hora_Laboral']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']="1";
            }  else  {
                $obj_horario->setCondicion("ID_Horario='".$_GET['ide']."'");
                $obj_horario->obtiene_todos_los_horarios();
                $params= $obj_horario->getArreglo();
            }
            require __DIR__ . '/../vistas/plantillas/frm_horario_gestion.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function horario_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_horario = new cls_horario();
            $obj_horario->setId($_GET['id']); 
            //Valida informacion enviada por el formulario
            //cuando la hora es 00:00 se agregará null
            
            //Valida Hora de entrada domingo
            if($_POST['entrada_domingo']=="00:00:00" || $_POST['entrada_domingo']=="00:00"){
                $obj_horario->setHora_apertura_domingo(null);
            }else {
                $obj_horario->setHora_apertura_domingo($_POST['entrada_domingo']);
            }
            //valida hora de cierre domingo
            if($_POST['salida_domingo']=="00:00:00"|| $_POST['salida_domingo']=="00:00"){
                $obj_horario->setHora_cierre_domingo(null);
            }else {
                $obj_horario->setHora_cierre_domingo($_POST['salida_domingo']);
            }
            //valida hora de entrada lunes
            if($_POST['entrada_lunes']=="00:00:00"|| $_POST['entrada_lunes']=="00:00"){
                $obj_horario->setHora_apertura_lunes(null);
            }else {
                $obj_horario->setHora_apertura_lunes($_POST['entrada_lunes']);
            }
            //valida hora de cierre lunes
            if($_POST['salida_lunes']=="00:00:00"|| $_POST['salida_lunes']=="00:00"){
                $obj_horario->setHora_cierre_lunes(null);
            }else {
                $obj_horario->setHora_cierre_lunes($_POST['salida_lunes']);
            }
            //valida hora de entrada de martes
            if($_POST['entrada_martes']=="00:00:00"|| $_POST['entrada_martes']=="00:00"){
                $obj_horario->setHora_apertura_martes(null);
            }else {
                $obj_horario->setHora_apertura_martes($_POST['entrada_martes']);
            }
            //Valida hora de cierre de martes
            if($_POST['salida_martes']=="00:00:00"|| $_POST['salida_martes']=="00:00"){
                $obj_horario->setHora_cierre_martes(null);
            }else {
                $obj_horario->setHora_cierre_martes($_POST['salida_martes']);
            }
            //valida hora de entrada de miercoles
            if($_POST['entrada_miercoles']=="00:00:00"|| $_POST['entrada_miercoles']=="00:00"){
                $obj_horario->setHora_apertura_miercoles(null);
            }else {
                $obj_horario->setHora_apertura_miercoles($_POST['entrada_miercoles']);
            }
            //Valida hora de cierre de miercoles
            if($_POST['salida_miercoles']=="00:00:00"|| $_POST['salida_miercoles']=="00:00"){
                $obj_horario->setHora_cierre_miercoles(null);
            }else {
                $obj_horario->setHora_cierre_miercoles($_POST['salida_miercoles']);
            }
            //Valida hora de entrada de jueves
            if($_POST['entrada_jueves']=="00:00:00"|| $_POST['entrada_jueves']=="00:00"){
                $obj_horario->setHora_apertura_jueves(null);
            }else {
                $obj_horario->setHora_apertura_jueves($_POST['entrada_jueves']);
            }
            //Valida hora de cierre de jueves
            if($_POST['salida_jueves']=="00:00:00"|| $_POST['salida_jueves']=="00:00"){
                $obj_horario->setHora_cierre_jueves(null);
            }else {
                $obj_horario->setHora_cierre_jueves($_POST['salida_jueves']);
            }
            //Valida hora de entrada de viernes
            if($_POST['entrada_viernes']=="00:00:00"|| $_POST['entrada_viernes']=="00:00"){
                $obj_horario->setHora_apertura_viernes(null);
            }else {
                $obj_horario->setHora_apertura_viernes($_POST['entrada_viernes']);
            }
            //Valida hora cierre de viernes
            if($_POST['salida_viernes']=="00:00:00"|| $_POST['salida_viernes']=="00:00"){
                $obj_horario->setHora_cierre_viernes(null);
            }else {
                $obj_horario->setHora_cierre_viernes($_POST['salida_viernes']);
            }
            //Valida hora de entrada de sabado
            if($_POST['entrada_sabado']=="00:00:00"|| $_POST['entrada_sabado']=="00:00"){
                $obj_horario->setHora_apertura_sabado(null);
            }else {
                $obj_horario->setHora_apertura_sabado($_POST['entrada_sabado']);
            }
            //valida de cierre de sabado
            if($_POST['salida_sabado']=="00:00:00"|| $_POST['salida_sabado']=="00:00"){
                $obj_horario->setHora_cierre_sabado(null);
            }else {
                $obj_horario->setHora_cierre_sabado($_POST['salida_sabado']);
            }
            $obj_horario->setObservaciones($_POST['observaciones']);
            $obj_horario->setEstado($_POST['estado']);
            
            //valida si es Horario nuevo o actualizacion
            if($_GET['id']==0){
                $obj_horario->agregar_horario();
            } else {
                //echo "edita";
                $obj_horario->setCondicion("ID_Horario='".$_GET['id']."'");
                $obj_horario->actualizar_horario();
            }
            
            header("location:/ORIEL/index.php?ctl=horario_listar");
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //////////Funciones para proveedores de enlaces BCR/////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function proveedor_listar(){
       if(isset($_SESSION['nombre'])){
           $obj_proveedor = new cls_proveedor_enlace();
           $obj_proveedor->obtener_proveedores();
           $params = $obj_proveedor->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_proveedor_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    //Funcion permite actualizar o crear un proveedor de enlaces
    public function proveedor_enlace_guardar() {
        if(isset($_SESSION['nombre'])){
           $obj_proveedor = new cls_proveedor_enlace();
           //Obtiene informacion enviada por el formulario
           $obj_proveedor->setNombre($_POST['nombre']);
           $obj_proveedor->setObservaciones($_POST['observaciones']);
           //Valida si el un nuevo proveedor o actualizar uno existente
           if($_POST['ID_Proveedor']==0){
               $obj_proveedor->setEstado("1");
               $obj_proveedor->setCondicion("");
           } else{
               $obj_proveedor->setCondicion("ID_Proveedor='".$_POST['ID_Proveedor']."'");
           }
           //agrega o actualiza el proveedor de enlaces
           $obj_proveedor->agregar_proveedor();
           //Carga nuevamente la ventana de proveedores
           $obj_proveedor->setCondicion("");
           $obj_proveedor->obtener_proveedores();
           $params = $obj_proveedor->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_proveedor_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function proveedor_enlace_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
           $obj_proveedor = new cls_proveedor_enlace();
           //Invierte el estado enviado por el formulario
           if($_GET['estado']==0){
               $obj_proveedor->setEstado("1");
           }else {
               $obj_proveedor->setEstado("0");
           }
           //agrega la condicion y actualiza el estado en BD
           $obj_proveedor->setCondicion("ID_Proveedor='".$_GET['ide']."'");
           $obj_proveedor->cambiar_estado_proveedor();
           //Carga nuevamente la lista de proveedores
           $obj_proveedor->setCondicion("");
           $obj_proveedor->obtener_proveedores();
           $params = $obj_proveedor->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_proveedor_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////Funciones para Tipos de enlaces BCR////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function tipo_enlace_listar() {
        if(isset($_SESSION['nombre'])){
           $obj_tipo_enlace = new cls_tipo_enlace();
           $obj_tipo_enlace->obtener_tipo_enlaces();
           $params = $obj_tipo_enlace->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_tipo_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function tipo_enlace_guardar() {
        if(isset($_SESSION['nombre'])){
           $obj_tipo_enlace = new cls_tipo_enlace();
           //Obtiene informacion enviada por el formulario (frm_tipo_enlace_catalogo)
           $obj_tipo_enlace->setNombre($_POST['nombre']);
           $obj_tipo_enlace->setObservaciones($_POST['observaciones']);
           //Valida si el un nuevo tipo de enlace o actualizar uno existente
           if($_POST['ID_Tipo_Enlace']==0){
               $obj_tipo_enlace->setEstado("1");
               $obj_tipo_enlace->setCondicion("");
           } else{
               $obj_tipo_enlace->setCondicion("ID_Tipo_Enlace='".$_POST['ID_Tipo_Enlace']."'");
           }
           //agrega o actualiza el proveedor de enlaces
           $obj_tipo_enlace->guardar_tipo_enlaces();
           //Carga nuevamente la ventana de tipos de enlace
           $obj_tipo_enlace->setCondicion("");
           $obj_tipo_enlace->obtener_tipo_enlaces();
           $params = $obj_tipo_enlace->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_tipo_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function tipo_enlace_cambiar_estado(){
        if(isset($_SESSION['nombre'])){
           $obj_tipo_enlace = new cls_tipo_enlace();
           //Invierte el estado que envia el formulario
           if($_GET['estado']==0){
               $obj_tipo_enlace->setEstado("1");
           }else {
               $obj_tipo_enlace->setEstado("0");
           }
           $obj_tipo_enlace->setCondicion("ID_Tipo_Enlace='".$_GET['ide']."'");
           $obj_tipo_enlace->cambiar_estado_tipo_enlace();
           //Carga nuevamente la ventana con la información modificada
           $obj_tipo_enlace->setCondicion("");
           $obj_tipo_enlace->obtener_tipo_enlaces();
           $params = $obj_tipo_enlace->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_tipo_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //////////Funciones para Medio de enlaces BCR/////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function medio_enlace_listar(){
       if(isset($_SESSION['nombre'])){
           $obj_medio = new cls_medio_enlace();
           $obj_medio->obtener_medio_enlaces();
           $params = $obj_medio->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_medio_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function medio_enlace_guardar(){
       if(isset($_SESSION['nombre'])){
           $obj_medio = new cls_medio_enlace();
           //Obtiene informacion enviada por el formulario
           $obj_medio->setNombre($_POST['nombre']);
           $obj_medio->setObservaciones($_POST['observaciones']);
           //Valida si el un nuevo medio de enlace o actualizar uno existente
           if($_POST['ID_Medio_Enlace']==0){
               $obj_medio->setEstado("1");
               $obj_medio->setCondicion("");
           } else{
               $obj_medio->setCondicion("ID_Medio_Enlace='".$_POST['ID_Medio_Enlace']."'");
           }
           //agrega o actualiza el proveedor de enlaces
           $obj_medio->guardar_medio_enlaces();
           //Carga nuevamente la ventana de tipos de enlace
           $obj_medio->setCondicion("");
           $obj_medio->obtener_medio_enlaces();
           $params = $obj_medio->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_medio_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function medio_enlace_cambiar_estado(){
       if(isset($_SESSION['nombre'])){
           $obj_medio = new cls_medio_enlace();
           //Invierte el estado que envia el formulario
           if($_GET['estado']==0){
               $obj_medio->setEstado("1");
           }else {
               $obj_medio->setEstado("0");
           }
           $obj_medio->setCondicion("ID_Medio_Enlace='".$_GET['ide']."'");
           $obj_medio->cambiar_estado_medio_enlace();
           //Carga nuevamente la ventana con la información modificada
           $obj_medio->setCondicion("");
           $obj_medio->obtener_medio_enlaces();
           $params = $obj_medio->getArreglo();
           require __DIR__ . '/../vistas/plantillas/frm_medio_enlace_catalogo.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //////////Funciones para Enlace Telecomunicaciones//////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function enlace_reporte() {
        if(isset($_SESSION['nombre'])){
            $obj_enlace = new cls_enlace_telecom();
            $obj_ip = new cls_direccionIP();
            
            $obj_enlace->enlaces_reporte();
            $telecom = $obj_enlace->getArreglo();
            
            $tam = count($telecom);
            
            for($i=0; $i<$tam;$i++){
                $obj_ip->setCondicion("(T_TipoIP.ID_Tipo_IP = '7' OR  T_TipoIP.ID_Tipo_IP = '8') AND t_puntobcrdireccionip.ID_PuntoBCR='".$telecom[$i]['ID_PuntoBCR']."'");
                $obj_ip->obtiene_direccionesIP();
                $direcciones = $obj_ip->getArreglo();
                //print_r($direcciones);
                $params[]= array_merge($telecom[$i],[($direcciones[0]['Tipo_IP'])=>($direcciones[0]['Direccion_IP'])],[($direcciones[1]['Tipo_IP'])=>($direcciones[1]['Direccion_IP'])]);
            }
//            echo("<pre>");
//            print_r($params);
//            echo("</pre>");
           require __DIR__ . '/../vistas/plantillas/rpt_enlace_telecom.php';
        }else{
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }   
    }
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////Trazabilidad//////////////////////////////////
    /////////////////////FUNCIONES PARA EVENTOS/////////////////////////////////
    public function frm_trazabilidad_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_traza = new cls_trazabilidad();
            $obj_traza->setCondicion("Fecha='".date("Y-m-d")."'");
            $obj_traza ->obtiene_trazabilidad(); 
            $params= $obj_traza->getArreglo();
            $obj_traza->setCondicion("");
            $obj_traza->obtiene_lista_usuarios_que_han_modificado_base_de_datos();
            $lista_de_usuarios=$obj_traza->getArreglo();
            $obj_traza->setCondicion("");
            $obj_traza->obtiene_lista_tablas_afectadas_en_el_sistema();
            $lista_tablas_afectadas=$obj_traza->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_trazabilidad_listar.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    /////////////////////Funciones para Unidades Ejecutoras/////////////////////
    ////////////////////////////////////////////////////////////////////////////
    
    public function unidad_ejecutora_listar(){
       if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
            $params = $obj_unidad_ejecutora->getArreglo();
            
            require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function unidad_ejecutora_guardar() {
        if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            $obj_unidad_ejecutora->setNumero_ue($_POST['numero']);
            $obj_unidad_ejecutora->setDepartamento($_POST['nombre']);
            $obj_unidad_ejecutora->setObservaciones($_POST['observaciones']);            
            
            if($_POST['ID_Unidad_Ejecutora']==0){
                $obj_unidad_ejecutora->setEstado(1);
                $obj_unidad_ejecutora->agregar_nueva_ue();
            }else{
                $obj_unidad_ejecutora->setEstado($_POST['estado']);
                $obj_unidad_ejecutora->setCondicion("ID_Unidad_Ejecutora='".$_POST['ID_Unidad_Ejecutora']."'");
                $obj_unidad_ejecutora->edita_ue();
            }
            $obj_unidad_ejecutora->setCondicion("");
            $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
            $params = $obj_unidad_ejecutora->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function unidad_ejecutora_cambiar_estado() {
         if(isset($_SESSION['nombre'])){
            $obj_unidad_ejecutora = new cls_unidad_ejecutora();
            //Valida el estado que envia por parametro y lo invierta para almacernarlo en BD
            if($_GET['estado']==1){
               $obj_unidad_ejecutora->setEstado("0");
            } else{
                $obj_unidad_ejecutora->setEstado("1");
            }
            //Condición para editar estado de unidad ejecutora
            $obj_unidad_ejecutora->setCondicion("ID_Unidad_Ejecutora='".$_GET['ide']."'");
            $obj_unidad_ejecutora->cambia_estado_ue();           
            
            //Carga nuevamente la lista de unidades ejecutoras
            $obj_unidad_ejecutora->setCondicion("");
            $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
            $params = $obj_unidad_ejecutora->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
            /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }    
    }
    
} 