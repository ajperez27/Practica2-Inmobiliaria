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
                    <a id="administrador" href="index.php">Adminstrador</a>
                </div>
            </div>
        </header>

        <div id="cuerpo">
            <div id="cuerpoCentro">
                <div id="filtro">
                    <h1>Modificar Casa</h1>
                    <form id="update" action = "phpUpdate.php" method = "POST" id="idformulario" enctype="multipart/form-data">
                        <input type = "hidden" name = "idCasa" value = "<?php echo $idCasa; ?>"/>
                        <label>Precio</label>
                        <input type="text" name="precio" value="<?php echo $casa->getPrecio(); ?>" size="40" id="precio" placeholder="precio" required/>
                        <label>€</label>
                        <br/>
                        <label>Localidad</label>
                        <input type="text" name="localidad" value="<?php echo $casa->getLocalidad(); ?>" size="40" id="localidad" placeholder="localidad" required/>
                        <br/>
                        <label>Metros</label>
                        <input type="text" name="metros" value="<?php echo $casa->getMetros(); ?>" size="30" id="metros" placeholder="metros" required/>
                        <label>m2</label>
                        <br/>
                        <label>Número de Habitaciones</label>
                        <input type="text" name="numHabitaciones" value="<?php echo $casa->getNumHabitaciones(); ?>" size="60" id="numHabitaciones" placeholder="numHabitaciones" required/>
                        <br/>   
                        <label>Dirección</label>
                        <input type="text" name="direccion" value="<?php echo $casa->getDireccion(); ?>" size="60" id="direccion" placeholder="direccion" required/>
                        <br/> 
                        <label>Fotos:</label>
                        <input class="subir" type="file" name="archivos[]" multiple/>
                        <a href="index.php">Volver</a>
                        <input class="boton" type="submit" value="Modificar" />                         
                    </form>    
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
                            <tr>
                                <td>
                                    <a data-idCasa='<?php echo $objeto->getIdCasa(); ?>'                           
                                       class='borrar' href='phpDeleteFoto.php?idFoto=<?php echo $foto[$indice]->getIdCasa(); ?>&idCasa=<?php echo $foto[$indice]->getIdFoto(); ?>'>Borrar Foto
                                    </a>
                                </td>                         
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                ?>  
                </div> 


                 
            </div>
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