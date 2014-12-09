<?php
require '../require/comun.php';
$bd = new BaseDatos();
/*if (!$bd->isConectado()) {
    header("Location: index.php?r=1");
    exit();
}*/

$idCasa = Leer::get("idCasa");
//$id = Leer::request("id")
$modelo = new ModeloCasa($bd);
//$persona = $modelo->get($id);
//$consultaSql = "delete from persona where id = :id;";
//$parametros["id"] = $id;

/*$r = $bd->setConsulta($consultaSql, $parametros);
$id = $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();*/
$r = $modelo->deletePorId($idCasa);
$bd->closeConexion();

//header("Location: index.php?op=delete&r=$id&cuenta=$cuenta");
header("Location: index.php?op=delete&r=$r");