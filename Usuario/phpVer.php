<?php
require '../require/comun.php';
$bd = new BaseDatos();
$idCasa = Leer::request("idCasa");
$modelo = new ModeloCasa($bd);
$casa = $modelo->get($idCasa);

$modelofoto = new ModeloFoto($bd);
//$foto = array();
$foto = $modelofoto->getFotoIdCasa($idCasa);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administrador</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/terceros/reset.css" title="style"/>
        <link rel="stylesheet" type="text/css" href="../css/casa.css" title="style"/>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <header>
            <div id="headerCentro">
                <img id="logo" src="../img/imgCss/Logo.png" alt="logo"/>
                <h1 id="titulo">Ibersend</h1>   
                <div id="enlaces">
                    <a id="usuario" href="../index.php">Usuario</a>
                    <a id="administrador" href="../administrador/index.php">Adminstrador</a>
                </div>
            </div>
        </header>

        <div id="cuerpo">
            <div id="cuerpoCentro">
                <div id="filtro">
                    <h1 id="ver">Ver Casa</h1>

                    <table class="datosCasa">                          
                        <tr>
                            <td>Precio:  <?php echo $casa->getPrecio(); ?> €</td>                                
                        </tr>                             
                        <tr>
                            <td>Localidad: <?php echo $casa->getLocalidad(); ?></td>
                        </tr>
                        <tr>
                            <td>Metros cuadrados: <?php echo $casa->getMetros(); ?>m2</td>  
                        </tr>
                        <tr>
                            <td>Número de Habitaciones: <?php echo $casa->getNumHabitaciones(); ?></td> 
                        </tr>
                        <tr>
                            <td>Dirección: <?php echo $casa->getDireccion(); ?></td>  
                        </tr>                        
                    </table>

                    <?php
                    foreach ($foto as $indice => $objeto) {
                        ?> 
                        <div class="casa">
                            <table class="datosCasa">
                                <tr>
                                    <td>
                                        <img  width="400px" src="<?php echo$foto[$indice]->getUrl(); ?>"/>  
                                    </td>                         
                                </tr>                         
                            </table>
                        </div>
                        <?php
                    }
                    ?>  
                </div> 
            </div>
            <a id="volver" id="administrador" href="../index.php">Volver</a>
        </div> 
        <footer>
            <div id="soporte">
                <span class="titulopie" id="iconoSoporte">Soporte</span>
                <ul>
                    <li>
                        · Ofertas
                    </li>
                    <li>
                        · Servicio
                    </li>
                    <li>
                        · Registrate                        
                    </li>
                </ul>                
            </div>
            <div class="linea"></div>
            <div  id="miEnvio">
                <span class="titulopie" id="iconoMiEnvio">Mi compra</span>
                <ul>
                    <li>
                        · Localizar
                    </li>
                    <li>
                        · Cancelar compra
                    </li>
                    <li>
                        · Cambiar compra                        
                    </li>
                </ul> 
            </div>
            <div class="linea"></div>
            <div id="conócenos">
                <span class="titulopie" id="iconoConocenos" >Conócenos</span>
                <ul>
                    <li>
                        · Ofertas
                    </li>
                    <li>
                        · Noticias
                    </li>
                    <li>
                        · Quienes somos
                    </li>
                </ul> 
            </div>
            <div class="linea"></div>
            <div id="deInterés">
                <span class="titulopie" id="iconoDeInteres">De interés</span>
                <ul>
                    <li>
                        · Condiciones
                    </li>
                    <li>
                        · Preguntas frecuentes
                    </li>
                    <li>
                        · Politica de privacidad
                    </li>
                </ul> 
            </div>
            <div id="aerolineasycopy">
                <span id="copy">Copyright © Ibersend 2014</span>                
                <span id="british" class="aerologos">E</span>  
                <span class="aerologos">F</span>
                <span id="iberia" class="aerologos">P</span>
                <span class="aerologos">L</span>                
            </div>
        </footer> 
    </body>
</html>