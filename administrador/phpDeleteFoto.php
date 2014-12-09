<?php
require '../require/comun.php';
$bd = new BaseDatos();
/*if (!$bd->isConectado()) {
    header("Location: index.php?r=1");
    exit();
}*/
$idFoto = Leer::request("idFoto");
$idCasa = Leer::request("idCasa");

//echo $idFoto;
//echo $idCasa;
$modelo = new ModeloFoto($bd);

$r = $modelo->deletePorIdFoto($idFoto);

$bd->closeConexion();

header("Location: phpVer.php?op=delete&r=$r&idCasa=$idCasa");