<?php

require '../require/comun.php';
$precio = Leer::post("precio");
$localidad = Leer::post("localidad");
$metros = Leer::post("metros");
$numeroHabitacoines = Leer::post("numHabitaciones");
$direccion = Leer::post("direccion");

$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
$objeto = new Casa(null, $precio, $localidad, $metros, $numeroHabitacoines, $direccion);
$r = $modelo->add($objeto);

$idCasa = $bd->getAutonumerico();

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

header("Location: index.php");
?>