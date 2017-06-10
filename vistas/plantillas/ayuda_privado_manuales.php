<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; utf-8"/>
        <title>Manuales de Ayuda</title>
        <?php require_once 'frm_librerias_head.html'; ?>

    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        
        <section class='container text-center espacio-arriba'>
            <!--<embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PERSONAL_EXTERNO_VP.pdf#toolbar=0" width="900" height="450">-->
            <?php switch ($manual) {
                case "Usuario_Inicial": ?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_INICIAL.pdf" width="1000" height="600"> 
                    <?php
                    break;
                case "Bitacora_Digital": ?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_BITACORA_DIGITAL.pdf" width="1000" height="600"> 
                    <?php
                    break;
                case "Personal_BCR":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PERSONAL_BCR.pdf" width="1000" height="600">
                    <?php
                    break;
                case "Personal_Externo":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PERSONAL_EXTERNO.pdf" width="1000" height="600">
                    <?php
                    break;
                case "Cencon":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_CENCON.pdf" width="1000" height="600">
                    <?php
                    break;
                case "Prueba_Alarma":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PRUEBA_ALARMA.pdf" width="1000" height="600"> 
                    <?php
                    break;
                case "Puntos_BCR":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_PUNTOS_BCR.pdf" width="1000" height="600"> 
                    <?php
                    break;
                case "Control_Video":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_CONTROL_VIDEO.pdf" width="1000" height="600"> 
                    <?php
                    break;
                case "Asistencia":?>
                    <embed src="vistas/Manuales/ORIEL_MANUAL_USUARIO_ASISTENCIA.pdf" width="1000" height="600"> 
                    <?php
                    break;
            }?>
        </section>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>
