<?php
require '../require/comun.php';

$idCasa = Leer::post("idCasa");
$precio = Leer::post("precio");
$localidad = Leer::post("localidad");
$metros = Leer::post("metros");
$numHabitaciones = Leer::post("numHabitaciones");
$direccion = Leer::post("direccion");

$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
$casa = new Casa($idCasa, $precio, $localidad, $metros, $numHabitaciones, $direccion);
$r = $modelo->edit($casa);

//$idCasa = $bd->getAutonumerico();

$modeloFoto = new ModeloFoto($bd);

$subir = new SubirArchivos("archivos");
$subir->setNombre($idCasa);
$subir->subir();

$extensiones = $subir->getExtensiones();

foreach ($extensiones as $i => $valor) {
   // echo $i."<br/>";
   // echo $valor."<br/>";
    $objetoFoto = new Foto(null, $idCasa, "$valor");
    $rFoto = $modeloFoto->add($objetoFoto);
}

$bd->closeConexion();
header("Location: index.php?op=update&r=$r");
?>    

