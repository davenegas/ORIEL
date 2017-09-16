<?php

/**
* Description of Encrypter
*
* 
* Clase que permite encriptar información sensible del sistema y la base de datos
* Utiliza base 64 como formato de encriptación de los datos.
* Adicionalmenten se declara un evento que permite procesar una cadena para eliminar tildes, 
* acentos, eñes, etc.
* 
*/

//Declaración de la clase
class Encrypter {
    //Clave para encriptar y desenciptar.
    private static $Key = "centrodecontrol";
    
    //Metodo que recibe una cadena y la encipta en base 64
    public static function encrypt ($input) {
        //Asigna a la variable output la codificacion correspondiente encriptada en base 64 de la cadena
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        //Devuelve el resultado del proceso
        return $output;
    }
 
    //Metodo que recibe una cadena y la desencripta de base 64
    public static function decrypt ($input) {
        //Asigna a la variable output la codificacion correspondiente desencriptada de base 64 de la cadena
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        //Devuuelve la cadena traducida a lenguaje normal
        return $output;
    }
    
    //Metodo que formatea una cadena, la recibe por parametro y le quita tildes y reemplaza caracteres especiales
    public static function quitar_tildes($cadena) {
        //Vector de caracteres no permitidos
        $no_permitidas= array ("Ñ","ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        //Vector de caracteres permitidos
        $permitidas= array ("N","n","a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        // Ejecuta el reemplazo correspondiente
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        //Devuelve el resultado
        return $texto;
    }
 
}


