<?php
require 'require/comun.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}

$condicion = "";
$parametros = array();

$filtroPrecio = Leer::request("filtroPrecio");
$filtroLocalidad = Leer::request("filtroLocalidad");
$filtroMetros = Leer::request("filtroMetros");
$filtroNumHabitaciones = Leer::request("filtroNumHabitaciones");
$orden = Leer::request("orden");

if ($filtroPrecio != "" && ($filtroLocalidad != "" || $filtroMetros != "" || $filtroNumHabitaciones != "")) {
    $condicion .= "precio = :precio and ";
    $parametros["precio"] = $filtroPrecio;
} elseif ($filtroPrecio != "") {
    $condicion .= "precio = :precio ";
    $parametros["precio"] = $filtroPrecio;
}

if ($filtroLocalidad != "" && ($filtroMetros != "" || $filtroNumHabitaciones != "")) {
    $condicion .= "localidad = :localidad and ";
    $parametros["localidad"] = $filtroLocalidad;
} elseif ($filtroLocalidad != "") {
    $condicion .= "localidad = :localidad ";
    $parametros["localidad"] = $filtroLocalidad;
}

if ($filtroMetros != "" && $filtroNumHabitaciones != "") {
    $condicion .= "metros = :metros and ";
    $parametros["metros"] = $filtroMetros;
} elseif ($filtroMetros != "") {
    $condicion .= "metros = :metros and ";
    $parametros["metros"] = $filtroMetros;
}

if ($filtroNumHabitaciones != "") {
    $condicion .= " numHabitaciones = :numHabitaciones";
    $parametros["numHabitaciones"] = $filtroNumHabitaciones;
}

if ($orden == "Ascendente") {
    $orderby = "precio ASC";
}
if ($orden == "Descendente") {
    $orderby = "precio DESC";
}
if ($orden != "Ascendente" && $orden != "Descendente") {
    $orderby = "1";
}
if ($condicion == "") {
    $condicion = "1=1";
}

/* echo$condicion."<br/>";
  echo "Precio = ".$filtroPrecio."<br/>";
  echo "Localidad = ".$filtroLocalidad."<br/>";
  echo "Metros = ".$filtroMetros."<br/>";
  echo "Habitaciones = ".$filtroNumHabitaciones."<br/>";
  echo "orden = ".$orden."<br/>"; */

$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
//$filas = $modelo->getList($pagina);
$paginas = $modelo->getNumeroPaginas();
$filas = $modelo->getList($pagina, Configuracion::RPP, $condicion, $parametros, $orderby);
$total = $modelo->count();
$enlaces = Util::getEnlacesPaginacion2($pagina, $total[0]);

$modelofoto = new ModeloFoto($bd);
$foto = array();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Usuario</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/terceros/reset.css" title="style"/>
        <link rel="stylesheet" type="text/css" href="css/casa.css" title="style"/>
        <script src="../js/main.js"></script>
    </head>
    <body>   
        <header>
            <div id="headerCentro">
                <img id="logo" src="img/imgCss/Logo.png" alt="logo"/>
                <h1 id="titulo">Ibersend</h1>   
                <div id="enlaces">
                    <a id="usuario" href="index.php">Usuario</a>
                    <a id="administrador" href="administrador/index.php">Adminstrador</a>
                </div>
            </div>
        </header>

        <div id="cuerpo">
            <div id="cuerpoCentro">
                <div id="filtro">
                    <h1>Filtrar</h1>
                    <form action="index.php" method="POST"> 
                        <label>Precio</label>
                        <input type="text" name="filtroPrecio" value="" size="40" id="filtroPrecio" />
                        <label>€</label>
                        <br/>
                        <label>Localidad</label>
                        <input type="text" name="filtroLocalidad" value="" size="40" id="filtroLocalidad"/>
                        <br/>
                        <label>Metros</label>
                        <input type="text" name="filtroMetros" value="" size="30" id="filtroMetros" />
                        <label>m2</label>
                        <br/>
                        <label>Número de habitaciones</label>
                        <input type="text" name="filtroNumHabitaciones" value="" size="60" id="filtroNumHabitaciones" />
                        <br/>  
                        <label>Ordenar por Precio:</label>                            
                        <input type="radio" name="orden" value="Ascendente" />
                        <label>Ascendente</label>      
                        <br/>  
                        <input id="descendente" type="radio" name="orden" value="Descendente" />
                        <label>Descendente</label>   
                        <br/> 
                        <input class="boton" type="submit" value="Filtrar" />
                    </form>     
                </div>    
                <?php
                foreach ($filas as $indice => $objeto) {
                    $foto = $modelofoto->getFotoIdCasa($objeto->getIdCasa());
                    ?>  
                    <div class="casa">
                        <?php
                        if ($foto) {
                            $ruta = $foto[0]->getUrl();
                            $longitud = strlen($ruta);
                            $ruta = substr($ruta, 3, $longitud - 3);
                            ?>                        
                            <img  width="500px" src="<?php echo $ruta ?>"/> 
                        <?php } ?>
                        <table class="datosCasa">                          
                            <tr>
                                <td>Precio:  <?php echo$objeto->getPrecio(); ?> €</td> 
                                <td><a data-idCasa='<?php echo $objeto->getIdCasa(); ?>'
                                       href='Usuario/phpVer.php?idCasa=<?php echo $objeto->getIdCasa(); ?>'>Ver Más
                                    </a>                    
                                </td>
                            </tr>                             
                            <tr>
                                <td>Localidad: <?php echo$objeto->getLocalidad(); ?></td>
                            </tr>
                            <tr>
                                <td>Metros cuadrados: <?php echo$objeto->getMetros(); ?>m2</td>  
                            </tr>
                            <tr>
                                <td>Número de Habitaciones: <?php echo$objeto->getNumHabitaciones(); ?></td> 
                            </tr>
                            <tr>
                                <td>Dirección: <?php echo$objeto->getDireccion(); ?></td>  
                            </tr>                        
                        </table>
                    </div>
                    <?php
                }
                ?>

                <div id="paginacion">
                    <?php echo $enlaces["inicio"]; ?>
                    <?php echo $enlaces["anterior"]; ?>
                    <?php echo $enlaces["primero"]; ?>
                    <?php echo $enlaces["segundo"]; ?>
                    <?php echo $enlaces["actual"]; ?>
                    <?php echo $enlaces["cuarto"]; ?>
                    <?php echo $enlaces["quinto"]; ?>
                    <?php echo $enlaces["siguiente"]; ?>
                    <?php echo $enlaces["ultimo"]; ?>
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
<?php
$bd->closeConexion();
?>