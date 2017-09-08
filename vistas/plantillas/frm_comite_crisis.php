<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Gestión de Puntos BCR</title>
        <script language="javascript" src="vistas/js/jquery.js"></script>
        <?php require_once 'frm_librerias_head.html'; ?>
        <script>
            function guardar_nota(tipo){
                switch(tipo){
                    case 'text_gerente_general':
                        nota = document.getElementById('text_gerente_general').value;
                        id=2;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_administracion_finanzas').value;
                        id=3;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_banca_minorista').value;
                        id=4;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_banca_mayorista').value;
                        id=5;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_riesgo_control').value;
                        id=6;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_capital_humano').value;
                        id=7;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_juridico').value;
                        id=8;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_gerente_general':
                        nota = document.getElementById('text_tecnologia_informacion').value;
                        id=9;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_obras_civiles':
                        nota = document.getElementById('text_obras_civiles').value;
                        id=10;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_seguridad':
                        nota = document.getElementById('text_seguridad').value;
                        id=11;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_salud_ocupacional':
                        nota = document.getElementById('text_salud_ocupacional').value;
                        id=12;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_comunicacion':
                        nota = document.getElementById('text_comunicacion').value;
                        id=13;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_continuidad_ti':
                        nota = document.getElementById('text_continuidad_ti').value;
                        id=14;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;
                    case 'text_continuidad_negocio':
                        nota = document.getElementById('text_continuidad_negocio').value;
                        id=15;
                        $.post("index.php?ctl=nota_guardar", { nota: nota, id:id }, function(data){ console.log(data); });
                        break;    
                }
            }
        </script>
        <style>
        .organigrama * {
            margin: 0px;
            padding: 0px;
        }
        
        .organigrama ul {
            padding-top: 20px;
            position: relative;
        }
        
        .organigrama li {
            float: left;
            text-align: center;
            list-style-type: none;
            padding: 20px 5px 0px 5px;
            position: relative;
        }

        .organigrama li::before, .organigrama li::after {
            content: '';
            position: absolute;
            top: 0px;
            right: 50%;
            border-top: 1px solid #f80;
            width: 50%;
            height: 20px;
        }

        .organigrama li::after{
            right: auto;
            left: 50%;
           border-left: 1px solid #f80;
        }

.organigrama li:only-child::before, .organigrama li:only-child::after {
	display: none;
}

.organigrama li:only-child {
  padding-top: 0;
}

.organigrama li:first-child::before, .organigrama li:last-child::after{
	border: 0 none;
}

.organigrama li:last-child::before{
	border-right: 1px solid #f80;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
	border-radius: 0 5px 0 0;
}

.organigrama li:first-child::after{
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
	border-radius: 5px 0 0 0;
}

.organigrama ul ul::before {
	content: '';
	position: absolute;
  top: 0;
  left: 50%;
	border-left: 1px solid #f80;
	width: 0;
  height: 20px;
}

.organigrama li a {
	border: 1px solid #f80;
	padding: 1em 0.75em;
	text-decoration: none;
	color: #333;
  background-color: rgba(255,255,255,0.6);
	font-family: arial, verdana, tahoma;
	font-size: 0.85em;
	display: table-cell;
  vertical-align: middle;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
  -webkit-transition: all 500ms;
  -moz-transition: all 500ms;
  transition: all 500ms;
}

.organigrama li:only-child > a {
  display: inline-block;
}

.organigrama li a:hover {
	border: 1px solid #fff;
	color: #ddd;
  background-color: rgba(255,128,0,0.7);
}

.organigrama > ul > li > a {
  font-size: 1.3em;
  font-weight: bold;
  padding: 2em;
}

.organigrama > ul > li > ul > li > a {
  width: 8em;
  height: 6em;
}

/*******************
Responsive section
*******************/
@media screen and (max-width:768px) {
  body {
    width: 50%;
  }
  .organigrama * {
    margin: 0;
    padding: 0;
  }
  .organigrama {
  }
  .organigrama ul, .organigrama ul ul {
    padding-top: 0px;
    left: 50%;
    width: 160px;
  }
  .organigrama ul ul::before {
    display: none;
  }
  .organigrama ul li {
    float: none;
    text-align: left;
    padding: 10px 0px;
    margin: 0px;
  }
  .organigrama ul li::before {
    right: auto;
    border: none;
  }
  .organigrama ul li:last-child::before {
    right: auto;
    border-right: none;
  }
  .organigrama ul li::after{
    left: auto;
    border: none;
  }
  .organigrama ul li ul li a {
    display: inline-block;
    padding: 16px;
    margin-left: 20px;
    width: 280px;
    height: 46px;
  }
  .organigrama > ul > li > a {
    padding: 1.5em;
    margin-left: 20px;
    margin-bottom: 10px;
  }
  .organigrama ul li::before {
    top: -51px;
    left: 0px;
    border-bottom: 1px solid #f80;
    border-left: 1px solid #f80;
    width: 20px;
    height: 100px;
  }
  .organigrama ul li:first-child::before {
    top: -10px;
    left: 0px;
    border-bottom: 1px solid #f80;
    border-left: 1px solid #f80;
    width: 20px;
    height: 3.6em;
  }
}
        </style>
    </head>
    <body>
        <?php require_once 'encabezado.php';?>
        <div class="container">
            <div class="row espacio-arriba">
                <div class="col-md-3">
                    <div id="myCarousel_1" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_1" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_1" data-slide-to="1"></li>
                            <li data-target="#myCarousel_1" data-slide-to="2"></li>
                            <li data-target="#myCarousel_1" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h3 style="text-align: center;">Gerente General</h3>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h3 style="text-align: center;">Gerente General</h3>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0539-0960.jpg">
                                <h4 style="text-align: center;">Leonardo Acuña Alvarado</h4>
                            </div>
                            <div class="item">
                                <h3 style="text-align: center;">Gerente General</h3>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0985-0602.jpg">
                                <h4 style="text-align: center;">Andres Víquez Lizano</h4>
                            </div>
                            <div class="item">
                                <h3 style="text-align: center;">Gerente General</h3>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0504-0816.jpg">
                                <h4 style="text-align: center;">Marvin Corrales Barboza</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_1" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_1" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_gerente_general" onblur="guardar_nota('text_gerente_general');"value="<?php echo $notas[1]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_2" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_2" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_2" data-slide-to="1"></li>
                            <li data-target="#myCarousel_2" data-slide-to="2"></li>
                            <li data-target="#myCarousel_2" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Subgerente General de Administracióny Finanzas</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Subgerente General de Administracióny Finanzas</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0539-0960.jpg">
                                <h4 style="text-align: center;">Leonardo Acuña Alvarado</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Administracióny Finanzas</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0551-0368.jpg">
                                <h4 style="text-align: center;">Tatiana Cardenas Carnice</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Administracióny Finanzas</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0905-0292.jpg">
                                <h4 style="text-align: center;">Gabriel Alpizar Cháves</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_2" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_2" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_administracion_finanzas" onblur="guardar_nota('text_administracion_finanzas');"value="<?php echo $notas[2]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_3" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_3" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_3" data-slide-to="1"></li>
                            <li data-target="#myCarousel_3" data-slide-to="2"></li>
                            <li data-target="#myCarousel_3" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Subgerente General de Banca Minorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Subgerente General de Banca Minorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0504-0816.jpg">
                                <h4 style="text-align: center;">Marvin Corrales Barboza</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Banca Minorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/05-0170-0884.jpg">
                                <h4 style="text-align: center;">Renán Murillo Pizarro</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Banca Minorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0822-0295.jpg">
                                <h4 style="text-align: center;">Rodrigo Ramírez Rodriguez</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_3" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_3" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_banca_minorista" onblur="guardar_nota('text_banca_minorista');"value="<?php echo $notas[3]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_4" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_4" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_4" data-slide-to="1"></li>
                            <li data-target="#myCarousel_4" data-slide-to="2"></li>
                            <li data-target="#myCarousel_4" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Subgerente General de Banca Mayorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Subgerente General de Banca Mayorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0985-0602.jpg">
                                <h4 style="text-align: center;">Andres Víquez Lizano</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Banca Mayorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0753-0487.jpg">
                                <h4 style="text-align: center;">Mynor Hernández Hernández</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Subgerente General de Banca Mayorista</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/02-0399-0229.jpg">
                                <h4 style="text-align: center;">Freddy Morera Zumbado</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_4" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_4" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_banca_mayorista" onblur="guardar_nota('text_banca_mayorista');"value="<?php echo $notas[4]['Nota']?>">
                </div>
            </div>
            
            <div class="row espacio-arriba">
                <div class="col-md-3">
                    <div id="myCarousel_5" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_5" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_5" data-slide-to="1"></li>
                            <li data-target="#myCarousel_5" data-slide-to="2"></li>
                            <li data-target="#myCarousel_5" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Gerente Corporativo de Riesgo y Control Interno</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Gerente Corporativo de Riesgo y Control Interno</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/06-0136-0819.jpg">
                                <h4 style="text-align: center;">Gilbert Barrantes Campos</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo de Riesgo y Control Interno</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/02-0512-0833.jpg">
                                <h4 style="text-align: center;">Oscar Jimmy Jimenez Bastos</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo de Riesgo y Control Interno</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0831-0440.jpg">
                                <h4 style="text-align: center;">Leonor Cuevillas Vallejos</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_5" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_5" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_riesgo_control" onblur="guardar_nota('text_riesgo_control');"value="<?php echo $notas[5]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_6" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_6" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_6" data-slide-to="1"></li>
                            <li data-target="#myCarousel_6" data-slide-to="2"></li>
                            <li data-target="#myCarousel_6" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Gerente Corporativo Capital Humano</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Gerente Corporativo Capital Humano</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/03-0326-0902.jpg">
                                <h4 style="text-align: center;">Nelson Marín Campos</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo Capital Humano</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/06-0236-0707.jpg">
                                <h4 style="text-align: center;">Patricia Mora Salinas</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo Capital Humano</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0869-0178.jpg">
                                <h4 style="text-align: center;">Lucia Mora Rodriguez</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_6" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_6" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_capital_humano" onblur="guardar_nota('text_capital_humano');"value="<?php echo $notas[6]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_7" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_7" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_7" data-slide-to="1"></li>
                            <li data-target="#myCarousel_7" data-slide-to="2"></li>
                            <li data-target="#myCarousel_7" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Gerente Corporativo<br> Jurídico</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Gerente Corporativo<br> Jurídico</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/04-0128-0580.jpg">
                                <h4 style="text-align: center;">Eduardo Ramírez Castro</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo<br> Jurídico</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0489-0519.jpg">
                                <h4 style="text-align: center;">Leovigildo Ramírez Anchia</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Corporativo<br> Jurídico</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0615-0847.jpg">
                                <h4 style="text-align: center;">Gilbert Aguilar Gutierrez</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_7" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_7" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_juridico" onblur="guardar_nota('text_juridico');"value="<?php echo $notas[7]['Nota']?>">
                </div>
                <div class="col-md-3">
                    <div id="myCarousel_8" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel_8" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel_8" data-slide-to="1"></li>
                            <li data-target="#myCarousel_8" data-slide-to="2"></li>
                            <li data-target="#myCarousel_8" data-slide-to="3"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <h4 style="text-align: center;">Gerente Tecnología <br> Información</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/pendiente.jpg">
                                <h4 style="text-align: center;">Pendiente</h4>
                            </div>
                            <div class="item" >
                                <h4 style="text-align: center;">Gerente Tecnología <br> Información</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/01-0736-0372.jpg">
                                <h4 style="text-align: center;">Johnny Muñoz Paniagua</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Tecnología <br> Información</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/03-0364-0503.jpg">
                                <h4 style="text-align: center;">Arnoldo Pereira Castillo</h4>
                            </div>
                            <div class="item">
                                <h4 style="text-align: center;">Gerente Tecnología <br> Información</h4>
                                <img src="vistas/Imagenes/Comite_Crisis/03-0315-0719.jpg">
                                <h4 style="text-align: center;">Leonardo Gutierrez Fallas</h4>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel_8" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel_8" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <input type="text" class="form-control" id="text_tecnologia_informacion" onblur="guardar_nota('text_tecnologia_informacion');"value="<?php echo $notas[8]['Nota']?>">
                </div>
            </div>
            
            <div class="row espacio-arriba center" style="align: center;">
                <div class="col-md-1"></div>
                <div class="col-md-10"> 
                    <div class="organigrama">
                    <ul>
                        <li><a>Gerencia de Obras Civiles<br>
                                <input type="text" class="form-control" id="text_obras_civiles" onblur="guardar_nota('text_obras_civiles');" 
                                    value="<?php echo $notas[9]['Nota']?>" placeholder="Notas importantes">
                            </a>
                            <ul>
                                <li><a>Marco Tulio Meza</a></li>
                                <li><a>Oscar Fallas</a></li>
                            </ul>
                        </li>
                        <li><a>Gerencia de Seguridad<br>
                                <input type="text" class="form-control" id="text_seguridad" onblur="guardar_nota('text_seguridad');" 
                                    value="<?php echo $notas[10]['Nota']?>" placeholder="Notas importantes"></a>
                            <ul>
                                <li><a>Edgar Fonseca</a></li>
                                <li><a>Edwards Vasquez</a></li>
                            </ul>
                        </li>
                        <li><a>Salud Ocupacional<br>
                                <input type="text" class="form-control" id="text_salud_ocupacional" onblur="guardar_nota('text_salud_ocupacional');" 
                                    value="<?php echo $notas[11]['Nota']?>" placeholder="Notas importantes"></a>
                            <ul>
                                <li><a>Esteban Ardon</a></li>
                                <li><a>Michael Brenes</a></li>
                            </ul>
                        </li>

                    </ul>
                </div> </div>
               
                <div class="col-md-1"></div>
            </div>
            <div class="row espacio-arriba" style="align: center;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="organigrama">
                    <ul>
                        <li><a>Comunicación Interna y Externa<br>
                                <input type="text" class="form-control" id="text_comunicacion" onblur="guardar_nota('text_comunicacion');" 
                                    value="<?php echo $notas[12]['Nota']?>" placeholder="Notas importantes"></a>
                            <ul>
                                <li><a>Marlen Sanchez</a></li>
                                <li><a>Mariana Villalobos</a></li>
                            </ul>
                        </li>
                        <li><a>Continuidad de TI<br>
                                <input type="text" class="form-control" id="text_continuidad_ti" onblur="guardar_nota('text_continuidad_ti');" 
                                    value="<?php echo $notas[13]['Nota']?>" placeholder="Notas importantes"></a>
                            <ul>
                                <li><a>Jorge Castro</a></li>
                                <li><a>Carla Rodriguez</a></li>
                            </ul>
                        </li>
                        <li><a>Continuidad del Negocio<br>
                                <input type="text" class="form-control" id="text_continuidad_negocio" onblur="guardar_nota('text_continuidad_negocio');" 
                                    value="<?php echo $notas[14]['Nota']?>" placeholder="Notas importantes"></a>
                            <ul>
                                <li><a>Jorge Santamaría</a></li>
                                <li><a>Giani Mora</a></li>
                            </ul>
                        </li>
                    </ul>
                </div> 
                </div>
                <div class="col-md-1"></div>
                
            </div>
        </div>
        <?php require_once 'pie_de_pagina.php' ?>
    </body>
</html>