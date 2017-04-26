 <?php

//Definición de la clase Controller. Componente principal de la lógica del negocio. 
 class Controller{
     
    //Declaración de métodos que envuelven toda la funcionalidad del sistema
    // A través del componente index se llaman cada uno de los eventos de la clase 
    // controller para que sean ejecutados según sea necesario.
     
    //Inicio del sitio web, llamada a la pantalla principal para inicio de sesión
    public function inicio(){
        //Variables que muestran tipos de advertencia en pantalla según sea necesario
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
    
    public function personal_externo_listar_publico(){
        //Creación del objeto personal
        $obj_externo = new cls_personal_externo();
        //Trae de la base de datos la lista de personas disponibles
        $obj_externo->obtiene_todo_personal_externo_filtrado();
        //Inicializa un vector con el total de registros de la base de datos
        $externo= $obj_externo->getArreglo();
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_personal_externo_listar_publico.php';
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //Metodos relacionados del area de Modulos de Seguridad del Sistema/////////
    ////////////////////////////////////////////////////////////////////////////

    // Metodo que llama al formulario correspondiente para validación de credenciales por parte del usuario
    public function iniciar_sesion(){
        //Variables que muestran tipos de adventencia en pantalla según sea necesario
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        //Llamada al formulario correspondiente de la vista   
        $this->ejecucion_automatico_proceso("Oficiales");        
        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
    }
    
    //Obtiene lista completa de roles del sistema
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

    //Metodo que realiza la llamada al formulario principal del sistema ORIEL
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
    
    //Paso del utilitario, pantalla de bienvendida, desde esta pantalla es posible 
    //seleccionar el archivo csv correspondiente con el listado total de personas
    //que pertenecen al conglomerado BCR. Este archivo es enviado de manera semanal
    //por parte de personal de capital humano.
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
    
    //Este metodo, el cual constituye el paso 2 de la importación del prontuario, permite
    //leer el contenido del archivo correspondiente (una vez sea validado) y pasarlo directamente a 
    //un vector como estructura propia de PHP. Una vez hecho esto será posible manipular la información
    //en los pasos siguientes del asistente.
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
    
    //Paso de importación del prontuario que permite actualizar la tabla de unidades ejecutoras en el sistema
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
        
    //Paso de importación del prontuario que permite actualizar la tabla de personas en el sistema
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
                $obj_personal->setLinkfoto("https://bcrcapitalhumano:2800/UCO/foto/".$arreglo_personal[$i][1].".jpg");
                
                //Establece la empresa, que en este caso 1 es para BCR
                $obj_personal->setId_empresa("1");

                //Observaciones lo establece vacio
                //$obj_personal->setObservaciones("");
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

    //Paso de importación del prontuario que permite actualizar la tabla de celulares en el sistema
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
    
    //Paso de importación del prontuario que permite actualizar la tabla de personas y telefonos de extensiones en el sistema
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
    
    //Paso de importación del prontuario que permite actualizar ls tabla de puestos y unidades ejecutoras
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
            
            //Obtiene el vector completo de inconsistencias generado por la consult a y lo anexa al vector actual.
            $vector_personas_con_numeros_en_cero[]=$obj_personal->getArreglo();
            
            //Agrega nombres a las columnas del vector de personas con numero en cero.
            $vector_personas_con_numeros_en_cero[][]=array("Apellido_Nombre" => "","Cedula" => "","ID_Persona" => "");
            
            //Obtiene el total de registros que trajo la consulta.
            $numero_personas_cero=count($obj_personal->getArreglo());
            //Agrega summary al vector de personas con numero en cero.
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
    
    // Ultimo paso de importación del prontuario que confirma que el proceso se realizó correctamente.
    public function frm_importar_prontuario_paso_11(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
           //Llamada al formulario correspondiente de la vista                    
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    //Prepara las variables y el formulario respectivo para cambio de clave
    public function cambiar_password(){   
        $usuario = "";       
        $clave = "";  
        //Variables que muestran un tipo de alerta específico en el formulario, dependiendo de la condición y solicitud del usuario
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
    }
 
    //Metodo que permite realizar el cambio de clave a un usuario registrado en el sistema.
    public function cambia_clave_usuario_post(){
        //Inicializa las variables de utilizacion en el metodo.
        $usuario = "";       
        $clave = "";  
        //Variables que muestran un tipo de alerta específico en el formulario, dependiendo de la condición y solicitud del usuario
        $tipo_de_alerta="alert alert-info";
        $validacion="En proceso de cambio de clave";

        //Crea un objeto de tipo usuarios del sistema, para el manejo en la tabla de la bd.
        $obj_usuarios= new cls_usuarios();       
        //Verifica el envío de información mediante el evento post del formulario.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //obtiene el usuario del formulario anterior.
            $usuario = $_POST['usu'];
            // obtiene el password anterior
            $clave= $_POST['password_antiguo'];
            //obtiene el nuevo password.
            $clave_nueva=$_POST['password_nuevo'];
            //Recibe la confirmación de la nueva clave.
            $confirmacion_clave=$_POST['confirmacion_password'];
            // Crea un objeto de tipo modulo de seguridad. 
            $obj_modulos = new cls_modulos();
            
            //verifica que la variable usuario traiga datos
            if (strlen($usuario)>0){
                //Valida que el usuario que requiere cambiar la clave, exista en la base de datos.
                if ($obj_usuarios->existe_usuario($usuario)){
                    //Verifica que el password sea correcto de acuerdo a la base de datos
                    if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                        //verifica si el usuario realizando el tramite está activo
                        if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                            //Verifica que las nuevas claves tengan informacion
                            if ((strlen($clave_nueva)>0) && (strlen($confirmacion_clave)>0)){
                                //Verifica que la nueva clave y la confirmación sean iguales.
                                if ($clave_nueva===$confirmacion_clave){
                                    //Verifica que la clave vieja sea diferente sea de la nueva.
                                    if ($clave_nueva!=$clave){
                                        //Define variables de sesión, por ejemplo: nombre, rol, name, apellido, id y modulos.
                                        $_SESSION['nombre']=$usuario;
                                        //Metodo que permite obtener el rol del usuario en cuestión.
                                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                                        //Variables de sesión que funcionan durante todo el recorrido del usuario en el sitio web.
                                        $_SESSION['rol']=$obj_usuarios->getRol();
                                        $_SESSION['name']=$obj_usuarios->getNombre();
                                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                                        $_SESSION['id']=$obj_usuarios->getId();
                                        //Establece el atributo nombre del objeto
                                        $obj_usuarios->setNombre($usuario);
                                        //Establece la nueva clave  en el objeto respectivo. 
                                        $obj_usuarios->setClave($clave_nueva);
                                        //Procede a editar el password  del usuario.
                                        $obj_usuarios->edita_passsword();
                                        //Define un vector de sesión, para almacenar todos los modulos o funcionalidades del sitio asignadas al usuario.
                                        $_SESSION['modulos']=array();
                                        //Obtiene todos los modulos del sistema
                                        $obj_modulos->obtiene_todos_los_modulos();
                                        //Define un vector para asignar el resultado de la consulta SQL.
                                        $modulos= $obj_modulos->getArreglo();
                                        //Ejecuta la función para ver que módulos tiene asignado el rol del usuario.
                                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                                        //asigna a la variable roles, el vector de resultados de la consulta desde la bd.
                                        $roles = $obj_modulos->getArreglo();
                                        //asigna a la variable la cantidad de modulos que trajo la consulta SQL.
                                        $tam = count($modulos);
                                        //asigna a la variable la cantidad de roles que trajo la consulta SQL.
                                        $tam2 = count($roles);
                                        //Asigna inactivo a la variable estado.
                                        $estado=0;
                                        //Este ciclo permite agregar el vector de modulos o funcionalidades que tiene el usuario en la sesión.
                                        for($i=0; $i<$tam;$i++){
                                            for($c=0;$c<$tam2;$c++){
                                                //Agrega un nuevo elemento al vector de modulos, con la descripcion del modulo desde base  de datos,
                                                //Utilizado para efectos de seguridad.
                                                //Si el rol tiene el módulo del sistema, procede a definir la variable estado a 1 y sale del bucle.
                                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                                    $estado = 1;
                                                    break;
                                                }
                                            }
                                            //Va agregando al vector de modulos en la sesión de usuario, las funcionalidades que tiene asignadas de acuerdo al rol correspondiente.
                                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                            //Inicializa la variable en cero.
                                            $estado= 0;
                                        }
                                        //Llamada al formulario correspondiente de la vista
                                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';

                                    }else{
                                        //Muestra un mensaje de error, de que la contraseña nueva y la vieja son iguales.
                                        //Inicializa las variables de trabajo del metodo.
                                        $validacion="La nueva contraseña debe ser diferente a la contraseña actual. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        //Llamada al formulario correspondiente de la vista
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                    }else{
                                        //Le muestra un mensaje de error que al usuario de que las contraseñas no coinciden.
                                        //Inicializa las variables de trabajo del metodo.
                                        $validacion="La nueva contraseña y confirmación no coinciden. Proceda a revisar.";
                                        $tipo_de_alerta="alert alert-danger";
                                        //Llamada al formulario correspondiente de la vista
                                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                    }
                                   
                                }else{
                                    //Le muestra un mensaje de error al usuario de que el largo de la contraseña y de la confirmación no coincide.
                                    //Inicializa las variables de trabajo del metodo.
                                    $validacion="Recuerde que los espacios para nueva clave y confirmación, no pueden quedar vacíos";
                                    $tipo_de_alerta="alert alert-danger";
                                    //Llamada al formulario correspondiente de la vista
                                    require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                                }
                            }else{
                                //Informa que el usuario no esta activo, por lo que no podrá realizarse el cambio de contraseña.
                                //Inicializa las variables de trabajo del metodo.
                                $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                                $tipo_de_alerta="alert alert-danger";
                                //Llamada al formulario correspondiente de la vista
                                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                            }
                        }else{
                            //De lo contrario notifica que la contraseña actual suministrada no es correcta de acuerdo a la bd.
                            //Inicializa las variables de trabajo del metodo.
                            $validacion="La Contraseña actual del usuario no es correcta";
                            $tipo_de_alerta="alert alert-danger";
                            $clave="";
                            //Llamada al formulario correspondiente de la vista
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php'; 
                        }
                    }else{
                        // De lo contrario notifica que este usuario no existe en la base de datos y define las variables de error correspondientes.
                        $validacion="El usuario no se encuentra registrado en la base de datos";
                        $tipo_de_alerta="alert alert-danger";
                        //Inicializa las variables de trabajo del metodo.
                        $usuario="";
                        $clave="";
                        //Llamada al formulario correspondiente de la vista
                        require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                    }
                    
                }else {
                    // De lo contrario notifica al usuario que es necesario ingresar el numero de cedula y define las variables de error correspondientes.
                    $tipo_de_alerta="alert alert-danger";
                    $validacion="Debe completar el espacio de usuario para poder continuar con el proceso";
                    //Inicializa las variables de trabajo del metodo.
                    $usuario="";
                    $clave="";
                    //Llamada al formulario correspondiente de la vista
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
                //Llamada al formulario correspondiente de la vista
                require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
            }
    }  

    //Cambia estado del rol (activo/inactivo)
    public function cambiar_estado_rol(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Verifica si la variable id fue enviada por el url de la solicitud.
            if (isset($_GET['id'])) {
                //Verifica si la variable estado fue enviada por el url de la solicitud.
                if (isset($_GET['estado'])) {
                    //Crea un objeto de tipo roles.
                    $obj_roles=new cls_roles();
                    // Estable el id del rol, enviado via get por el url.
                    $obj_roles->setId($_GET['id']);
                    // Estable el estado del rol, enviado via get por el url.
                    $obj_roles->setEstado($_GET['estado']);
                    //Procede a cambiar el estado del rol mediante el metodo.
                    $obj_roles->edita_estado_rol();
                    
                    //Redefine nuevamente el objeto de tipo rol
                    $obj_roles=new cls_roles();
                    //Obtiene el listado completado de roles del sistema.
                    $obj_roles->obtiene_todos_los_roles();
                    // asigna el resultado de la consulta sql, al vector de parametros.
                    $params= $obj_roles->getArreglo();
                    //Llamada al formulario correspondiente de la vista
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
          //Llamada al formulario correspondiente de la vista
          require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
      }
    }

    //Metodo que permite cerrar o destruir la sesión actual de usuario, para poder 
    //validar nuevamente el ingreso y validacion de usuario
    public function cerrar_sesion(){
       //Envia un tipo de alerta de información, indicando que el sistema cerró la sesion actual
       $tipo_de_alerta="alert alert-info";
       $validacion="Verificación de Identidad";
       //Llamada al formulario correspondiente de la vista
       require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
       //Función de PHP que permite destruir la sesión actual del usuario.
       session_destroy();
    }
    
    //Metodo que permite obtener las notas del sistema, a nivel del rol de coordinacion de Z1.
    public function nota_obtener() {
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Crea un objeto de la clase general.
            $obj_general = new cls_general();
            //Procede a ejecutar la consulta SQL para traer todas las notas contenidas en la bd.
            $obj_general->obtener_notas();
            //Obtener el vector de la consulta
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    //Evento que guarda en caliente las notas que se  agregan en la ventana dinamica. 
    public function nota_guardar() {
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Creación de objeto de tipo general para gestionar las notas.
            $obj_general = new cls_general();
            // Establece el id de la nota, para editarla 
            $obj_general->setId($_POST['id']);
            //Establecer el contenido de la noa.
            $obj_general->setNota($_POST['nota']);
            //Guarda la nota en bd
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }    
    }
    
    //Metodo que permite almacenar un nuevo modulo (funcionalidad) a nivel de seguridad en el sistema
    public function guardar_modulo_rol($id_Rol){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Verifica si la variable lista esta definida por medio del evento post del formulario html
            if (isset($_POST["lista"])){
                //Obtiene el listado de modulos que viene desde el formulario html
                $listaModulos = $_POST["lista"];
                // Crea un objeto de la clase roles
                $obj_roles = new cls_roles();
                //verifica que se haya recibido un id valido por parametro en el metodo.
                if($id_Rol!=0){
                    //Llama al metodo que permite insertar una cantidad x de modulos asignado a un rol.
                    $obj_roles->insertar_rolesModulo($id_Rol,$listaModulos);
                }   else{
                    //De lo contrario muestra un mensaje en pantalla.
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    // Guarda un nuevo Rol del sistema
    public function guardar_rol(){       
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Verificar si la solicitud trae información por el metodo post del formulario HTML
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               //Crea un objeto de tipo roles
                $obj_roles=new cls_roles();
                //agrega descripcion al rol, la cual viene del formulario html
                $obj_roles->setDescripcion($_POST['descripcion']);
                //Establece el estado 
                $obj_roles->setEstado($_POST['estado']);
              
                //En caso de que el id enviado sea cero, procede a incluir un nuevo rol
                if ($_GET['id']==0){
                    //Ejecuta la sentencia SQL para traer todos lo roles establecidos por bd
                    $obj_roles->obtiene_todos_los_roles();
                    //Inicializa un vector con la consulta y el listado de roles
                    $validacion = $obj_roles->getArreglo();
                    //Extrae la cantidad de registros de la consulta
                    $tam = count($validacion);
                    //Variable bandera para verificar si la descrupción del módulo ya existe en la bd
                    $correcto=0;
                    //Recorre el listado general de roles del sistema
                    for($i=0; $i<$tam;$i++){
                        //Valida si la descripcion del rol en bd es igual a la que trae el formulario html.
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                            //en caso de que sea correcto, asigna a la variable bandera el valor de 1
                            $correcto=1;
                            //Envía una alerta indicando que este rol ya se encuentra en la base de datos con la misma descripción.
                            echo '<script>alert("Este Rol ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    //Si la variable bandera se mantiene en el valor inicial, procede a guardar la información del nuevo rol.
                    if($correcto==0){
                        //Ingresa el rol en bd
                        $obj_roles->inserta_rol();
                        //Obtiene el id del rol recien ingresado
                        $obj_roles->obtiene_id_ultimo_rol_ingresado();
                        //Asigna el id a una var iable
                        $id_ult_rol=$obj_roles->getId_ultimo_rol_ingresado();
                        //Procede a guardar los modulos relacionados al rol, enviando por parametro el id del rol
                        $this->guardar_modulo_rol($id_ult_rol);
                    }   else    {
                        //Caso contrario vuelve a la pantalla de gestion del rol
                         header ("location:/ORIEL/index.php?ctl=gestion_roles");
                        }
                    //En caso de que el id enviado sea diferente a cero, procede a modificar un rol
                }   else    {
                    //Establece el atributo del objeto con la información enviada desde el formulario html.
                    $obj_roles->setId($_GET['id']);
                    //Guarda el rol modificado en base de datos
                    $obj_roles->edita_rol();
                    //Guarda el modulo modificado en base de datos
                    $this->guardar_modulo_rol($_GET['id']);
                }
                //Vuelve a traer la lista completa de roles de seguridad presentes en la bd
                $obj_roles->obtiene_todos_los_roles();
                //Asigna a una variable el vector de registros de la consulta SQL.
                $params = $obj_roles->getArreglo();
        }
        //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite guardar nuevos o modificar roles en el modulo de seguridad del sistema
    public function gestion_roles(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Si el id enviado por parámetro es cero, procede a ingresar un nuevo rol.
            if ($_GET['id']==0){
                //Inicializa variables para presentarlas en pantalla
                $desc="";
                $esta=1;
                $ide=$_GET['id'];
                //Inicializa un vector de lista de roles
                $lista= array();
                
                //Modifica un rol existente
            }   else   {
                //Inicializa las variables para presentarlas en pantalla
                $ide=$_GET['id'];
                $desc=$_GET['descripcion'];
                $esta=$_GET['estado']; 
            
                //Crea un objeto de tipo roles del sistema
                $obj_roles= new cls_roles();
                //Ejecuta la sentencia SQL para traer todos los modulos por rol de seguridad
                $obj_roles->obtiene_todos_los_modulos_por_rol($ide);
                //Inicializa los valores  a un vector 
                $lista= $obj_roles->getArreglo();
            }
            //Crea un objeto de tipo modulos
            $obj_modulos=new cls_modulos();
            //Establece una condicion para traer solamente modulos activos en el sistema
            $obj_modulos->setCondicion("Estado=1");
            //Ejecuta la sentencia SQL
            $obj_modulos->obtiene_todos_los_modulos();
            // Asigna el resultado a un vector
            $params= $obj_modulos->getArreglo();
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }     
    
    //Trae la lista completa de modulos del sistema
    public function modulos_listar(){     
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Crea un objeto de tipo modulos
            $obj_modulos=new cls_modulos();
            //Ejecuta la sentencia SQL
            $obj_modulos->obtiene_todos_los_modulos();
            //Inicializa el vector correspondiente 
            $params= $obj_modulos->getArreglo();
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
     
    //Ingresa un nuevo módulo de seguridad en la base de datos
    public function modulos_guardar(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){   
            //Verifica si trae variables de formulario HTML vía metodo POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Crea un objeto de tipo modulos para manipular la tabla de bd
                $obj_modulos=new cls_modulos();
                //Inicializa la descripcion como atributo del objeto
                $obj_modulos->setDescripcion($_POST['descripcion']);
                //Inicializa el estado como atributo del objeto
                $obj_modulos->setEstado($_POST['estado']);
              
                //Si el id recibido por la url es cero, procede a ingresar un nuevo modulo
                if ($_GET['id']==0){
                    //Ejecuta la sentencia SQL para traer la lista de modulos
                    $obj_modulos->obtiene_todos_los_modulos();
                    //Inicializa una variable con el listado de modulos
                    $validacion= $obj_modulos->getArreglo();
                    //Tamaño de registros del vector
                    $tam = count($validacion);
                    //Variable bandera para verificar que el nuevo modulo no exista en bd
                    $correcto=0;
                    //Este bucle compara el lista de todos los modulos con el nuevo por ingresar para descartar que este repetido
                    for($i=0; $i<$tam;$i++){
                        //Valida si ya existe la descripcion del nuevo modulo en alguno de los ya existentes.
                        if($_POST['descripcion']==$validacion[$i]['Descripcion']){
                            //En caso de ser así, cambia el valor de la bandera
                            $correcto=1;
                            //Notifica al usuario final que ya este modulo se encuentra en bd
                            echo '<script>alert("Este Modulo ya se encuentra registrado en el sistema");</script>';
                        }
                    }
                    //En caso de no encontra  repetidos, procede a ingresarlo
                    if($correcto==0){
                        //Guarda en bd
                        $obj_modulos->inserta_modulo();
                        //Obtiene el id del modulo ingresado
                        $ultimo_modulo = $obj_modulos->getArreglo();
                        //Procede a ingresar los modulos del rol correspondiente
                        $obj_modulos->insertar_rolesModulo("1", $ultimo_modulo[0]['ID_Modulo']);
                    }   else    {
                        //Llamada al formulario correspondiente de la vista
                        header ("location:/ORIEL/index.php?ctl=modulos_gestion");
                                            }
                //En caso de que el id sea diferente de cero, procede a editar un modulo
                }   else   {
                    //Inicializa los atributos del objeto correspondiente
                    $obj_modulos->setId($_GET['id']);
                    //Guarda la nueva información en bd
                    $obj_modulos->edita_modulo();
                }
                //Procede a generar nuevamente la consulta de todos los modulos de seguridad que se encuentran en bd
                $obj_modulos->obtiene_todos_los_modulos();
                //Inicializa una variable con el total de registros traidos en la consulta desde la bd
                $params= $obj_modulos->getArreglo();
            }
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite cambiar el estado de un modulo (activo/inactivo)
    public function modulos_cambiar_estado(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Valida que se haya enviado por url el id del modulo a gestionar
            if (isset($_GET['id'])) {
                //Verifica que se haya enviado por url el estado nuevo del modulo
                if (isset($_GET['estado'])) { 
                    //Crea un objeto de clase correspondiente
                    $obj_modulos=new cls_modulos();
                    //Establece el atributo id del modulo
                    $obj_modulos->setId($_GET['id']);
                    // Establece el atributo estado del modulo
                    $obj_modulos->setEstado($_GET['estado']);
                    //Procede a ejecutar el cambio de estado en el modulo correspondiente
                    $obj_modulos->edita_estado_modulo();
                    //Reinicia la instancia del objeto de la clase modulos
                    $obj_modulos=new cls_modulos();
                    //Obtiene la lista completa de modulos de segurida del sistema
                    $obj_modulos->obtiene_todos_los_modulos();
                    //Asigna el resultado a una variable de tipo vector
                    $params= $obj_modulos->getArreglo();
                    // Procede a eliminar los modulos asignados a un rol en especifico
                    $obj_modulos->eliminar_modulos_roles($_GET['id']);
                    //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    //Permite agregar o modificar modulos de seguridad del sistema
    public function modulos_gestion(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            // Verifica si el id enviado por la url, esta en cero o no
            if ($_GET['id']==0){
                //Establece la variable de control a vacio
                $desc="";
                //Asigna activo a la variable estado
                $esta=1;
                //Obtiene el valor de id enviado por url
                $ide=$_GET['id'];
                
            }   else   {
                //Obtiene el valor de id enviado por url
                $ide=$_GET['id'];
                //Establece la variable de control a vacio
                $desc=$_GET['descripcion'];
                //Asigna el estado a la variable de control
                $esta=$_GET['estado'];
            }
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite traer de bd el listado total de usuarios del sistema 
    public function listar_usuarios(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Crea una instancia de la clase usuarios
            $obj_usuarios= new cls_usuarios();
            //Metodo que ejecuta la sentecia SQL para traer todos los usuarios
            $obj_usuarios ->obtiene_todos_los_usuarios();
            //Inicializa una variable con el vector total de registros de la bd
            $params= $obj_usuarios->getArreglo();
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    //Metodo que permite el mantenimiento de usuarios de seguridad del sistema
    public function gestion_usuarios(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Inicializa la variable params
            $params="";
            //Crea una instancia de la clase roles
            $obj_roles= new cls_roles();
            //Establece una condicion de consulta, que permita traer los roles activos del sistema
            $obj_roles->setCondicion("Estado=1");
            //Procede a ejecutar la consulta correspondiente, bajo el criterio especificado
            $obj_roles->obtiene_todos_los_roles();
            //Obtiene el arreglo de registros del sistema
            $roles = $obj_roles->getArreglo();
            
            //Si el id que viene via url es cero, procde a inicializar las posiciones del vector de control a vacio 
            if ($_GET['id']==0){
                //Inicializa a cero el id de la gestion
                $ide=0;
                
                //Inicializacion de los elementos del vector a vacio, ya que se ingresará un nuevo usuario del sistema
                $params[0]['Nombre']="";
                $params[0]['Apellido']="";
                $params[0]['Cedula']="";
                $params[0]['Correo']="";
                $params[0]['Rol']="";
                $params[0]['Observaciones']="";
                $params[0]['Estado']="1";

            }
                //En caso de que el id venga inicializado a -1, procede a inicializar los elementos del vector con los parametros enviados desde el formulario HTML
            if($_GET['id']==-1){
                //inicializa la variable ide en cero
                $ide=0;
                //Inicializa los elementos del vector con los parametros enviados por post desde el formulario HTML
                $params[0]['Nombre']=$_POST['Nombre'];
                $params[0]['Apellido']=$_POST['Apellido'];
                $params[0]['Cedula']=$_POST['Cedula'];
                $params[0]['Correo']=$_POST['Correo'];
                $params[0]['Rol']="";
                $params[0]['Observaciones']=$_POST['Observaciones'];
                $params[0]['Estado']="1";
            }
            //En caso de que el id sea diferente a -1 y 0, procede a buscar el usuario en bd y enviar el vector correspondiente a la capa de presentacion del sistema
            else    {
                //Inicializa la variable ide con el parametro enviado por url desde el formulario html
                $ide=$_GET['id'];
                //Crea una instancia de la clase usuarios
                $obj_usuario = new cls_usuarios();
                //Establece condicion de busqueda en la bd
                $obj_usuario->setCondicion("ID_Usuario=$ide");
                //Ejecuta el metodo que trae la lista de usuarios de acuerdo a la condicion
                $obj_usuario->obtiene_todos_los_usuarios();
                //Inicializa el vector con el resultado de la busqueda
                $params= $obj_usuario->getArreglo();
            }
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    //Metodo que permite realizar el mantenimiento general de la tabla de usuarios del sistema
    public function guardar_usuario(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            // Crea una instancia de la clase usuarios
            $obj_usuarios= new cls_usuarios();
            //Verifica si vienen datos por medio del metodo post, es decir usando un formulario html
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Validar información para ver si el usuario en cuestion existe en la bd
                $obj_usuarios->setCondicion("ID_Usuario<>".$_GET['id']);
                //Ejecuta el metodo para correr la sentencia SQL segun criterio
                $obj_usuarios->obtiene_todos_los_usuarios();
                //Inicializa una variable con el vector de resultados
                $validacion = $obj_usuarios->getArreglo();
                //Inicializa una variable con la cantidad de registros recibidos
                $tam = count($validacion);
                //Variable bandera para validar la no repetición de usuarios en el sistema
                $correcto=0;
                    //Recorre el vector de registros que trae la consulta
                    for($i=0; $i<$tam;$i++){
                        //Valida si la cedula del registro actual es igual que está en gestión
                        if($_POST['Cedula']==$validacion[$i]['Cedula']){
                            //Cambia el estado de la variable bandera
                            $correcto=1;
                            //Envia notificacion de la validacion al usuario en cuestion
                            echo '<script>alert("Esta Cedula ya se encuentra registrada en el sistema");</script>';
                            //Inicializa la variable post del formulario a vacio para que se vuelva a ingresar
                            $_POST['Cedula']="";
                            //Inicializa la variable post del formulario a -1 para el control correspondiente
                            $_GET['id']=-1;
                        }
                        //Valida la información del correo suministrada por el usuario que está utilizando el modulo
                        //Tanto en contenido como que sea diferente de los que se encuentran en bd
                        if($_POST['Correo']!="" && $_POST['Correo']==$validacion[$i]['Correo']){
                            //Cambia el valor de la varuable bandera
                            $correcto=1;
                            //Notifica al usuario del error.
                            echo '<script>alert("Este correo ya se encuentra registrado en el sistema");</script>';
                            //Inicializa la variable del formulario a vacio para su nuevo ingreso
                            $_POST['Correo']="";
                             //Inicializa la variable post del formulario a -1 para el control correspondiente
                            $_GET['id']=-1;
                        }
                        //Validacion del correo cuando sea vacio
                        if($_POST['Correo']==""){
                            $correcto=0;
                        }
                    }
                    //Si la variable bandera es igual a cero, procede a gestionar la actualizacion en base de datos
                if($correcto==0){
                    /*
                     * Establece los diferentes atributos del objeto de la clase, con la información proveniente 
                     * desde el formulario html via post
                     */
                    $obj_usuarios->setId($_GET['id']);
                    $obj_usuarios->setNombre($_POST['Nombre']);
                    $obj_usuarios->setApellido($_POST['Apellido']);
                    $obj_usuarios->setCedula($_POST['Cedula']);
                    $obj_usuarios->setCorreo($_POST['Correo']);
                    $obj_usuarios->setObservaciones($_POST['Observaciones']);
                    $obj_usuarios->setRol($_POST['Rol']);
                    $obj_usuarios->setEstado($_POST['Estado']);
                    //Guarda la informacion en base de datos
                    $obj_usuarios->guardar_usuario();
                    //Obtiene todos los usuarios posterior a la actualizacion de datos
                    $obj_usuarios->obtiene_todos_los_usuarios();
                    // Inicializa el vector con los resultados de la consulta a la bd
                    $params = $obj_usuarios->getArreglo();
                    //Llamada al formulario correspondiente de la vista
                    header ("location:/ORIEL/index.php?ctl=listar_usuarios");
                   
                 }   else    {
                    //Llama al metodo de la clase controller. 
                    //Se cambió por el header, en caso de error, volver a colocar la llamada directa al metodo de la clase
                    //$this->gestion_usuarios();***
                    //Llamada al formulario correspondiente de la vista
                    header ("location:/ORIEL/index.php?ctl=gestion_usuarios");                    
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite cambiar de estado un usuario en la bd (activo/inactivo)
    public function cambiar_estado_usuario(){
        //Creacion de una instancia de la clase roles
        $obj_roles= new cls_roles();
        //Creacion de una instancia de la clase usuario
        $obj_usuario= new cls_usuarios(); 
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
             //Valida que el id haya sido enviado via url por el metodo get
            if (isset($_GET['id'])) {
                //Valida que el estado haya sido enviado via url por el metodo get
                if (isset($_GET['estado'])){
                    //Establece condicion para verificar antes cual es el estado del rol al que pertenece el usuario en cuestion
                    $obj_roles->setCondicion("ID_Rol=".$_GET['rol']);
                    //Ejecuta la sentecia sql 
                    $obj_roles->obtiene_todos_los_roles();
                    //Asigna a la variable el arreglo con la consulta correspondiente
                    $rolusuario=($obj_roles->getArreglo());
                    //Si el estado del rol de usuario está activo, procede a realizar la actualización en la información del estado del usuario
                    if($rolusuario[0]['Estado']==1){
                        //Establece el atributo id del objeto de clase
                        $obj_usuario->setId($_GET['id']);
                        //Establece el atributo estado del objeto de la clase
                        $obj_usuario->setEstado($_GET['estado']);
                        //Procede a editar el estado del usuario
                        $obj_usuario->edita_estado_usuario();
                        //Genera la consulta con el listado completo de usuarios del sistema
                        $obj_usuario->obtiene_todos_los_usuarios();
                        // Obtiene el listado de usuarios en la variable corrrespondiente
                        $params= $obj_usuario->getArreglo();
                    }
                    else{
                        //Muestra un warning al usuario, indicando que el rol está desactivado
                        echo '<script>alert("Rol Desactivado");</script>';
                        //Procede a ejecutar la consulta para traer todos los usuarios
                        $obj_usuario->obtiene_todos_los_usuarios();
                        // Inicializa la variable con el vector correspondiente.
                        $params= $obj_usuario->getArreglo();
                    }
                    //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    //Metodo que permite resetear la clave de un usuario en especifico, por parte de un usuario administrador.
    //El nuevo password queda de manera momentánea, con la cedula o SSN para ingresar nuevamente.
    public function reset_password(){ 
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Validación para verificar si el usuario está logeado en el sistema
            if (isset($_GET['id'])) {
                //Creación de una instancia del objto usuario
                $obj_usuario= new cls_usuarios();
                //Establece los atributos del objeto desde los parametros 
                //Id del usuario=cedula
                $obj_usuario->setId($_GET['id']);
                //Establece la clave del usario con el valor del numero de cedula
                $obj_usuario->setClave($_GET['cedula']);
                //Procede a cambiar el password con el nuevo valor
                $obj_usuario->reset_password_usuario();
                //Procede a traer la lista actualizada de usuarios del sistema
                $obj_usuario->obtiene_todos_los_usuarios();
                //Asigna el resultado de la consulta a una variable de tipo arreglo
                $params= $obj_usuario->getArreglo();
                //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    //Metodo que permite recordar el password de un usuario mediante el envio de la información por correo 
    public function recordar_password(){
        //Inicializa la variable para notificar al usuario del resultado de la operacion
        $validacion="";
        //Creacion de una instancia de la clase usuarios
        $obj_usuarios= new cls_usuarios();
        //Creacion de una instancia del clase mail provider, para envio de correos
        $obj_correo=new Mail_Provider();
         
        //Verifica que la llamada de este metodo haya sido por invocando el metodo GET=URL
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Obtiene la cedula del usuario enviada por parametro
             $usuario = $_GET['nom'];
                   
             //Verifica que el usuario exista.
             if ($obj_usuarios->existe_usuario($usuario)){
                 //Metodo que va a la bd con el nombre de usuario para traer el correo electrónico y la clave del mismo
                    $obj_usuarios->obtiene_correo_y_password_de_usuario($usuario);   
                    //Asigna correo a una variable
                    $correo=$obj_usuarios->getCorreo();
                    //Asigna la clave a una variable de este metodo
                    $pass=$obj_usuarios->getClave();
                    //Agrega el asunto del correo para envio al usuario realizando la solicitud
                    $obj_correo->agregar_asunto_de_correo("Recordatorio Clave Sistema Oriel");
                    //Agrega detalle de correo
                    $obj_correo->agregar_detalle_de_correo("Este es un mensaje automático, favor no responderlo.</br> Su clave del sistema Oriel es: ".$pass);
                    //Agrega direccion de correo del destinatario
                    $obj_correo->agregar_direccion_de_correo($correo, $usuario);
                    //Procede a enviar el correo
                    $obj_correo->enviar_correo();
                    //Inicializa variables para notificar al usuario en pantalla del resultado
                    $tipo_de_alerta="alert alert-info";
                    $validacion="Se ha enviado un recordatorio de password a su correo electrónico";  
                    //Llamada al formulario correspondiente de la vista
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
                    //Llamada al formulario correspondiente de la vista
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
                 }
        }
    }
    
    //Este es uno de los metodos principales del sistema, permite hacer la validacion inicial de credenciales del usuario a nivel de seguridad
    //para hacer ingreso a la parte privada del sistema. En este metodo se inicializan las variables de sesión del usuario, las cuales permiten
    //navegar dentro de todas las funcionalidades de ORIEL.
    public function listar(){
        //Inicializa las variables de control para notificar al usuario del resultado del proceso
        $validacion="";
        //Creacion de una instancia de la clase usuario
        $obj_usuarios= new cls_usuarios();
        //Creacion de una instancia de la clase modulos
        $obj_modulos = new cls_modulos();

        
        //Verifica que el envio de parametros sea por medio del metodo post=formulario HTML
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            //Obtiene la información del usuario
            $usuario = $_POST['nombre'];
            //Obtiene la información de la contraseña del usuario
            $clave= $_POST['password'];
        
            //Verifica si el usuario existe
            if ($obj_usuarios->existe_usuario($usuario)){
                //Valida el password del usuario que sea correcto
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    //Verifica si el usuario está activo en el sistema
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){        
                        //Valida si es la primera vez que ingresa al sistema o si tiene clave por defecto para dirigirlo al formulario de cambio correspondiente.
                        if (!$obj_usuarios->tiene_clave_por_defecto($usuario,$clave)){
                            //Ejecuta el metodo que trae todos los usuarios del sistema. 
                            $obj_usuarios->obtiene_todos_los_usuarios();
                            //Obtiene el resultado de la consulta en una variable
                            $params=$obj_usuarios->getArreglo();
                            //Asigna el numero de cedula a la variable de sesion
                            $_SESSION['nombre']=$usuario;
                            //Metodo que permite obtener el rol, nombre, y apellido del usuario
                            $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                            //Asigna a la variable de sesion, el rol del usuario
                            $_SESSION['rol']=$obj_usuarios->getRol();
                            //Asigna a la variable de sesion, el nombre del usuario
                            $_SESSION['name']=$obj_usuarios->getNombre();
                            //Asigna a la variable de sesion, el apellido del usuario
                            $_SESSION['apellido']=$obj_usuarios->getApellido();
                            //Asigna a la variable de sesion, el id del usuario
                            $_SESSION['id']=$obj_usuarios->getId();    
                            //Crea una variable de sesion de tipo vector para acumular el total de modulos del sistema
                            $_SESSION['modulos']=array();
                            //Obtiene todos los modulos de seguridad registrados en la bd
                            $obj_modulos->obtiene_todos_los_modulos();
                            //Asigna a la variable modulos, el total de registros de modulos del sistema
                            $modulos= $obj_modulos->getArreglo();
                            //Obtiene los modulos de seguridad asignados al rol del usuario en especifico
                            $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                            //Obtiene los modulos asignados al rol del usuario
                            $roles = $obj_modulos->getArreglo();
                            // Tamaño del arreglo de modulos de seguridad del sistema
                            $tam = count($modulos);
                            // Tamaño del arreglo de modulos de seguridad asignados al usuario
                            $tam2 = count($roles);
                            //Variable bandera para controlar cuales modulos tiene asignado un usuario especifico
                            $estado=0;
                            //Recorre el total de registros contenidos en el vector de modulos de seguridad del sistema
                            for($i=0; $i<$tam;$i++){
                                for($c=0;$c<$tam2;$c++){
                                    //Valida los modulos del sistema contra los modulos de seguridad asignados al usuario
                                    if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                        //En caso de que el usuario tenga asignado un modulo de seguridad, procede a cambiar el estado de la variable bandera
                                        $estado = 1;
                                        //Detiene el recorrido.
                                        break;
                                    }
                                }
                                //Al vector instanciado como variable de sesión, le empieza aagregar cada uno de los modulos de seguridad con el estado correspondiente para validar si el usuario tiene privilegios.
                                $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                                //Inicializa la variable bandera para continuar con el recorrido del vector de modulos de seguridad.
                                $estado= 0;
                            }
                            //Llamada al formulario correspondiente de la vista
                            require __DIR__ . '/../vistas/plantillas/frm_principal.php';

                        }else{
                            //Define las variables de notificacion en pantalla para el usuario, en caso de que la clave y el usuario sean el mismo.
                            $tipo_de_alerta="alert alert-info";
                            $validacion="Es necesario cambiar su clave para poder ingresar al sistema";   
                            //Llamada al formulario correspondiente de la vista
                            require __DIR__ . '/../vistas/plantillas/frm_Cambio_Clave.php';
                        }
                        
                    }else{
                        //Define las variables de notificacion en pantalla para el usuario, en caso de que el usuario esté inactivo.
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        $tipo_de_alerta="alert alert-danger";
                        //Llamada al formulario correspondiente de la vista
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }else {
                    //Define las variables de notificacion en pantalla para el usuario, en caso de que la clave sea incorrecta.
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    $tipo_de_alerta="alert alert-danger";
                    //Llamada al formulario correspondiente de la vista
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    
            else{
                //Define las variables de notificacion en pantalla para el usuario, en caso de que el usuario no exista en la bd.
                $validacion="El usuario no se encuentra registrado en la base de datos";
                $tipo_de_alerta="alert alert-danger";
                //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
     
    //Metodo que permite iniciar el ingreso a la parte privada del sistema, cambiando la clave.
    public function iniciar_sistema_cambiando_clave(){
        //Inicializa la variable de control para informar al usuario del resultado del proceso.
        $validacion="";
        //Creación de una instancia de la clase usuarios.
        $obj_usuarios= new cls_usuarios();
        //Verifica que los parametros hayan sido enviados mediante el evento post.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Asigna a una variable la cedula del usuario.
            $usuario = $_POST['nombre'];
            //Asigna a una variable la clave del usuario.
            $clave= $_POST['password'];
            //Creacion de una instancia de la clase modulos.
            $obj_modulos =  new cls_modulos();
            //Verifica si el usuario existe mediante el numero de cedula.
            if ($obj_usuarios->existe_usuario($usuario)){
                //Verifica que el password del usuario sea correcto
                if ($obj_usuarios->valida_password_de_usuario($usuario, $clave)){
                    //Verifica que el usuario este activo en el sistema.
                    if ($obj_usuarios->el_usuario_esta_activo($usuario, $clave)){
                        //obtiene el listado completo de usuarios 
                        $obj_usuarios->obtiene_todos_los_usuarios();
                        //Asigna a una variable el arreglo de usuarios del sistema
                        $params=$obj_usuarios->getArreglo();
                        //asigna a la variable de sesion correspondiente, la cedula del usuario.
                        $_SESSION['nombre']=$usuario;
                        //Obtiene la información de seguridad especifica del usuario
                        $obj_usuarios->obtiene_rol_nombre_apellido_de_usuario($usuario);
                        //Asigna el rol del usuario a la variable de sesion 
                        $_SESSION['rol']=$obj_usuarios->getRol();
                        //Asigna el nombre del usuario a la variable de sesion 
                        $_SESSION['name']=$obj_usuarios->getNombre();
                        //Asigna el apellido del usuario a la variable de sesion 
                        $_SESSION['apellido']=$obj_usuarios->getApellido();
                        //Asigna el id del usuario a la variable de sesion 
                        $_SESSION['id']=$obj_usuarios->getId();
                        //Crea un vector de sesion con la cantidad de modulos de seguridad del sistema.
                        $_SESSION['modulos']=array();
                        // Obtiene todos los modulos de seguridad del sistema.
                        $obj_modulos->obtiene_todos_los_modulos();
                        //Obtiene el arreglo completo de modulos de seguridad del sistema
                        $modulos= $obj_modulos->getArreglo();
                        //Obtiene la lista de modulos de seguridad que tiene un usuario por medio del rol correspondiente.
                        $obj_modulos->obtiene_lista_de_modulos_por_rol($obj_usuarios->getRol());
                        //Obtiene en una variable, el listado de roles que tiene asignado el usuario.
                        $roles = $obj_modulos->getArreglo();
                        //Obtiene el tamaño total de modulos de seguridad del sistema
                        $tam = count($modulos);
                        //Obtiene el tamaño total de modulos de seguridad asignados a un usuario.
                        $tam2 = count($roles);
                        //Variable bandera para verificar que modulos de seguridad del total, tiene asignado el usuario en cuestión.
                        $estado=0;
                        //Bucle que permite recorrer y comparar cuales modulos de seguridad tiene el usuario
                        for($i=0; $i<$tam;$i++){
                            for($c=0;$c<$tam2;$c++){
                                //En caso de que el usuario cuente con el modulo, procede a cambiar el estado de la variable bandera.
                                if($modulos[$i]['Descripcion']==$roles[$c]['Descripcion']){
                                    //Cambia el estado del bucle
                                    $estado = 1;
                                    //Sale del ciclo
                                    break;
                                }
                            }
                            //Construye el vector de sesion que almacena el total de modulos de seguridad que se encuentran en bd
                            $_SESSION['modulos']= array_merge($_SESSION['modulos'],[($modulos[$i]['Descripcion'])=>($estado)]);
                            //Inicializa el estado de la variable bandera
                            $estado= 0;
                        }    
                        //Llamada al formulario correspondiente de la vista
                        require __DIR__ . '/../vistas/plantillas/frm_principal.php';
                    }   else{
                        //Notifica al usuario que se encuentra inactivo
                        $validacion="Usuario Inactivo, contacte al administrador del sistema!!!";
                        //Cambia el estado de las variables de notificacion al usuario
                        $tipo_de_alerta="alert alert-danger";
                        //Llamada al formulario correspondiente de la vista
                        require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                    }
                      
                }   else   {
                    //Notifica al usuario que la contraseña es incorrecta
                    $validacion="Contraseña Incorrecta, vuelva a intentarlo";
                    //Cambia el estado de las variables de notificacion al usuario
                    $tipo_de_alerta="alert alert-danger";
                     //Llamada al formulario correspondiente de la vista
                    require __DIR__ . '/../vistas/plantillas/inicio_sesion.php'; 
                }
            }    else   {
                //Notifica al usuario que el usuario no se encuentra en la base de datos
                $validacion="El usuario no se encuentra registrado en la base de datos";
                //Cambia el estado de las variables de notificacion al usuario
                $tipo_de_alerta="alert alert-danger";
                 //Llamada al formulario correspondiente de la vista
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
             //Cambia el estado de las variables de notificacion al usuario
            $validacion="Es necesario iniciar sesión para ingresar al sistema";
             //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }

    }
    
    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////FUNCIONES PARA EVENTOS///////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    //Metodo que permite listar los eventos de bitácora que están activos o en atención.
    public function frm_eventos_listar(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            $this->ejecucion_automatico_proceso("Pruebas");
            //Creacion de objeto de clase eventos
            $obj_eventos = new cls_eventos();
            
            //Vector que almacena un si o uno dependiendo si el evento en cuestion pertenece a alguna mezcla
            $eventos_con_mezcla=array();
            
            //Establece el criterio de filtrado correspondiente para buscar los eventos.
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND T_Evento.ID_Tipo_Evento<>39");
            //Ejecuta la sentencia SQL
            $obj_eventos ->obtiene_todos_los_eventos(); 
            //Obtiene el vector de registros correspondientes
            $params= $obj_eventos->getArreglo();
            $puesto_enviado=0;
            $check_continuidad=0;
            //Implementación para obtener el último seguimiento de cada evento, además del último usuario que lo agregó
            
            //Saca el tamaño del vector de registros 
        $tam=count($params);
        //verifica que hayan eventos devueltos en la consulta.
        if (count($params)>0){
            //Empieza a recorrer registro por registro
            for ($i = 0; $i <$tam; $i++) {
                
                $obj_eventos->setId($params[$i]['ID_Evento']);
                if ($obj_eventos->existe_este_evento_en_otra_mezcla()){
                    array_push($eventos_con_mezcla, "SI");
                }else{
                    array_push($eventos_con_mezcla, "NO");
                }
                
                //Criterio de busqueda que permite traer todos los seguimientos del evento en cuestion
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();

                //Verifica que hayan seguimientos
                if(count($obj_eventos->getArreglo())>0){
                    //Construye el vector de seguimientos asociados al evento que se está analizando.
                    if ($i==0){
                        $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                    }else{
                        $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());                 
                    }
                }
                
                //Trae el seguimiento asociado a un evento en especifico, solo el mas viejo, lo cual permite determinar quien hizo el ultimo seguimiento en el evento.
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                //asigna el resultado de la consulta aun objeto de tipo arreglo
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();

                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    //Arma el vector de seguimientos asociados a un evento en específico
                    if ($i==0){
                        //Arma el vector con el detalle y el ultimo usuario que registro un seguimiento en el evento de bitacora
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Último seguimiento ingresado-->Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
                    }else{
                        //Concatena al vector la nueva linea de información del seguimiento.
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Último seguimiento ingresado-->Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));  
                    }
                }else{
                    //En caso de que no hayan seguimientos asociados, procede a registrar las validación correspondiente.
                    if ($i==0){
                        //Con el primer elemento del vector, utiliza esta linea de codigo
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]);
                    }else{
                        //Con el resto de lineas del vector, usa esta otra programación.
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]));
                    }
                }
            }
        } 
        //print_r($eventos_con_mezcla);
       //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Este metodo es llamado desde codigo javascript, especificamente en la pantalla que lista los eventos abiertos de bitácora. Tiene como proposito
    //ordenar o visualizar en pantalla los eventos por puesto de monitoreo del centro de control Z1. Esto permite facilidad a la hora de realizar
    //auditorías por puesto por parte del coordinador a cargo, así como enfocar el trabajo de cada operador de monitoreo.
    public function eventos_listar_filtrado(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            $this->ejecucion_automatico_proceso("Pruebas");
            //Vector que almacena un si o uno dependiendo si el evento en cuestion pertenece a alguna mezcla
            $eventos_con_mezcla=array();
            //Creación de una instancia de un objeto de la clase eventos.

            $obj_eventos = new cls_eventos();
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==1){
                //Variable de control del puesto a visualizar
                $puesto_enviado=1;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Provincia=4 OR T_Evento.ID_Provincia=5 OR T_Evento.ID_Provincia=6) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==2){
                //Variable de control del puesto a visualizar
                $puesto_enviado=2;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND T_Evento.ID_Provincia=1 AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==3){
                //Variable de control del puesto a visualizar
                $puesto_enviado=3;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Tipo_Punto=3 OR T_Evento.ID_Tipo_Punto=4)");
            }
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==4){
                //Variable de control del puesto a visualizar
                $puesto_enviado=4;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5 AND (T_Evento.ID_Provincia=2 OR T_Evento.ID_Provincia=3 OR T_Evento.ID_Provincia=7) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4)");
            }
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==5){
                //Variable de control del puesto a visualizar
                $puesto_enviado=5;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("(T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5) AND (T_Evento.ID_Tipo_Evento=17 OR T_Evento.ID_Tipo_Evento=38)");
            }
            //Verifica para cual puesto de monitoreo fue realizada la solicitud, esto mediante el metodo post 
            if($_POST['puesto']==0){
                //Variable de control del puesto a visualizar
                $puesto_enviado=0;
                //Establecer la condición de filtrado por puesto para la consulta SQL a la base de datos
                $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento<>3 AND T_Evento.ID_EstadoEvento<>5");
            }
            
            if(isset($_POST['continuidad'])){
                $check_continuidad=1;
            } else{
                $check_continuidad=0;
                $obj_eventos->setCondicion($obj_eventos->getCondicion()." AND T_Evento.ID_Tipo_Evento<>39");
            }
            //Ejecuta la consulta SQL con el filtro correspondiente
            $obj_eventos ->obtiene_todos_los_eventos(); 
            //Asigna el resultado a una variable tipo vector.
            $params= $obj_eventos->getArreglo();
            
            //Implementación para obtener el último seguimiento de cada evento, además del último usuario que lo agregó
        
        //Saca el tamaño del vector de registros 
        $tam=count($params);
        //verifica que hayan eventos devueltos en la consulta.
        if (count($params)>0){
            //Empieza a recorrer registro por registro
            for ($i = 0; $i <$tam; $i++) {
                
                $obj_eventos->setId($params[$i]['ID_Evento']);
                if ($obj_eventos->existe_este_evento_en_otra_mezcla()){
                    array_push($eventos_con_mezcla, "SI");
                }else{
                    array_push($eventos_con_mezcla, "NO");
                }
                //Criterio de busqueda que permite traer todos los seguimientos del evento en cuestion
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                //Verifica que hayan seguimientos
                if(count($obj_eventos->getArreglo())>0){
                    //Construye el vector de seguimientos asociados al evento que se está analizando.
                    if ($i==0){                      
                        $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                    }else{
                        $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());                 
                    }
                }
                //Trae el seguimiento asociado a un evento en especifico, solo el mas viejo, lo cual permite determinar quien hizo el ultimo seguimiento en el evento.
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$i]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                //asigna el resultado de la consulta aun objeto de tipo arreglo
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();

                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    //Arma el vector de seguimientos asociados a un evento en específico
                    if ($i==0){
                        //Arma el vector con el detalle y el ultimo usuario que registro un seguimiento en el evento de bitacora
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
                    }else{
                        //Concatena al vector la nueva linea de información del seguimiento.
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));  
                    }
                }else{
                    //En caso de que no hayan seguimientos asociados, procede a registrar las validación correspondiente.
                    if ($i==0){
                        //Con el primer elemento del vector, utiliza esta linea de codigo
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]);
                    }else{
                        //Con el resto de lineas del vector, usa esta otra programación.
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']]));
                    }
                }
            }
//          
        } 
        //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo del contralador que permite listar los eventos cerrados en pantalla de la bitacora digital.
    public function frm_eventos_lista_cerrados(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Creación de un objeto de clase eventos
            $obj_eventos = new cls_eventos();
            //Establece la condición de busqueda de eventos cerrados del modulo de bitacora digital.
            $obj_eventos->setCondicion("(T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.Fecha='".date("Y-m-d")."'");
            //Ejecuta la sentecia SQL
            $obj_eventos ->obtiene_todos_los_eventos(); 
            //Asigna al vector correspondiente el resultado de la consulta SQL
            $params= $obj_eventos->getArreglo();
            
            //Metodo de la clase que permite obtener todas las provincias que se encuentran listadas en el sistema.
            $obj_eventos->obtener_todas_las_provincias();
            //Asigna el resultado a un vector
            $lista_provincias=$obj_eventos->getArreglo();
            
            //Obtiene todos lps tipos de puntos BCR que se encuentran activos en la base de datos
            $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
            //Asigna el resultado de la consulta a un vector
            $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
            
            //Obtiene las oficinas de san jose
                    
            $obj_eventos->setTipo_punto("1");
            $obj_eventos->setProvincia("1");
            
            //Metodo que filtra los puntos BCR para uso de la bitacora digital
            $obj_eventos->filtra_sitios_bcr_bitacora();
            //Obtiene el resultado de la consulta en una variable vector.
            $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
            
            //Extrae la cantidad de registros en el vector que almacena la consulta
            $tamano=count($params);
            //Verifica que hayan registros 
            if (count($params)>0){
                //Recorre el listado de registros
                for ($x = 0; $x <$tamano; $x++) {
                    //Establece el criterio de busqueda correspondiente,para extraer los seguimientos asignados a un evento en especifico
                    $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                    //Obtiene los seguimientos del evento seleccionado, si los hubiere
                    $obj_eventos->obtiene_detalle_evento();

                    //Verifica que hayan seguimientos asociados
                    if(count($obj_eventos->getArreglo())>0){
                        if ($x==0){
                            //Arma el vector de seguimientos por cada evento cerrado del sistema
                            $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
                        
                        }else{
                            //Arma el vector de seguimientos por cada evento cerrado del sistema
                            $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
                          
                        }
                    }
                    
                // trae la fecha y ultimo seguimiento del evento en cuestion
                $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                //Obtiene los seguimientos del evento seleccionado, si los hubiere
                $obj_eventos->obtiene_detalle_evento();
                //asigna el vector a una variable para posteriormente utilizarlo.
                $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();
                
                
                //Verifica si existen seguimientos asociados al evento actual
                if(count($ultimo_seguimiento_asociado)>0){
                    //Arma el vector de seguimientos asociados
                    if ($x==0){
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
//                     
                    }else{
                        //Arma el vector de seguimientos asociados
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
//                      
                    }
                }else{
                    if ($x==0){
                        //Valida el vector en caso de que no hayan seguimientos asociados al evento en cuestion
                        $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                    }else{
                        //Valida el vector en caso de que no hayan seguimientos asociados al evento en cuestion
                        $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                    }
                }
                }
            }
            //Llamada al formulario correspondiente de la vista
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo del controler que permite agregar un nuevo evento al modulo de la bitacora digital del centro de control
    public function frm_eventos_agregar(){
        //Valida errores durante el procedimiento realizado
        try {
            //Validación para verificar si el usuario está logeado en el sistema
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
                
                //Verifica el valor del parametro id enviado por el url, con esto se determina si se está agregando un evento 
                //o si por el contrario se está editando.
                if ($_GET['id']==0){
                  
                    //Establece e inicializa una variable a cero
                    $ide=0;
                    
                    //Crea objeto de tipo eventos para cargar las listas correspondientes
                    $obj_eventos = new cls_eventos();
                    
                    $params[0]['Nombre']=null;
                    //Obtiene todos los tipos de eventos que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    //asigna el resultado de la sentecia SQL, a una variable tipo vector
                    $lista_tipos_de_eventos=$obj_eventos->getArreglo();
                    
                    //Obtiene todas las provincias que se encuentran activas en la base de datos
                    $obj_eventos->obtener_todas_las_provincias();
                    //Asigna la lista de provincias a un arreglo
                    $lista_provincias=$obj_eventos->getArreglo();
                    
                    //Obtiene todos los tipos de puntos BCR que se encuentran activos en la base de datos
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    //Asignado el listado a una variable tipo vector
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    //Obtiene los diferentes seguimientos
                    $obj_eventos->obtener_seguimientos();
                    //Obtiene el listado de seguimientos asociados a un evento en especifico
                    $estadoEventos = $obj_eventos->getArreglo();
                    
                    //Obtiene las oficinas de san jose
                    
                    $obj_eventos->setTipo_punto("1");
                    $obj_eventos->setProvincia("1");

                    //Filtra los sitios que se utilizan dentro del modulo de bitacora
                    $obj_eventos->filtra_sitios_bcr_bitacora();
                    //Obtiene la lista de sitios en una variable tipo vector
                    $lista_puntos_bcr_oficinas_sj=$obj_eventos->getArreglo(); 
                       
                    //Llamada al formulario correspondiente de la vista
                    require __DIR__ . '/../vistas/plantillas/frm_eventos_agregar.php';
                    
                }else{   
                    //En caso de que el id corresponda a algun evento en especifico, corre este procedimiento
                    $ide=$_GET['id'];
                    //Crea un objeto del tipo puntos bcr
                    $obj_Puntobcr = new cls_puntosBCR();
                    //Crea un objeto de tipo eventos de bitacora
                    $obj_eventos = new cls_eventos();

                    //Establece una condicion de busqueda por punto BCR en específico
                    $obj_Puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$_GET['id']);
                    //Ejecuta el filtrado
                    $obj_Puntobcr->obtiene_todos_los_puntos_bcr();
                    //Obtiene los resultados de la consulta.
                    $params= $obj_Puntobcr->getArreglo();
                    
                    //Establece la condicion a vacio
                    $obj_eventos->setCondicion("");
                    //Obtiene todos los tipos de eventos de bitacora
                    $obj_eventos->obtener_todos_los_tipos_eventos();
                    //Los asigna a una variable de tipo vector
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
                    
                    //Obtener tipos de puntos BCR: oficinas, ATMs, etc
                    $obj_eventos->setCondicion("");
                    //Ejecuta la sentencia 
                    $obj_eventos->obtener_todos_los_tipos_de_puntos_BCR();
                    //Asigna el resultado a una variable de tipo vector
                    $lista_tipos_de_puntos_bcr=$obj_eventos->getArreglo();
                    
                    //Busca los eventos de un punto BCR en especifico
                    $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$ide);
                    //Obtiene los eventos
                    $obj_eventos->obtiene_todos_los_eventos();
                    //Recibe el resultado de la busqueda
                    $eventos_relacionados=$obj_eventos->getArreglo();
                    
                    //Llamada al formulario correspondiente de la vista
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
                //Llamada al formulario correspondiente de la vista
                require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        //Recolecta los errores
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }  
    }
       
    //Metodo que permite notificar al usuario en pantalla cuando va a ingresar un tipo de evento en un punto bcr que ya se encuentra abierto
    public function mezcla_eventos_bitacora_digital(){
                
        //Verifica que los parametros del metodo post estén definidos y hayan sido enviados al metodo
        if(isset($_POST['id_numeros_de_evento'])){
            
            //Validación para verificar si el usuario está logeado en el sistema
            if(isset($_SESSION['nombre'])){
                // Creacion de una instancia de la clase eventos
                $obj_eventos= new cls_eventos();
                
                $vector_eventos=explode('-',trim($_POST['id_numeros_de_evento']));
                
                if (sort($vector_eventos,SORT_NUMERIC)){
                    
                    $cadena_eventos=  implode("-", $vector_eventos);                    
                    //Define el atributo de la clase referencia de mezcla
                    $obj_eventos->setReferencia_mezcla($cadena_eventos);
                    
                    //Verifica que no exista esta mezcla en el sistema
                    if ($obj_eventos->existe_esta_mezcla_de_eventos_en_el_sistema()){
                        //Mensaje de notificacion en pantalla
                        echo "NO";
                        exit;
                    }else
                    {
                        $bandera=0;
                        for ($i = 0; $i < count($vector_eventos); $i++) {
                            $obj_eventos->setId($vector_eventos[$i]);
                            if ($obj_eventos->existe_este_evento_en_otra_mezcla()){
                                $bandera=1;
                            }
                        }
                        if ($bandera==0){
                            $obj_eventos->setFecha(date("Y-m-d")); 
                            $obj_eventos->setHora(date("H:i", time()));
                            $obj_eventos->setId_usuario($_SESSION['id']);
                            for ($i = 0; $i < count($vector_eventos); $i++) {
                                $obj_eventos->setId($vector_eventos[$i]);
                                $obj_eventos->guardar_registro_en_mezcla_de_eventos();
                            }
                            echo "";
                            exit;
                        }else{
                            echo "NO";
                            exit;
                        }
                            
                    }
                }else{
                      echo "NO";
                      exit;
                }
                
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida  y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               //Validación para verificar si el usuario está logeado en el sistema
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
           }
           //En caso de que no estén definidos los parámetros, procede a sacarlo del metodo de ejecución.
        }   else   {
            exit;
        }
    }
    
    //Metodo que permite notificar al usuario en pantalla cuando va a ingresar un tipo de evento en un punto bcr que ya se encuentra abierto
    public function agregar_nueva_unidad_de_video(){

        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){

            $obj_unidades_de_video= new cls_unidad_video();
            $obj_unidades_de_video->setCondicion("Mac_Address='00000000000000000' OR Serie='0000000'");                         
            
            if ($obj_unidades_de_video->existe_este_dato_en_la_tabla_unidades_video()){
                echo 'NO';
            }else{
                $obj_unidades_de_video->agregar_nueva_unidad_de_video();
                echo 'SI';
            }
             

        }else {
              /*
         * Esta es la validación contraria a que la sesión de usuario esté definida  y abierta.
         * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
         * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
         * En la última línea llama a la pagina de inicio de sesión.
         */
           $tipo_de_alerta="alert alert-warning";
           $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
           //Validación para verificar si el usuario está logeado en el sistema
           require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
       }
       //En caso de que no estén definidos los parámetros, procede a sacarlo del metodo de ejecución.

    }
    
    
    public function editar_campo_unidades_de_video(){

        //Verifica que los parametros del metodo post estén definidos y hayan sido enviados al metodo
        if(isset($_POST['id_unidad_video']) && (isset($_POST['campo_a_editar'])) && (isset($_POST['valor']))){
            
            //Validación para verificar si el usuario está logeado en el sistema
            if(isset($_SESSION['nombre'])){
                
                $obj_unidades_de_video= new cls_unidad_video();
                $obj_unidades_de_video->setCondicion("ID_Unidad_Video=".$_POST['id_unidad_video']);  
                
                if(($_POST['campo_a_editar']=="Cuadros_Por_Segundo")||($_POST['campo_a_editar']=="Camaras_Habilitadas")||($_POST['campo_a_editar']=="Cantidad_Entradas_Video")||($_POST['campo_a_editar']=="Regulacion")||($_POST['campo_a_editar']=="Calidad")||($_POST['campo_a_editar']=="Version_Software")||($_POST['campo_a_editar']=="Capacidad_Disco_Duro")||($_POST['campo_a_editar']=="Promedio_Dias")){
                    $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor']);
                    $obj_unidades_de_video->actualizar_campo_unidades_de_video();
                    //echo "t_unidadvideo". "Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'] ." ID_Unidad_Video="."_".$_POST['id_unidad_video']."_" ;
                    echo 'SI';
                }
                 if($_POST['campo_a_editar']=="Arranque_Automatico"){
                    $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor']);
                    $obj_unidades_de_video->actualizar_campo_unidades_de_video();
                    //echo "t_unidadvideo". "Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'] ." ID_Unidad_Video="."_".$_POST['id_unidad_video']."_" ;
                    echo 'SI';
                }
                 if($_POST['campo_a_editar']=="Estado"){
                    $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'].",ID_PuntoBCR=0");
                    $obj_unidades_de_video->actualizar_campo_unidades_de_video();
                    //echo "t_unidadvideo". "Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'] ." ID_Unidad_Video="."_".$_POST['id_unidad_video']."_" ;
                    echo 'SI';
                }
                 if($_POST['campo_a_editar']=="ID_PuntoBCR"){
                    $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'].",Estado=0");
                    $obj_unidades_de_video->actualizar_campo_unidades_de_video();
                    //echo "t_unidadvideo". "Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'] ." ID_Unidad_Video="."_".$_POST['id_unidad_video']."_" ;
                    echo 'SI';
                }
                 if(($_POST['campo_a_editar']=="Descripcion")||($_POST['campo_a_editar']=="Observaciones")||($_POST['campo_a_editar']=="Resolucion")){
                    $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."='".$_POST['valor']."'");
                    $obj_unidades_de_video->actualizar_campo_unidades_de_video();
                    //echo "t_unidadvideo". "Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."=".$_POST['valor'] ." ID_Unidad_Video="."_".$_POST['id_unidad_video']."_" ;
                    echo 'SI';
                 }
                 if($_POST['campo_a_editar']=="Mac_Address"){
                    $obj_unidades_de_video->setCondicion("ID_Unidad_Video<>".$_POST['id_unidad_video']." AND Mac_Address='".$_POST['valor']."'");
                    if ($obj_unidades_de_video->existe_este_dato_en_la_tabla_unidades_video()){
                        echo "NO";
                    }else{
                          $obj_unidades_de_video->setCondicion("ID_Unidad_Video=".$_POST['id_unidad_video']);  
                          $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."='".$_POST['valor']."'");
                          $obj_unidades_de_video->actualizar_campo_unidades_de_video();               
                          echo 'SI';
                    }
                  
                 }
                 if($_POST['campo_a_editar']=="Serie"){
                    $obj_unidades_de_video->setCondicion("ID_Unidad_Video<>".$_POST['id_unidad_video']." AND Serie='".$_POST['valor']."'");
                    if ($obj_unidades_de_video->existe_este_dato_en_la_tabla_unidades_video()){
                        echo "NO";
                    }else{
                          $obj_unidades_de_video->setCondicion("ID_Unidad_Video=".$_POST['id_unidad_video']);  
                          $obj_unidades_de_video->setCampos_valores("Fecha_Actualizacion='".date("Y-m-d")."',".$_POST['campo_a_editar']."='".$_POST['valor']."'");
                          $obj_unidades_de_video->actualizar_campo_unidades_de_video();               
                          echo 'SI';
                    }
                  
                 }
                    
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida  y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               //Validación para verificar si el usuario está logeado en el sistema
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
           }
           //En caso de que no estén definidos los parámetros, procede a sacarlo del metodo de ejecución.
        }   else   {
            exit;
        }
    }
    
    //Metodo que permite notificar al usuario en pantalla cuando va a ingresar un tipo de evento en un punto bcr que ya se encuentra abierto
    public function alerta_en_vivo_mismo_punto_bcr_y_evento(){
                
        //Verifica que los parametros del metodo post estén definidos y hayan sido enviados al metodo
        if(isset($_POST['id_punto_bcr'])&& (isset($_POST['id_tipo_evento']))){
            
            //Validación para verificar si el usuario está logeado en el sistema
            if(isset($_SESSION['nombre'])){
            // Creacion de una instancia de la clase eventos
            $obj_eventos= new cls_eventos();
            //Define el atributo de la clase tipo de evento
            $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
            //Define el atributo de la clase punto bcr
            $obj_eventos->setPunto_bcr($_POST['id_punto_bcr']);
                //Verifica que no exista este tipo de evento abierto para este punto bcr
                if ($obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    //Mensaje de notificacion en pantalla
                    echo "Ya existe abierto este tipo de evento para este punto BCR. Proceda a cerrarlo o ingrese un seguimiento!!!";
                    exit;
                }else
                {
                    exit;
                }
            }else {
                  /*
             * Esta es la validación contraria a que la sesión de usuario esté definida  y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
               $tipo_de_alerta="alert alert-warning";
               $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
               //Validación para verificar si el usuario está logeado en el sistema
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
           }
           //En caso de que no estén definidos los parámetros, procede a sacarlo del metodo de ejecución.
        }   else   {
            exit;
        }
    }
   
    //Este metodo permite actualizar en pantalla el listado de eventos de trazabilidad de acuerdo a los 
    //parametros de busqueda suministrados por el usuario de consulta. Entre los parametros se encuentran,
    //nombre de usuario, fecha, tabla, etc.
    public function actualiza_en_vivo_reporte_trazabilidad(){
            //Realiza una pausa de 2 segundos
            sleep(2);       
            //verifica que la variable de sesión nombre esté establecida.
            if(isset($_SESSION['nombre'])){
                //Toma la fecha inicial para establecer los parametros de busqueda
                $fecha_inicial=$_POST['fecha_inicial'];
                //Toma la fecha final para establecer los parametros de busqueda
                $fecha_final=$_POST['fecha_final'];
                //Recibe el usuario en caso de que se haya definido dentro de los parametros de busqueda
                $usuario=$_POST['usuario'];
                //Recibe la tabla de base de datos que se requiere consultar.
                $tabla_afectada=$_POST['tabla'];
                //Estable la sintaxis del sql para definir los parametros de fecha
                $condicion="t_traza.Fecha between '".$fecha_inicial."' AND '".$fecha_final."' ";
                
                /*
                 * verifica si se eligió un usuario en especifico para filtrar la información del reporte.
                 */
                if (!$usuario=="0"){
                    $condicion.="AND t_traza.ID_Usuario=".$usuario." ";
                }
                
                /*
                 * Verifica si se eligió alguna tabla en específico o si por el contrario la búsqueda se realizará sobre todas las tablas
                 */
                if ($tabla_afectada!="todas"){
                    $condicion.="AND t_traza.Tabla_Afectada='".$tabla_afectada."'";
                }
                  
                // Crea un objeto de tipo trazabilidad
                $obj_trazabilidad= new cls_trazabilidad();
                //Establece la condición de búsqueda de registros de trazabilidad
                $obj_trazabilidad->setCondicion($condicion);
                //Ejecuta la sentecia SQL
                $obj_trazabilidad->obtiene_trazabilidad();
                //Asigna el resultado de la búsqueda a una variable de tipo vector
                $params=$obj_trazabilidad->getArreglo();

                //Verifica que hayan resultados
                if (count($params)>0){
                    
                    //Dibuja desde PHP mediante una variable cadena, el resultado de datos en formato HTML que se mostrará en pantalla
                    //Tabla HTML
                    $html="<table id='tabla' class='display2'>";
                    //Cuerpo de la tabla
                    $html.="<thead>";   
                    //Fila
                    $html.="<tr>";
                    //Columnas o cabeceras
                    $html.="<th>ID_Traza</th>";
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Antiguedad Dias</th>";
                    $html.="<th>Usuario</th>";
                    $html.="<th>Tabla Afectada</th>";
                    $html.="<th>Dato Actualizado</th>";
                    $html.="<th>Dato Anterior</th>";
                    //Finaliza la linea
                    $html.="</tr>";
                    //Finalizan las cabeceras
                    $html.="</thead>";
                    
                    //Cuerpo de la tabla
                    $html.="<tbody id='cuerpo'>";
                    //Tamaño del vector de resultados
                    $tam=count($params);
                    //Ciclo que permite recorrer cada registro
                    for ($i = 0; $i <$tam; $i++) {
           
                        //Establece líneas de registros de información
                        $html.="<tr>";
           
                        //Establece una variable fecha para almacenar el campo del vector
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        //Fecha del día
                        $fecha_actual = date_create(date("d-m-Y"));
                        //Establece diferencia en días entre ambas fechas
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        //Pinta cada uno de los campos del vector
                        $html.="<td>".$params[$i]['ID_Traza']."</td>";
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre']." ".$params[$i]['Apellido']."</td>";
                        $html.="<td>".$params[$i]['Tabla_Afectada']."</td>";
                        $html.="<td>".$params[$i]['Dato_Actualizado']."</td>";
                        $html.="<td>".$params[$i]['Dato_Anterior']."</td>";
                        
                        //Cierra la línea
                        $html.="</tr>";
                         }
                    //Cierra el cuerpor la tabla
                    $html.="</tbody>";

                    //Cierra la tabla
                    $html.=" </table>";
                    
                    //Manda a pintar la tabla completa al formulario
                    echo $html;
                    //Sale del metodo de la clase
                    exit;
                    //En caso de que la consulta no devuelva registros, muestra en pantalla un mensaje informativo
                }else{
                    //
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     echo $html;
                     //Sale del metodo de la clase
                     exit;
                }    
                // Imprime el html en pantalla
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
               //Llamada al formulario correspondiente de la vista
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            } 
        
    }
    
    //Muestra en pantalla un reportes de eventos cerrados, de acuerdo a parametros de busqueda específicos, como fecha, sitio, etc.
    public function actualiza_en_vivo_reporte_cerrados(){
        //Espera 2 segundos antes de iniciar la ejecución del método, para mostrar un gift de espera en pantalla
            sleep(2);       
            //Validación para verificar si el usuario está logeado en el sistema
            if(isset($_SESSION['nombre'])){
                //Creación de un nuevo objeto de la clase eventos
                $obj_eventos = new cls_eventos();
                
                //Recibe la fecha inicial del reporte
                $fecha_inicial=$_POST['fecha_inicial'];
                //Recibe la fecha final del reporte
                $fecha_final=$_POST['fecha_final'];
                //Obtiene el id del punto bcr a consultar
                $id_punto_bcr=$_POST['id_punto_bcr'];
                               
                //Establece la condición SQL para definir el rango de fechas del reporte
                $condicion="(T_Evento.Fecha between '".$fecha_inicial."' AND '".$fecha_final."') AND (T_Evento.ID_EstadoEvento=3 OR T_Evento.ID_EstadoEvento=5) AND T_Evento.ID_PuntoBCR=".$id_punto_bcr;
                            
                //Establece la condicion de la consulta
                $obj_eventos->setCondicion($condicion);
                //Obtiene los eventos de acuerdo a la condicion.
                $obj_eventos ->obtiene_todos_los_eventos(); 
                //Obtiene el arreglo de resultados
                $params= $obj_eventos->getArreglo();
                //Define una variable cadena a vacio
                $todos_los_seguimientos_juntos="";
                //Obtiene el tamaño del vector de resultados
                $tamano=count($params);
                
                //Verifica que la consulta haya encontrado algo
                if (count($params)>0){

                    //Bucle que recorre la cantidad de registros de la consulta uno por uno
                    for ($x = 0; $x <$tamano; $x++) {

                        //Esta condicion trae los seguimientos del evento en cuestion, para pintarlos ocultos en el HTML
                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();

                        //Verifica que la consulta haya traido resultados
                        if(count($obj_eventos->getArreglo())>0){
                            if ($x==0){
                                //Va concatenando los resultados de la consulta de seguimientos, en una variable 
                                $todos_los_seguimientos_juntos=$obj_eventos->getArreglo();
        //                     
                            }else{
                                //En caso de que ya tenga datos, adjunta el vector con lo que tenga actualmente
                                $todos_los_seguimientos_juntos = array_merge($todos_los_seguimientos_juntos,$obj_eventos->getArreglo());
        //                      
                            }
                        }
                        //Obtiene la fecha y usuario del ultimo seguimiento que tenga el evento
                        $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$params[$x]['ID_Evento']." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc limit 0,1");
                        //Obtiene los seguimientos del evento seleccionado, si los hubiere
                        $obj_eventos->obtiene_detalle_evento();
                        //Obtiene los datos del ultimo seguimiento asociado
                        $ultimo_seguimiento_asociado= $obj_eventos->getArreglo();


                        //Verifica si existen seguimientos asociados al evento actual
                        if(count($ultimo_seguimiento_asociado)>0){
                            if ($x==0){
                                //Agrega el resultado de la consulta a una variable específica
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]);
        //                     
                            }else{
                                //En caso de que la variable ya contenga datos, procede a concatenar el resultado obtenido
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"Fecha: ".date_format(date_create($ultimo_seguimiento_asociado[0]['Fecha']), 'd/m/Y').".Hora: ".$ultimo_seguimiento_asociado[0]['Hora'].". ".$ultimo_seguimiento_asociado[0]['Detalle']]+['Usuario'=>$ultimo_seguimiento_asociado[0]['Nombre_Usuario']." ".$ultimo_seguimiento_asociado[0]['Apellido']]));
        //                      
                            }
                        }else{
                            //En caso de que no existan registros, agrega la validación correspondiente y un mensaje informativo al respecto para el usuario
                            if ($x==0){
                                $detalle_y_ultimo_usuario= array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]);
                            }else{
                             //En caso de que la variable ya contenga información, procede a concatenar el vector de resultados
                                $detalle_y_ultimo_usuario = array_merge($detalle_y_ultimo_usuario,array(['Detalle'=>"No hay seguimientos asociados a este evento. Para agregar uno oprima el link:'Gestionar Seguimiento de la fila respectiva.'"]+['Usuario'=>$params[$x]['Nombre_Usuario']." ".$params[$x]['Apellido']]));
                            }
                        }   
                        
                    }
                }
                //verifica que hayan resultados en la consulta, para empezar a pintar la tabla HTML que se mostrará en pantalla al formulario
                if (count($params)>0){
                    
                    //Creación de la tabla
                    $html="<table id='tabla' class='display2'>";
                    //Creación de la cabecera de la tabla
                    $html.="<thead>";
                    //Creación de la fila de títulos de la tabla
                    $html.="<tr>";
                    //Columna id evento, la cual está oculta en la tabla
                    $html.="<th hidden='true'>ID_Evento</th>";
                    //Resto de columnas de la tabla, de acuerdo a lo requerido en la consulta SQL
                    $html.="<th>Fecha</th>";
                    $html.="<th>Hora</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Codigo</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Cerrado Por</th>";
                    //Dependiendo del rol del usuario en cuestión, mostrará el botón de gestión de los eventos.
                    if ($_SESSION['modulos']['Recuperar Eventos Cerrados']==1){  
                        $html.="<th>Gestión</th>";
                    }
                    //Resto de columnas
                    $html.="<th>Consulta</th>";
                    //Columna para agregar la tabla de seguimientos de cada evento
                    $html.="<th hidden='true'>Seguimientos</th> ";
                    //termina la fila de cabeceras
                    $html.="</tr>";
                    //termina la cabecera de la tabla
                    $html.="</thead>";
                    
                    //Inicializa el cuerpo de la tabla
                    $html.="<tbody id='cuerpo'>";
                    //Retorna el tamaño del vector que almacena la consulta sql
                    $tam=count($params);
                    
                    //Vector que recorre registro por registros de la consulta SQL
                    for ($i = 0; $i <$tam; $i++) {
           
                        //Agrega a la fila de cada evento, un comentario interno con el detalle del último seguimiento
                        $html.="<tr data-toggle='tooltip' title='".$detalle_y_ultimo_usuario[$i]['Detalle']."'>";
           
                        //Establece la fecha del evento
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        //Establece la fecha actual
                        $fecha_actual = date_create(date("d-m-Y"));
                        //Establece la diferencia en dias entre ambas fechas
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        //Pinta y oculta el id del evento 
                        $html.="<td hidden='true'>".$params[$i]['ID_Evento']."</td>";
                        //Pinta las columnas correspondientes al reporte de eventos
                        $html.="<td>".date_format($fecha_evento, 'd/m/Y')."</td>";   
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Codigo']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";       
                        //Muestra el último usuario que realizó seguimiento en el evento
                        $html.="<td>".$detalle_y_ultimo_usuario[$i]['Usuario']."</td>";
                        
                        //Dependiendo del rol del usuario, muestra en pantalla la opción de recuperar eventos
                        if ($_SESSION['modulos']['Recuperar Eventos Cerrados']==1){  
                            //Asigna la función de javascript que ejecuta la recuperación en vivo del evento, para que sea reabierto
                            $html.="<td align='center'><a onclick='recuperar_evento(".$params[$i]['ID_Evento'].",".$params[$i]['ID_PuntoBCR'].",".$params[$i]['ID_Tipo_Evento'].")'>Recuperar Evento</a></td>";
                        }   
                        //Link para ver el detalle de un evento
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_cerrados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        
                        //Saca el tamaño del vector que tiene todos los seguimientos de los eventos
                        $tama=count($todos_los_seguimientos_juntos);
                        //Inicializa la variable cadena
                        $cadena="";
                        //Bucle que recorre el vector de seguimientos
                        for ($j = 0; $j <$tama; $j++) {
                        
                            //Extrae la fecha del evento
                            $fecha_evento = date_create($todos_los_seguimientos_juntos[$j]['Fecha']);
                            //Extrae la fecha actual
                            $fecha_actual = date_create(date("d-m-Y"));
                            // Define los días abiertos que tiene el evento
                            $dias_abierto= date_diff($fecha_evento, $fecha_actual);
                            //extrae los seguimiento por cada evento, y los concatena en una variable para colocarlos en una de las columnas de la tabla
                            if ($params[$i]['ID_Evento']==$todos_los_seguimientos_juntos[$j]['ID_Evento']){
                                //va concatenando cada seguimiento en una variable
                               $cadena.=date_format($fecha_evento, 'd/m/Y')." ".$todos_los_seguimientos_juntos[$j]['Detalle']."\n";
                            }
                        }
                        //Esconde y pinta la columna correspondiente
                        $html.="<td hidden='true'>".$cadena."</td>";

                        //Cierra la fila del registro del evento en cuestión.
                        $html.="</tr>";
                    }

                    //Finaliza el cuerpo de la tabla
                    $html.="</tbody>";

                    //Culmina la tabla
                    $html.=" </table>";
                    
                    //Imprime en pantalla el codigo html estructurado en este metodo
                    echo $html;
                    //Sale del metodo
                    exit;
                }else{
                    //En caso de que no hayan resultados, muestra la información correspondiente.
                     $html="<h4>No se encontraron eventos para este filtro.</h4>";
                     //Imprime la variable html
                     echo $html;
                     //Sale del metodo
                     exit;
                }    
                //Imprime la variable html y sale del metodo
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
               //Llamada al formulario correspondiente de la vista
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
    }
    
    //Metodo utilizado desde javascript para el pintado de eventos relacionados a un sitio bcr, en el momento de ingresar un nuevo
    //evento de bitacora digital. Esto con el fin de que el usuario pueda valorar la historia de un sitio antes de ingresar la información.
    public function dibuja_tabla_eventos_relacionados_a_punto_bcr(){
                
       //valida si fue enviado el id del punto bcr mediante el evento post del formulario html
       if(isset($_POST['id_punto_bcr'])){
            //Validación para verificar si el usuario está logeado en el sistema
            if(isset($_SESSION['nombre'])){
                //Creacion de una instancia de la clase eventos
                $obj_eventos= new cls_eventos();
                //Establece la condición de búsqueda de acuerdo al id del sitio.
                $obj_eventos->setCondicion("T_Evento.ID_PuntoBCR=".$_POST['id_punto_bcr']);
                //ejecuta la sentencia SQL
                $obj_eventos->obtiene_todos_los_eventos();
                //Obtiene el resultado en una variable 
                $params=$obj_eventos->getArreglo();

                //Verifica si la consulta produjo resultados
                if (count($params)>0){
                    
                    //Establece La cabecera de la tabla
                    $html="<thead>";   
                    //Linea de los titulos de las columnas
                    $html.="<tr>";
                    //Columna fecha 
                    $html.="<th align='center'>Fecha</th>";
                    //Definición de las columnas de la tabla de acuerdo a la consulta SQL
                    $html.="<th>Hora</th>";
                    $html.="<th>Lapso</th>";
                    $html.="<th>Provincia</th>";
                    $html.="<th>Tipo Punto</th>";
                    $html.="<th>Punto BCR</th>";
                    $html.="<th>Tipo de Evento</th>";
                    $html.="<th>Estado del Evento</th>";
                    $html.="<th>Ingresado Por</th>";
                    $html.="<th>Consulta</th>";
                    //Cierra la fila
                    $html.="</tr>";
                    // Cierre de las cabeceras
                    $html.="</thead>";
                    //Cierre del cuerpo de la tabla
                    $html.="<tbody>";
                    
                    //Obtiene el tamaño de la variable parametros que almacena la consulta
                    $tam=count($params);

                    //Bucle que permite recorrer el vector que almacena la consulta de registros.
                    for ($i = 0; $i <$tam; $i++) {
           
                        //Creacion de una nueva linea en la tabla
                        $html.="<tr>";
           
                        //Campos de fecha dentro de la tabla
                        $fecha_evento = date_create($params[$i]['Fecha']);
                        $fecha_actual = date_create(date("d-m-Y"));
                        //Diferencia de dias entre una fecha y otra
                        $dias_abierto= date_diff($fecha_evento, $fecha_actual);
            
                        //Definición de los campos de la tabla, con respecto al vector que almacena los datos.
                        $html.="<td align='center'>".date_format($fecha_evento, 'd/m/Y')."</td>";
                        $html.="<td>".$params[$i]['Hora']."</td>";
                        $html.="<td align='center'>".$dias_abierto->format('%a')."</td>";
                        $html.="<td>".$params[$i]['Nombre_Provincia']."</td>";
                        $html.="<td>".$params[$i]['Tipo_Punto']."</td>";
                        $html.="<td>".$params[$i]['Nombre']."</td>";
                        $html.="<td>".$params[$i]['Evento']."</td>";
                        $html.="<td>".$params[$i]['Estado_Evento']."</td>";
                        $html.="<td>".$params[$i]['Nombre_Usuario']." ".$params[$i]['Apellido']."</td>";
                        //Link que muestra el detalle de los eventos
                        $html.="<td align='center'><a href='index.php?ctl=frm_eventos_editar&accion=consulta_relacionados&id=".$params[$i]['ID_Evento']."'>Ver detalle</a></td>";
                        //Culmina la linea  de datos
                        $html.="</tr>";
                         }
                    //Culmina el cuerpo de la tabla
                    $html.="</tbody>";
                    
                    //Imprime en pantalla el html construido
                    echo $html;
                    //sale del metodo
                    exit;
                }else{
                    // En caso de que no hayan resultados, muestra en pantalla la información
                     $html="<h4>No se encontraron eventos para este sitio.</h4>";
                     //Imprime la variable html construida
                     echo $html;
                     //Sale del metodo
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
               //Llamada al formulario correspondiente de la vista
               require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
            }
        }else
        {
            //Imprime nulo en caso de no cumplir con las validaciones  de id correspondientes
            echo "";
            //Sale del metodo
            exit;
        }     
    }
    
    //Metodo que permite eliminar una imagen del padron fotografico de puntos BCR
    public function eliminar_imagen_padron_puntobcr(){
      //Validación para verificar si el usuario está logeado en el sistema  
        if(isset($_SESSION['nombre'])){
            //Creacion de una instancia de la clase padron fotografico
            $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
            //Verifica que el envión de información haya sido realizado mediante el metodo post )formulario HTML)
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Busca el registro correspondiente mediante el id llave de la tabla
                $obj_padron_fotografico->setCondicion("ID_padron_puntobcr=".$_POST['id_imagen']);
                //Ejecuta el metodo que obtiene las imagenes correspondientes
                $obj_padron_fotografico->obtener_imagenes_puntosbcr();
                //Obtiene el arreglo correspondiente
                $params=$obj_padron_fotografico->getArreglo();
                //Elimina la imagen de la base de datos
                $obj_padron_fotografico->eliminar_imagen_puntobcr();
                
                //Obtiene la ruta del directorio raiz de oriel mediante la variable reservada correspondiente
                $raiz=$_SERVER['DOCUMENT_ROOT'];
    
                //Formatea la ruta para verificar si tiene la cantidad adecuada de /
                if (substr($raiz,-1)!="/"){
                    $raiz.="/";
                }

                //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/20161110111422Entrada Principal.jpg";
               //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/".$_POST['ruta_imagen'];
                //Establece la ruta completa de la imagen, incluyendo el nombre y la extensión de la misma
                $ruta=  $raiz."Padron_Fotografico_Puntos_BCR/".$params[0]['Nombre_Ruta'];
                
               //Borra el archivo fisico del disco duro
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite eliminar una imagen del padron fotografico de puntos BCR
    public function eliminar_imagen_padron_unidades_de_video(){
      //Validación para verificar si el usuario está logeado en el sistema  
        if(isset($_SESSION['nombre'])){
            //Creacion de una instancia de la clase padron fotografico
            $obj_padron_fotografico= new cls_padron_fotografico_unidades_de_video();
            //Verifica que el envión de información haya sido realizado mediante el metodo post )formulario HTML)
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Busca el registro correspondiente mediante el id llave de la tabla
                $obj_padron_fotografico->setCondicion("ID_Padron_Unidad_Video=".$_POST['id_imagen']);
                //Ejecuta el metodo que obtiene las imagenes correspondientes
                $obj_padron_fotografico->obtener_imagenes_unidades_de_video();
                //Obtiene el arreglo correspondiente
                $params=$obj_padron_fotografico->getArreglo();
                //Elimina la imagen de la base de datos
                $obj_padron_fotografico->eliminar_imagen_unidad_de_video();
                
                //Obtiene la ruta del directorio raiz de oriel mediante la variable reservada correspondiente
                $raiz=$_SERVER['DOCUMENT_ROOT'];
    
                //Formatea la ruta para verificar si tiene la cantidad adecuada de /
                if (substr($raiz,-1)!="/"){
                    $raiz.="/";
                }

                //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/20161110111422Entrada Principal.jpg";
               //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/".$_POST['ruta_imagen'];
                //Establece la ruta completa de la imagen, incluyendo el nombre y la extensión de la misma
                $ruta=  $raiz."Padron_Fotografico_Unidades_Video/".$params[0]['Nombre_Ruta'];
                
               //Borra el archivo fisico del disco duro
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite recuperar un evento en estado cerrado o abierto por error.
    public function frm_eventos_recuperar(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Crea una instancia de la clase eventos
            $obj_eventos= new cls_eventos();
            //Verifica que el envio de datos se haya realizado mediante el metodo post de html
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                //Establece los atributos del objeto evento, con la información del formulario HTML
                $obj_eventos->setFecha(date("Y-m-d")); 
                $obj_eventos->setHora(date("H:i", time()));
                $obj_eventos->setTipo_evento($_POST['id_tipo_evento']);
                $obj_eventos->setPunto_bcr($_POST['id_puntobcr']);
                $obj_eventos->setEstado_evento("1");
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
                  
                //Verifica si el evento no está abierto para proceder con el tramite 
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                   //Agrega un detalle para registrar el procedimiento mediante un seguimiento al evento
                    $obj_eventos->setDetalle("Evento re-abierto (recuperado) por ".$_SESSION['name']." ".$_SESSION['apellido']);
                    //Estable el id a cero para agregar un nuevo seguimiento
                    $obj_eventos->setId2(0);
                    $obj_eventos->setId($_POST['id_evento']);
                    $obj_eventos->edita_estado_evento("1");
                    $obj_eventos->setAdjunto("N/A");
                    //Inserta en bd un nuevo seguimiento
                    $obj_eventos->ingresar_seguimiento_evento();  
                    //Llama a la pantalla del listado de eventos cerrados
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_lista_cerrados");
                    //Devuelve un cero en la variable de impresión para javascript, para validar lo que se hizo en el metodo
                    echo "0";
                    
                }else{
                   //Devuelve un uno en la variable de impresión para javascript, para validar lo que se hizo en el metodo
                    echo "1";
                    //Sale del metodo de la clase.
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
            //Validación para verificar si el usuario está logeado en el sistema
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite recuperar un evento en estado cerrado o abierto por error.
    public function eliminar_mezcla_eventos_bitacora(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Crea una instancia de la clase eventos
            $obj_eventos= new cls_eventos();
            //Verifica que el envio de datos se haya realizado mediante el metodo post de html
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                //Establece los atributos del objeto evento, con la información del formulario HTML
               
                $obj_eventos->setCondicion("Referencia_Mezcla='".$_POST['referencia']."'");
                $obj_eventos->eliminar_mezcla_del_sistema();

                //Devuelve un cero en la variable de impresión para javascript, para validar lo que se hizo en el metodo
                echo "0";
                    
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
            //Validación para verificar si el usuario está logeado en el sistema
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo que permite guardar un nuevo evento de bitacora digital
    public function guardar_evento(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Creacion de una instancia de la clase eventos
            $obj_eventos= new cls_eventos();
            //Verifica que la información enviada sea por medio del metodo post de html
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Formatea la fecha, para definir este atributo correctamente en el objeto de la clase.
                $fecha_seguimiento = strtotime($_POST['fecha']);
                $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);

                //Validaciones de la fecha ingresada para el evento, caso negativo muestra una advertencia en pantalla
                if ($fecha_seguimiento >  date("Y-m-d")){
                    //Muestra modal en pantalla
                    echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                    //Sale del metodo
                    exit();
                    //Verifica que la fecha sea de hoy
                }if($fecha_seguimiento == date("Y-m-d")){
                     $hora_seguimiento = strtotime($_POST['hora']);
                     $hora_seguimiento = date("H:i", $hora_seguimiento);

                     //Valida que no se ingresen eventos en tiempo futuro
                     if ($hora_seguimiento >  date("H:i", time())){
                         //Muestra mensaje en pantalla para advertir al usuario
                        echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                        //Sale del metodo
                        exit();
                     }
                }
                //Establece los atributos de la clase para el ingreso del evento
                $obj_eventos->setFecha($_POST['fecha']); 
                $obj_eventos->setHora($_POST['hora']);
                $obj_eventos->setTipo_evento($_POST['tipo_evento']);
                $obj_eventos->setProvincia($_POST['nombre_provincia']); 
                $obj_eventos->setTipo_punto($_POST['tipo_punto']); 
                $obj_eventos->setPunto_bcr($_POST['punto_bcr']);
                $obj_eventos->setEstado_evento($_POST['estado_evento']);
                $obj_eventos->setId_usuario($_SESSION['id']);
                $obj_eventos->setEstado(1);
               
                //Verifica que no exista este tipo de evento abierto para este punto BCR
                if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                    //Ingresa el evento mediante el metodo de la clase
                    $obj_eventos->ingresar_evento();
                   
                    //Si el evento trae algun seguimiento procede a guardarlo tambien
                    if(isset($_POST['seguimiento'])&&($_POST['seguimiento']!="")){
                       //Establece los atributos de la clase, con la información que viene desde el formulario
                       $obj_eventos->setDetalle($_POST['seguimiento']);
                       $obj_eventos->setId2(0);
                       //Obtiene el id del ultimo seguimiento para incluirlo en el nuevo
                       $obj_eventos->obtiene_id_ultimo_evento_ingresado(); 
                       //Establece el id correspondiente
                       $obj_eventos->setId($obj_eventos->getId_ultimo_evento_ingresado());
                       $obj_eventos->setAdjunto("N/A");
                       //Ingresa el seguimiento
                       $obj_eventos->ingresar_seguimiento_evento();  
                       //echo "3 guarda seguimiento";
                    }
                    //Llama al listado principal de eventos abiertos o pendientes
                    header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
                }else{
                    //Alerta al usuario en pantalla mediante un modal de que este tipo de evento ya está abierto para este punto bcr
                    echo "<script type=\"text/javascript\">alert('Ya existe este evento abierto para este punto BCR. Proceda a cerrarlo o agregue un seguimiento!!!');history.go(-1);</script>";
                    //Sale del metodo
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
            //Validación para verificar si el usuario está logeado en el sistema
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Permite agregar un seguimiento para un evento o cerrar uno
    public function frm_eventos_editar(){
        //Validación para verificar si el usuario está logeado en el sistema
        if(isset($_SESSION['nombre'])){
            //Controlador de errores
            try {
                //Obtiene el id del evento en cuestión mediante el metodo post del url
                $ide=$_GET['id'];
                //Crea una instancia de la clase eventos
                $obj_eventos = new cls_eventos();
                //Establece la condición para buscar la información del evento en la tabla de bd
                $obj_eventos->setCondicion("ID_Evento=$ide");
                
                $obj_eventos->obtener_informacion_general_de_la_mezcla();
                $vector_informacion_general_mezcla=$obj_eventos->getArreglo();
           
                //Obtiene el evento que se muesta en la ventana
                $obj_eventos->obtiene_todos_los_eventos();
                //Obtiene el arreglo de resultados
                $params= $obj_eventos->getArreglo();
                                
                $obj_eventos->setCondicion("Referencia_Mezcla='".$vector_informacion_general_mezcla[0]['Referencia_Mezcla']."'");
                $obj_eventos->obtener_listado_de_eventos_de_una_mezcla();
                $vector_listado_eventos_mezclados=$obj_eventos->getArreglo();
       
                //Verifica que haya traido la información correspondiente
                if (count($params)>0){
                    // Toma el estado del evento
                     $estado_evento=$params[0]['Estado_Evento']; 
                     //Establece el tipo de evento
                     $obj_eventos->setTipo_evento($params[0]['ID_Tipo_Evento']);
                     //Obtiene la prioridad del evento en cuestión
                     $prioridad_evento=$obj_eventos->obtiene_prioridad_de_tipo_de_evento();
                     
                }
                
                $condicion_seguimientos="";
                if ($vector_informacion_general_mezcla!=null){
                    $tam=count($vector_listado_eventos_mezclados);
                    
                     for ($i = 0; $i <$tam; $i++) {
                         if (strlen($condicion_seguimientos)!=0){
                             $condicion_seguimientos=$condicion_seguimientos." or ";
                         }
                         $condicion_seguimientos=$condicion_seguimientos."T_DetalleEvento.ID_Evento=".$vector_listado_eventos_mezclados[$i]['ID_Evento'];
                     }
                    
                }else{
                        $condicion_seguimientos="T_DetalleEvento.ID_Evento=".$ide;
                     }
                
               //Obtiene los seguimientos del evento
                $obj_eventos->setCondicion($condicion_seguimientos." order by T_DetalleEvento.Fecha desc,T_DetalleEvento.Hora desc");
                //Obtiene los detalles del evento seleccionado
                $obj_eventos->obtiene_detalle_evento();
                //Asigna el resultado a un vector
                $detalleEvento= $obj_eventos->getArreglo();
                //Obtiene los diferentes seguimientos
                $obj_eventos->obtener_seguimientos();
                //Obtiene el estado del evento
                $estadoEventos = $obj_eventos->getArreglo();
                //Llamada al formulario correspondiente de la vista
                
                $condicion_eventos="";
                if ($vector_informacion_general_mezcla!=null){
                    $tam=count($vector_listado_eventos_mezclados);
                    
                     for ($i = 0; $i <$tam; $i++) {
                         if (strlen($condicion_eventos)!=0){
                             $condicion_eventos=$condicion_eventos." or ";
                         }
                         $condicion_eventos=$condicion_eventos."ID_Evento=".$vector_listado_eventos_mezclados[$i]['ID_Evento'];
                     }
                    
                }else{
                    $condicion_eventos="ID_Evento=".$ide;
                }
               
                //Obtiene los seguimientos del evento
                $obj_eventos->setCondicion($condicion_eventos." order by T_Evento.Fecha desc,T_Evento.Hora desc");
                //Obtiene el evento que se muesta en la ventana
                $obj_eventos->obtiene_todos_los_eventos();
                //Obtiene el arreglo de resultados
                $params2= $obj_eventos->getArreglo();
                
                require __DIR__ . '/../vistas/plantillas/frm_eventos_editar.php';
                //Controlador de errores.
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Metodo de la clase que permite contar los ingresos a puntos bcr publico.
    public function cuenta_visitas_a_puntos_bcr_publico(){
        
           //Extrae el directorio raiz del proyecto oriel
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
           //Obtiene la hora actual
            $time = time();

            //Formatea la ruta de acceso al proyecto oriel
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            //Establece la ruta completa para almacenar mediantes archivos de texto el ingreso y el uso de las funcionalidades del sistema oriel
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Puntos_BCR/".date("Ymd", $time)." Visitas_a_Puntos_BCR_Publico.txt";
            
            //Abre el archivo del día y en caso de que no exista lo crea en la carpeta correspondiente.
            $fp = fopen($ruta,"a+");
            //Cierra el archivo
            fclose($fp);
            
            //Obtiene la ip del equipo remoto que está utilizando Oriel
            $ip = $_SERVER['REMOTE_ADDR'];
            //Obtiene el nombre del equipo remoto que está utilizando Oriel
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            //Concatena la ip con el nombre de la maquina.
            $ip=$ip."-->".$nombre_host;
            
            //Variable bandera para verificar si ya esta registrada la ip y el nombre de la maquina
            $existe = 0;
            //Vector para recorrer la información del archivo txt
            $visitas = array();
                       
            //Abre el archivo correspondente
            $fp = fopen($ruta,"r"); 
            //La variable establecida a vacio
            $ips="";
           
            //Recorre el archivo y concatena la información de cada registro en una variable
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            //Cierra el archivo
            fclose($fp);
            
            //Define una cadena a vacio
            $cadena_de_direcciones="";
            //Cuenta las visitas realizadas
            $total_visitas=0;
            //Verifica que la variable ips tenga información
            if (strlen($ips)>0){
                //Convierte la cadena en un vector de información
                $total_direcciones=  explode(",", $ips); 
                
                //Recorre el vector y va contando las visitas que han habido durante el día
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    $total_visitas++;
                    //Cadena que almacena todas las direcciones que se encuentran en el archivo
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //incrementa la variable que cuenta las visitas
                $total_visitas++;
                //Agrega a la cadena de direcciones, la ip actual 
                $cadena_de_direcciones.=$ip.",";
                //Abre el archivo para escribirle datos
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo la cadena correspondiente y borra antes lo que tenga
                fwrite($fp, $cadena_de_direcciones);
                //Cierra el archivo
                fclose($fp);
            //Si el archivo no contiene datos, procede a escribir la información actual solamente
            }else{
                //Abre el archivo
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //escribe la información de la ip en el archivo
                fwrite($fp, $ip.",");
                //Incrementa las visitas
                $total_visitas++;
                //Cierra el archivo
                fclose($fp);
            }        
            //Establece la ruta nuevamente para localizar el archivo
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Puntos_BCR/".date("Ymd", $time)." Total_de_Visitas_Puntos_BCR_Publico.txt";
            
            //Abre el archivo para escrirle información
            $fp = fopen($ruta,"w+");

            //Escribe el summary final de las visitas
            fwrite($fp, "Total de consultas a la tabla puntos BCR desde la parte publica ".date("Ymd", $time).":".$total_visitas);
            //Cierra el archivo
            fclose($fp);

    }
    
    //Metodo de la clase que permite contar las visitas a puntos bcr area limitada por nombre de usuario y contraseña.
    public function cuenta_visitas_a_puntos_bcr_privado(){
        
           // Extrae el directorio raiz del proyecto ORIEL
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
           //Extrae la hora actual
            $time = time();

            //Formatea el directorio raiz del proyecto ORIEL con los \ necesarios
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            //Arma la ruta completa del archivo que registrara las visitas a la consulta privada de puntos BCR
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Puntos_BCR/".date("Ymd", $time)." Visitas_a_Puntos_BCR_Privado.txt";
            
            //Abre el archivo, en caso de que no lo encuentre lo crea
            $fp = fopen($ruta,"a+");
            //Lo cierra
            fclose($fp);
            
            //Obtiene la ip de la maquina cliente que está usando ORIEL
            $ip = $_SERVER['REMOTE_ADDR'];
            //Obtiene nombre del equipo cliente que está usando ORIEL
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            //Concatena ip con el nombre del equipo
            $ip=$ip."-->".$nombre_host;
            
            //Variable bandera que verifica si la ip ya se encuentra registrada
            $existe = 0;
            //Vector que almacena todas las visitas a la funcionalidad
            $visitas = array();
                       
            //Abre el archivo en modo lectura
            $fp = fopen($ruta,"r"); 
            //Inicializa la variable cadena
            $ips="";
           
            //Recorre las lineas  del archivo, siempre y cuando tenga
            while($ip2 = fgets($fp)){
                //Concatena la información en la variable correspondiente
                $ips .= $ip2;
               
            }
            
            //Cierra el archivo
            fclose($fp);
            
            //inicializa la variable cadena
            $cadena_de_direcciones="";
            //Inicializa la variable entera
            $total_visitas=0;
            //Verifica que la variable ips tenga información,
            if (strlen($ips)>0){
                //Obtiene mediante la funcion explode, un vector a partir de la cadena
                $total_direcciones=  explode(",", $ips); 
                
                //Recorre el vector de datos
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    //Incrementa la variable de visitas a la funcionalidad
                    $total_visitas++;
                    //Concatena la información del vector en una variable de tipo cadena
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //Incrementa la variable con la visita actual
                $total_visitas++;
                //Concatena el contenido del archivo con la nueva información de la visita
                $cadena_de_direcciones.=$ip.",";
                //Abre el archivo para escritura nueva y borrado del contenido actual
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo
                fwrite($fp, $cadena_de_direcciones);
                //Cierra el archivo
                fclose($fp);
            }else{
                //Abre el archivo en modo escritura nueva
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe la dirección ip actual en el archivo
                fwrite($fp, $ip.",");
                //incrementa la variable visitas
                $total_visitas++;
                //Cierra el archivo
                fclose($fp);
            }        

            //Establece nuevamente la ruta del archivo
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Puntos_BCR/".date("Ymd", $time)." Total_de_Visitas_Puntos_BCR_Privado.txt";
            //Lo abre en modo escritura que agregue a lo actual
            $fp = fopen($ruta,"w+");
            // Escribe un summary del total de visitas al final del archivo
            fwrite($fp, "Total de consultas a la tabla puntos BCR desde la parte privada ".date("Ymd", $time).":".$total_visitas);
            //Cierra el archivo
            fclose($fp);

    }
    
    //Metodo que permite contar todas las visitas del dia que se hacen al modulo de bitacora digital de ORIEL
    public function cuenta_visitas_a_bitacora_digital(){
        
        // Obtiene la raiz del directorio donde esta localizado oriel
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
           //Obtiene la hora actual
            $time = time();

            //Formatea la ruta del directorio raiz
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            //Crea la ruta con el nombre del archivo para registro de las visitas
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Bitacora_Digital/".date("Ymd", $time)." Visitas_a_Bitacora_Digital.txt";
            
            //Abre el archivo, si no existe lo crea
            $fp = fopen($ruta,"a+");
            //Cierra el archivo
            fclose($fp);
            
            //Obtiene la direccion ip del cliente que está utilizando el modulo
            $ip = $_SERVER['REMOTE_ADDR'];
            //Obtiene el nombre del equipo
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            // Concatena la direccion ip con el nombre del equipo cliente
            $ip=$ip."-->".$nombre_host;
            
            //variable bandera que permite verificar si el equipo ya utilizó la funcionalidad en este día
            $existe = 0;
            //Vector que permite almacenar todas las visitas registradas en el archivo de texto plano
            $visitas = array();
                    
            //Abre el archivo en modo lectura
            $fp = fopen($ruta,"r"); 
            //Inicializa a vacio la variable ips
            $ips="";
           
            //Recorre cada uno de los registros contenidos en el archivo y los pasa a una variable
            while($ip2 = fgets($fp)){
                //Va concatenando el contenido del archivo en una variable
                $ips .= $ip2;
               
            }
            
            //Cierra el archivo
            fclose($fp);
            
            //Variable inicializada en vacio 
            $cadena_de_direcciones="";
            //Cuenta las visitas realizadas al modulo
            $total_visitas=0;
            //Verifica que haya información para evaluar
            if (strlen($ips)>0){
                //Convierte el contenido de la variable ips en un vector para administrarlo
                $total_direcciones=  explode(",", $ips); 
                
                //Recorre el vector para contar el total de visitas y la cantidad de direcciones registradas en el archivo
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    //Incrementa la variable de visitas
                    $total_visitas++;
                    //Concatena cada una de las direcciones que encuentra en el vector
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //Incrementa la variable total de visitas con la visita actual 
                $total_visitas++;
                //Le agrega a la variable la direccion ip actual
                $cadena_de_direcciones.=$ip.",";
                //Abre el archivo en modo escritura borrando lo que actualmente tiene
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo el contenido actualizado
                fwrite($fp, $cadena_de_direcciones);
                //Cierre el archivo
                fclose($fp);
            }else{
                //En caso de que el archivo no contenga nada, abre y escribe directamente en el archivo
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo
                fwrite($fp, $ip.",");
                //Incrementa la variable que lleva el total de visitas
                $total_visitas++;
                //Cierra el archivo correspondiente
                fclose($fp);
            }        

            //Establece la ruta para crear el archivo que resume el total de visitas
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Bitacora_Digital/".date("Ymd", $time)." Total_de_Visitas_Bitacora_Digital.txt";
            
            //Abre el archivo y borra el contenido
            $fp = fopen($ruta,"w+");

            //Escribe el resumen general con el total de consultas
            fwrite($fp, "Total de consultas a la tabla bitacora digital ".date("Ymd", $time).":".$total_visitas);
            //Cierra el archivo
            fclose($fp);

    }
    
    //Metodo que permite registrar las visitas al modulo de personal privado de ORIEL
    public function cuenta_visitas_a_personal_privado(){
        
        //Obtiene la ruta del directorio raiz del proyecto ORIEL
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             
           //Obtiene la hora actual
            $time = time();

            //Formatea la ruta 
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            
            //Define la ruta completa del archivo que almacenará la información de las visitas a la consulta privada de personal
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Personal/".date("Ymd", $time)." Visitas_a_Personal_Privado.txt";
            
            //Abre el archivo, en caso de que no exista lo crea
            $fp = fopen($ruta,"a+");
            //Cierra el archivo
            fclose($fp);
            
            //Obtiene la ip remota del cliente que esta usando el modulo
            $ip = $_SERVER['REMOTE_ADDR'];
            //Obtiene el nombre del equipo remoto que accede al modulo
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            //Concatena la ip con el nombre de la maquina
            $ip=$ip."-->".$nombre_host;
            
            //Variable bandera para controlar si el equipo ya ingresó durante el día a la funcionalidad
            $existe = 0;
            //Crea un arreglo que almacenará todas las visitas 
            $visitas = array();
                 
            //Abre el archivo en modo lectura
            $fp = fopen($ruta,"r"); 
            //Inicializa la variable bandera
            $ips="";
           
            //Recorre la información del archivo y la concatena en una variable
            while($ip2 = fgets($fp)){
                $ips .= $ip2;
               
            }
            
            //Cierra el archivo
            fclose($fp);
            
            //Inicializa la variable que almacena las direcciones de visitas
           $cadena_de_direcciones="";
           //Inicializa la variable que cuenta visitas
            $total_visitas=0;
            //Verifica si el archivo tiene información
            if (strlen($ips)>0){
                //A la variable le asigna el vector de visitas al modulo
                $total_direcciones=  explode(",", $ips); 
                
                //Recorre el vector y va incrementando el contador de visitas al modulo
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    //Incrementa la variable
                    $total_visitas++;
                    //Concatena la información de cada visita en una variable tipo cadena
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //Incrementa la variable de visitas con la visita actual
                $total_visitas++;
                //Agrega a la variable la información del cliente que visito el modulo
                $cadena_de_direcciones.=$ip.",";
                //Abre el archivo en modo escritura y limpia lo que tenga
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo la información contenida en la variable correspondiente
                fwrite($fp, $cadena_de_direcciones);
                //Cierra el archivo
                fclose($fp);
            
            // En caso de  no tener información, escribe la información actual del cliente que visita el modulo
            }else{
                //Abre el archivo
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe la información en el archivo
                fwrite($fp, $ip.",");
                //Incrementa la variable de visitas
                $total_visitas++;
                //Cierra el archivo
                fclose($fp);
            }        
            //Crea el archivo que contiene el total general de visitas al modulo
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Privada_Personal/".date("Ymd", $time)." Total_de_Visitas_Personal_Privado.txt";
            //Abre el archivo para escribirle 
            $fp = fopen($ruta,"w+");
            //Escribe la información correspondiente en el archivo
            fwrite($fp, "Total de consultas a la tabla personal desde la parte privada ".date("Ymd", $time).":".$total_visitas);
            //Cierra el archivo
            fclose($fp);

    }
    
    //Modulo del sistema que permite contar  la cantidad de veces que se utiliza el área de consulta de personal en vista publica
    public function cuenta_visitas_a_personal_publico(){
           //Obitne el directorio raiz donde está alojado el proyecto ORIEL
           $raiz=$_SERVER['DOCUMENT_ROOT'];
             //Obtiene la hora actual del sistema
            $time = time();
            //Formatea la ruta del proyecto ORIEL
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            //Establece la ruta del archivo txt que almacenará la información de las visitas
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Personal/".date("Ymd", $time)." Visitas_a_Personal_Publico.txt";
            //Abre el archivo 
            $fp = fopen($ruta,"a+");
            //Cierra el archivo
            fclose($fp);
            //Obtiene la dirección ip del cliente que está utilizando el modulo
            $ip = $_SERVER['REMOTE_ADDR'];
            //Obtiene el nombre del equipo del cliente que está usando el modulo
            $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            //Concatena la direccion ip con el nombre del equipo
            $ip=$ip."-->".$nombre_host;
            //Variable bandera que controla si la visita ya se ha realizado anteriormente durante el día
            $existe = 0;
            //Vector que almacena las visitas de todos los clientes durante el día
            $visitas = array();
            //Abre el archivo en modo lectura           
            $fp = fopen($ruta,"r"); 
            //Inicializa la variable a vacio
            $ips="";
           
            //Recorre el archivo para sacar todas las visitas realizadas durante el día.
            while($ip2 = fgets($fp)){
                //Concatena la información que se  va leyendo una variable tipo cadena
                $ips .= $ip2;
               
            }
            //Cierra el archivo
            fclose($fp);
            //Inicializa la variable cadena a vacio
            $cadena_de_direcciones="";
            //Inicializa la variable de cantidad de visitas
            $total_visitas=0;
            //Verifica que haya información en el archivo
            if (strlen($ips)>0){
                //Convierte la información en un vector
                $total_direcciones=  explode(",", $ips); 
                // Recorre la información del vector 
                for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                    //Va incrementando la variable que cuenta las visitas
                    $total_visitas++;
                    //Toma la información de cada visita en una variable cadena
                    $cadena_de_direcciones.=$total_direcciones[$i].",";
                }
                //Incrementa la variable visitas con la visita actual
                $total_visitas++;
                //Concatena la información de la visita actual a la variable contenedora
                $cadena_de_direcciones.=$ip.",";
                //Abre el archivo para escribirle 
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo
                fwrite($fp, $cadena_de_direcciones);
                //Cierra el archivo
                fclose($fp);
            }else{
                //En caso de que no haya información en el archivo, escribe el dato actual
                $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                //Escribe en el archivo
                fwrite($fp, $ip.",");
                //Incrementa la variable cuenta visitas
                $total_visitas++;
                //Cierra el archivo
                fclose($fp);
            }        
             
            //Establece la ruta del archivo que lleva el total general de visitas al modulo
            $ruta=  $raiz."Cuenta_Visitas_Oriel/Consulta_Publica_Personal/".date("Ymd", $time)." Total_de_Visitas_Personal_Publico.txt";
            //Abre el archivo en modo escritura.
            $fp = fopen($ruta,"w+");
            //Escribe la información correspondiente en el archivo
            fwrite($fp, "Total de consultas a la tabla personal desde la parte publica ".date("Ymd", $time).":".$total_visitas);
            //Cierra el archivo
            fclose($fp);

    }
    
    //Metodo que permite registrar el conteo de visitas al sitio web ORIEL
    public function cuenta_visitas_a_la_pagina(){
        //Obtiene el directorio raiz donde se encuentra localizado el proyecto ORIEL
        $raiz=$_SERVER['DOCUMENT_ROOT'];
             
        //Obtiene la hora actual del sistema
        $time = time();

        //Formatea la ruta del directorio raiz del proyecto ORIEL
        if (substr($raiz,-1)!="/"){
            $raiz.="/";
        }
        //Establece la ruta del archivo txt que lleva el control de visitas  a la pagina
        $ruta=  $raiz."Cuenta_Visitas_Oriel/Ingreso_al_Sitio/".date("Ymd", $time)." Visitas_al_Sitio.txt";
            
        //Abre el archivo , lo crea si no lo encuentra
        $fp = fopen($ruta,"a+");
        //Cierra el archivo
        fclose($fp);
          
        //Obtiene la direccion ip del cliente que está utilizando el modulo
        $ip = $_SERVER['REMOTE_ADDR'];
        //Obtiene el nombre del equipo cliente desde donde se está utilizando el modulo
        $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        //Concatena la direccion ip en conjunto con el nombre del equipo
        $ip=$ip."-->".$nombre_host;
        //Variable bandera que permite determinar si una visita ya fue realizada durante el dia
        $existe = 0;
        //Arreglo que permite almacenar las direcciones de los equipos que visitaron el sistema durante el día actual
        $visitas = array();
        //Abre el archivo en solo lectura           
        $fp = fopen($ruta,"r"); 
        //Variable cadena que se inicializa en vacio
        $ips="";
        //Recorre los registros contenidos en el archivo
        while($ip2 = fgets($fp)){
            //Concatena en una variable cada uno de los registros del archivo
            $ips .= $ip2;
        }
        //Cierra el archivo
        fclose($fp);
        //Variable bandera que permite determinar si el cliente ya visitó el día de hoy el módulo
        $bandera=0;
        //Inicializa la variable cadena a vacio
        $cadena_de_direcciones="";
        //Inicializa la variable de conteo de visitas
        $total_visitas=0;
        //Verifica que haya información en el archivo
        if (strlen($ips)>0){
            //Asigna a la variable, un vector con todas las visitas realizadas al sitio
            $total_direcciones=  explode(",", $ips); 
            //Recorre el vector de visitas
            for ($i = 0; $i < count($total_direcciones)-1; $i++) {
                // Verifica si la información contenida en el archivo concuerda con la información del cliente actual que está visitando el modulo
                if ($ip==$total_direcciones[$i]){
                    //En caso de encontrarla, cambia el valor de la variable bandera
                    $bandera=1;
                }else{
                    //Incrementa la variable visitas
                    $total_visitas++;
                }
                //Agrega la información de la posicion actual del vector, a la variable que almacena toda la información.
                $cadena_de_direcciones.=$total_direcciones[$i].",";
            }
            // En caso de que no haya información en el archivo, procede a escribir la información del cliente actual
        }else{
            //Abre el archivo en modo escritura y borra la información que tenga.
            $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
            //Escribe la información en el archivo
            fwrite($fp, $ip);
            //Cierra el archivo
            fclose($fp);
        }        
         
        //Si la bandera es cero, procede a escribir en el archivo la información del cliente actual que visia el modulo
        if($bandera == 0){
            //Incrementa la variable que cuenta las visitas totales
            $total_visitas++;
            //Agrega la información del cliente a la variable actual
            $cadena_de_direcciones.=$ip.",";
            //Abre el archivo en modo escritura agregando al final del archivo
            $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
            //Escribe en el archivo
            fwrite($fp, $cadena_de_direcciones);
            //Cierra el archivo
            fclose($fp);
            }else{
                //Incrementa el total de visitas realizadas al sitio
                $total_visitas++;
            }
            //Establece la ruta del archivo que lleva el total de visitas al sitio
        $ruta=  $raiz."Cuenta_Visitas_Oriel/Ingreso_al_Sitio/".date("Ymd", $time)." Total_de_Visitas_al_Sitio.txt";
        //Abre el archivo en modo escritura
        $fp = fopen($ruta,"w+");
        //Escribe la información en el archivo
        fwrite($fp, "Total de visitas registradas el día ".date("Ymd", $time).":".$total_visitas);
        //Cierra el archivo
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
            //Llamada al  formulario de la vista.
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function frm_puntos_bcr_padron_fotografico(){
        if(isset($_SESSION['nombre'])){
            
            if (isset($_GET['id'])){
                //Trae las capturas de un punto bcr 
                $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
                $obj_padron_fotografico->setCondicion("ID_PuntoBCR=".$_GET['id']); 
                $obj_padron_fotografico->obtener_imagenes_puntosbcr();
                $params=$obj_padron_fotografico->getArreglo();
               
                //Trae las capturas de dia y noche de los grabadores de video instalados en la oficina de nicoya
                $obj_padron_fotografico_unidades=new cls_padron_fotografico_unidades_de_video();
                $obj_padron_fotografico_unidades->setCondicion("t_puntobcr.ID_PuntoBCR=".$_GET['id']);
                $obj_padron_fotografico_unidades->obtener_imagenes_unidades_de_video_desde_punto_bcr();
                $params_unidades=$obj_padron_fotografico_unidades->getArreglo();
               
                $obj_puntobcr=new cls_puntosBCR();
                $obj_puntobcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$_GET['id']);
                $obj_puntobcr->obtiene_todos_los_puntos_bcr();
                $params_puntobcr=$obj_puntobcr->getArreglo();
                
                //echo '<pre>';
                //print_r($params_puntobcr);
                //echo '</pre>';
                
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
    
    public function frm_unidades_de_video_padron_fotografico(){
        if(isset($_SESSION['nombre'])){  
            if (isset($_GET['id'])){
                $obj_padron_fotografico= new cls_padron_fotografico_unidades_de_video();
                $obj_padron_fotografico->setCondicion("ID_Unidad_Video=".$_GET['id']); 
                $obj_padron_fotografico->obtener_imagenes_unidades_de_video();
                $params=$obj_padron_fotografico->getArreglo();
               
            }else{
                echo "<script type=\"text/javascript\">alert('Se presentó un error inesperado, por favor vuelva a seleccionar el punto BCR');history.go(-1);</script>";;
                exit();
            }
            
            require __DIR__ . '/../vistas/plantillas/frm_unidades_de_video_padron_fotografico.php';
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
    
    public function guardar_imagen_unidades_de_video(){
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
              
               if (!(isset($_POST['id_unidad_video']))){
                
                exit();
              }
              
              $nombre_imagen= str_replace('"','',str_replace("'","",$_POST['Nombre']));
              $categoria=$_POST['Categoria'];
              $descripcion=str_replace("'","",$_POST['Descripcion']);
              $id_unidad_video=$_POST['id_unidad_video'];
              
              
              //Validación de informacion en detalle de evento, elimina algunos caracteres especiales
              
              $descripcion= str_replace("'","",$descripcion);
              $descripcion= str_replace('"','',$descripcion);


            //Obtiene el mensaje de verificacion del envio del archivo
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];

              
            $obj_padron_fotografico = new cls_padron_fotografico_unidades_de_video();
            $obj_padron_fotografico->setId_unidad_video($id_unidad_video);
            $obj_padron_fotografico->setNombre_imagen($nombre_imagen);

            //Asigna el atributo descripcion
            $obj_padron_fotografico->setDescripcion($descripcion);
            //Asigna el atributo categoria

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
            
            $ruta=  str_replace('"','',str_replace("'","",$raiz."Padron_Fotografico_Unidades_Video/".Encrypter::quitar_tildes($id_unidad_video."-".$result."-".$_FILES['archivo_adjunto']['name'])));
                      
            $nombre_ruta=str_replace('"','',str_replace("'","",Encrypter::quitar_tildes($id_unidad_video."-".$result."-".$_FILES['archivo_adjunto']['name'])));
            
            
            switch ($recepcion_archivo) {
                case 0:{
                    if ((basename($_FILES['archivo_adjunto']['type'])==="jpeg")||(basename($_FILES['archivo_adjunto']['type'])==="gif")||(basename($_FILES['archivo_adjunto']['type'])==="png")||(basename($_FILES['archivo_adjunto']['type'])==="bmp")||(basename($_FILES['archivo_adjunto']['type'])==="tiff")||(basename($_FILES['archivo_adjunto']['type'])==="jpg")){
                        if (move_uploaded_file($_FILES['archivo_adjunto']['tmp_name'], $ruta)){
                            $obj_padron_fotografico->setNombre_ruta(Encrypter::quitar_tildes($nombre_ruta));
                            $obj_padron_fotografico->setFormato(basename($_FILES['archivo_adjunto']['type']));
                            $obj_padron_fotografico->setCondicion("");
                            $obj_padron_fotografico->guardar_imagen_unidad_de_video();
                            header ("location:/ORIEL/index.php?ctl=frm_unidades_de_video_padron_fotografico&id=".$obj_padron_fotografico->getId_unidad_video());
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


            //Obtiene el mensaje de verificacion del envio del archivo
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];

              
            $obj_padron_fotografico = new cls_padron_fotografico_puntosbcr();
            $obj_padron_fotografico->setId_puntobcr($id_punto_bcr);
            $obj_padron_fotografico->setNombre_imagen($nombre_imagen);

            //Asigna el atributo descripcion
            $obj_padron_fotografico->setDescripcion($descripcion);
            //Asigna el atributo categoria

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
    
    public function ejecucion_automatico_proceso($proceso){
        //Obtiene el directorio raiz donde se encuentra localizado el proyecto ORIEL
        $raiz=$_SERVER['DOCUMENT_ROOT'];
        //Obtiene la hora actual del sistema
        $time = time();
        //Formatea la ruta del directorio raiz del proyecto ORIEL
        if (substr($raiz,-1)!="/"){
            $raiz.="/";
        }
        switch ($proceso) {
            case "Oficiales":
                $ruta=  $raiz."Cuenta_Visitas_Oriel/Ejecucion_Procesos/".date("Ymd", $time)." Revision_Oficiales.txt";
                if(!file_exists($ruta)){
                    //Abre el archivo , lo crea si no lo encuentra
                    $fp = fopen($ruta,"a+");
                    //Cierra el archivo
                    fclose($fp);

                    $obj_personal=new cls_personal_externo();
                    $fecha_actual= getdate();
                    $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];

                    $obj_personal->setCondicion("(Fecha_Vencimiento_Portacion<'".$fecha_actual."' AND Fecha_Vencimiento_Portacion<> '0000-00-00' AND Validado=1 ) "
                            . "OR (Fecha_Vencimiento_Residencia<'".$fecha_actual."' AND Fecha_Vencimiento_Residencia<>'0000-00-00' AND Validado=1) "
                            . "OR (Fecha_Salida<'".$fecha_actual."' AND Fecha_Salida<>'0000-00-00' AND Validado=1)");
                    $obj_personal->obtiene_todo_el_personal_externo();
                    $params= $obj_personal->getArreglo();

                    $obj_personal->invalidar_personas_automatico();

                    $cadena_oficiales="";
                    // Recorre la información del vector 
                    for ($i = 0; $i < count($params); $i++) {
                        //Toma la información de cada visita en una variable cadena
                        $cadena_oficiales.='Identificacion: '.$params[$i]['Identificacion'].",";
                    }
                    //Abre el archivo para escribirle 
                    $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                    //Escribe en el archivo
                    fwrite($fp, $cadena_oficiales);
                    //Cierra el archivo
                    fclose($fp);
                    //echo ($cadena_oficiales);
                }
                break;
            case "Pruebas":
                if(date("H:i:s", $time)>='21:00:00' && date("H:i:s", $time)<='22:00:00'){
                    $ruta=  $raiz."Cuenta_Visitas_Oriel/Ejecucion_Procesos/".date("Ymd", $time)." Incosistencia_Pruebas.txt";
                    if(!file_exists($ruta)){
                        //Abre el archivo , lo crea si no lo encuentra
                        $fp = fopen($ruta,"a+");
                        //Cierra el archivo
                        fclose($fp);

                        $obj_prueba = new cls_prueba_alarma();
                        $obj_eventos = new cls_eventos();
                        //Busca información de apertura posiblemente incorrectas
                        $obj_prueba->setCondicion("T_PruebaAlarma.Fecha='".date("Y-m-d")."' AND ((Hora_Apertura_Alarma>='00:00:00' AND Hora_Apertura_Alarma<='04:00:00') OR (Hora_Apertura_Alarma>='15:00:00' AND Hora_Apertura_Alarma<='23:59:00'))");
                        $obj_prueba->obtener_prueba_alarma();
                        $inconsistencia_apertura= $obj_prueba->getArreglo();

                        //Busca información de cierre posiblemente incorrectas
                        $obj_prueba->setCondicion("T_PruebaAlarma.Fecha='".date("Y-m-d")."' AND ((Hora_Cierre_Alarma>='00:00:00' AND Hora_Cierre_Alarma<='11:00:00'))");
                        $obj_prueba->obtener_prueba_alarma();
                        $inconsistencia_cierre= $obj_prueba->getArreglo();

                        //Busca información de apertura posiblemente incorrectas
                        $obj_prueba->setCondicion("T_PruebaAlarma.Fecha='".date("Y-m-d")."' AND ((Hora_Prueba_Alarma>='00:00:00' AND Hora_Prueba_Alarma<='04:00:00') OR (Hora_Prueba_Alarma>='15:00:00' AND Hora_Prueba_Alarma<='23:59:00'))");
                        $obj_prueba->obtener_prueba_alarma();
                        $inconsistencia_prueba= $obj_prueba->getArreglo();

                        //Busca pruebas de alarma 
                        $obj_prueba->setCondicion("T_PruebaAlarma.Fecha='".date("Y-m-d")."' AND (Numero_Zona_Prueba='0') OR (Numero_Zona_Prueba>'999')");
                        $obj_prueba->obtener_prueba_alarma();
                        $inconsistencia_zona= $obj_prueba->getArreglo();
                        
                        $cadena_incosistencias=" A continuación se detallan Puntos BCR con inconsistencias para revisión... \r\n";
                        if(count($inconsistencia_apertura)>0){
                            $cadena_incosistencias.=" Hora de apertura de alarma: \r\n";
                            // Recorre la información del vector 
                            for ($i = 0; $i < count($inconsistencia_apertura); $i++) {
                                //Toma la información de cada visita en una variable cadena
                                $cadena_incosistencias.="->".$inconsistencia_apertura[$i]['Nombre'].", apertura reportada: ".$inconsistencia_apertura[$i]['Hora_Apertura_Alarma']."\r\n";
                            }
                        }
                        if(count($inconsistencia_cierre)>0){
                            $cadena_incosistencias.="// \r\n Hora de cierre de alarma: \r\n";
                            for ($i = 0; $i < count($inconsistencia_cierre); $i++) {
                                //Toma la información de cada visita en una variable cadena
                                $cadena_incosistencias.="->".$inconsistencia_cierre[$i]['Nombre'].", Cierre reportada: ".$inconsistencia_cierre[$i]['Hora_Cierre_Alarma']."\r\n";
                            }
                        }
                        if(count($inconsistencia_prueba)>0){
                            $cadena_incosistencias.="// \r\n Hora de prueba de alarma: \r\n";
                            for ($i = 0; $i < count($inconsistencia_prueba); $i++) {
                                //Toma la información de cada visita en una variable cadena
                                $cadena_incosistencias.="->".$inconsistencia_prueba[$i]['Nombre'].", Hora prueba: ".$inconsistencia_prueba[$i]['Hora_Prueba_Alarma']."\r\n";
                            }
                        }
                        if(count($inconsistencia_zona)>0){
                            $cadena_incosistencias.="// \r\n Número de zona: \r\n";
                            for ($i = 0; $i < count($inconsistencia_zona); $i++) {
                                //Toma la información de cada visita en una variable cadena
                                $cadena_incosistencias.="->".$inconsistencia_zona[$i]['Nombre'].", Zona reportada: ".$inconsistencia_zona[$i]['Numero_Zona_Prueba']."\r\n";
                            }
                        }
                        //Abre el archivo para escribirle 
                        $fp = fopen($ruta,"w+"); //no olvidar crear al archivo visitantes.txt y poner el path correcto
                        //Escribe en el archivo
                        fwrite($fp, $cadena_incosistencias);
                        //Cierra el archivo
                        fclose($fp);
                        //echo ($cadena_oficiales);
                        //echo strlen($cadena_incosistencias);
                        if (strlen($cadena_incosistencias)>90){
                            //Establece los atributos de la clase para el ingreso del evento
                            $obj_eventos->setFecha(date("Ymd", $time)); 
                            $obj_eventos->setHora("21:00:00");
                            $obj_eventos->setTipo_evento('37');
                            $obj_eventos->setProvincia('1'); 
                            $obj_eventos->setTipo_punto('6'); 
                            $obj_eventos->setPunto_bcr('914');
                            $obj_eventos->setEstado_evento('1');
                            $obj_eventos->setId_usuario('82');
                            $obj_eventos->setEstado(1);

                            //Verifica que no exista este tipo de evento abierto para este punto BCR
                            if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                                //Ingresa el evento mediante el metodo de la clase
                                $obj_eventos->ingresar_evento();

                                //Establece los atributos del seguimiento del evento de Z1
                                $obj_eventos->setDetalle($cadena_incosistencias);
                                $obj_eventos->setId2(0);
                                //Obtiene el id del ultimo seguimiento para incluirlo en el nuevo
                                $obj_eventos->obtiene_id_ultimo_evento_ingresado(); 
                                //Establece el id correspondiente
                                $obj_eventos->setId($obj_eventos->getId_ultimo_evento_ingresado());
                                $obj_eventos->setAdjunto("N/A");
                                //Ingresa el seguimiento
                                $obj_eventos->ingresar_seguimiento_evento(); 
                            }else{
                                $obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio();
                                $id_evento= $obj_eventos->getArreglo();
                                $obj_eventos->setDetalle($cadena_incosistencias);
                                $obj_eventos->setId2(0);
                                $obj_eventos->setId($id_evento[0]['ID_Evento']);
                                $obj_eventos->setAdjunto("N/A");
                                //Ingresa el seguimiento
                                $obj_eventos->ingresar_seguimiento_evento();  
                            }
                        }
                    }
                }
                break;
                    
         }
        //Establece la ruta del archivo txt que lleva el control de visitas  a la pagina
       
        
    }
    
    /////////////////////////////////////////////////////////////////////////////
    ///Metodos relacionados del area de Tipos de Evento de Seguridad del Sistema//
    /////////////////////////////////////////////////////////////////////////////

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
       
    
     public function unidades_de_video_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_unidad_video=new cls_unidad_video();
            $obj_puntos = new cls_puntosBCR();
            $obj_unidad_video->obtiene_todas_las_unidades_de_video();
            $params= $obj_unidad_video->getArreglo();
            //Obtiene los puntos BCR
            
            $obj_puntos->obtiene_todos_los_puntos_bcr();
            $puntosbcr = $obj_puntos->getArreglo();
            
            $obj_puntos->setCondicion("T_PuntoBCR.Estado=1 AND not T_PuntoBCR.ID_PuntoBCR In (Select ID_PuntoBCR From t_unidadvideo)");
            $obj_puntos->obtiene_todos_los_puntos_bcr();
            $puntosbcr_sin_video=$obj_puntos->getArreglo();
           
            require __DIR__ . '/../vistas/plantillas/frm_unidades_de_video_listar.php';
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
    //Metodos relacionados del area de Empresas de Seguridad del Sistema
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
            $obj_empresa = new cls_empresa();
            $obj_personal= new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_ue = new cls_unidad_ejecutora();
            if ($_GET['id']==0){
                $empresa[0]['ID_Empresa'] = 0;
                $empresa[0]['Empresa'] ="";
                $empresa[0]['Observaciones'] ="";
                $empresa[0]['Estado'] ="";
                $empresa[0]['Cedula_Juridica'] ="";
                $empresa[0]['ID_Persona_Externa'] ="";
                $empresa[0]['Telefono_Empresa'] ="";
                $empresa[0]['Direccion'] ="";
                $empresa[0]['Tipo_Empresa'] ="";
                $empresa[0]['ID_Unidad_Ejecutora'] ="";
                $empresa[0]['ID_Persona'] ="";
                $empresa[0]['Fecha_Inicio'] ="";
                $empresa[0]['Fecha_Final'] ="";
                $empresa[0]['Nombre_Externo'] ="";
                $empresa[0]['Apellido_Externo'] ="";
                $empresa[0]['Apellido_Nombre'] ="";
                $empresa[0]['Departamento'] ="";
            }   else   {
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa='".$_GET['id']."'");
                $obj_empresa->obtiene_todas_las_empresas();
                $empresa= $obj_empresa->getArreglo();
                $obj_externo->setCondicion("T_PersonalExterno.ID_Empresa=".$empresa[0]['ID_Empresa']);
            } 
            
            //Obtiene todo el personal BCR
            $obj_personal->obtiene_todo_el_personal();
            $personal_bcr = $obj_personal->getArreglo();
            
            //Obtiene todo el personal externo
            $obj_externo->obtiene_todo_el_personal_externo();
            $personal_externo = $obj_externo->getArreglo();
            
            //Obtiene las Unidades Ejecutoras
            $obj_ue->obtener_unidades_ejecutoras();
            $unidad_ejecutora = $obj_ue->getArreglo();
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
                $obj_empresas->setCedula_juridica($_POST['cedula_juridica']);
                $obj_empresas->setId_externo($_POST['ID_Personal_Externo']);
                $obj_empresas->setTelefono($_POST['telefono_empresa']);
                $obj_empresas->setDireccion($_POST['direccion']);
                $obj_empresas->setTipo_empresa($_POST['tipo_empresa']);
                $obj_empresas->setId_ue($_POST['ID_Unidad_Ejecutora']);
                $obj_empresas->setId_persona($_POST['ID_Persona']);
                $obj_empresas->setFecha_inicio($_POST['fecha_inicio']);
                $obj_empresas->setFecha_final($_POST['fecha_final']);
                
               
                $obj_empresas->guardar_empresa();
                //header ("location:/ORIEL/index.php?ctl=empresas_listar");
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
                        if($tam>$i && $tam-1<>$i){
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
                $obj_horario->setCondicion("ID_Horario='".$params[0]['ID_Horario']."' OR ID_Horario='".$params[0]['ID_Horario_Apertura']."'");
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
    
    //Metodo que permite actualizar en tiempo real la lista de cantones
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
    //Metodo que permite actualizar en tiempo real la lista de puntos bcr
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
                $obj_Puntobcr->sethoraslaborales("");

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
                $obj_telefono->setId($_POST['ID_Telefono']);
                $obj_telefono->setId2($_POST['ID_PuntoBCR']);
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                $obj_telefono->setNumero($_POST['numero_telefono']);
                $obj_telefono->setObservaciones($_POST['observaciones_telefono']);
                if($_POST['ID_Telefono']==0){
                    $obj_telefono->setCondicion("");
                }   else {
                    $obj_telefono->setCondicion("ID_Telefono='".$_POST['ID_Telefono']."'");
                }
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
            //Paramatros para crear nueva Dirección IP
            $obj_direccion_ip->setId($_POST['ID_Direccion_IP']);
            $obj_direccion_ip->setTipo_IP($_POST['tipo_ip']);
            $obj_direccion_ip->setDireccionIP($_POST['direccion_ip']);
            $obj_direccion_ip->setObservaciones($_POST['observaciones_ip']);
            
            if($_POST['ID_Direccion_IP']==0){
                $obj_direccion_ip->setCondicion("");
            } else {
                $obj_direccion_ip->setCondicion("ID_Direccion_IP=".$_POST['ID_Direccion_IP']);
            }
            $obj_direccion_ip->agregar_direccion_ip();
            
            $nueva_ip= $obj_direccion_ip->getArreglo();
            
            //Asigna dirección IP al puntoBCR
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
            if($_POST['tipo_horario']=="Público"){
                $obj_horario->setEstado("0");
            } else{
                $obj_horario->setEstado("1");
            }
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
            if($_POST['tipo_horario']=="Público"){
                $obj_horario->setEstado("0");
            } else{
                $obj_horario->setEstado("1");
            }
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
    
    public function enlace_guardar(){
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
            
            header("location:/ORIEL/index.php?ctl=enlace_reporte");
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
    /////////////////////////MANTENIMIENTO DE PERSONAL//////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function personal_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal();
            $obj_personal->obtiene_todo_el_personal_modulo_personas();
            $personas= $obj_personal->getArreglo();
           // echo "<pre>";
            //print_r($personas);
            //echo "</pre>";
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
            echo ($_POST['Tipo_Area_Apoyo']);
            $obj_area_apoyo->setDistrito($_POST['distrito2']);
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

            //Establece la condicion para buscar si el area de apoyo ya está asignada al punto bcr
            $obj_area_apoyo->setCondicion("T_PuntoBCRAreaApoyo.ID_PuntoBCR='".$_POST['ID_PuntoBCR']."' AND T_PuntoBCRAreaApoyo.ID_Area_Apoyo='".$area_apoyo[0]['ID_Area_Apoyo']."'");
            //Ejecuta la consulta sobre la bd

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

    //Metodo que permite listar las direcciones ip registradas en la base de datos

    public function direcciones_ip_listar(){
       if(isset($_SESSION['nombre'])){
            $obj_direcciones=new cls_direccionIP();
            $obj_direcciones->setCondicion("");
            $obj_direcciones->obtiene_direccionesIP();
            $params= $obj_direcciones->getArreglo();
            $obj_direcciones->obtiene_tipo_direcciones_ip();
            $tipo_IP = $obj_direcciones->getArreglo();
            
            
            require __DIR__ . '/../vistas/plantillas/frm_direcciones_ip_listar.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function direcciones_ip_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_tipo_ip = new cls_direccionIP();
               $obj_tipo_ip->setTipo_IP($_POST['nombre']);
               $obj_tipo_ip->setDireccionIP($_POST['numero']); 
               $obj_tipo_ip->setObservaciones($_POST['observaciones']);
               
              if ($_POST['ID_Direccion_IP']==0){
                   $obj_tipo_ip->agregar_direccion_ip();
                }else{
                           $obj_tipo_ip->setCondicion("ID_Direccion_IP='".$_POST['ID_Direccion_IP']."'");
                           $obj_tipo_ip->edita_ip();
                }       
                   
           $obj_tipo_ip->setCondicion("");    
           $obj_tipo_ip->obtiene_direccionesIP();
           $params =$obj_tipo_ip->getArreglo();
           require __DIR__.'/../vistas/plantillas/frm_direcciones_ip_listar.php';
        }else {
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
                $params[0]['Hora_Apertura_Domingo']="";
                $params[0]['Hora_Cierre_Domingo']="";
                $params[0]['Hora_Apertura_Lunes']="";
                $params[0]['Hora_Cierre_Lunes']="";
                $params[0]['Hora_Apertura_Martes']="";
                $params[0]['Hora_Cierre_Martes']="";
                $params[0]['Hora_Apertura_Miercoles']="";
                $params[0]['Hora_Cierre_Miercoles']="";
                $params[0]['Hora_Apertura_Jueves']="";
                $params[0]['Hora_Cierre_Jueves']="";
                $params[0]['Hora_Apertura_Viernes']="";
                $params[0]['Hora_Cierre_Viernes']="";
                $params[0]['Hora_Apertura_Sabado']="";
                $params[0]['Hora_Cierre_Sabado']="";
                $params[0]['Observaciones']="";
                $params[0]['Tipo_Horario']="";
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
            $obj_horario->setTipo_horario($_POST['tipo_horario']);
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
    ///////////////////////Funciones de Unidades Ejecutoras/////////////////////          
    ////////////////////////////////////////////////////////////////////////////
    public function unidad_ejecutora_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_unidad_ejecutora = new cls_unidad_ejecutora();
           $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
           $params =$obj_unidad_ejecutora->getArreglo();
           
            require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function unidad_ejecutora_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_unidad_ejecutora = new cls_unidad_ejecutora();
               $obj_unidad_ejecutora->setDepartamento($_POST['nombre']);
               $obj_unidad_ejecutora->setNumero_ue($_POST['numero']); 
               $obj_unidad_ejecutora->setObservaciones($_POST['observaciones']);
               
                if ($_POST['ID_Unidad_Ejecutora']==0){
                   $obj_unidad_ejecutora->setEstado(1);
                   $obj_unidad_ejecutora->agregar_nueva_ue();
                }else{
                           $obj_unidad_ejecutora->setEstado($_POST['estado']);
                           $obj_unidad_ejecutora->setCondicion("ID_Unidad_Ejecutora='".$_POST['ID_Unidad_Ejecutora']."'");
                           $obj_unidad_ejecutora->edita_ue();
                   
                }       
           $obj_unidad_ejecutora->setCondicion("");    
           $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
           $params =$obj_unidad_ejecutora->getArreglo();
           require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function unidad_ejecutora_cambiar_estado() {
       if(isset($_SESSION['nombre'])){
           $obj_unidad_ejecutora = new cls_unidad_ejecutora();
           
           if ($_GET['estado']==1){
               
               $obj_unidad_ejecutora->setEstado("0");
               
           }else {
               
               $obj_unidad_ejecutora->setestado("1");
           }
           $obj_unidad_ejecutora->setCondicion("ID_Unidad_Ejecutora='".$_GET['id']."'");
           $obj_unidad_ejecutora->cambiar_estado_ue();
           $obj_unidad_ejecutora->setCondicion("");    
           $obj_unidad_ejecutora->obtener_unidades_ejecutoras();
           $params =$obj_unidad_ejecutora->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_unidad_ejecutora_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }

    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Funciones de CENCON /////////////////////////////////          
    ////////////////////////////////////////////////////////////////////////////
    //Funcion para cargar el catálogo Cencon.
    //Carga información de Personal BCR, Personal Externo y PuntosBCR
    public function cencon_gestion(){
        if(isset($_SESSION['nombre'])){
            //Crea lo objetos necesarios para cargar la información 
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_puntos = new cls_puntosBCR();
            $obj_cencon = new cls_cencon();
            
            //Obtiene todo el personal BCR
            $obj_personal->setCondicion("T_Personal.Estado=1");
            $obj_personal->obtiene_todo_el_personal();
            $personal_bcr = $obj_personal->getArreglo();
            
            //Obtiene todo el personal externo
            $obj_externo->setCondicion("T_PersonalExterno.ID_Estado_Persona=1");
            $obj_externo->obtiene_todo_el_personal_externo();
            $personal_externo = $obj_externo->getArreglo();
            
            //Obtiene los puntos BCR que sean tipo ATM
            $obj_puntos->setCondicion("(T_Puntobcr.ID_Tipo_Punto=2 OR T_Puntobcr.ID_Tipo_Punto=3 OR T_Puntobcr.ID_Tipo_Punto=4 OR T_Puntobcr.ID_Tipo_Punto=8) AND T_PuntoBCR.Estado=1");
            $obj_puntos->obtiene_todos_los_puntos_bcr();
            $puntosbcr = $obj_puntos->getArreglo();
            
            unset($obj_cencon); 
            unset($obj_personal);
            unset($obj_externo);
            unset($obj_puntos);
            
            require __DIR__.'/../vistas/plantillas/frm_cencon_gestion.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Permiter crear una realación entre un Punto BCR y una persona
    public function cencon_agregar_relacion(){
        if(isset($_SESSION['nombre'])){
            //Crea lo objetos necesarios para cargar la información 
            $obj_cencon = new cls_cencon();
            
            $obj_cencon->setEmpresa($_POST['empresa']);
            //Obtiene la información de los cajeros de la persona
            $obj_cencon->setCondicion("T_Cencon.Cedula_Cencon='".$_POST['cedula']."'");
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
            
            //Obtiene la cantidad de cajeros que tiene la persona
            $tamaño = count($cajeros);
            $validar=0;
            //recorre la lista de cajeros para ver si tiene el cajero en el vector
            for($i=0; $i<$tamaño;$i++){
                //Si encuentra el cajero en la lista asigna 1
                if($cajeros[$i]['ID_PuntoBCR']==$_POST['id_atm']){
                    $validar=1;
                }
            }
            //si es 0 la persona no tiene acceso al cajero
            if($validar==0){
                //Estable los parametros para agregar la relación
                $obj_cencon->setId($_POST['id_atm']);
                $obj_cencon->setId2($_POST['id_persona']);
                $obj_cencon->setCedula($_POST['cedula']);
                $obj_cencon->setEmpresa($_POST['empresa']);
                //Agrega la relación del cajero con la persona
                $obj_cencon->setCondicion("");
                $obj_cencon->agregar_relacion();
            }
            //Obtiene nuevamente la información de los cajeros de la persona
            $obj_cencon->setCondicion("T_Cencon.Cedula_Cencon='".$_POST['cedula']."'");
            $obj_cencon->setEmpresa($_POST['empresa']);
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
           
            //Procedimiento para crear la tabla y enviarla al html
            $tam = count($cajeros);
            $html="";
            $html.='<thead> 
                            <th style="text-align:center">Número ATM</th>
                            <th style="text-align:center">Nombre de ATM</th>
                            <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Opciones</th>
                        </thead>
                        <tbody>';
            for($i=0; $i<$tam;$i++){
                $html .='<tr>'; 
                $html .='<td style="text-align:center">'.$cajeros[$i]['Codigo'].'</td>';
                $html .='<td style="text-align:center">'.$cajeros[$i]['Nombre_Punto'].'</td>';
                $html .='<td style="text-align:center" id="'.$cajeros[$i]['ID_Cencon'].'" onclick="cencon_observaciones('.$cajeros[$i]['ID_Cencon'].',&#39;'.$cajeros[$i]['Observaciones_Cencon'].'&#39;)" value="'.$cajeros[$i]['Observaciones_Cencon'].'">'.$cajeros[$i]['Observaciones_Cencon'].'</td>';
                $html .='<td style="text-align:center"><a class="btn" role="button" onclick="eliminar_cajero('.$cajeros[$i]['ID_Cencon'].');">Eliminar ATM</a></td></td>';
                $html .='</tr>'; 
            }  
            $html.='</tbody> 
                    </table>';
            
            unset($obj_cencon);
            
            echo $html;
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Funcion para realiza busqueda de relaciones entre Puntos BCR y personar, es necesario el ID_Empresa
    public function cencon_buscar_relaciones(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            //Obtiene todas las relaciones de la persona, debe tener la empresa
            $obj_cencon->setCondicion("T_Cencon.ID_Persona=".$_POST['id_persona']." AND T_Cencon.ID_Empresa=".$_POST['empresa']);
            $obj_cencon->setEmpresa($_POST['empresa']);
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
            
            //Procedimiento para crear la tabla y enviarla al html
            $tam = count($cajeros);
            $html="";
            $html.='<thead> 
                        <th style="text-align:center">Número ATM</th>
                        <th style="text-align:center">Nombre de ATM</th>
                        <th style="text-align:center">Observaciones</th>
                        <th style="text-align:center">Opciones</th>
                        </thead>
                        <tbody>';
            for($i=0; $i<$tam;$i++){
                $html .='<tr>'; 
                $html .='<td style="text-align:center">'.$cajeros[$i]['Codigo'].'</td>';
                $html .='<td style="text-align:center">'.$cajeros[$i]['Nombre_Punto'].'</td>';
                $html .='<td style="text-align:center" id="'.$cajeros[$i]['ID_Cencon'].'" onclick="cencon_observaciones('.$cajeros[$i]['ID_Cencon'].',&#39;'.$cajeros[$i]['Observaciones_Cencon'].'&#39;)" value="'.$cajeros[$i]['Observaciones_Cencon'].'">'.$cajeros[$i]['Observaciones_Cencon'].'</td>';
                $html .='<td style="text-align:center"><a class="btn" role="button" onclick="eliminar_cajero('.$cajeros[$i]['ID_Cencon'].');">Eliminar ATM</a></td></td>';
                $html .='</tr>'; 
            }  
            $html.='</tbody> 
                    </table>';
            
            unset($obj_cencon);
            
            echo $html;
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Elimina una relación entre punto BCR y una persona
    public function cencon_eliminar_relacion(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            
            $obj_cencon->setEmpresa($_POST['empresa']);
            //Se elimina la relacion entre el atm y la persona
            $obj_cencon->setCondicion("ID_Cencon=".$_POST['id_cencon']);
            $obj_cencon->eliminar_relacion_persona_puntobcr();
            
            //Obtiene nuevamente la lista de Cajeros del usuario
            $obj_cencon->setCondicion("T_Cencon.ID_Persona=".$_POST['id_persona']." AND T_Cencon.ID_Empresa=".$_POST['empresa']);
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
           
            //Procedimiento para crear la tabla y enviarla al html
            $tam = count($cajeros);
            $html="";
            $html.='<thead> 
                            <th style="text-align:center">Número ATM</th>
                            <th style="text-align:center">Nombre de ATM</th>
                            <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Opciones</th>
                        </thead>
                        <tbody>';
            for($i=0; $i<$tam;$i++){
                $html .='<tr>'; 
                $html .='<td style="text-align:center">'.$cajeros[$i]['Codigo'].'</td>';
                $html .='<td style="text-align:center">'.$cajeros[$i]['Nombre_Punto'].'</td>';
                $html .='<td style="text-align:center" id="'.$cajeros[$i]['ID_Cencon'].'" onclick="cencon_observaciones('.$cajeros[$i]['ID_Cencon'].',&#39;'.$cajeros[$i]['Observaciones_Cencon'].'&#39;)" value="'.$cajeros[$i]['Observaciones_Cencon'].'">'.$cajeros[$i]['Observaciones_Cencon'].'</td>';
                $html .='<td style="text-align:center"><a class="btn" role="button" onclick="eliminar_cajero('.$cajeros[$i]['ID_Cencon'].');">Eliminar ATM</a></td></td>';
                $html .='</tr>'; 
            }  
            $html.='</tbody> 
                    </table>';
            
            unset($obj_cencon);
            echo $html;
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Funcion para cambiar observaciones a relacion entre Punto BCR y personas
    public function cencon_observaciones(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            //Se crea la condición de edición y se edita la observación
            $obj_cencon->setCondicion("T_Cencon.ID_Cencon=".$_POST['id_cencon']);
            $obj_cencon->setObservaciones($_POST['observaciones']);
            $obj_cencon->editar_observaciones_cencon();
            unset($obj_cencon);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    //Función permite agregar o eliminar todos los Puntos BCR a una persona
    public function todos_cajero_relacion(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_puntos = new cls_puntosBCR();
            
            //Valida la accion que trae desde la página
            if($_POST['accion']=='agregar'){
                //Obtiene los puntos BCR
                $obj_puntos->setCondicion("T_Puntobcr.ID_Tipo_Punto=2 OR T_Puntobcr.ID_Tipo_Punto=3 OR T_Puntobcr.ID_Tipo_Punto=4 OR T_Puntobcr.ID_Tipo_Punto=8");
                $obj_puntos->obtiene_todos_los_puntos_bcr();
                $puntosbcr = $obj_puntos->getArreglo();
                
                //Elimina las relaciones de la persona para no repetir cajeros
                $obj_cencon->setCondicion("ID_Persona=".$_POST['id_persona']." AND ID_Empresa=".$_POST['empresa']);
                $obj_cencon->eliminar_relacion_persona_puntobcr();
                
                //obtiene el tamaño del vector
                $tamaño = count($puntosbcr);
                for($i=0; $i<$tamaño;$i++){
                    //Establece los parametros para agregar la relación entre la persona y los puntos
                    $obj_cencon->setId($puntosbcr[$i]['ID_PuntoBCR']);
                    $obj_cencon->setId2($_POST['id_persona']);
                    $obj_cencon->setCedula($_POST['cedula']);
                    $obj_cencon->setEmpresa($_POST['empresa']);
                    //Agrega la relación
                    $obj_cencon->agregar_relacion(); 
                }
            }
            if($_POST['accion']=='eliminar'){
                //Define la condicion para eliminar
                $obj_cencon->setCondicion("ID_Persona=".$_POST['id_persona']." AND ID_Empresa=".$_POST['empresa']);
                $obj_cencon->eliminar_relacion_persona_puntobcr();
            }
            $obj_cencon->setEmpresa($_POST['empresa']);
            $obj_cencon->setCondicion("T_Cencon.ID_Persona=".$_POST['id_persona']." AND T_Cencon.ID_Empresa=".$_POST['empresa']);
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
           
            $tam = count($cajeros);
            $html="";
            $html.='<thead> 
                            <th style="text-align:center">Número ATM</th>
                            <th style="text-align:center">Nombre de ATM</th>
                            <th style="text-align:center">Observaciones</th>
                            <th style="text-align:center">Opciones</th>
                        </thead>
                        <tbody>';
            for($i=0; $i<$tam;$i++){
                $html .='<tr>'; 
                $html .='<td style="text-align:center">'.$cajeros[$i]['Codigo'].'</td>';
                $html .='<td style="text-align:center">'.$cajeros[$i]['Nombre'].'</td>';
                $html .='<td style="text-align:center" id="'.$cajeros[$i]['ID_Cencon'].'" onclick="cencon_observaciones('.$cajeros[$i]['ID_Cencon'].',&#39;'.$cajeros[$i]['Observaciones_Cencon'].'&#39;)" value="'.$cajeros[$i]['Observaciones_Cencon'].'">'.$cajeros[$i]['Observaciones_Cencon'].'</td>';
                $html .='<td style="text-align:center"><a class="btn" role="button" onclick="eliminar_cajero('.$cajeros[$i]['ID_Cencon'].');">Eliminar ATM</a></td></td>';
                $html .='</tr>'; 
            }  
            $html.='</tbody> 
                    </table>';
            
            unset($obj_cencon);
            
            echo $html;
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    /////////////////////Eventos Módulo Cencon /////////////////////////////////
    //Función que permite buscar la información de un PuntoBCR y enviarla a JavaScript
    public function eventos_cencon(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            
            $obj_cencon->setCondicion("Hora_Cierre is null");
            $obj_cencon->obtener_todos_eventos_cencon();
            $params= $obj_cencon->getArreglo();
            
            $tam=count($params);
            for($i=0;$i<$tam;$i++){
                if($params[$i]['ID_Empresa']==1){
                    $obj_personal->setCondicion("ID_Persona='".$params[$i]['ID_Persona']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $params[$i] = array_merge((['Nombre_Persona' =>($persona[0]['Apellido_Nombre'])]),(['Correo' =>($persona[0]['Correo'])]),$params[$i]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$params[$i]['ID_Persona']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $params[$i] = array_merge((['Nombre_Persona' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),(['Correo' =>($persona[0]['Correo'])]),$params[$i]);
                }
            }
            //Obtiene la fecha del servidor en un arreglo
            $fecha_actual= getdate();
            //Convierta la fecha a formto aaaa/mm/dd hh:mm
            $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'];
            //asigna la fecha actual a un arreglo formato DateTime
            $fecha1 = new DateTime($fecha_actual);
            $diff="";
            for ($i = 0; $i <$tam; $i++) {
                //asigna da date2 la fecha que trae en el arreglo
                $fecha2 = new DateTime($params[$i]['Fecha_Apertura'].' '.$params[$i]['Hora_Apertura']);
                $diff = $fecha1->diff($fecha2);
                //print_r($diff);
                $vencidos[$i]['tiempo']=(intval($diff->d)*1440)+(intval($diff->h)*60)+(intval($diff->i)*1);
                $vencidos[$i]['mensaje']= ("ATM #".$params[$i]['Codigo']." | D:". $diff->d." | Hr:". $diff->h." | Min:". $diff->i." \n "); 
                
                //Obtiene la hora actual del sistema
                $hora_actual= getdate();
                $hora_actual=$hora_actual['hours'];
                if($hora_actual<19){
                    if($vencidos[$i]['tiempo']<'300'){
                        if(!($params[$i]['Seguimiento']=="Arqueo de ATM" ||$params[$i]['Seguimiento']=="ATM en Mantenimiento"||
                            $params[$i]['Seguimiento']=="Apertura con llave Azul"||$params[$i]['Seguimiento']=="Permiso Especial")){
                            if($vencidos[$i]['tiempo']>'40'){
                                if($params[$i]['Seguimiento']=="Se envió correo al funcionario"||$params[$i]['Seguimiento']=="Se envió correo al encargado"||
                                    $params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                    if($vencidos[$i]['tiempo']>'70'){
                                        if($params[$i]['Seguimiento']=="Se envió correo al encargado"||
                                            $params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                            if($vencidos[$i]['tiempo']>'100'){
                                                if($params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                                    $vencidos[$i]['color']="color: blueviolet";
                                                    //echo "blueviolet +100 informó".$params[$i]['Codigo']."\n||||";
                                                }else{
                                                    $vencidos[$i]['color']="color: red";
                                                    //echo "rojo +100 sin informar".$params[$i]['Codigo']."\n||||";
                                                } 
                                            }else{
                                                $vencidos[$i]['color']="color: orange";
                                                //echo "naranja -110".$params[$i]['Codigo']."\n|||||";
                                            }
                                        }else{
                                            $vencidos[$i]['color']="color: red";
                                            //echo "rojo -correo encargado".$params[$i]['Codigo']."\n|||||";
                                        }
                                    }else{
                                        $vencidos[$i]['color']="color: orange";
                                        //echo "naranja -70 y correo".$params[$i]['Codigo']."\n|||||";
                                    }
                                }else{
                                    $vencidos[$i]['color']="color: red";
                                    //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                                }
                            } else{
                                $vencidos[$i]['color']="color: black";
                                //echo "nada".$params[$i]['Codigo']."\n||||";
                            }
                        } else{
                            $vencidos[$i]['color']="color:mediumblue; text-decoration: underline;";
                            //echo "nada".$params[$i]['Codigo']."\n||||";
                        }    
                    }else{
                        $vencidos[$i]['color']="color: red";
                        //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                    }
                }else{
                    $vencidos[$i]['color']="color: red";
                    //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                }    
            }
            
            if(isset ($vencidos)){
                rsort($vencidos);
            }
           
            unset($obj_cencon); 
            unset($obj_personal);
            unset($obj_externo);
            
            require __DIR__.'/../vistas/plantillas/frm_eventos_cencon.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function evento_buscar_cajero() {
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_punto = new cls_puntosBCR();
            //Buscar la información de un PuntoBCR basado en el código del cajero
            $obj_punto->setCondicion("T_PuntoBCR.Codigo=".$_POST['id']." AND T_PuntoBCR.Estado=1");
            $obj_punto->obtiene_todos_los_puntos_bcr();
            $cajero = $obj_punto->getArreglo();
            
            //Convierte la información en un json para enviarlo a JavaScript
            unset($obj_cencon);
            unset($obj_punto);
            
            if($cajero[0]!=null){
                echo json_encode($cajero[0], JSON_FORCE_OBJECT);
            } else {
                echo "No se encontró la persona";
            }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Función que permite buscar la información de una persona y enviarla a JavaScript
    public function evento_buscar_persona(){
        if(isset($_SESSION['nombre'])){
            //Se crean los objetos necesarios
            $obj_cencon = new cls_cencon();
            $obj_persona = new cls_personal();
            $obj_externo = new cls_personal_externo();
            
            //Obtiene la información de relaciones de la persona para saber a cual empresa pertenece
            $obj_cencon->setCondicion("T_Cencon.Cedula_Cencon='".$_POST['id']."'");
            $obj_cencon->buscar_persona_cencon();
            $funcionario = $obj_cencon->getArreglo();
            
            //Obtiene la información completa de la persona según la empresa (externa o Banco==1)
            if($funcionario[0]['ID_Empresa']==1){
                //Obtiene la información si la persona es BCR
                $obj_persona->setCondicion("T_Personal.ID_Persona='".$funcionario[0]['ID_Persona']."'");
                $obj_persona->obtiene_todo_el_personal();
                $funcionario= $obj_persona->getArreglo();
            }else{
                //Obtiene la información en caso de ser otra empresa
                $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$funcionario[0]['ID_Persona']."'");
                $obj_externo->obtiene_todo_el_personal_externo();
                $funcionario= $obj_externo->getArreglo();
            }
            
            //Convierte la información en un json para enviarlo a JavaScript
            unset($obj_cencon); 
            unset($obj_persona);
            unset($obj_externo);
            
            if($funcionario[0]!=null){
                echo json_encode($funcionario[0], JSON_FORCE_OBJECT);
            } else {
                echo "No se encontró la persona";
            }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    //Función necesaria para buscar relación entre puntos BCR y Personas
    public function evento_buscar_relaciones(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            
            //Obtiene todas las relaciones buscando por Cedula
            $obj_cencon->setCondicion("T_Cencon.Cedula_Cencon='".$_POST['id']."'");  
            $obj_cencon->setEmpresa($_POST['empresa']);
            $obj_cencon->obtener_todas_relaciones();
            $cajeros =  $obj_cencon->getArreglo();
            
            unset($obj_cencon);
            //Convierte la información en un json para enviarlo a JavaScript
            echo json_encode($cajeros, JSON_FORCE_OBJECT);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function evento_nuevo_guardar() {
        if(isset($_SESSION['nombre'])){
            //Clases necesarias para agregar un evento de cencon
            $obj_cencon = new cls_cencon();
            $obj_eventos= new cls_eventos();
            $obj_puntobcr = new cls_puntosBCR();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            
            //Estable atributos para el evento de Cencon
            $obj_cencon->setFecha($_POST['fecha_apertura']);
            $obj_cencon->setHora($_POST['hora_apertura']);
            $obj_cencon->setId($_POST['id_puntobcr']);
            $obj_cencon->setId2($_POST['id_persona']);
            $obj_cencon->setEmpresa($_POST['id_empresa']);
            $obj_cencon->setUsuario($_SESSION['id']);
            $obj_cencon->setObservaciones($_POST['observaciones']);
            $obj_cencon->setSeguimiento($_POST['seguimiento']);

            //Valida que la fecha y la hora del evento cencon
            $fecha_seguimiento = strtotime($_POST['fecha_apertura']);
            $fecha_seguimiento = date("Y-m-d", $fecha_seguimiento);

            //Validaciones de la fecha ingresada para el evento, caso negativo muestra una advertencia en pantalla
            if ($fecha_seguimiento >  date("Y-m-d")){
                //Muestra modal en pantalla
                echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                //Sale del metodo
                exit();
                //Verifica que la fecha sea de hoy
            }if($fecha_seguimiento == date("Y-m-d")){
                $hora_seguimiento = strtotime($_POST['hora_apertura']);
                $hora_seguimiento = date("H:i", $hora_seguimiento);

                //Valida que no se ingresen eventos en tiempo futuro
                if ($hora_seguimiento >  date("H:i", time())){
                    //Muestra mensaje en pantalla para advertir al usuario
                    echo "<script type=\"text/javascript\">alert('No es posible ingresar eventos futuros!!!!');history.go(-1);</script>";;
                    //Sale del metodo
                    exit();
                }
            }
            
            //Obtiene eventos de Cencon pendiente de cierre.
            $obj_cencon->setCondicion("Hora_Cierre is null");
            $obj_cencon->obtener_todos_eventos_cencon();
            $params= $obj_cencon->getArreglo();
          
            //Valida que el cajero no se encuentre abierto
            $tam=count($params);
            for($i=0;$i<$tam;$i++){
                if($params[$i]['ID_PuntoBCR']==$_POST['id_puntobcr']){
                   echo "No es posible abrir, pendiente de cierre";
                   exit();
                }
            }
            //Se agrega el evento de Cencon
            $obj_cencon->agregar_evento_cencon();
            //
            ///Se procede a agregar el evento a la bitacora de Centro de Control
            
            //Se obtiene informacion necesaria del Punto BCR para agregar el evento
            $obj_puntobcr->setCondicion("T_Puntobcr.ID_PuntoBCR=".$_POST['id_puntobcr']);
            $obj_puntobcr->obtiene_todos_los_puntos_bcr();
            $puntosbcr = $obj_puntobcr->getArreglo();
            
            //Establece los atributos de la clase para el ingreso del evento
            $obj_eventos->setFecha($_POST['fecha_apertura']); 
            $obj_eventos->setHora($_POST['hora_apertura']);
            $obj_eventos->setTipo_evento('39');
            $obj_eventos->setProvincia($puntosbcr[0]['ID_Provincia']); 
            $obj_eventos->setTipo_punto($puntosbcr[0]['ID_Tipo_Punto']); 
            $obj_eventos->setPunto_bcr($_POST['id_puntobcr']);
            $obj_eventos->setEstado_evento('1');
            $obj_eventos->setId_usuario($_SESSION['id']);
            $obj_eventos->setEstado(1);
            
            //Obtiene informacion de la persona que realizó la apertura
            if($_POST['id_empresa']==1){
                $obj_personal->setCondicion("ID_Persona='".$_POST['id_persona']."'");
                $obj_personal->obtener_personas_prontuario();
                $personal = $obj_personal->getArreglo();
                $persona=$personal[0]['Apellido_Nombre'];
            } else {
                $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$_POST['id_persona']."'");
                $obj_externo->obtiene_todo_el_personal_externo();
                $personal = $obj_externo->getArreglo();
                $persona = $personal[0]['Apellido']." ".$personal[0]['Nombre'];
            }
            //Verifica que no exista este tipo de evento abierto para este punto BCR
            if (!$obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio()){
                //Ingresa el evento mediante el metodo de la clase
                $obj_eventos->ingresar_evento();
                
                //Establece los atributos del seguimiento del evento de Z1
                $obj_eventos->setDetalle("Se realiza apertura de la cerradura de Cencon al funcionario: ".$persona);
                $obj_eventos->setId2(0);
                //Obtiene el id del ultimo seguimiento para incluirlo en el nuevo
                $obj_eventos->obtiene_id_ultimo_evento_ingresado(); 
                //Establece el id correspondiente
                $obj_eventos->setId($obj_eventos->getId_ultimo_evento_ingresado());
                $obj_eventos->setAdjunto("N/A");
                //Ingresa el seguimiento
                $obj_eventos->ingresar_seguimiento_evento();  
                //echo "3 guarda seguimiento";
                //Llama al listado principal de eventos abiertos o pendientes
                //header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
            }else{
                $obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio();
                $id_evento= $obj_eventos->getArreglo();
                $obj_eventos->setDetalle("Se realiza apertura de la cerradura de Cencon al funcionario: ".$persona);
                $obj_eventos->setId2(0);
                $obj_eventos->setId($id_evento[0]['ID_Evento']);
                $obj_eventos->setAdjunto("N/A");
                //Ingresa el seguimiento
                $obj_eventos->ingresar_seguimiento_evento();  
            }
            
            unset($obj_cencon); 
            unset($obj_eventos);
            unset($obj_puntobcr);
            unset($obj_personal);
            unset($obj_externo);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function evento_cencon_cerrar(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_eventos= new cls_eventos();
            $obj_puntobcr = new cls_puntosBCR();
            //Estable parametros necesarios para realizar el cierre del evento de Cencon
            $obj_cencon->setFecha(date("Y-m-d"));
            $obj_cencon->setHora(date("H:i", time()));
            $obj_cencon->setCondicion("ID_Evento_Cencon=".$_POST['id_evento_cencon']);
            //Se procede a cerrar el evento de control
            $obj_cencon->cerrar_evento_cencon();
            
            //Obtenemos informacion del evento de cencon cerrado
            $obj_cencon->obtener_todos_eventos_cencon();
            $cencon_cerrado = $obj_cencon->getArreglo();
            
            //Se obtiene informacion necesaria del Punto BCR para agregar al seguimiento
            $obj_puntobcr->setCondicion("T_Puntobcr.ID_PuntoBCR=".$cencon_cerrado[0]['ID_PuntoBCR']);
            $obj_puntobcr->obtiene_todos_los_puntos_bcr();
            $puntosbcr = $obj_puntobcr->getArreglo();
            
            //Estable parametros necesarios para realizar seguimiento a la bitácora de Centro de Control
            $obj_eventos->setFecha(date("Y-m-d")); 
            $obj_eventos->setHora(date("H:i", time()));
            $obj_eventos->setTipo_evento('39');
            $obj_eventos->setProvincia($puntosbcr[0]['ID_Provincia']); 
            $obj_eventos->setTipo_punto($puntosbcr[0]['ID_Tipo_Punto']); 
            $obj_eventos->setPunto_bcr($cencon_cerrado[0]['ID_PuntoBCR']);
            $obj_eventos->setId_usuario($_SESSION['id']);
            
            //Obtiene evento para agregar seguimiento
            $obj_eventos->existe_abierto_este_tipo_de_evento_en_este_sitio();
            $id_evento= $obj_eventos->getArreglo();
            $obj_eventos->setDetalle("Se realiza cierre de la cerradura de Cencon");
            $obj_eventos->setId2(0);
            $obj_eventos->setId($id_evento[0]['ID_Evento']);
            $obj_eventos->setAdjunto("N/A");
            //Ingresa el seguimiento
            $obj_eventos->ingresar_seguimiento_evento(); 
            
            //Obtiene los seguimientos del evento
            $obj_eventos->setCondicion("T_DetalleEvento.ID_Evento=".$id_evento[0]['ID_Evento']);
            $obj_eventos->obtiene_detalle_evento();
            $params = $obj_eventos->getArreglo();
            $tam=count($params);
            if($tam==2){
                $obj_eventos->edita_estado_evento("3");
            }
            
            unset($obj_cencon); 
            unset($obj_eventos);
            unset($obj_puntobcr);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function evento_cencon_observaciones(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_cencon->setCondicion("T_EventoCencon.ID_Evento_Cencon=".$_POST['id_evento_cencon']);
            $obj_cencon->setObservaciones($_POST['observaciones']);
            $obj_cencon->editar_observaciones_evento();
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }    
    }
    
    public function evento_cencon_seguimiento(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_cencon->setCondicion("T_EventoCencon.ID_Evento_Cencon=".$_POST['id_evento_cencon']);
            $obj_cencon->setSeguimiento($_POST['seguimiento']);
            $obj_cencon->editar_seguimiento_evento();
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    public function evento_cencon_reasignar(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            
            $obj_cencon->setCondicion("T_Cencon.Cedula_Cencon='".$_POST['cedula_cencon']."' AND T_Cencon.ID_PuntoBCR='".$_POST['numero_cajero']."'");
            $obj_cencon->buscar_persona_cencon();
            $params = $obj_cencon->getArreglo();
            
            if ($params!=null){
                $obj_cencon->setCondicion("T_EventoCencon.ID_Evento_Cencon=".$_POST['id_evento_cencon']);
                $obj_cencon->setId($params[0]['ID_Persona']);
                $obj_cencon->setEmpresa($params[0]['ID_Empresa']);
                $obj_cencon->setUsuario($_SESSION['id']);
                $obj_cencon->reasignar_evento_cencon();
            } else {
                echo "No se puede reasignar";
            }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    
    ////////////////////MANTENIMIENTO DE PERSONAL EXTERNO///////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function personal_externo_listar(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal_externo();
            //Muestra solamente información de oficiales VMA, rol 10 Seguridad Privada VMA
            if($_SESSION['rol']==10){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=2");
            }
            //Muestra solamente información de personal externo G4S, rol 9 Seguridad Privada G4S
            if($_SESSION['rol']==9){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=3");
            } 
            //Muestra solamente información de personal externo G4S y VMA, rol 16 Operaciones de Seguridad
            if($_SESSION['rol']==16){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=3 OR T_PersonalExterno.ID_Empresa=2");
            }
            //Muestra solamente información de personal externo Qubo Digital Ltda(15) y Sistemas Contra Incendio OLPRA(16), rol 15 Defensa al Cliente
            if($_SESSION['rol']==15){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=15 OR T_PersonalExterno.ID_Empresa=16");
            }
            //Muestra solamente información de personal externo NOVUS(8) y Correos de Costa Rica(9), rol 7 Servicios Auxiliar
            if($_SESSION['rol']==7 || $_SESSION['rol']==4){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=8 OR T_PersonalExterno.ID_Empresa=9");
            }
            //Muestra solamente información de personal externo SELOSA SA(10), CLIMA TECNICA REFRIGERACIÓN INDUST(11),
            //SCO MANTENIMIENTO INDUSTRIAL SA(12),ENFRION DEL NORTE SA(13),SERVICIOS TECNICOS Y COMERCIALES SA(14),
            //FONT SERVICIOS ELECTROMECANICOS SA(17), MATRA(18),  rol 13 Obras Civiles
            if($_SESSION['rol']==13){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Empresa=10 OR T_PersonalExterno.ID_Empresa=11 OR
                        T_PersonalExterno.ID_Empresa=12 OR T_PersonalExterno.ID_Empresa=13 OR
                       T_PersonalExterno.ID_Empresa=14 OR T_PersonalExterno.ID_Empresa=17 OR 
                       T_PersonalExterno.ID_Empresa=18");
            }
            
            $obj_personal->obtiene_todo_el_personal_externo();
            $params= $obj_personal->getArreglo();
            //Calcula proximas portaciones a vencer
            $fecha_actual= getdate();
            $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];
            
            
            $tam=count($params);
            $cantidad=0;
            for ($i = 0; $i <$tam; $i++) {
                if($params[$i]['Fecha_Vencimiento_Portacion']<>"0000-00-00" && $params[$i]['ID_Estado_Persona']<>2){
                    $dias = (strtotime($params[$i]['Fecha_Vencimiento_Portacion'])-strtotime($fecha_actual))/86400;
                    //echo ("Faltan ".$dias." para vencer portación de ".$params[$i]['Identificacion'])."<br>";
                    if($dias<60){
                        if($dias<0){
                            $vencidos[$cantidad]['dias']=intval($dias);
                            $vencidos[$cantidad]['mensaje']= ($params[$i]['Nombre']." ".$params[$i]['Apellido']." portación vencida hace <b>".(intval(-$dias)))."</b> días.";   
                            
                        }else{
                            $vencidos[$cantidad]['dias']=intval($dias);
                            $vencidos[$cantidad]['mensaje']= ($params[$i]['Nombre']." ".$params[$i]['Apellido']." portación vence en <b>".intval($dias)."</b> días.");
                            
                        }
                        $cantidad++;
                    }
                }
            }
            if(isset ($vencidos)){
                sort($vencidos);
            }
            
            require __DIR__ . '/../vistas/plantillas/frm_personal_externo_listar.php';
        }else{
              /*
             * Esta es la validación contraria que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de "warning" correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_externo_gestion(){
        if(isset($_SESSION['nombre'])){
            $obj_personal=new cls_personal_externo();
            $obj_empresa = new cls_empresa();
            $obj_estado_civil = new cls_estado_civil();
            $obj_estado_persona = new cls_estado_persona();
            $obj_nacionalidad = new cls_nacionalidad();
            $obj_nivel_academico = new cls_nivel_academico();
            $obj_telefono = new cls_telefono();
            $obj_Puntobcr = new cls_puntosBCR(); 
            $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
            
            //Validación si carga informacion de persona o formulario en blanco
            if($_GET['id']<>0){
                $obj_personal->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$_GET['id']."'");
                $obj_personal->obtiene_todo_el_personal_externo();
                $params= $obj_personal->getArreglo();
            } else {
                $params[0]['ID_Persona_Externa'] = 0;
                $params[0]['Identificacion'] ="";
                $params[0]['Apellido'] ="";
                $params[0]['Nombre'] ="";
                $params[0]['Fecha_Nacimiento'] ="";
                $params[0]['Fecha_Vencimiento_Residencia'] ="";
                $params[0]['Fecha_Vencimiento_Portacion'] ="";
                $params[0]['Fecha_Ingreso'] ="";
                $params[0]['Fecha_Salida'] ="";
                $params[0]['Correo'] ="";
                $params[0]['Genero'] ="";
                $params[0]['Direccion'] ="";
                $params[0]['ID_Distrito']  =1;
                $params[0]['ID_Estado_Civil'] =1;
                $params[0]['ID_Nacionalidad'] =1;
                $params[0]['ID_Nivel_Academico'] =1;
                $params[0]['ID_Empresa'] ="";
                $params[0]['ID_Estado_Persona'] =1;
                $params[0]['Validado'] =0;
                $params[0]['Observaciones'] ="";
                $params[0]['Ocupacion'] ="";
                $params[0]['Nombre_Estado'] ="";
                $params[0]['Descripcion'] ="";
                $params[0]['Empresa'] ="";
                $params[0]['Nombre_Usuario'] ="";
                $params[0]['Apellido_Usuario'] ="";
            }
            
            //Obtiene información de empresas
            //Según el rol asignado
            $obj_empresa->setCondicion("");
            if($_SESSION['rol']==10){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=2");
            }
            //Muestra solamente información de personal externo G4S, rol 9 Seguridad Privada G4S
            if($_SESSION['rol']==9){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=3");
            } 
            //Muestra solamente información de personal externo G4S y VMA, rol 16 Operaciones de Seguridad
            if($_SESSION['rol']==16){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=3 OR T_Empresa.ID_Empresa=2");
            }
            //Muestra solamente información de personal externo Qubo Digital Ltda(15) y Sistemas Contra Incendio OLPRA(16), rol 15 Defensa al Cliente
            if($_SESSION['rol']==15){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=15 OR T_Empresa.ID_Empresa=16");
            }
            //Muestra solamente información de personal externo NOVUS(8) y Correos de Costa Rica(9), rol 7 Servicios Auxiliar
            if($_SESSION['rol']==7 || $_SESSION['rol']==4){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=8 OR T_Empresa.ID_Empresa=9");
            }
            //Muestra solamente información de personal externo SELOSA SA(10), CLIMA TECNICA REFRIGERACIÓN INDUST(11),
            //SCO MANTENIMIENTO INDUSTRIAL SA(12),ENFRION DEL NORTE SA(13),SERVICIOS TECNICOS Y COMERCIALES SA(14),
            //FONT SERVICIOS ELECTROMECANICOS SA(17), MATRA(18),  rol 13 Obras Civiles
            if($_SESSION['rol']==13){
                $obj_empresa->setCondicion("T_Empresa.ID_Empresa=10 OR T_Empresa.ID_Empresa=11 OR
                        T_Empresa.ID_Empresa=12 OR T_Empresa.ID_Empresa=13 OR
                       T_Empresa.ID_Empresa=14 OR T_Empresa.ID_Empresa=17 OR 
                       T_Empresa.ID_Empresa=18");
            }
            $obj_empresa->obtiene_todas_las_empresas();
            $empresas= $obj_empresa->getArreglo();
		
            //Obtiene Distrito->Cantón->Provincia
            //Distritos
            $obj_Puntobcr->setCondicion("");
            //Ejecuta la consulta SQL
            $obj_Puntobcr->obtiene_distritos();
            //Asigna el resultado a una variable tipo vector
            $distritos = array_merge(array(['ID_Distrito'=>0]+['Nombre_Distrito'=>""]),$obj_Puntobcr->getArreglo());
            //Cantones
            $obj_Puntobcr->setCondicion("");
            //Ejecuta la consulta SQL
            $obj_Puntobcr->obtiene_cantones();
            //Obtiene el resultado en una variable tipo vector
            $cantones   = array_merge(array(['ID_Canton'=>0]+['Nombre_Canton'=>""]),$obj_Puntobcr->getArreglo());
            //Provincias
            $obj_Puntobcr->setCondicion("");
            //Ejecuta la consulta
            $obj_Puntobcr->obtiene_provincias();
            //Asigna el resultado a una variable tipo vector
            $provincias = array_merge(array(['ID_Provincia'=>"0"]+['Nombre_Provincia'=>""]),$obj_Puntobcr->getArreglo());
                
                
            //Obtiene Estado Civil
            $obj_estado_civil->setCondicion("");
            $obj_estado_civil->obtener_estado_civil_todos();
            $estado_civil = $obj_estado_civil->getArreglo();
            
            //Obtiene Nacionalidad
            $obj_nacionalidad->setCondicion("");
            $obj_nacionalidad->obtener_todas_nacionalidades();
            $nacionalidad = $obj_nacionalidad->getArreglo();
            
            //Obtiene nivel academico
            $obj_nivel_academico->setCondicion("");
            $obj_nivel_academico->obtener_todos_niveles_academicos();
            $nivel_academico= $obj_nivel_academico->getArreglo();
            
            //Obtiene el estado de la persona
            $obj_estado_persona->setCondicion("");
            $obj_estado_persona->obtener_todos_estados_personas();
            $estado_persona = $obj_estado_persona->getArreglo();
            
            //Obtiene telefonos realacionados al personal externo
            $obj_telefono->setCondicion("ID='".$_GET['id']."'");
            $obj_telefono->obtiene_telefonos_personal_externo();
            $num_telefono= $obj_telefono->getArreglo();
            
            //Obtiene los tipos de telefono
            $obj_telefono->setCondicion("");
            $obj_telefono->obtiene_tipo_telefonos();
            $tipo_telefono = $obj_telefono->getArreglo();
            
            //Obtiene fotos del personal
            //Establece la condición de busqueda mediante el id del punto bcr
            $obj_padron_fotografico->setCondicion("ID_Persona_Externa=".$_GET['id']);
            //Obtiene el listado de imagenes del punto bcr
            $obj_padron_fotografico->obtener_imagenes_personal_externo();
            //Asigna el resultado a una variable tipo vector
            $fotos=$obj_padron_fotografico->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/frm_personal_externo_detalle.php';
            
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
    
    public function personal_externo_numero_telefono_guardar(){
        //Verifica que la sesion de usuario esté activa 
        if(isset($_SESSION['nombre'])){   
            //Verifica que el metodo de envio de datos sea por medio del formulario html
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Creacion del objeto de la clase telefono
                $obj_telefono = new cls_telefono();
                //Establece los parametros requeridos para el objeto de la clase
                //ID del telefono
                $obj_telefono->setId($_POST['ID_Telefono']);
                //Id de la persona
                $obj_telefono->setId2($_POST['ID_Persona_Telefono']);
                //Tipo de telefono
                $obj_telefono->setTipo_telefono($_POST['Tipo_Telefono']);
                //Establece el numero
                $obj_telefono->setNumero($_POST['numero']);
                //Define las observaciones
                echo '<script>alert("Prueba");</script>';
                $obj_telefono->setObservaciones($_POST['observaciones_tel']);
                //Dependiendo del numero de id que se reciba, se guarda un nuevo telefono o se edita el existente
                if($_POST['ID_Telefono']==0){
                    $obj_telefono->guardar_telefono();
                }   else    {
                    //Establece la condicion de busqueda para editar el telefono
                    $obj_telefono->setCondicion("ID_Telefono='".$_POST['ID_Telefono']."'");
                    //Ejecuta la edicion de los datos
                    $obj_telefono->actualizar_telefono();
                }
                //Muestra la vista de usuario correspondiente
                header("location:/ORIEL/index.php?ctl=personal_externo_gestion&id=".$_POST['ID_Persona_Telefono']);
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
            //Muestra la vista de usuario correspondiente
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function personal_externo_eliminar_telefono(){
        //Verifica que la sesion de usuario esté activa
       if(isset($_SESSION['nombre'])){
           //Crear objeto de la clase telefono
            $obj_telefono = new cls_telefono();
            //Establece el id del telefono en cuestion
            $obj_telefono->setId($_POST['id_telefono']);
            //Procede a armar la condicion de busqueda del SQL
            $obj_telefono->setCondicion("ID_Telefono='".$_POST['id_telefono']."'");
            //Elimina el telefono de la base de datos
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
            //Muestra la vista de usuario correspondiente
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    //Metodo que permite guardar la información correspondiente a una persona externa
    public function persona_externa_guardar_informacion(){
        //Verifica que la sesión de usuario esté establecida
        if(isset($_SESSION['nombre'])){
            //Crear objeto de la clase personal
            $obj_persona = new cls_personal_externo ();
            //Establece los atributos de la clase: tales como identificacion, nombre, empresa, etc
            $obj_persona->setIdentificacion($_POST['identificacion']);
            $obj_persona->setEmpresa($_POST['empresa']);
            $obj_persona->setNombre(strtoupper($_POST['nombre']));
            $obj_persona->setApellido(strtoupper ($_POST['apellido']));
            $obj_persona->setFecha_nacimiento($_POST['fecha_nacimiento']);
            $obj_persona->setFecha_ingreso($_POST['fecha_ingreso']);
            $obj_persona->setFecha_salida($_POST['fecha_salida']);
            $obj_persona->setNacionalidad($_POST['nacionalidad']);
            $obj_persona->setFecha_residencia($_POST['fecha_residencia']);
            $obj_persona->setFecha_portacion($_POST['fecha_portacion']);
            $obj_persona->setDistrito($_POST['Distrito']);
            $obj_persona->setDireccion($_POST['Direccion']);
            $obj_persona->setEstado_civil($_POST['estado_civil']);
            $obj_persona->setCorreo($_POST['correo']);
            $obj_persona->setNivel_academico($_POST['nivel_academico']);
            $obj_persona->setObservaciones($_POST['observaciones']);
            $obj_persona->setEstado_persona($_POST['estado_persona']);
            $obj_persona->setGenero($_POST['genero']);
            $obj_persona->setOcupacion($_POST['ocupacion']);
            //Obtiene la información de todo el personal externo
            $obj_persona->obtiene_todo_el_personal_externo();
            $params= $obj_persona->getArreglo();
            
            //Valida si es una persona nueva o editar una exsitente
            //Agrega persona nueva
            if($_POST['id_persona']==0){
                $obj_persona->setCondicion("");
                $tam = count($params);
                for($i=0; $i<$tam;$i++){
                    if($params[$i]['Identificacion']==$_POST['identificacion']){
                        echo 'Repetido';
                        exit();
                    }
                }
            } //Editar persona   
            else {
                //Establece la condicion de busqueda SQL
                $obj_persona->setCondicion("ID_Persona_Externa='".$_POST['id_persona']."'");
            }
            
            //Ejecuta el cambio en base de datos
            $obj_persona->guardar_informacion_persona_externa();
            
            if($_POST['id_persona']==0){
                $ultimo=$obj_persona->getArreglo();
                $nueva_persona=$ultimo[0]['ID_Persona_Externa'];
            } else {
                $nueva_persona=$_POST['id_persona'];
            }
            echo $nueva_persona;
        }else{
            /*
            * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
            * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
            * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
            * En la última línea llama a la pagina de inicio de sesión.
            */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llama a la vista de usuario correspondiente
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function guardar_imagen_persona_externa(){
        if(isset($_SESSION['nombre'])){
            //Verifica que el nombre de la imagen exista en los parametros enviados
            if (!(isset($_POST['Nombre']))){
                //Muestra advertencia en pantalla
                echo "<script type=\"text/javascript\">alert('Es necesario ingresar un nombre de referencia para la imágen!');history.go(-1);</script>";;
                //Sale del metodo
                exit();
            }
            //Verifica que la descripcion de la imagen exista en los parametros enviados
            if (!(isset($_POST['Descripcion']))){
                //Muestra advertencia en pantalla
                echo "<script type=\"text/javascript\">alert('Es necesario ingresar una descripción básica para la imágen!');history.go(-1);</script>";;
                //Sale del metodo
                exit();
            } 
            //Verifica que la categoria de la imagen exista en los parametros enviados
            if (!(isset($_POST['Categoria']))){
                //Muestra advertencia en pantalla
                echo "<script type=\"text/javascript\">alert('Es necesario elegir una categoría para la imágen!');history.go(-1);</script>";;
                //Sale del metodo
                exit();
            }
            //Verifica que el id del punto bcr exista en los parametros enviados
            if (!(isset($_POST['ID_Persona']))){
                //Sale del metodo
                exit();
            }
              
            //Elimina caracteres especiales del nombre de la imagen enviado desde el formulario html
            $nombre_imagen= str_replace('"','',str_replace("'","",$_POST['Nombre']));
            //Obtiene la categoria de la imagen
            $categoria=$_POST['Categoria'];
            //Reemplaza caracteres especiales en la descripcion
            $descripcion=$_POST['Descripcion'];
            //Obtiene el id del punto bcr
            $id_persona=$_POST['ID_Persona'];
              
              
            //Validación de informacion en descripcion de la imagen, elimina algunos caracteres especiales
              
            $descripcion= str_replace("'","",$descripcion);
            $descripcion= str_replace('"','',$descripcion);
            //echo $descripcion;
            //Obtiene el mensaje de verificacion del envio del archivo
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
              
            //Crea una nueva instancia de la clase padron
            $obj_padron_fotografico = new cls_padron_fotografico_puntosbcr();
            //Asigna el atributo id
            $obj_padron_fotografico->setId_puntobcr($id_persona);
            //Asigna el atributo nombre de la imagen
            $obj_padron_fotografico->setNombre_imagen($nombre_imagen);
            //Asigna el atributo descripcion
            $obj_padron_fotografico->setDescripcion($descripcion);
            //Asigna el atributo categoria
            $obj_padron_fotografico->setCategoria($categoria);
            
            //Obtiene el mensaje de verificacion del envio del archivo
            $recepcion_archivo=$_FILES['archivo_adjunto']['error'];
        
            //Obtiene la fecha actual
            $date=new DateTime(); //this returns the current date time
            //Obtiene la fecha actual
            $result = $date->format('Y-m-d-H-i-s');
            //Formatea la fecha actual sin -
            $krr = explode('-',$result);
            //Obtiene en una variable la fecha actua ya formateada
            $result = implode("",$krr);
            //Obtiene el directorio raiz donde está localizado ORIEL           
            $raiz=$_SERVER['DOCUMENT_ROOT'];
            //Formatea la raiz de la ruta donde se localiza ORIEL
            if (substr($raiz,-1)!="/"){
                $raiz.="/";
            }
            //Establece la ruta donde almacenará el archivo
            $ruta=  str_replace('"','',str_replace("'","",$raiz."Padron_Fotografico_Personal_externo/".Encrypter::quitar_tildes($id_persona."-".$result."-".$_FILES['archivo_adjunto']['name'])));
            //Formatea el nombre del archivo a almacenar
            $nombre_ruta=str_replace('"','',str_replace("'","",Encrypter::quitar_tildes($id_persona."-".$result."-".$_FILES['archivo_adjunto']['name'])));
            
            //Validación de como llegó el archivo adjunto desde el formulario html
            switch ($recepcion_archivo) {
                //En caso de que sea cero, procede a almacenar la imagen
                case 0:{
                    //Verifica que el formato y extensión del archivo sean de imagen
                    if ((basename($_FILES['archivo_adjunto']['type'])==="jpeg")||(basename($_FILES['archivo_adjunto']['type'])==="gif")||(basename($_FILES['archivo_adjunto']['type'])==="png")||(basename($_FILES['archivo_adjunto']['type'])==="bmp")||(basename($_FILES['archivo_adjunto']['type'])==="tiff")||(basename($_FILES['archivo_adjunto']['type'])==="jpg")){
                    //Verifica que el archivo se pueda trasladar a la ubicación correspondiente.
                        if (move_uploaded_file($_FILES['archivo_adjunto']['tmp_name'], $ruta)){
                            //Establece el nombre de la imagen a guardar
                            $obj_padron_fotografico->setNombre_ruta(Encrypter::quitar_tildes($nombre_ruta));
                            //Establece el formato de la imagen
                            $obj_padron_fotografico->setFormato(basename($_FILES['archivo_adjunto']['type']));
                            //Define la condición a vacio, para que agregue un nuevo registro
                            $obj_padron_fotografico->setCondicion("");
                            //Inserta en bd
                            $obj_padron_fotografico->guardar_imagen_personal_externo();
                            //Llama al formulario correspondiente
                            header ("location:/ORIEL/index.php?ctl=personal_externo_gestion&id=".$obj_padron_fotografico->getId_puntobcr());
                            //echo ("Ingresada correctamente");
                        }else{
                            //Muestra en pantalla que se presentó un error al subir el archivo
                            echo "<script type=\"text/javascript\">alert('Hubo un problema al subir el archivo al servidor!!!');history.go(-1);</script>";;
                        }
                    }else{
                        //Muestra en pantalla que el formato del archivo no es correcto
                        echo "<script type=\"text/javascript\">alert('El archivo no corresponde a un formato valido de imagenes !!!!');history.go(-1);</script>";;
                    }
                    break;
                }
                //Envia un mensaje al usuario porque el archivo es mas grande de lo previsto    
                case 2:{
                    echo "<script type=\"text/javascript\">alert('El archivo consume mayor espacio del permitido (2 mb) !!!!');history.go(-1);</script>";;
                    break;
                }
                case 4:{ 
                    //Envia un mensaje al usuario indicando que es necesario seleccionar un archivo para adjuntar
                    echo "<script type=\"text/javascript\">alert('No fue seleccionado ningun archivo!!!!');history.go(-1);</script>";;
                                       
                    break;
                }
                 case 6:{
                     //Envia al usuario un mensaje indicando que hay problemas para acceder a la carpeta temporal
                    echo "<script type=\"text/javascript\">alert('El servidor no tiene acceso a la carpeta temporal de almacenamiento!!!!');history.go(-1);</script>";
                    break;
                 } 
                case 7:{
                    //Envia un mensaje al usuario indicando que hay problemas para escribir en el disco duro del server
                    echo "<script type=\"text/javascript\">alert('No es posible escribir en el disco duro del servidor!!!!');history.go(-1);</script>";;
                    break;
                }  
                case 8:{
                    //Envia  mensaje al usuario debido a un error de PHP
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
            //Llamada al formulario de la vista para el usuario
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
         }  
    }
    
    public function eliminar_imagen_personal_externo(){
        //Validación para verificar si el usuario está logeado en el sistema  
        if(isset($_SESSION['nombre'])){
            //Creacion de una instancia de la clase padron fotografico
            $obj_padron_fotografico= new cls_padron_fotografico_puntosbcr();
            //Verifica que el envión de información haya sido realizado mediante el metodo post )formulario HTML)
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Busca el registro correspondiente mediante el id llave de la tabla
                $obj_padron_fotografico->setCondicion("ID_Padron_Personal=".$_POST['id_imagen']);
                //Ejecuta el metodo que obtiene las imagenes correspondientes
                $obj_padron_fotografico->obtener_imagenes_personal_externo();
                //Obtiene el arreglo correspondiente
                $params=$obj_padron_fotografico->getArreglo();
                //Elimina la imagen de la base de datos
                $obj_padron_fotografico->eliminar_imagen_personal_externo();
                
                //Obtiene la ruta del directorio raiz de oriel mediante la variable reservada correspondiente
                $raiz=$_SERVER['DOCUMENT_ROOT'];
    
                //Formatea la ruta para verificar si tiene la cantidad adecuada de /
                if (substr($raiz,-1)!="/"){
                    $raiz.="/";
                }

                //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/20161110111422Entrada Principal.jpg";
               //$ruta=  $raiz."Padron_Fotografico_Puntos_BCR/".$_POST['ruta_imagen'];
                //Establece la ruta completa de la imagen, incluyendo el nombre y la extensión de la misma
                $ruta=  $raiz."Padron_Fotografico_Personal_externo/".$params[0]['Nombre_Ruta'];
                
               //Borra el archivo fisico del disco duro
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
            //Llamada al formulario correspondiente de la vista
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
            
    public function personal_externo_validar(){
        if(isset($_SESSION['nombre'])){
            //Crear objeto de la clase personal
            $obj_persona = new cls_personal_externo ();
            //Establece los atributos de la clase
            $obj_persona->setValidado($_POST['validar']);
            $obj_persona->setId($_SESSION['id']);
            $obj_persona->setCondicion("ID_Persona_Externa='".$_POST['id_persona']."'");
            
            $obj_persona->validar_persona_externa();
            
        }else {
              /*
             * Esta es la validación contraria a que la sesión de usuario esté definida y abierta.
             * Lo cual quiere decir, que si la sesión está cerrada, procede  a enviar la solicitud
             * a la pantalla de inicio de sesión con el mensaje de warning correspondiente.
             * En la última línea llama a la pagina de inicio de sesión.
             */
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            //Llamada al formulario de la vista para el usuario
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    /////////////////////////Funciones de Tipo Telefono/////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    public function tipo_telefono_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_tipo_telefono = new cls_tipo_telefono();
           $obj_tipo_telefono->obtener_tipo_telefono();
           $params =$obj_tipo_telefono->getArreglo();
           
            require __DIR__.'/../vistas/plantillas/frm_tipo_telefono_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 
    
    public function tipo_telefono_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_tipo_telefono = new cls_tipo_telefono();
               $obj_tipo_telefono->setTipo_Telefono($_POST['nombre']); 
               $obj_tipo_telefono->setObservaciones($_POST['observaciones']);
               
                if ($_POST['ID_Tipo_Telefono']==0){
                   $obj_tipo_telefono->setEstado(1);
                   $obj_tipo_telefono->agregar_nueva_tt();
                }else{
                           $obj_tipo_telefono->setEstado($_POST['estado']);
                           $obj_tipo_telefono->setCondicion("ID_Tipo_Telefono='".$_POST['ID_Tipo_Telefono']."'");
                           $obj_tipo_telefono->edita_tt();
                   
                }       
           $obj_tipo_telefono->setCondicion("");    
           $obj_tipo_telefono->obtener_tipo_telefono();
           $params =$obj_tipo_telefono->getArreglo();
           require __DIR__.'/../vistas/plantillas/frm_tipo_telefono_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function tipo_telefono_cambiar_estado() {
       if(isset($_SESSION['nombre'])){
           $obj_tipo_telefono = new cls_tipo_telefono();
           
           if ($_GET['estado']==1){
               
               $obj_tipo_telefono->setEstado("0");
               
           }else {
               
               $obj_tipo_telefono->setestado("1");
           }
           $obj_tipo_telefono->setCondicion("ID_Tipo_Telefono='".$_GET['id']."'");
           $obj_tipo_telefono->cambiar_estado_tt();
           $obj_tipo_telefono->setCondicion("");    
           $obj_tipo_telefono->obtener_tipo_telefono();
           $params =$obj_tipo_telefono->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_tipo_telefono_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Funciones de Tipo Punto/////////////////////          
    ////////////////////////////////////////////////////////////////////////////
    public function tipo_punto_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_tipo_punto = new cls_tipo_punto();
           $obj_tipo_punto->obtener_tipo_punto();
           $params =$obj_tipo_punto->getArreglo();
           
            require __DIR__.'/../vistas/plantillas/frm_tipo_punto_bcr_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }  

    public function tipo_punto_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_tipo_punto = new cls_tipo_punto();
               $obj_tipo_punto->setTipo_Punto($_POST['nombre']); 
               $obj_tipo_punto->setObservaciones($_POST['observaciones']);
               
                if ($_POST['ID_Tipo_Punto']==0){
                   $obj_tipo_punto->setEstado(1);
                   $obj_tipo_punto->agregar_nueva_tp();
                }else{
                           $obj_tipo_punto->setEstado($_POST['estado']);
                           $obj_tipo_punto->setCondicion("ID_Tipo_Punto='".$_POST['ID_Tipo_Punto']."'");
                           $obj_tipo_punto->edita_tp();
                   
                }       
           $obj_tipo_punto->setCondicion("");    
           $obj_tipo_punto->obtener_tipo_punto();
           $params =$obj_tipo_punto->getArreglo();
           require __DIR__.'/../vistas/plantillas/frm_tipo_punto_bcr_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function notas_coordinacion_bitacora_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_eventos = new cls_eventos();
               
               $obj_eventos->setObservaciones_supervision($_POST['observaciones']);
               $obj_eventos->setId($_POST['ID_Evento']);
               
                if (strcmp ($_POST['observaciones'],"Sin Anotaciones")==0){
                    $obj_eventos->setFecha_notas_supervision("1983-04-09");
                }else
                {
                    $obj_eventos->setFecha_notas_supervision(date("Y-m-d"));
                }
               
                $obj_eventos->edita_notas_supervision_evento();
                
                header ("location:/ORIEL/index.php?ctl=frm_eventos_listar");
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function tipo_punto_cambiar_estado() {

       if(isset($_SESSION['nombre'])){
           $obj_tipo_punto = new cls_tipo_punto();
           
           if ($_GET['estado']==1){
               
               $obj_tipo_punto->setEstado("0");
               
           }else {
               
               $obj_tipo_punto->setestado("1");
           }
           $obj_tipo_punto->setCondicion("ID_Tipo_Punto='".$_GET['id']."'");
           $obj_tipo_punto->cambiar_estado_tp();
           $obj_tipo_punto->setCondicion("");    
           $obj_tipo_punto->obtener_tipo_punto();
           $params =$obj_tipo_punto->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_tipo_punto_bcr_catalogo.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////Gerentes de Zona////////////////////////////////          
    ////////////////////////////////////////////////////////////////////////////
    public function gerente_zona_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_gerentezona = new cls_gerente_zona();
           $obj_gerentezona->setCondicion("");
           $obj_gerentezona->obtiene_gerente_zona();
           $params =$obj_gerentezona->getArreglo();
           $numero =$obj_gerentezona->getArreglo();
           $obj_gerentezona->obtener_nombre_gerente_zona();
           $nombre =$obj_gerentezona->getArreglo();
                   
           require __DIR__.'/../vistas/plantillas/frm_gerente_zona_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 
    
    public function gerente_zona_guardar(){
        if(isset($_SESSION['nombre'])){   
            $obj_gerentezona = new cls_gerente_zona();
            $obj_gerentezona->setNombre($_POST['nombre2']);
            $obj_gerentezona->setZona($_POST['zona_gerencia2']);
            $obj_gerentezona->setObservaciones($_POST['observaciones2']);
            $obj_gerentezona->setEstado($_POST['estado2']);
            $obj_gerentezona->guardar_gerente_zona();
                
            header ("location:/ORIEL/index.php?ctl=gerente_zona_listar");
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function gerente_zona_editar(){
        if(isset($_SESSION['nombre'])){
            $obj_gerentezona = new cls_gerente_zona();
            $obj_gerentezona->setNombre($_POST['nombre']); 
            $obj_gerentezona->setZona($_POST['zona_gerencia']); 
            $obj_gerentezona->setObservaciones($_POST['observaciones']);
              
            if ($_POST['ID_Gerente_Zona']>=(1)){
                $obj_gerentezona->setCondicion("ID_Gerente_Zona='".$_POST['ID_Gerente_Zona']."'");
                $obj_gerentezona->editar_gerente_zona();
                   
            }       
           header ("location:/ORIEL/index.php?ctl=gerente_zona_listar");
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function gerente_zona_cambiar_estado() {
       if(isset($_SESSION['nombre'])){
           $obj_gerentezona = new cls_gerente_zona();
           
           if ($_GET['estado']==1){
               
               $obj_gerentezona->setEstado("0");
               
           }else {
               
               $obj_gerentezona->setestado("1");
           }
           $obj_gerentezona->setCondicion("ID_Gerente_Zona='".$_GET['id']."'");
           $obj_gerentezona->cambiar_estado_gerente_zona();
           $obj_gerentezona->setCondicion("");    
           $obj_gerentezona->obtiene_gerente_zona();
           $params =$obj_gerentezona->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_gerente_zona_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////Supervisor de Zona//////////////////////////////      
    ////////////////////////////////////////////////////////////////////////////
    public function supervisor_zona_listar() {
        if(isset($_SESSION['nombre'])){
            $obj_supervisorzona = new cls_supervisor_zona();
            $obj_supervisorzona->setCondicion("");
            $obj_supervisorzona->obtiene_supervisor_zona();
            $params =$obj_supervisorzona->getArreglo();
            
            //$numero =$obj_supervisorzona->getArreglo();
            $obj_supervisorzona->obtener_nombre_supervisor_zona();
            $nombre =$obj_supervisorzona->getArreglo();

            require __DIR__.'/../vistas/plantillas/frm_supervisor_zona_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 
    
    public function supervisor_zona_guardar(){
        if(isset($_SESSION['nombre'])){   
            $obj_supervisorzona = new cls_supervisor_zona();
            $obj_supervisorzona->setNombre($_POST['nombre2']);
            $obj_supervisorzona->setZona($_POST['zona_supervisor2']);
            $obj_supervisorzona->setObservaciones($_POST['observaciones2']);
            $obj_supervisorzona->setEstado($_POST['estado2']);
            $obj_supervisorzona->guardar_supervisor_zona();
            header ("location:/ORIEL/index.php?ctl=supervisor_zona_listar");
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function supervisor_zona_editar(){
        if(isset($_SESSION['nombre'])){
            $obj_supervisorzona = new cls_supervisor_zona();
            $obj_supervisorzona->setNombre($_POST['nombre']); 
            $obj_supervisorzona->setZona($_POST['zona_supervisor']); 
            $obj_supervisorzona->setObservaciones($_POST['observaciones']);
               
            if ($_POST['ID_Supervisor_Zona']>=(1)){
                $obj_supervisorzona->setCondicion("ID_Supervisor_Zona='".$_POST['ID_Supervisor_Zona']."'");
                $obj_supervisorzona->editar_supervisor_zona();    
            }       
            header ("location:/ORIEL/index.php?ctl=supervisor_zona_listar");
        }else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function supervisor_zona_cambiar_estado() {
       if(isset($_SESSION['nombre'])){
           $obj_supervisorzona = new cls_supervisor_zona();
           
           if ($_GET['estado']==1){
               
               $obj_supervisorzona->setEstado("0");
               
           }else {
               
               $obj_supervisorzona->setestado("1");
           }
           $obj_supervisorzona->setCondicion("ID_Supervisor_Zona='".$_GET['id']."'");
           $obj_supervisorzona->cambiar_estado_supervisorzona();
           $obj_supervisorzona->setCondicion("");    
           $obj_supervisorzona->obtiene_supervisor_zona();
           $params =$obj_supervisorzona->getArreglo();
            require __DIR__.'/../vistas/plantillas/frm_supervisor_zona_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    
   ////////////////////////////////////////////////////////////////////////////
    /////////////////////////Manuales de Ayuda//////////////////////////////////  
    ////////////////////////////////////////////////////////////////////////////    
    public function manual_personal_externo_publico() {
        //Llamada al formulario correspondiente de la vista
        require __DIR__ . '/../vistas/plantillas/frm_ayuda_personal_externo_publico.php';
    }
        
    public function manual_ayuda_privado(){
        if(isset($_SESSION['nombre'])){
            //Llamada al formulario correspondiente de la vista
            $manual=$_GET['manual'];
            require __DIR__ . '/../vistas/plantillas/ayuda_privado_manuales.php';
        } else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        } 
    }
      
    
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////Controles de Video////////////////////////////////  
    ////////////////////////////////////////////////////////////////////////////
    public function validar_inconsistencias_video_guardar() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           
           $obj_puesto_monitoreo->setCondicion("ID_Inconsistencia_Video=".$_POST['ID_Inconsistencia_Video']);
           
           
           $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
           
           $obj_puesto_monitoreo->setFecha_validacion(date("Y-m-d"));
           $obj_puesto_monitoreo->setHora_validacion(date("H:i:s", time()));
           $obj_puesto_monitoreo->setEstado($_POST['estado_validacion']);
           $obj_puesto_monitoreo->setTipo_inconsistencia($_POST['tipo_inconsistencia']);
           $obj_puesto_monitoreo->setObservaciones($_POST['observaciones_validacion']);
           
           $obj_puesto_monitoreo->edita_validacion_inconsistencia_de_video();
           
           header ("location:/ORIEL/index.php?ctl=inconsistencias_de_video_listar");
                    
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
            
    public function solucionar_inconsistencias_video_guardar() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           
           $obj_puesto_monitoreo->setCondicion("ID_Inconsistencia_Video=".$_POST['ID_Inconsistencia_Video_SO']);
           
           
           $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
           
           $obj_puesto_monitoreo->setFecha_solucion(date("Y-m-d"));
           $obj_puesto_monitoreo->setHora_solucion(date("H:i:s", time()));
           $obj_puesto_monitoreo->setEstado($_POST['estado_solucion']);
           $obj_puesto_monitoreo->setObservaciones($_POST['observaciones_solucion']);
           
           $obj_puesto_monitoreo->edita_solucion_inconsistencia_de_video();
           
           header ("location:/ORIEL/index.php?ctl=inconsistencias_de_video_listar");
                    
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function reportar_inconsistencias_video_guardar() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           
           $obj_puesto_monitoreo->setCondicion("ID_Inconsistencia_Video=".$_POST['ID_Inconsistencia_Video_RE']);
           
           
           $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
           
           $obj_puesto_monitoreo->setFecha_reporta(date("Y-m-d"));
           $obj_puesto_monitoreo->setHora_reporta(date("H:i:s", time()));
           $obj_puesto_monitoreo->setEstado($_POST['estado_reporte']);
           $obj_puesto_monitoreo->setId_averia($_POST['id_averia']);
           $obj_puesto_monitoreo->setObservaciones($_POST['observaciones_reporte']);
           
           $obj_puesto_monitoreo->edita_reporte_inconsistencia_de_video();
           
           header ("location:/ORIEL/index.php?ctl=inconsistencias_de_video_listar");
                    
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function guarda_revision_de_video_actual() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           $obj_traza = new cls_trazabilidad();
           $resultado="";
           
           //Valida que el puesto de monitoreo se encuentre tomado por el usuario actual antes de salvar la revisión de video
           $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.Estado=1 AND t_puestomonitoreo.ID_Usuario=".$_SESSION['id']." AND t_puestomonitoreo.ID_Puesto_Monitoreo=".$_POST['id_puesto']);
           $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
          
           if (count($obj_puesto_monitoreo->getArreglo())>0){
              
               $obj_puesto_monitoreo->setCondicion("ID_Usuario=".$_SESSION['id']." AND Estado=0 AND ID_Bitacora_Revision_Video=".$_POST['id_revis']);
               if ($obj_puesto_monitoreo->existe_revision_de_video_pendiente_en_bitacora()){
              
                    $obj_puesto_monitoreo->setCondicion("ID_Bitacora_Revision_Video=".$_POST['id_revis']);

                    $obj_puesto_monitoreo->setEstado("1");
                    $obj_puesto_monitoreo->setFecha_termina_revision(date("Y-m-d"));
                    $obj_puesto_monitoreo->setHora_termina_revision(date("H:i:s", time()));
                    
                    $obj_puesto_monitoreo->setRequirio_mantenimiento($_POST['req_mantenimiento']);
                    $obj_puesto_monitoreo->setResultado_conexion($_POST['res_conexion']);
                    $obj_puesto_monitoreo->setReporta_situacion($_POST['rep_situacion']);

                    if (strlen(trim($_POST['rep_situacion']))>5){
                        $obj_puesto_monitoreo->setId_bitacora_revision_video($_POST['id_revis']);
                        $obj_puesto_monitoreo->setEstado_inconsistencia("0");
                        $obj_puesto_monitoreo->setTipo_inconsistencia("0");
                        $obj_puesto_monitoreo->agregar_nuevo_registro_inconsistencias_de_video();
                    }

                    $fechaInicialRevision = $_POST['fecha_ini']." ".$_POST['hora_ini'];     
                    $fechaActual =date("Y-m-d")." ".date("H:i:s", time());
                    $diferenciasegundos = intval(strtotime($fechaActual) - strtotime($fechaInicialRevision));

                    $obj_puesto_monitoreo->setDuracion_revision($diferenciasegundos);

                    $tiempo_maximo_revision=intval($_POST['tiem']);

                    if ($diferenciasegundos<=$tiempo_maximo_revision){
                        $obj_puesto_monitoreo->setRetraso_segundos("0");
                        $obj_puesto_monitoreo->setJustificacion_retraso("");
                        $obj_puesto_monitoreo->guarda_y_concluye_una_revision_de_video();
                        $resultado= 'on_time';
                    }else{
                        $diferenciasegundos=$diferenciasegundos-$tiempo_maximo_revision;
                        $obj_puesto_monitoreo->setRetraso_segundos($diferenciasegundos);
                        $obj_traza->setCondicion("(t_traza.ID_Usuario=".$_SESSION['id'].") AND (t_traza.Tabla_Afectada='T_Evento' OR t_traza.Tabla_Afectada='T_detalleEvento' OR t_traza.Tabla_Afectada='T_EventoCencon' OR t_traza.Tabla_Afectada='T_PruebaAlarma') AND (t_traza.Fecha between '".$_POST['fecha_ini']."' AND '".date("Y-m-d")."') AND (t_traza.Hora between '".$_POST['hora_ini']."' AND '".date("H:i:s", time())."')");
                        $obj_traza->obtiene_trazabilidad();
                        if (count($obj_traza->getArreglo())>0){
                            $obj_puesto_monitoreo->setJustificacion_retraso("JUSTIFICADO. Usuario: ".$_SESSION['name']." ".$_SESSION['apellido']." Cédula: ".$_SESSION['nombre']." Id:".$_SESSION['id']." con retraso justificado de ".$diferenciasegundos." segundos, en la revisión de video actual. Atendiendo procesos del centro de control (bitácora, cencon y pruebas de alarma).");
                            $resultado= 'justificado'; 
                        }else{
                            $obj_puesto_monitoreo->setJustificacion_retraso("INJUSTIFICADO. Usuario: ".$_SESSION['name']." ".$_SESSION['apellido']." Cédula: ".$_SESSION['nombre']." Id:".$_SESSION['id']." no justificó el retraso de ".$diferenciasegundos." segundos, en la revisión de video actual. La ventana de justificación fue omitida o cerrada por el usuario.");
                            $resultado= 'retraso'; 
                        }    
                        
                        $obj_puesto_monitoreo->guarda_y_concluye_una_revision_de_video();
                        
                    }

                    $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$_POST['id_puesto']);
                    $obj_puesto_monitoreo->obtiene_todas_las_unidades_asociadas_a_un_puesto_de_monitoreo();

                    if (count($obj_puesto_monitoreo->getArreglo())>0){

                          $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.Estado=1 AND t_puestomonitoreo.ID_Usuario=".$_SESSION['id']." AND t_puestomonitoreo.ID_Puesto_Monitoreo=".$_POST['id_puesto']);
                          $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
                          $vector_puesto_de_monitoreo_actual=$obj_puesto_monitoreo->getArreglo();

                          if (count($obj_puesto_monitoreo->getArreglo())>0){
                             //ingresa en base de datos la siguiente revisión
                             $obj_puesto_monitoreo->setId_puesto_monitoreo($_POST['id_puesto']);
                             $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=1 order by ID_Bitacora_Revision_Video desc");
                             $obj_puesto_monitoreo->obtiene_ultima_posicion_concluida_en_puesto_de_monitoreo();
                             $temp_posicion=intval($obj_puesto_monitoreo->getUltima_posicion_concluida());
                             $temp_posicion=$temp_posicion+1;
                             //$obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=".$obj_puesto_monitoreo->getUltima_posicion_concluida()+1);
                             $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=".$temp_posicion);
                             if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                 //$obj_puesto_monitoreo->setPosicion($obj_puesto_monitoreo->getUltima_posicion_concluida()+1);
                                 $obj_puesto_monitoreo->setPosicion($temp_posicion);
                             }else{
                                 $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=1");
                                 if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                     $obj_puesto_monitoreo->setPosicion(1);

                                 }
                             } 
                           
                           //Validación que permite enviar un sitio 10 posiciones adelante
                             
                              $verifica_si_hay_para_revisar=-1;
                              $verifica_si_hay_para_reacomodar=-1;
                             
                               if (($_POST['req_mantenimiento']=="1")&&($_POST['res_conexion']=="2")){
                                   if (!isset($_SESSION['vector_temp_revision_video'])){
                                       $vector_temp_revision_video=array();
                                       $vector_temp_revision_video[]=array("ID_Puesto_Monitoreo"=>$_POST['id_puesto'],"Posicion"=>$_POST['pos'],"ID_Usuario"=>$_SESSION['id'],"Contador"=>0,"Posicion_Real"=>$obj_puesto_monitoreo->getPosicion());
                                       $_SESSION['vector_temp_revision_video']=$vector_temp_revision_video;
                                      
                                   }else{
                                       $tam=count($_SESSION['vector_temp_revision_video']);
                                       $ya_existe_esta_posicion=0;
                                       for ($i = 0; $i < $tam; $i++) {
                                           if (($_SESSION['vector_temp_revision_video'][$i]['ID_Usuario']==$_SESSION['id'])&&($_SESSION['vector_temp_revision_video'][$i]['ID_Puesto_Monitoreo']==$_POST['id_puesto'])){
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Posicion']==$obj_puesto_monitoreo->getPosicion()){
                                                    $ya_existe_esta_posicion=1;    
                                               }
                                               $temp=intval($_SESSION['vector_temp_revision_video'][$i]['Contador']);
                                               $temp=$temp+1;
                                               $_SESSION['vector_temp_revision_video'][$i]['Contador']=$temp;
                                               
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']<11){
                                                   $_SESSION['vector_temp_revision_video'][$i]['Posicion_Real']=$obj_puesto_monitoreo->getPosicion();
                                               }
                                               
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']==10){
                                                   $verifica_si_hay_para_revisar=$i;
                                               }
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']==11){
                                                   $verifica_si_hay_para_reacomodar=$i;
                                               }
                                           }
                                       }
                                       if ($ya_existe_esta_posicion==0){
                                           $vector_temp_revision_video[]=array("ID_Puesto_Monitoreo"=>$_POST['id_puesto'],"Posicion"=>$_POST['pos'],"ID_Usuario"=>$_SESSION['id'],"Contador"=>0,"Posicion_Real"=>$obj_puesto_monitoreo->getPosicion());
                                           $_SESSION['vector_temp_revision_video']=  array_merge($_SESSION['vector_temp_revision_video'],$vector_temp_revision_video);
                                       }
                                   }    
                               }else{
                                   if (isset($_SESSION['vector_temp_revision_video'])){
                                       $tam=count($_SESSION['vector_temp_revision_video']);
                                       for ($i = 0; $i < $tam; $i++) {
                                           if (($_SESSION['vector_temp_revision_video'][$i]['ID_Usuario']==$_SESSION['id'])&&($_SESSION['vector_temp_revision_video'][$i]['ID_Puesto_Monitoreo']==$_POST['id_puesto'])){
                                               $temp=intval($_SESSION['vector_temp_revision_video'][$i]['Contador']);
                                               $temp=$temp+1;
                                               $_SESSION['vector_temp_revision_video'][$i]['Contador']=$temp;
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']<11){
                                                   $_SESSION['vector_temp_revision_video'][$i]['Posicion_Real']=$obj_puesto_monitoreo->getPosicion();
                                               }
                                               
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']==10){
                                                   $verifica_si_hay_para_revisar=$i;
                                               }
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']==11){
                                                   $verifica_si_hay_para_reacomodar=$i;
                                               }
                                           }
                                       }
                                   }
                               }
                            
                             if ($verifica_si_hay_para_revisar>-1){
                                $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_revisar]['ID_Puesto_Monitoreo']. " AND Posicion=".$_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_revisar]['Posicion']);
                                if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                      $obj_puesto_monitoreo->setPosicion($_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_revisar]['Posicion']);
                                }
                                $verifica_si_hay_para_revisar=-1;
                             }  
                              if ($verifica_si_hay_para_reacomodar>-1){
                                $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_reacomodar]['ID_Puesto_Monitoreo']. " AND Posicion=".$_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_reacomodar]['Posicion_Real']);
                                if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                      $obj_puesto_monitoreo->setPosicion($_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_reacomodar]['Posicion_Real']);
                                }
                                unset($_SESSION['vector_temp_revision_video'][$verifica_si_hay_para_reacomodar]);
                                if(count($_SESSION['vector_temp_revision_video'])==0){
                                    unset($_SESSION['vector_temp_revision_video']);
                                }else{
                                    $_SESSION['vector_temp_revision_video'] = array_values($_SESSION['vector_temp_revision_video']);
                                     if (isset($_SESSION['vector_temp_revision_video'])){
                                        $tam=count($_SESSION['vector_temp_revision_video']);

                                        for ($i = 0; $i < $tam; $i++) {
                                            if (($_SESSION['vector_temp_revision_video'][$i]['ID_Usuario']==$_SESSION['id'])&&($_SESSION['vector_temp_revision_video'][$i]['ID_Puesto_Monitoreo']==$_POST['id_puesto'])){
                                               if ($_SESSION['vector_temp_revision_video'][$i]['Contador']==10){
                                                   $_SESSION['vector_temp_revision_video'][$i]['Contador']=9;
                                               }
                                               $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_SESSION['vector_temp_revision_video'][$i]['ID_Puesto_Monitoreo']);   
                                               $temp_ultima_posicion=$obj_puesto_monitoreo->obtiene_ultima_posicion_de_un_puesto_de_monitoreo();
                                               if ($temp_ultima_posicion>0){
                                                   $temp_pos_mas_diez=11 + intval($_SESSION['vector_temp_revision_video'][$i]['Posicion']);
                                                   if ($temp_pos_mas_diez<$temp_ultima_posicion){
                                                       $_SESSION['vector_temp_revision_video'][$i]['Posicion_Real']=$temp_pos_mas_diez;
                                                   }else{
                                                       if (($temp_pos_mas_diez-$temp_ultima_posicion)==0){
                                                           $_SESSION['vector_temp_revision_video'][$i]['Posicion_Real']=1;
                                                       }else{
                                                           $_SESSION['vector_temp_revision_video'][$i]['Posicion_Real']=$temp_pos_mas_diez-$temp_ultima_posicion;
                                                       }
                                                   }
                                               }
                                            }
                                        }
                                    }
                                }
                                $verifica_si_hay_para_reacomodar=-1;
                                
                             }
                             
                            
                             //Ingresa próxima revision de video en bitacora de revisiones de video.
                             $obj_puesto_monitoreo->setId_ultimo_toma_puesto_ingresada($_POST['id_control_puesto']);
                             $obj_puesto_monitoreo->setFecha_inicia_revision(date("Y-m-d"));
                             $obj_puesto_monitoreo->setHora_inicia_revision(date("H:i:s", time()));
                             $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
                             $obj_puesto_monitoreo->setObservaciones("");
                             $obj_puesto_monitoreo->setEstado(0);
                             $obj_puesto_monitoreo->agregar_nuevo_registro_bitacora_revisiones_de_video();
                          }
                    }
                    echo $resultado;
                    
               }else{
               $resultado="revision_cerrada";
               echo $resultado;
           }
           }else{
               $resultado="no_asignado";
               echo $resultado;
           }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function guarda_justificacion_retraso_control_de_video() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
                     
           $obj_puesto_monitoreo->setCondicion("ID_Bitacora_Revision_Video=".$_POST['id_bitacora_revision_actual']);
           
           if (strlen(trim($_POST['txt_retraso']))>14){
               $obj_puesto_monitoreo->setJustificacion_retraso($_POST['txt_retraso']);
               $obj_puesto_monitoreo->agrega_justificacion_en_retraso_de_una_revision_de_video();
               $obj_puesto_monitoreo->setFecha_inicia_revision(date("Y-m-d"));
               //$obj_puesto_monitoreo->setHora_inicia_revision(date("H:i:s", time()));
               $obj_puesto_monitoreo->setHora_inicia_revision("ADDTIME(Hora_Inicia_Revision,'00:00:15')");
               $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto_justificacion']." AND ID_Usuario=".$_SESSION['id']." AND Estado=0");
               $obj_puesto_monitoreo->edita_tiempo_de_inicio_en_revision_de_video();
               
               header ("location:/ORIEL/index.php?ctl=controles_de_video_listar");
           }else{
               header ("location:/ORIEL/index.php?ctl=controles_de_video_listar");
           }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function tomar_puesto_de_monitoreo() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.ID_Puesto_Monitoreo=".$_POST['id_puesto']." AND t_puestomonitoreo.Estado=1");
           $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
           if (count($obj_puesto_monitoreo->getArreglo())>0){
               $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.ID_Usuario=".$_SESSION['id']." AND ID_Puesto_Monitoreo<>".$_POST['id_puesto']);
               $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
               if (count($obj_puesto_monitoreo->getArreglo())>0){
                   echo 'En otro puesto';
               }else{
                   $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.ID_Puesto_Monitoreo=".$_POST['id_puesto']." AND t_puestomonitoreo.ID_Usuario<>0");
                   $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
                   if (count($obj_puesto_monitoreo->getArreglo())>0){
                        echo 'Ocupado';
                   }else{
                       $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']." AND Estado=1");
                       $obj_puesto_monitoreo->obtiene_bitacora_puestos_de_monitoreo();
                       if (count($obj_puesto_monitoreo->getArreglo())>0){
                            echo 'Ocupado';
                       }else{
                            $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$_POST['id_puesto']);
                            $obj_puesto_monitoreo->obtiene_todas_las_unidades_asociadas_a_un_puesto_de_monitoreo();
                             if (count($obj_puesto_monitoreo->getArreglo())>0){
                                
                                $obj_puesto_monitoreo->setFecha_toma_control(date("Y-m-d"));
                                $obj_puesto_monitoreo->setHora_toma_control(date("H:i:s", time()));
                                $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
                                $obj_puesto_monitoreo->setId_puesto_monitoreo($_POST['id_puesto']);
                                $obj_puesto_monitoreo->setEstado("1");
                                $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']);
                                $obj_puesto_monitoreo->insertar_toma_de_puesto_de_monitoreo();
                                $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=1 AND ID_Usuario=".$_SESSION['id']);
                                $obj_puesto_monitoreo->obtiene_id_ultimo_toma_puesto_ingresada();
                                $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=0 AND ID_Usuario=".$_SESSION['id']);
                                
                                if (!($obj_puesto_monitoreo->existe_revision_de_video_pendiente_en_bitacora())){
                                    $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=0 AND ID_Usuario<>".$_SESSION['id']);
                                    if ($obj_puesto_monitoreo->existe_revision_de_video_pendiente_en_bitacora()){
                                        $obj_puesto_monitoreo->setFecha_inicia_revision(date("Y-m-d"));
                                        $obj_puesto_monitoreo->setHora_inicia_revision(date("H:i:s", time()));
                                        $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
                                        $obj_puesto_monitoreo->edita_usuario_y_tiempo_de_inicio_en_revision_de_video();                 
                                    }else{
                                        $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=1 order by ID_Bitacora_Revision_Video desc");
                                        $obj_puesto_monitoreo->obtiene_ultima_posicion_concluida_en_puesto_de_monitoreo();
                                        $temp_posicion=intval($obj_puesto_monitoreo->getUltima_posicion_concluida());
                                        $temp_posicion=$temp_posicion+1;
                                        //$obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=".$obj_puesto_monitoreo->getUltima_posicion_concluida()+1);
                                        $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=".$temp_posicion);
                                        if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                            //$obj_puesto_monitoreo->setPosicion($obj_puesto_monitoreo->getUltima_posicion_concluida()+1);
                                            $obj_puesto_monitoreo->setPosicion($temp_posicion);
                                        }else{
                                            $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Posicion=1");
                                            if ($obj_puesto_monitoreo->existe_esta_posicion_en_este_puesto_de_monitoreo()){
                                                $obj_puesto_monitoreo->setPosicion(1);
                                                
                                            }
                                        } 
                                        //Ingresa nuevo registro de bitacora en la tabla de revisiones de video.
                                        $obj_puesto_monitoreo->setFecha_inicia_revision(date("Y-m-d"));
                                        $obj_puesto_monitoreo->setHora_inicia_revision(date("H:i:s", time()));
                                        $obj_puesto_monitoreo->setId_usuario($_SESSION['id']);
                                        $obj_puesto_monitoreo->setId_puesto_monitoreo($_POST['id_puesto']);
                                        $obj_puesto_monitoreo->setObservaciones("");
                                        $obj_puesto_monitoreo->setEstado(0);
                                        $obj_puesto_monitoreo->agregar_nuevo_registro_bitacora_revisiones_de_video();
                                    }
                                }else{
                                    $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']. " AND Estado=0 AND ID_Usuario=".$_SESSION['id']);
                                    $obj_puesto_monitoreo->edita_toma_de_puesto_en_revision_de_video_pendiente();
                                }
                                echo 'Tomado';
                             }else{
                                  echo 'Sin_Unidades';
                             }               
                       }
                       
                   }
               }
           }else{
               echo 'Inactivo';
           }     
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function liberar_puesto_de_monitoreo() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$_POST['id_puesto']);
           $obj_puesto_monitoreo->setFecha_libera_control(date("Y-m-d"));
           $obj_puesto_monitoreo->setHora_libera_control(date("H:i:s", time()));
           $obj_puesto_monitoreo->setEstado("0");
           $obj_puesto_monitoreo->liberar_puesto_monitoreo();
           echo "liberado";           
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function actualiza_segundero_revision_video() {
       if(isset($_SESSION['nombre'])){
           //echo ;
           $fechaInicialRevision = $_POST['fecha_inicio'];
           $fechaActual =date("Y-m-d")." ".date("H:i:s", time());
           $diferenciasegundos = strtotime($fechaActual) - strtotime($fechaInicialRevision);
           echo $diferenciasegundos;
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function inconsistencias_de_video_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           $obj_puesto_monitoreo->obtiene_inconsistencias_de_video();
           $params =$obj_puesto_monitoreo->getArreglo();
           
            //print_r($vector_estadisticas);
            require __DIR__.'/../vistas/plantillas/frm_inconsistencias_video_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 
    
    public function puestos_de_monitoreo_listar() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
           $params =$obj_puesto_monitoreo->getArreglo();
           
           $vector_estadisticas=array ();
           //$vector_estadisticas[]=array ("","","");
           
           for ($i = 0; $i < count($params); $i++) {
                
               $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$params[$i]['ID_Puesto_Monitoreo']);
               $obj_puesto_monitoreo->obtiene_estadistica_general_puestos_de_monitoreo();
               $vector_temporal=$obj_puesto_monitoreo->getArreglo();
               
               if (count($vector_temporal)>0){
                  $vector_estadisticas[]=$vector_temporal[0];
                }else {
                  $vector_estadisticas[]=array("Total_Minutos"=>"0","Total_Unidades"=>"0","Total_Camaras"=>"0");
                }
            }
            
            $obj_puesto_monitoreo->setCondicion("t_unidadvideo.Estado=0");
            $obj_puesto_monitoreo->obtiene_distribucion_unidades_de_video_en_puestos_de_monitoreo();
            $vector_distribucion_unidades=$obj_puesto_monitoreo->getArreglo();
            
//            echo '<pre>';
//                print_r($vector_distribucion_unidades);
//            echo '</pre>';
            
            //print_r($vector_estadisticas);
            require __DIR__.'/../vistas/plantillas/frm_puestos_de_monitoreo_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 
    
    public function controles_de_video_listar() { 
       if(isset($_SESSION['nombre'])){
             $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
             $obj_unidad_video = new cls_unidad_video();
             $obj_puntos_bcr = new cls_puntosBCR();
             
             //Vector puesto de monitoreo actual 1
             $obj_puesto_monitoreo->setCondicion("t_puestomonitoreo.Estado=1 AND t_puestomonitoreo.ID_Usuario=".$_SESSION['id']);
             $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
             $vector_puesto_de_monitoreo_actual=$obj_puesto_monitoreo->getArreglo();
             //termina la consulta 
             
             if (count($obj_puesto_monitoreo->getArreglo())>0){
                 
                //Vector revision de video actual en bitacora 2
                $obj_puesto_monitoreo->setCondicion("Estado=0 AND ID_Usuario=".$_SESSION['id']." AND ID_Puesto_Monitoreo=".$vector_puesto_de_monitoreo_actual[0]['ID_Puesto_Monitoreo']);
                $obj_puesto_monitoreo->obtiene_revisiones_de_video();
                $vector_revision_de_video_actual=$obj_puesto_monitoreo->getArreglo();
                //termina la consulta 
                
                if (count($vector_revision_de_video_actual)>0){
                     $fechaInicialRevision = $vector_revision_de_video_actual[0]['Fecha_Inicia_Revision']." ".$vector_revision_de_video_actual[0]['Hora_Inicia_Revision'];
                     $fechaActual =date("Y-m-d")." ".date("H:i:s", time());
                     $diferenciasegundos = strtotime($fechaActual) - strtotime($fechaInicialRevision);
                     
                     //Vector información unidad de video 3
                     $obj_unidad_video->setCondicion("t_unidadvideo.ID_Unidad_Video=".$vector_revision_de_video_actual[0]['ID_Unidad_Video']);
                     $obj_unidad_video->obtiene_todas_las_unidades_de_video();
                     $vector_informacion_unidad_video=$obj_unidad_video->getArreglo();
                     //termina la consulta 
                     
                     //Vector información puesto de monitoreo-unidad de video 4
                     $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$vector_revision_de_video_actual[0]['ID_Puesto_Monitoreo']." AND T_PuestoMonitoreoUnidadVideo.Posicion=".$vector_revision_de_video_actual[0]['Posicion']);
                     $obj_puesto_monitoreo->obtiene_todas_las_unidades_asociadas_a_un_puesto_de_monitoreo();
                     $vector_puesto_monitoreo_unidad_video=$obj_puesto_monitoreo->getArreglo();
                     //termina la consulta 
                     
                     //Vector información punto BCR relacionado a la unidad de video 5
                     $obj_puntos_bcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$vector_informacion_unidad_video[0]['ID_PuntoBCR']);
                     $obj_puntos_bcr->obtiene_todos_los_puntos_bcr();
                     $vector_punto_bcr=$obj_puntos_bcr->getArreglo();
                     //termina la consulta 
                     
                     //Vector información padrón fotográfico unidades de video
                     $obj_padron_fotografico= new cls_padron_fotografico_unidades_de_video();
                     
                     $hora1 = date("H:i",strtotime( "06:00" )); 
                     $hora2 = date("H:i",strtotime( "18:00" )); 
                     $hora_actual=date("H:i", time());
                       
                     if (($hora_actual > $hora1) && ($hora_actual < $hora2)){                            
                         $obj_padron_fotografico->setCondicion("ID_Unidad_Video=".$vector_revision_de_video_actual[0]['ID_Unidad_Video']." order by Categoria asc");  
                     }else{
                         $obj_padron_fotografico->setCondicion("ID_Unidad_Video=".$vector_revision_de_video_actual[0]['ID_Unidad_Video']." order by Categoria desc");   
                     }
                     $obj_padron_fotografico->obtener_imagenes_unidades_de_video();
                     $vector_padron_fotografico=$obj_padron_fotografico->getArreglo();
                     //termina la consulta 
                     
                     //Vector 1 unidad siguiente
                     $pos=$vector_revision_de_video_actual[0]['Posicion'];
                     $pos=$pos+1;
                     $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$vector_revision_de_video_actual[0]['ID_Puesto_Monitoreo']." AND (T_PuestoMonitoreoUnidadVideo.Posicion>".$vector_revision_de_video_actual[0]['Posicion']." AND T_PuestoMonitoreoUnidadVideo.Posicion<=".$pos.")");
                     $obj_puesto_monitoreo->obtiene_las_unidades_siguientes_para_revision();
                     $vector_proximas_unidades=$obj_puesto_monitoreo->getArreglo();
                     
                     //Vector 1 Unidades de Video Siguientes
                    
                     if (count($vector_proximas_unidades)==0){
                         $pos=1;
                         $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$vector_revision_de_video_actual[0]['ID_Puesto_Monitoreo']." AND T_PuestoMonitoreoUnidadVideo.Posicion=".$pos);
                         $obj_puesto_monitoreo->obtiene_las_unidades_siguientes_para_revision();
                         $vector_proximas_unidades=$obj_puesto_monitoreo->getArreglo();
                       
                     }
                     
                     $obj_unidad_video->setCondicion("t_unidadvideo.ID_Unidad_Video=".$vector_proximas_unidades[0]['ID_Unidad_Video']);
                     $obj_unidad_video->obtiene_todas_las_unidades_de_video();
                     $vector_informacion_unidad_video_siguiente=$obj_unidad_video->getArreglo();
                     
                     $obj_puntos_bcr->setCondicion("T_PuntoBCR.ID_PuntoBCR=".$vector_informacion_unidad_video_siguiente[0]['ID_PuntoBCR']);
                     $obj_puntos_bcr->obtiene_todos_los_puntos_bcr();
                     $vector_punto_bcr_siguiente=$obj_puntos_bcr->getArreglo(); 
                                       
                      require __DIR__.'/../vistas/plantillas/frm_controles_de_video_listar.php';
                   
                }
             
             } else{
                 header ("location:/ORIEL/index.php?ctl=puestos_de_monitoreo_listar");
             }                 
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    } 

    public function puesto_monitoreo_cambiar_estado() {
       if(isset($_SESSION['nombre'])){
           $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
           
           if ($_GET['estado']==1){
               
               $obj_puesto_monitoreo->setEstado("0");
               
           }else {
               
               $obj_puesto_monitoreo->setestado("1");
           }
           $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo='".$_GET['id']."'");
           $obj_puesto_monitoreo->cambiar_estado_puesto_monitoreo();
           $obj_puesto_monitoreo->setCondicion("");    
           $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
           $params =$obj_puesto_monitoreo->getArreglo();
           
            $vector_estadisticas=array ();
           //$vector_estadisticas[]=array ("","","");
           
           for ($i = 0; $i < count($params); $i++) {
                
               $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$params[$i]['ID_Puesto_Monitoreo']);
               $obj_puesto_monitoreo->obtiene_estadistica_general_puestos_de_monitoreo();
               $vector_temporal=$obj_puesto_monitoreo->getArreglo();
               
               if (count($vector_temporal)>0){
                  $vector_estadisticas[]=$vector_temporal[0];
                }else{
                  $vector_estadisticas[]=array("Total_Minutos"=>"0","Total_Unidades"=>"0","Total_Camaras"=>"0");
                }
            }
           
            require __DIR__.'/../vistas/plantillas/frm_puestos_de_monitoreo_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function puesto_monitoreo_guardar() {
          if(isset($_SESSION['nombre'])){
               $obj_puesto_monitoreo = new cls_puestos_de_monitoreo();
               $obj_puesto_monitoreo->setNombre($_POST['nombre']); 
               $obj_puesto_monitoreo->setDescripcion($_POST['descripcion']); 
               $obj_puesto_monitoreo->setObservaciones($_POST['observaciones']);
               $obj_puesto_monitoreo->setTiempo_estandar_revision($_POST['tiempo_estandar_revision']); 
               
                if ($_POST['ID_Puesto_Monitoreo']==0){
                   $obj_puesto_monitoreo->setEstado(1);
                   $obj_puesto_monitoreo->agregar_nuevo_puesto_monitoreo();
                }else{  
                           $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo='".$_POST['ID_Puesto_Monitoreo']."'");
                           $obj_puesto_monitoreo->edita_puesto_monitoreo();
                           $obj_puesto_monitoreo->setCondicion("ID_Puesto_Monitoreo='".$_POST['ID_Puesto_Monitoreo']."' AND Tiempo_Personalizado_Revision=".$_POST['tiempo_revision_original']);
                           $obj_puesto_monitoreo->edita_tiempo_en_unidades_de_video_ligadas_al_puesto();
                   
                }       
           $obj_puesto_monitoreo->setCondicion("");    
           $obj_puesto_monitoreo->obtiene_todos_puestos_de_monitoreo();
           $params =$obj_puesto_monitoreo->getArreglo();
           
            $vector_estadisticas=array ();
                 
           for ($i = 0; $i < count($params); $i++) {
                
               $obj_puesto_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$params[$i]['ID_Puesto_Monitoreo']);
               $obj_puesto_monitoreo->obtiene_estadistica_general_puestos_de_monitoreo();
               $vector_temporal=$obj_puesto_monitoreo->getArreglo();
               
               if (count($vector_temporal)>0){
                  $vector_estadisticas[]=$vector_temporal[0];
                }else{
                  $vector_estadisticas[]=array("Total_Minutos"=>"0","Total_Unidades"=>"0","Total_Camaras"=>"0");
                }
            }
           
           header ("location:/ORIEL/index.php?ctl=puestos_de_monitoreo_listar");
           //require __DIR__.'/../vistas/plantillas/frm_puestos_de_monitoreo_listar.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    //public function puestos_de_monitoreo_editar(){
    public function puestos_de_monitoreo_editar(){
        //Variables que muestran tipos de adventencia en pantalla según sea necesario
        $tipo_de_alerta="alert alert-info";
        $validacion="Verificación de Identidad";
        $tiempo_estandar = $_GET['tiempo_revision'];
        
        $obj_unidades_de_video= new cls_unidad_video();
        $obj_unidades_de_video->obtiene_unidades_de_video_que_tienen_punto_bcr();
        $params=$obj_unidades_de_video->getArreglo();
       
        $obj_puesto_de_monitoreo= new cls_puestos_de_monitoreo();        
        $obj_puesto_de_monitoreo->setCondicion("T_PuestoMonitoreoUnidadVideo.ID_Puesto_Monitoreo=".$_GET['id']);
        $obj_puesto_de_monitoreo->obtiene_todas_las_unidades_asociadas_a_un_puesto_de_monitoreo();
        $unidades_asociadas_al_puesto=$obj_puesto_de_monitoreo->getArreglo();
        
        $obj_unidades_de_video->setCondicion("t_unidadvideo.Estado=0 AND not t_unidadvideo.ID_Unidad_Video In (Select ID_Unidad_Video From T_PuestoMonitoreoUnidadVideo)");
        $obj_unidades_de_video->obtiene_unidades_de_video_que_tienen_punto_bcr();
        $unidades_video_sin_puesto_monitoreo=$obj_unidades_de_video->getArreglo();
              
        //echo $_GET['id'];
        require __DIR__ . '/../vistas/plantillas/frm_puestos_de_monitoreo_editar.php';
        
    }
     
    public function actualiza_puesto_de_monitoreo(){

        $obj_puestos_de_monitoreo= new cls_puestos_de_monitoreo();
        $elementos = $_POST['data'];
        
        $tam= count($elementos[0]);
        $obj_puestos_de_monitoreo->setCondicion("ID_Puesto_Monitoreo=".$elementos[0][0]);
        $obj_puestos_de_monitoreo->eliminar_registros_puesto_de_monitoreo();
        
        if($tam>1){   
            for ($i = 1; $i < $tam; $i++) {
                $obj_puestos_de_monitoreo->setId_puesto_monitoreo($elementos[0][$i]);
                $obj_puestos_de_monitoreo->setId_unidad_video($elementos[1][$i]);
                $obj_puestos_de_monitoreo->setPosicion($i);
                $obj_puestos_de_monitoreo->setTiempo_personalizado_revision($elementos[6][$i]);
                $obj_puestos_de_monitoreo->agregar_nueva_unidad_de_video_a_puesto_de_monitoreo();
                
            }
        }
    }

    
    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Funciones de Reportes////////////////////////////////  
    ////////////////////////////////////////////////////////////////////////////
    public function reporte_seguimiento_eventos(){
        if(isset($_SESSION['nombre'])){
            $obj_reporte = new cls_reporteria();
            //Verifica si se envió una fecha especifica de busqueda
            if(isset($_POST['fecha_inicial'])){
                $fecha_inicio = $_POST['fecha_inicial'];
                $fecha_fin= $_POST['fecha_final'];
                $obj_reporte->setCondicion("(t_detalleevento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."') AND (T_Usuario.Estado=1)");
                $titulo = "Historico de Seguimiento del ".$fecha_inicio." al ".$fecha_fin." ingresador por Usuario";
            } else{
                $fecha_inicio = '2016-01-01';
                $fecha_fin= date("Y-m-d");
                $obj_reporte->setCondicion("t_detalleevento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
                $titulo = "Historico de Seguimientos ingresados por Usuario";
            }
            
            $obj_reporte->seguimientos_por_operador();
            $params= $obj_reporte->getArreglo();
            require __DIR__ . '/../vistas/plantillas/rpt_seguimiento_eventos.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function reporte_eventos_provincia(){
        if(isset($_SESSION['nombre'])){
            $obj_reporte = new cls_reporteria();
            //Verifica si se envió una fecha especifica de busqueda
            if(isset($_POST['fecha_inicial'])){
                $fecha_inicio = $_POST['fecha_inicial'];
                $fecha_fin= $_POST['fecha_final'];
                $obj_reporte->setCondicion("t_evento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
                $titulo = "Historico de Activaciones del ".$fecha_inicio." al ".$fecha_fin." por Provincia";
            } else{
                $fecha_inicio = '2016-01-01';
                $fecha_fin= date("Y-m-d");
                $obj_reporte->setCondicion("t_evento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
                $titulo = "Historico de Activaciones por Provincia";
            }
            
            $obj_reporte->eventos_por_provincia();
            $params= $obj_reporte->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/rpt_eventos_provincia.php';

        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';

        }
    }
    
    public function reporte_eventos_oficina(){
        if(isset($_SESSION['nombre'])){
            $obj_reporte = new cls_reporteria();
            //Verifica si se envió una fecha especifica de busqueda
            if(isset($_POST['fecha_inicial'])){
                $fecha_inicio = $_POST['fecha_inicial'];
                $fecha_fin= $_POST['fecha_final'];
                $obj_reporte->setCondicion("t_evento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
                $titulo = "Historico de Activaciones del ".$fecha_inicio." al ".$fecha_fin." por Punto BCR";
            } else{
                $fecha_inicio = '2016-01-01';
                $fecha_fin= date("Y-m-d");
                $obj_reporte->setCondicion("t_evento.Fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
                $titulo = "Historico de Activaciones por Punto BCR";
            }
            
            $obj_reporte->eventos_por_sitio();
            $params= $obj_reporte->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/rpt_eventos_sitio.php';

        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }

    public function reporte_lineas_telefonicas(){
        if(isset($_SESSION['nombre'])){
            $obj_puntobcr= new cls_puntosBCR();
            //Trae de la base de datos la lista de puntos BCR disponibles
            $obj_puntobcr->obtiene_todos_los_puntos_bcr_telefonos();
            //Inicializa un vector con el total de registros de la base de datos
            $params = $obj_puntobcr->getArreglo();
            
            require __DIR__ . '/../vistas/plantillas/rpt_lineas_telefonicas.php';
        }else{
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function reporte_cencon(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            
            if(isset($_POST['fecha_inicial'])){
                $fecha_inicio = $_POST['fecha_inicial'];
                $fecha_fin= $_POST['fecha_final'];
                $obj_cencon->setCondicion("(T_EventoCencon.Fecha_Apertura between '".$fecha_inicio."' AND '".$fecha_fin."')");
                $titulo = "Eventos de Cencon del ".$fecha_inicio." al ".$fecha_fin;
            } else{
                $fecha_inicio = date("Y-m-d");
                $fecha_fin= date("Y-m-d");
                $obj_cencon->setCondicion("(T_EventoCencon.Fecha_Apertura between '".$fecha_inicio."' AND '".$fecha_fin."')");
                $titulo = "Eventos de Cencon de hoy: ".$fecha_inicio;
            }
            $obj_cencon->setCondicion("(T_EventoCencon.Fecha_Apertura between '".$fecha_inicio."' AND '".$fecha_fin."')");
            $obj_cencon->obtener_todos_eventos_cencon();
            $params= $obj_cencon->getArreglo();
            
            $tam=count($params);
            for($i=0;$i<$tam;$i++){
                if($params[$i]['ID_Empresa']==1){
                    $obj_personal->setCondicion("ID_Persona='".$params[$i]['ID_Persona']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $params[$i] = array_merge((['Nombre_Persona' =>($persona[0]['Apellido_Nombre'])]),$params[$i]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$params[$i]['ID_Persona']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $params[$i] = array_merge((['Nombre_Persona' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$params[$i]);
                }
            }
            
            $reporte_aperturas;
            for($i=6;$i<20;$i++){
                $hora_inicio=$i.':00';
                $hora_final= ($i+1).':00';
                $obj_cencon->setCondicion("(Hora_Apertura>'".$hora_inicio."' AND Hora_Apertura<'".$hora_final."') AND Fecha_Apertura between '".$fecha_inicio."' AND '".$fecha_fin."'");
                $obj_cencon->informacion_reporte();
                $total= $obj_cencon->getArreglo();
                $reporte_aperturas[$i] = array_merge((['Horas' =>($hora_inicio.'-'.$hora_final)]),$total[0]);
            }
//            echo "<pre>";
//            print_r($reporte_aperturas);
//            echo "</pre>";
            require __DIR__.'/../vistas/plantillas/rpt_eventos_cencon.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function reporte_prueba_alarma(){
        if(isset($_SESSION['nombre'])){
            
            $obj_prueba = new cls_prueba_alarma();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_usuario = new cls_usuarios();
            
            if(isset($_POST['fecha_inicial'])){
                $fecha_inicio = $_POST['fecha_inicial'];
                $fecha_fin= $_POST['fecha_final'];
                //$titulo = "Eventos de Cencon del ".$fecha_inicio." al ".$fecha_fin;
            } else{
                $fecha_inicio = date("Y-m-d");
                $fecha_fin= date("Y-m-d");
                //$titulo = "Eventos de Cencon de hoy: ".$fecha_inicio;
            }
            $obj_prueba->setCondicion("(T_PruebaAlarma.Fecha between '".$fecha_inicio."' AND '".$fecha_fin."')");
            $obj_prueba->obtener_prueba_alarma();
            $prueba= $obj_prueba->getArreglo();
            
            $tam=count($prueba);
            for($i=0;$i<$tam;$i++){
                if($prueba[$i]['ID_Empresa_Persona_Apertura']==1){
                    $obj_personal->setCondicion("ID_Persona='".$prueba[$i]['ID_Persona_Reporta_Apertura']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido_Nombre'])]),$prueba[$i]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$prueba[$i]['ID_Persona_Reporta_Apertura']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i]);
                }
                if($prueba[$i]['ID_Empresa_Persona_Cierra']==1){
                    $obj_personal->setCondicion("ID_Persona='".$prueba[$i]['ID_Persona_Reporta_Cierre']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido_Nombre'])]),$prueba[$i]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$prueba[$i]['ID_Persona_Reporta_Cierre']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i]);
                }
                //Obtiene la información de los Usuarios que ingresan la información a la tabla
                if($prueba[$i]['ID_Usuario_reporte']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[$i]['ID_Usuario_reporte']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Usuario_Reporte' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i]);
                } else{
                    $prueba[$i] = array_merge((['Nombre_Usuario_Reporte' =>""]),$prueba[$i]);
                }
                if($prueba[$i]['ID_Usuario_Prueba']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[$i]['ID_Usuario_Prueba']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Usuario_Prueba' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i]);
                } else{
                    $prueba[$i] = array_merge((['Nombre_Usuario_Prueba' =>""]),$prueba[$i]);
                }
                if($prueba[$i]['ID_Usuario_Reporte_Cierre']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[$i]['ID_Usuario_Reporte_Cierre']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Usuario_Reporte_Cierre' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i]);
                } else {
                    $prueba[$i] = array_merge((['Nombre_Usuario_Reporte_Cierre' =>""]),$prueba[$i]);
                }
                if($prueba[$i]['ID_Usuario_Cierra']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[$i]['ID_Usuario_Cierra']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[$i] = array_merge((['Nombre_Usuario_Cierra' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[$i ]);
                }else{
                    $prueba[$i] = array_merge((['Nombre_Usuario_Cierra' =>""]),$prueba[$i]);
                }
            }
            require __DIR__.'/../vistas/plantillas/rpt_prueba_alarma.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function alertas_generales(){
        if(isset($_SESSION['nombre'])){
            $obj_cencon = new cls_cencon();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_Puntosbcr = new cls_puntosBCR();
            $obj_prueba = new cls_prueba_alarma();
            $obj_eventos = new cls_eventos();
            
            
            ////////////////////////////////////////////////////////////////////
            //OBTIENE INFORMACIÓN DE PRUEBAS, APERTURAS Y CIERRES DE ALARMA
            //Obtiene información del Punto BCR
            $obj_Puntosbcr->setCondicion("(T_PuntoBCR.ID_Tipo_Punto=1 OR T_PuntoBCR.ID_Tipo_Punto=5 OR T_PuntoBCR.ID_Tipo_Punto=9 OR
                T_PuntoBCR.ID_Tipo_Punto=10 OR T_PuntoBCR.ID_Tipo_Punto=11) AND T_PuntoBCR.Estado=1");
            $obj_Puntosbcr->obtiene_todos_los_puntos_bcr();
            $Oficinas = $obj_Puntosbcr->getArreglo();
            
            //Contadores para gráficos
            //Vectores nuevo para almacer toda la información del horario
            $datos="";
            //Contadores de aperturas realizadas y pendientes
            $datos['contador_aperturas'] =0;
            $datos['cont_aperturas_pendientes'] =0;
            //Contadores de Pruebas, realizadas y pendientes
            $datos['contador_pruebas']=0;
            $datos['cont_pruebas_pendientes'] =0;
            //Contadores de Cierres, realizados y pendientes
            $datos['contador_cierres']=0;
            $datos['cont_cierres_pendientes'] =0;
            
            //Obtiene la fecha del servidor en un arreglo
            $fecha_actual= getdate();
            //Convierta la fecha a formto aaaa/mm/dd hh:mm
            $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'];
            //asigna la fecha actual a un arreglo formato DateTime
            $fecha1 = new DateTime($fecha_actual);
            $fecha_actual= getdate();
            $diff="";
            
            $tam=count($Oficinas);
            for($i=0;$i<$tam;$i++){
                $prueba="";
                $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR=".$Oficinas[$i]['ID_PuntoBCR']." AND Fecha='".date('Y-m-d')."'");
		$obj_prueba->obtener_prueba_alarma();
		$prueba= $obj_prueba->getArreglo();
                if($prueba[0]['Seguimiento']!='Oficina en Asueto'){
                    //print_r($prueba);
                    switch ($fecha_actual['weekday']) {
                        case 'Monday':
                            if($Oficinas[$i]['Hora_Apertura_Lunes']!="" || $Oficinas[$i]['Hora_Apertura_Lunes']!=null){
                                /*
                                //Función para verificar horarios de oficina, validar ingresos, cierres y preubas
                                //Envia los siguientes parametros: 
                                //  -Hora apertura (según el día de la semana)
                                //  -Hora Cierre (según el día de la semana)
                                //  -Información anterior almacenada (para almacenar nueva y devolver completa)
                                //  -Información de prueba de hoy (horas de apertura, hora de prueba, hora de cierre, etc)
                                //  -Información de la oficina (Nombre, código: para el mensaje cuando sea necesario)
                                 */
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Lunes'],$Oficinas[$i]['Hora_Cierre_Lunes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Tuesday':
                            if($Oficinas[$i]['Hora_Apertura_Martes']!="" || $Oficinas[$i]['Hora_Apertura_Martes']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Martes'],$Oficinas[$i]['Hora_Cierre_Martes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Wednesday':
                            if($Oficinas[$i]['Hora_Apertura_Miercoles']!="" || $Oficinas[$i]['Hora_Apertura_Miercoles']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Miercoles'],$Oficinas[$i]['Hora_Cierre_Miercoles'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Thursday':
                            if($Oficinas[$i]['Hora_Apertura_Jueves']!="" || $Oficinas[$i]['Hora_Apertura_Jueves']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Jueves'],$Oficinas[$i]['Hora_Cierre_Jueves'],$datos,$prueba,$Oficinas[$i]);
                            } 
                            break;
                        case 'Friday':
                            if($Oficinas[$i]['Hora_Apertura_Viernes']!="" || $Oficinas[$i]['Hora_Apertura_Viernes']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Viernes'],$Oficinas[$i]['Hora_Cierre_Viernes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Saturday':
                            if($Oficinas[$i]['Hora_Apertura_Sabado']!="" || $Oficinas[$i]['Hora_Apertura_Sabado']!=null){
                                
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Sabado'],$Oficinas[$i]['Hora_Cierre_Sabado'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Sunday':
                            if($Oficinas[$i]['Hora_Apertura_Domingo']!="" || $Oficinas[$i]['Hora_Apertura_Domingo']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Domingo'],$Oficinas[$i]['Hora_Cierre_Domingo'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                    }
                }
            }
            
            
            ////////////////////////////////////////////////////////////////////
            //OBTIENE INFORMACIÓN DE APERTURA DE CERRADURAS DE CENCON
            $obj_cencon->setCondicion("Hora_Cierre is null");
            $obj_cencon->obtener_todos_eventos_cencon();
            $params= $obj_cencon->getArreglo();
            
            //Obtiene la fecha del servidor en un arreglo
            $fecha_actual= getdate();
            //Convierta la fecha a formto aaaa/mm/dd hh:mm
            $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'];
            //asigna la fecha actual a un arreglo formato DateTime
            $fecha1 = new DateTime($fecha_actual);
            $diff="";
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++) {
                //asigna da date2 la fecha que trae en el arreglo
                $fecha2 = new DateTime($params[$i]['Fecha_Apertura'].' '.$params[$i]['Hora_Apertura']);
                $diff = $fecha1->diff($fecha2);
                //print_r($diff);
                $vencidos[$i]['tiempo']=(intval($diff->d)*1440)+(intval($diff->h)*60)+(intval($diff->i)*1);
                //$vencidos[$i]['mensaje']= ("#".$params[$i]['Codigo']." ".$params[$i]['Nombre']." | Abierto hace: ". $diff->d." días, ". $diff->h." horas y ". $diff->i." minutos. \n "); 
                $vencidos[$i]['mensaje']= ("#".$params[$i]['Codigo']." ".$params[$i]['Nombre']." | Abierto hace: ". $diff->d."d: ". $diff->h."h: ". $diff->i."m. \n "); 
                
                //Obtiene la hora actual del sistema
                $hora_actual= getdate();
                $hora_actual=$hora_actual['hours'];
                if($hora_actual<19){
                    if($vencidos[$i]['tiempo']<'300'){
                        if(!($params[$i]['Seguimiento']=="Arqueo de ATM" ||$params[$i]['Seguimiento']=="ATM en Mantenimiento"||
                            $params[$i]['Seguimiento']=="Apertura con llave Azul"||$params[$i]['Seguimiento']=="Permiso Especial")){
                            if($vencidos[$i]['tiempo']>'40'){
                                if($params[$i]['Seguimiento']=="Se envió correo al funcionario"||$params[$i]['Seguimiento']=="Se envió correo al encargado"||
                                    $params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                    if($vencidos[$i]['tiempo']>'70'){
                                        if($params[$i]['Seguimiento']=="Se envió correo al encargado"||
                                            $params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                            if($vencidos[$i]['tiempo']>'100'){
                                                if($params[$i]['Seguimiento']=="Se le informó al coordinador"){
                                                    $vencidos[$i]['color']="color: blueviolet";
                                                    //echo "blueviolet +100 informó".$params[$i]['Codigo']."\n||||";
                                                }else{
                                                    $vencidos[$i]['color']="color: red";
                                                    //echo "rojo +100 sin informar".$params[$i]['Codigo']."\n||||";
                                                } 
                                            }else{
                                                $vencidos[$i]['color']="color: orange";
                                                //echo "naranja -110".$params[$i]['Codigo']."\n|||||";
                                            }
                                        }else{
                                            $vencidos[$i]['color']="color: red";
                                            //echo "rojo -correo encargado".$params[$i]['Codigo']."\n|||||";
                                        }
                                    }else{
                                        $vencidos[$i]['color']="color: orange";
                                        //echo "naranja -70 y correo".$params[$i]['Codigo']."\n|||||";
                                    }
                                }else{
                                    $vencidos[$i]['color']="color: red";
                                    //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                                }
                            } else{
                                $vencidos[$i]['color']="color: black";
                                //echo "nada".$params[$i]['Codigo']."\n||||";
                            }
                        } else{
                            $vencidos[$i]['color']="color:mediumblue; text-decoration: underline;";
                            //echo "nada".$params[$i]['Codigo']."\n||||";
                        }    
                    }else{
                        $vencidos[$i]['color']="color: red";
                        //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                    }
                }else{
                    $vencidos[$i]['color']="color: red";
                    //echo "rojo +40 sin correo".$params[$i]['Codigo']."\n||||";
                }    
            }
            
            if(isset ($vencidos)){
                rsort($vencidos);
            }
            
            ////////////////////////////////////////////////////////////////////
            ///////////PENDIENTES DE CADA PUESTO DE MONITOREO
            $pendiente_puesto1[0]['Contador']=0;
            $pendiente_puesto2[0]['Contador']=0;
            $pendiente_puesto3[0]['Contador']=0;
            $pendiente_puesto4[0]['Contador']=0;
            $pendiente_puestoZ2[0]['Contador']=0;
            //Eventos puesto 1
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento=1 AND (T_Evento.ID_Provincia=4 OR T_Evento.ID_Provincia=5 OR T_Evento.ID_Provincia=6) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4 AND T_Evento.ID_Tipo_Punto<>2 AND T_Evento.ID_Tipo_Punto<>8)");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();            
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++){
                $pendiente_puesto1[$i]['Mensaje']=$params[$i]['Nombre'].": ".$params[$i]['Evento'];
                $pendiente_puesto1[0]['Contador']=$i+1;
            }
            
            //Eventos puesto 2
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento=1 AND T_Evento.ID_Provincia=1 AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4 AND T_Evento.ID_Tipo_Punto<>2 AND T_Evento.ID_Tipo_Punto<>8)");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();            
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++){
                $pendiente_puesto2[$i]['Mensaje']=$params[$i]['Nombre'].": ".$params[$i]['Evento'];
                $pendiente_puesto2[0]['Contador']=$i+1;
            }
            
            //Eventos puesto 3
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento=1 AND (T_Evento.ID_Tipo_Punto=3 OR T_Evento.ID_Tipo_Punto=4)");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();            
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++){
                $pendiente_puesto3[$i]['Mensaje']=$params[$i]['Nombre'].": ".$params[$i]['Evento'];
                $pendiente_puesto3[0]['Contador']=$i+1;
            }
            //Eventos puesto 4
            $obj_eventos->setCondicion("T_Evento.ID_EstadoEvento=1 AND (T_Evento.ID_Provincia=2 OR T_Evento.ID_Provincia=3 OR T_Evento.ID_Provincia=7) AND (T_Evento.ID_Tipo_Punto<>3 AND T_Evento.ID_Tipo_Punto<>4 AND T_Evento.ID_Tipo_Punto<>2 AND T_Evento.ID_Tipo_Punto<>8)");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();            
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++){
                $pendiente_puesto4[$i]['Mensaje']=$params[$i]['Nombre'].": ".$params[$i]['Evento'];
                $pendiente_puesto4[0]['Contador']=$i+1;
            }
            //Eventos Z2
            $obj_eventos->setCondicion("(T_Evento.ID_EstadoEvento=1) AND (T_Evento.ID_Tipo_Evento=17 OR T_Evento.ID_Tipo_Evento=38)");
            $obj_eventos ->obtiene_todos_los_eventos(); 
            $params= $obj_eventos->getArreglo();            
            $tam=count($params);
            for ($i = 0; $i <$tam; $i++){
                $pendiente_puestoZ2[$i]['Mensaje']=$params[$i]['Nombre'].": ".$params[$i]['Evento'];
                $pendiente_puestoZ2[0]['Contador']=$i+1;
            }
            require __DIR__ . '/../vistas/plantillas/rpt_alerta_general.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }  
    }
    
    public function enlace_reporte() {
        if(isset($_SESSION['nombre'])){
            $obj_enlace = new cls_enlace_telecom();
            $obj_ip = new cls_direccionIP();
            $obj_medio_enlace = new cls_medio_enlace();
            $obj_tipo_enlace = new cls_tipo_enlace();
            $obj_proveedor_enlace = new cls_proveedor_enlace();
            
            //Obtiene la información de medios de enlace
            $obj_medio_enlace->obtener_medio_enlaces();
            $medio_enlace = $obj_medio_enlace->getArreglo();

            //Obtiene la informacion de tipos de enlace
            $obj_tipo_enlace->obtener_tipo_enlaces();
            $tipo_enlace =  $obj_tipo_enlace->getArreglo();

            //Obtiene la informacion de proveedor de enlaces
            $obj_proveedor_enlace->obtener_proveedores();
            $proveedor_enlace= $obj_proveedor_enlace->getArreglo();
            
            $obj_enlace->enlaces_reporte();
            $telecom = $obj_enlace->getArreglo();
            
            $tam = count($telecom);
            for($i=0; $i<$tam;$i++){
                $obj_ip->setCondicion("(T_TipoIP.ID_Tipo_IP = '7' OR  T_TipoIP.ID_Tipo_IP = '8') AND t_puntobcrdireccionip.ID_PuntoBCR='".$telecom[$i]['ID_PuntoBCR']."'");
                $obj_ip->obtiene_direccionesIP();
                $direcciones = $obj_ip->getArreglo();
                //print_r($direcciones);
                if(isset($direcciones[1]['Tipo_IP'])){
                    $params[$i]= array_merge($telecom[$i],[($direcciones[0]['Tipo_IP'])=>($direcciones[0]['Direccion_IP'])],[($direcciones[1]['Tipo_IP'])=>($direcciones[1]['Direccion_IP'])]);
                } else {
                    $params[$i]= array_merge($telecom[$i],[($direcciones[0]['Tipo_IP'])=>($direcciones[0]['Direccion_IP'])]);
                }
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
    //////////////////////Funciones para Pruebas de alarma//////////////////////  
    ////////////////////////////////////////////////////////////////////////////
    public function pruebas_alarma(){
        if(isset($_SESSION['nombre'])){
            $obj_persona = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_Puntosbcr = new cls_puntosBCR();
            $obj_prueba = new cls_prueba_alarma();
            $obj_horario = new cls_horario();
            //Obtiene informacion básica del Personal BCR
            $obj_persona->obtiene_todo_el_personal_pruebas_alarma();
            $personas= $obj_persona->getArreglo();
            
            //Obtiene informacion básica del Personal Externo
            $obj_externo->obtiene_todo_el_personal_externo_prueba_alarma();
            $externos = $obj_externo->getArreglo();
            
            //Une la informacion de las personas 
            $params = array_merge($personas,$externos);
            
            //Obtiene información del Punto BCR
            $obj_Puntosbcr->setCondicion("(T_PuntoBCR.ID_Tipo_Punto=1 OR T_PuntoBCR.ID_Tipo_Punto=5 OR T_PuntoBCR.ID_Tipo_Punto=9 OR
                T_PuntoBCR.ID_Tipo_Punto=10 OR T_PuntoBCR.ID_Tipo_Punto=11) AND T_PuntoBCR.Estado=1");
            $obj_Puntosbcr->obtiene_todos_los_puntos_bcr();
            $Oficinas = $obj_Puntosbcr->getArreglo();

            //Vectores nuevo para almacer toda la información del horario
            $datos="";
            //Contadores de aperturas realizadas y pendientes
            $datos['contador_aperturas'] =0;
            $datos['cont_aperturas_pendientes'] =0;
            //Contadores de Pruebas, realizadas y pendientes
            $datos['contador_pruebas']=0;
            $datos['cont_pruebas_pendientes'] =0;
            //Contadores de Cierres, realizados y pendientes
            $datos['contador_cierres']=0;
            $datos['cont_cierres_pendientes'] =0;
            //Obtiene la fecha del servidor en un arreglo
            $fecha_actual= getdate();
            //Convierta la fecha a formto aaaa/mm/dd hh:mm
            $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'];
            //asigna la fecha actual a un arreglo formato DateTime
            $fecha1 = new DateTime($fecha_actual);
            $fecha_actual= getdate();
            $diff="";
            
            $tam=count($Oficinas);
            for($i=0;$i<$tam;$i++){
                unset($prueba);
                $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR=".$Oficinas[$i]['ID_PuntoBCR']." AND T_PruebaAlarma.Fecha='".date('Y-m-d')."'");
		$obj_prueba->obtener_prueba_alarma();
		$prueba= $obj_prueba->getArreglo();
                if($prueba[0]['Seguimiento']!='Oficina en Asueto'){
                    //print_r($prueba);
                    $obj_horario->setCondicion("ID_Horario='".$Oficinas[$i]['ID_Horario_Apertura']."'");
                    $obj_horario->obtiene_todos_los_horarios();
                    $horariopunto= $obj_horario->getArreglo();
                    
                    switch ($fecha_actual['weekday']) {
                        case 'Monday':
                            if($Oficinas[$i]['Hora_Apertura_Lunes']!="" || $Oficinas[$i]['Hora_Apertura_Lunes']!=null){
                                /*
                                //Función para verificar horarios de oficina, validar ingresos, cierres y preubas
                                //Envia los siguientes parametros: 
                                //  -Hora apertura (según el día de la semana)
                                //  -Hora Cierre (según el día de la semana)
                                //  -Información anterior almacenada (para almacenar nueva y devolver completa)
                                //  -Información de prueba de hoy (horas de apertura, hora de prueba, hora de cierre, etc)
                                //  -Información de la oficina (Nombre, código: para el mensaje cuando sea necesario)
                                 */
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Lunes'],$Oficinas[$i]['Hora_Cierre_Lunes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Tuesday':
                            if($Oficinas[$i]['Hora_Apertura_Martes']!="" || $Oficinas[$i]['Hora_Apertura_Martes']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Martes'],$Oficinas[$i]['Hora_Cierre_Martes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Wednesday':
                            if($Oficinas[$i]['Hora_Apertura_Miercoles']!="" || $Oficinas[$i]['Hora_Apertura_Miercoles']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Miercoles'],$Oficinas[$i]['Hora_Cierre_Miercoles'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Thursday':
                            if($Oficinas[$i]['Hora_Apertura_Jueves']!="" || $Oficinas[$i]['Hora_Apertura_Jueves']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Jueves'],$Oficinas[$i]['Hora_Cierre_Jueves'],$datos,$prueba,$Oficinas[$i]);
                            } 
                            break;
                        case 'Friday':
                            if($Oficinas[$i]['Hora_Apertura_Viernes']!="" || $Oficinas[$i]['Hora_Apertura_Viernes']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Viernes'],$Oficinas[$i]['Hora_Cierre_Viernes'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Saturday':
                            if($Oficinas[$i]['Hora_Apertura_Sabado']!="" || $Oficinas[$i]['Hora_Apertura_Sabado']!=null){
                                
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Sabado'],$Oficinas[$i]['Hora_Cierre_Sabado'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                        case 'Sunday':
                            if($Oficinas[$i]['Hora_Apertura_Domingo']!="" || $Oficinas[$i]['Hora_Apertura_Domingo']!=null){
                                $datos=$this->verificar_horario_puntobcr($Oficinas[$i]['Hora_Apertura_Domingo'],$Oficinas[$i]['Hora_Cierre_Domingo'],$datos,$prueba,$Oficinas[$i]);
                            }
                            break;
                    }
                }
            }
            if(isset($datos['aperturas_pendietes'])){
                sort($datos['aperturas_pendietes']);
            }
            if(isset($datos['pruebas_pendientes'])){
                sort($datos['pruebas_pendientes']);
            }
            if(isset($datos['cierres_pendientes'])){
                sort($datos['cierres_pendientes']);            
            }

            require __DIR__ . '/../vistas/plantillas/frm_pruebas_alarma.php';
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function buscar_punto_prueba_alarma() {
        if(isset($_SESSION['nombre'])){
            $obj_punto = new cls_puntosBCR();
            $obj_horario = new cls_horario();
            //Buscar la información de un PuntoBCR basado en el código del cajero
            $obj_punto->setCondicion("T_PuntoBCR.Codigo='".strtoupper($_POST['id'])."' AND T_PuntoBCR.Estado=1");
            $obj_punto->obtiene_todos_los_puntos_bcr();
            $puntobcr = $obj_punto->getArreglo();
            
            //Obtiene horario de oficina
            $obj_horario->setCondicion("ID_Horario='".$puntobcr[0]['ID_Horario_Apertura']."'");
            $obj_horario->obtiene_todos_los_horarios();
            $horariopunto= $obj_horario->getArreglo();
                
            $fecha_actual= getdate();
            switch ($fecha_actual['weekday']) {
                case 'Monday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Lunes'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Lunes'])]),$puntobcr[0]);
                    break;
                case 'Tuesday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Martes'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Martes'])]),$puntobcr[0]);
                    break;
                case 'Wednesday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Miercoles'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Miercoles'])]),$puntobcr[0]);
                    break;
                case 'Thursday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Jueves'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Jueves'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Apertura_Agencia' =>($horariopunto[0]['Hora_Apertura_Jueves'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Agencia' =>($horariopunto[0]['Hora_Cierre_Jueves'])]),$puntobcr[0]);
                    break;
                case 'Friday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Viernes'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Viernes'])]),$puntobcr[0]);
                    break;
                case 'Saturday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Sabado'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Sabado'])]),$puntobcr[0]);
                    break;
                case 'Sunday':
                    $puntobcr[0] = array_merge((['Hora_Apertura_Publico' =>($puntobcr[0]['Hora_Apertura_Domingo'])]),$puntobcr[0]);
                    $puntobcr[0] = array_merge((['Hora_Cierre_Publico' =>($puntobcr[0]['Hora_Cierre_Domingo'])]),$puntobcr[0]);
                    break;
            }
            //Convierte la información en un json para enviarlo a JavaScript
            echo json_encode($puntobcr[0], JSON_FORCE_OBJECT);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function buscar_prueba_alarma(){
        if(isset($_SESSION['nombre'])){
            $obj_prueba = new cls_prueba_alarma();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_usuario = new cls_usuarios();
            //
            $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND T_PruebaAlarma.Fecha='".date("Y-m-d")."'");
            $obj_prueba->obtener_prueba_alarma();
            $prueba= $obj_prueba->getArreglo();
            
            if($prueba<>null){
                if($prueba[0]['ID_Empresa_Persona_Apertura']==1){
                    $obj_personal->setCondicion("ID_Persona='".$prueba[0]['ID_Persona_Reporta_Apertura']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido_Nombre'])]),$prueba[0]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$prueba[0]['ID_Persona_Reporta_Apertura']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                if($prueba[0]['ID_Empresa_Persona_Cierra']==1){
                    $obj_personal->setCondicion("ID_Persona='".$prueba[0]['ID_Persona_Reporta_Cierre']."'");
                    $obj_personal->obtener_personas_prontuario();
                    $persona = $obj_personal->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido_Nombre'])]),$prueba[0]);
                } else{
                    $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$prueba[0]['ID_Persona_Reporta_Cierre']."'");
                    $obj_externo->obtiene_todo_el_personal_externo();
                    $persona = $obj_externo->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                //Obtiene la información de los Usuarios que ingresan la información a la tabla
                if($prueba[0]['ID_Usuario_reporte']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[0]['ID_Usuario_reporte']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Usuario_Reporte' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                if($prueba[0]['ID_Usuario_Prueba']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[0]['ID_Usuario_Prueba']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Usuario_Prueba' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                if($prueba[0]['ID_Usuario_Reporte_Cierre']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[0]['ID_Usuario_Reporte_Cierre']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Usuario_Reporte_Cierre' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                if($prueba[0]['ID_Usuario_Cierra']!=null){
                    $obj_usuario->setCondicion("ID_Usuario=".$prueba[0]['ID_Usuario_Cierra']);
                    $obj_usuario->obtiene_todos_los_usuarios();
                    $persona = $obj_usuario->getArreglo();
                    $prueba[0] = array_merge((['Nombre_Usuario_Cierra' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),$prueba[0]);
                }
                
            } else{
                echo "No se encontró prueba de alarma";
                exit();
            }
            //print_r($prueba);
            //Convierte la información en un json para enviarlo a JavaScript
            echo json_encode($prueba[0], JSON_FORCE_OBJECT);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function pruebas_alarma_anteriores(){
        if(isset($_SESSION['nombre'])){
            $obj_prueba = new cls_prueba_alarma();
            $obj_personal = new cls_personal();
            $obj_externo = new cls_personal_externo();
            $obj_usuario = new cls_usuarios();
            //
            $fecha_fin= date('Y-m-d');
            $fecha_inicio= strtotime('-5 day', strtotime($fecha_fin));
            $fecha_inicio= date ('Y-m-d', $fecha_inicio);
            try{
                $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND (T_PruebaAlarma.Fecha between '".$fecha_inicio."' AND '".$fecha_fin."') GROUP BY t_pruebaalarma.ID_Persona_Reporta_Apertura");
                $obj_prueba->obtener_prueba_alarma();
                $pruebas_anteriores= $obj_prueba->getArreglo();

                for ($i = 0; $i < count($pruebas_anteriores); $i++){
                    if($pruebas_anteriores[$i]['ID_Empresa_Persona_Apertura']==1){
                        $obj_personal->setCondicion("T_Personal.ID_Persona='".$pruebas_anteriores[$i]['ID_Persona_Reporta_Apertura']."'");
                        $obj_personal->obtiene_todo_el_personal();
                        $persona = $obj_personal->getArreglo();
                        $pruebas_anteriores[$i] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido_Nombre'])]),(['Cedula'=> ($persona[0]['Cedula'])]),(['Empresa'=> ($persona[0]['Empresa'])]),$pruebas_anteriores[$i]);
                    } 
                    if($pruebas_anteriores[$i]['ID_Empresa_Persona_Apertura']!=1){
                        $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$pruebas_anteriores[$i]['ID_Persona_Reporta_Apertura']."'");
                        $obj_externo->obtiene_todo_el_personal_externo();
                        $persona = $obj_externo->getArreglo();
                        $pruebas_anteriores[$i] = array_merge((['Nombre_Persona_Apertura' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),(['Cedula'=> ($persona[0]['Identificacion'])]),(['Empresa'=> ($persona[0]['Empresa'])]), $pruebas_anteriores[$i]);
                    }
                    if($pruebas_anteriores[$i]['ID_Empresa_Persona_Cierra']==1){
                        $obj_personal->setCondicion("T_Personal.ID_Persona='".$pruebas_anteriores[$i]['ID_Persona_Reporta_Apertura']."'");
                        $obj_personal->obtiene_todo_el_personal();
                        $persona = $obj_personal->getArreglo();
                        $pruebas_anteriores[$i] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido_Nombre'])]),(['Cedula_Cierre'=> ($persona[0]['Cedula'])]),(['Empresa_Cierre'=> ($persona[0]['Empresa'])]),$pruebas_anteriores[$i]);
                    } 
                    if($pruebas_anteriores[$i]['ID_Empresa_Persona_Cierra']!=1){
                        $obj_externo->setCondicion("T_PersonalExterno.ID_Persona_Externa='".$pruebas_anteriores[$i]['ID_Persona_Reporta_Apertura']."'");
                        $obj_externo->obtiene_todo_el_personal_externo();
                        $persona = $obj_externo->getArreglo();
                        $pruebas_anteriores[$i] = array_merge((['Nombre_Persona_Cierre' =>($persona[0]['Apellido']." ".$persona[0]['Nombre'])]),(['Cedula_Cierre'=> ($persona[0]['Identificacion'])]),(['Empresa_Cierre'=> ($persona[0]['Empresa'])]), $pruebas_anteriores[$i]);
                    }
                }
                
                $time= time();
                $tam = count($pruebas_anteriores);
                $html="";
                $html.='<thead> 
                            <th style="text-align:center">Cedula</th>
                            <th style="text-align:center">Apellidos Nombre</th>
                            <th style="text-align:center">Departamento</th>
                            <th style="text-align:center">Opciones</th>
                        </thead>
                        <tbody>';
                for($i=0; $i<$tam;$i++){
                    if(date("H:i:s", $time)>='00:00:00' && date("H:i:s", $time)<='14:00:00'){
                        $html .='<tr>'; 
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Cedula'].'</td>';
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Nombre_Persona_Apertura'].'</td>';
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Empresa'].'</td>';
                        $html .='<td style="text-align:center" '
                                . 'onclick="agregar_persona_prueba('.$pruebas_anteriores[$i]['ID_Persona_Reporta_Apertura'].','
                                . '&#39;'.$pruebas_anteriores[$i]['Cedula'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['Nombre_Persona_Apertura'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['Empresa'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['ID_Empresa_Persona_Apertura'].'&#39;)">'
                                . '<a>Reporta Prueba</a></td>';
                        $html .='</tr>'; 
                    } else {
                        $html .='<tr>'; 
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Cedula_Cierre'].'</td>';
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Nombre_Persona_Cierre'].'</td>';
                        $html .='<td style="text-align:center">'.$pruebas_anteriores[$i]['Empresa_Cierre'].'</td>';
                        $html .='<td style="text-align:center" '
                                . 'onclick="agregar_persona_cierre('.$pruebas_anteriores[$i]['ID_Persona_Reporta_Cierre'].','
                                . '&#39;'.$pruebas_anteriores[$i]['Cedula_Cierre'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['Nombre_Persona_Cierre'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['Empresa_Cierre'].'&#39,'
                                . '&#39;'.$pruebas_anteriores[$i]['ID_Empresa_Persona_Cierra'].'&#39;)">'
                                . '<a>Reporta Cierre</a></td>';
                        $html .='</tr>'; 
                    }
                }  
                $html.='</tbody> 
                        </table>';
                echo $html;
            } catch(Exception $e){
                
            }
            //print_r($prueba);
            //Convierte la información en un json para enviarlo a JavaScript
            
            //echo json_encode($pruebas_anteriores, JSON_FORCE_OBJECT);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function numero_zona_prueba_realizadas(){
        if(isset($_SESSION['nombre'])){
            $obj_prueba = new cls_prueba_alarma();
            
            $fecha_fin= date('Y-m-d');
            $fecha_inicio= strtotime('-7 day', strtotime($fecha_fin));
            $fecha_inicio= date ('Y-m-d', $fecha_inicio);
            
            $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR='".$_POST['id_puntobcr']."' AND (T_PruebaAlarma.Fecha between '".$fecha_inicio."' AND '".$fecha_fin."') GROUP BY t_pruebaalarma.Numero_Zona_Prueba");
            $obj_prueba->obtener_zonas_alarma();
            $pruebas_anteriores= $obj_prueba->getArreglo();
            
            
            $zonas_prueba="<p>";
            for ($i = 0; $i < count($pruebas_anteriores); $i++){
                if($_POST['id_tipo']==1 or $_POST['id_tipo']==9 or $_POST['id_tipo']==10){
                    if($pruebas_anteriores[$i]['Cantidad']>1){
                        $zonas_prueba.="<p>Zona ".$pruebas_anteriores[$i]['Numero_Zona_Prueba']." Cant: ".$pruebas_anteriores[$i]['Cantidad'].".</p>\n";
                    }
                }
            }
            $zonas_prueba.="</p>";
            echo($zonas_prueba);
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function prueba_alarma_guardar(){
        if(isset($_SESSION['nombre'])){
            $obj_prueba = new cls_prueba_alarma();
            //Busca nuevamente la prueba de alarma
            $obj_prueba->setCondicion("T_PruebaAlarma.ID_PuntoBCR='".$_POST['punto_bcr']."' AND T_PruebaAlarma.Fecha='".date("Y-m-d")."'");
            $obj_prueba->obtener_prueba_alarma();
            $prueba= $obj_prueba->getArreglo();
            
            if($prueba!=null || $prueba==""){
                $_POST['id_prueba']=$prueba[0]['ID_Prueba_Alarma'];
            }
            switch ($_POST['tipo']) {
                case 'Persona_Prueba':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setId_persona($_POST['id_persona']);
                    $obj_prueba->setEmpresa($_POST['id_empresa']);
                    $obj_prueba->setTipo_prueba($_POST['tipo_prueba']);
                    $obj_prueba->setRevision($_POST['revision_atm']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_reporte_prueba();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Tipo_Prueba':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setTipo_prueba($_POST['tipo_prueba']);
                    $obj_prueba->setRevision($_POST['revision_atm']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_reporte_tipo_prueba();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Apertura_Alarma_SIS':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setHora1($_POST['hora_apertura']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_apertura_alarma();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Hora_Prueba_Alarma_SIS':
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setHora2($_POST['hora_prueba']);
                    $obj_prueba->setZona($_POST['zona']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_prueba_alarma();
                    
                    break;
                case 'Reporte_Cierre':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setId_persona($_POST['id_persona']);
                    $obj_prueba->setEmpresa($_POST['id_empresa']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_reporte_cierre();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Reporte_Informacion_Cierre':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setCuenta_secundaria($_POST['cuenta_secundaria']);
                    $obj_prueba->setCuenta_principal($_POST['cuenta_principal']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guarda_informacion_cierres();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Cierre_Agencia':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setCierre($_POST['cierre']);
                    $obj_prueba->setId_usuario($_SESSION['id']);
                    $obj_prueba->guardar_cierre();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Observaciones_Prueba':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setObservaciones($_POST['observaciones']);
                    $obj_prueba->guardar_observaciones();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
                case 'Seguimiento_Prueba':
                    $obj_prueba->setId_punto($_POST['punto_bcr']);
                    $obj_prueba->setId_prueba($_POST['id_prueba']);
                    $obj_prueba->setSeguimiento($_POST['seguimiento']);
                    $obj_prueba->guardar_seguimiento();
                    if($_POST['id_prueba']=="0"){
                        $ultimo = $obj_prueba->getArreglo();
                        echo $ultimo[0]['ID_Prueba_Alarma'];
                    }
                    break;
            }
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    public function prueba_alarma_eliminar(){
        if(isset($_SESSION['nombre'])){
            $obj_prueba = new cls_prueba_alarma();
            
            $obj_prueba->setCondicion("ID_Prueba_Alarma=".$_POST['id_prueba']);
            $obj_prueba->eliminar_registro_prueba_alarma();
        }
        else {
            $tipo_de_alerta="alert alert-warning";
            $validacion="Es necesario volver a iniciar sesión para consultar el sistema";
            require __DIR__ . '/../vistas/plantillas/inicio_sesion.php';
        }
    }
    
    /*
    //Función para verificar horarios de oficina, validar ingresos, cierres y pruebas
    //Recibe los siguientes parametros: 
    //  -Hora apertura (según el día de la semana)
    //  -Hora Cierre (según el día de la semana)
    //  -Información anterior almacenada (para almacenar nueva y devolver completa)
    //  -Información de prueba de hoy (horas de apertura, hora de prueba, hora de cierre, etc)
    //  -Información de la oficina (Nombre, código: para el mensaje cuando sea necesario)
    */
    public function verificar_horario_puntobcr($hora_apertura,$hora_cierre, $datos, $prueba,$Oficina){
        $fecha_actual= getdate();
        //Convierta la fecha a formto aaaa/mm/dd hh:mm
        $fecha_actual= $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'].' '.$fecha_actual['hours'].':'.$fecha_actual['minutes'];
        //asigna la fecha actual a un arreglo formato DateTime
        $fecha1 = new DateTime($fecha_actual);
        $fecha2 = new DateTime(date('Y-m-d').' '.$hora_apertura);
        $diff = $fecha1->diff($fecha2); 
        $difencia_tiempo=(intval($diff->h)*60)+(intval($diff->i)*1);

        //Información de apertura de alarma pendientes y Urgentes
        if($prueba[0]['Seguimiento']!='Alarma abierta 24 horas'){
            if($prueba[0]['Hora_Apertura_Alarma']=="" || $prueba[0]['Hora_Apertura_Alarma']==null){
                if($diff->invert==1 && $difencia_tiempo>1) {
                    $datos['aperturas_pendietes'][$datos['cont_aperturas_pendientes']]['Mensaje']= $Oficina['Codigo']." - ".$Oficina['Nombre'];
                    $datos['aperturas_pendietes'][$datos['cont_aperturas_pendientes']]['Color']="color: red";
                    $datos['cont_aperturas_pendientes']++;
                }
            } else {
                $datos['contador_aperturas']++;
            }
        }
        //Información de pruebas de alarma pendientes y urgentes
        if($prueba[0]['Hora_Prueba_Alarma']=="" || $prueba[0]['Hora_Prueba_Alarma']==null){
            if($diff->invert==0 && $difencia_tiempo<30) {
                $datos['pruebas_pendientes'][$datos['cont_pruebas_pendientes']]['Mensaje']= $Oficina['Codigo']." - ".$Oficina['Nombre'];
                $datos['pruebas_pendientes'][$datos['cont_pruebas_pendientes']]['Color']="color: orange";
                $datos['cont_pruebas_pendientes']++;
                $datos['contador_pruebas']++;
            } if($diff->invert==1 && $difencia_tiempo>1) {
                $datos['pruebas_pendientes'][$datos['cont_pruebas_pendientes']]['Mensaje']= $Oficina['Codigo']." - ".$Oficina['Nombre'];
                $datos['pruebas_pendientes'][$datos['cont_pruebas_pendientes']]['Color']="color: red";
                $datos['cont_pruebas_pendientes']++;
            } 
        }else {
               $datos['contador_pruebas']++; 
            }
        //Información de cierre de alarma urgentes
        if($prueba[0]['Seguimiento']!='Alarma abierta 24 horas'){
            if($prueba[0]['Hora_Cierre_Alarma']=="" || $prueba[0]['Hora_Cierre_Alarma']==null){
                $fecha2 = new DateTime(date('Y-m-d').' '.$hora_cierre);//Día
                $diff = $fecha1->diff($fecha2); 
                $difencia_tiempo=(intval($diff->h)*60)+(intval($diff->i)*1);

                if($diff->invert==1 && $difencia_tiempo>240) {
                    $datos['cierres_pendientes'][$datos['cont_cierres_pendientes']]['Mensaje']= $Oficina['Codigo']." - ".$Oficina['Nombre'];
                    $datos['cierres_pendientes'][$datos['cont_cierres_pendientes']]['Color']="color: orange";
                    $datos['cont_cierres_pendientes']++;
                }
            } else {
                $datos['contador_cierres']++;
            }
        }
        return $datos;
    }
    
    public function asistencia_personal(){
        require __DIR__ . '/../vistas/plantillas/frm_asistencia_personal.php';
    }
}