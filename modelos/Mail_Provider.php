<?php


class Mail_Provider{
    /*
    * Variables publicas, que determinan los parametros de conexión a la base de datos,
    * así como el uso de variables propias de la clase para gestión de la información
    */
   private $mail;
   
    //Constructor que inicializa las variables 
    public function __construct(){
        //Controlador de excepciones
        try{
            $this->mail = new PHPMailer();
            //indico a la clase que use SMTP
            $this->mail->isSMTP();
            //permite modo debug para ver mensajes de las cosas que van ocurriendo
            //$this->mail->SMTPDebug=2;
            //Debo de hacer autenticación SMTP
            $this->mail->SMTPAuth = true;
            $this->mail->CharSet='UTF-8';
            //$this->mail->SMTPSecure = "ssl";
            $this->mail->SMTPSecure = "tls";
            //indico el servidor de Gmail para SMTP
            //$this->mail->Host = "smtp.gmail.com";
            //$this->mail->Host = "smtp.office365.com";
            $this->mail->Host = "10.1.8.1";
            //indico el puerto que usa Gmail
            //$this->mail->Port = 465;
            $this->mail->Port = 25;
            //$this->mail->Port = 587;

            //indico un usuario / clave de un usuario de gmail
            //$this->mail->Username = "113100038@bancobcr.com";
            $this->mail->Username = "oriel@bancobcr.com";
            //$this->mail->Password = "Entoas79.";
            $this->mail->Password = "asdf123.";
            //$this->mail->SetFrom('orielinforma@gmail.com', 'Oriel Jefatura de Seguridad');
            //$this->mail->addReplyTo('orielinforma@gmail.com', 'Oriel Jefatura de Seguridad');
            
            //$this->mail->SetFrom('113100038@bancobcr.com', 'Oriel');
            $this->mail->SetFrom('oriel@bancobcr.com', 'Oriel');
            $this->mail->addReplyTo('oriel@bancobcr.com', 'Oriel');
          
            
        //Acapara los errores que se puedan presentar y muestra en pantalla lo correspondiente
        }catch (Exception $e){
           echo 'Hubo un problema al inicializar las variables de la clase Mail_Provider';
        }  
   }

    //Metodo que agrega asunto a la base de datos
    public function agregar_asunto_de_correo($asunto){
        try{
           $this->mail->Subject = $asunto;
        }catch (Exception $e){
           echo 'Hubo un problema al agregar el asunto del correo';
       }
    }
   
    //Metodo que agrega detalle a la base de datos
    public function agregar_detalle_de_correo($detalle){
        try{
           $this->mail->msgHTML($detalle);
        }catch (Exception $e){
            echo 'Hubo un problema al agregar el detalle del correo del correo';
        }
    }
   
    //Metodo que agrega detalle a la base de datos
    public function agregar_direccion_de_correo($direccion,$nombre_destinatario){
        try{
        $this->mail->addAddress($direccion, $nombre_destinatario);
        }catch (Exception $e){
           echo 'Hubo un problema al agregar la dirección de correo';
        }
    }
   
    //Metodo que agrega detalle a la base de datos
    public function agregar_direccion_de_correo_copia($direccion,$nombre_destinatario){
        try{
           $this->mail->addCC($direccion, $nombre_destinatario);
        }catch (Exception $e){
           echo 'Hubo un problema al agregar la dirección de correo';
        }
    }
    
    //Metodo que agrega detalle a la base de datos
    public function agregar_direccion_de_correo_oculta($direccion,$nombre_destinatario){
        try{
        $this->mail->addBCC($direccion, $nombre_destinatario);
        }catch (Exception $e){
           echo 'Hubo un problema al agregar la dirección de correo';
        }
    }
    
    //Metodo que agrega detalle a la base de datos
    public function enviar_correo(){
        try{
            if(!$this->mail->send()) {
                //echo "Error al enviar: " . $mail->ErrorInfo;
                return false; 
            } else {
                //echo "Mensaje enviado!";
                return true;
            }
        }catch (Exception $e){
           echo 'Hubo un problema al intentar enviar el correo';
        }
    }
}
