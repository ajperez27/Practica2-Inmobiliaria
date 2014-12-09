<?php

/**
 * Class ModeloCasa
 *
 * @version 1.01
 * @author Antonio Javier Pérez Medina
 * @license http://...
 * @copyright izvbycv
 * Esta clase gestiona las casas con la base de datos.
 */
class ModeloCasa {

    private $bd;
    private $tabla = "casa";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    /**
     * Devuelve -1 si no añade correctamente
     * @access public
     * @return int 
     */
    function add(Casa $objeto) {
        $sql = "insert into $this->tabla values (null, :precio, :localidad, "
                . ":metros, :numHabitaciones, :direccion);";
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["localidad"] = $objeto->getLocalidad();
        $parametros["metros"] = $objeto->getMetros();
        $parametros["numHabitaciones"] = $objeto->getNumHabitaciones();
        $parametros["direccion"] = $objeto->getDireccion();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0         
    }

    /**
     * Devuelve -1 si no borra correctamente
     * @access public
     * @return int 
     */
    function delete(Casa $objeto) {
        $sql = "delete from $this->tabla where idCasa = :idCasa";
        $parametros["idCasa"] = $objeto->getIdCasa();
        $r = $this->bd->setConsulta($sql, $parametros);

        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas(); //0
    }

    /**
     * Devuelve el resultado del borrado
     * @access public
     * @return int 
     */
    function deletePorId($idCasa) {
        return $this->delete(new Casa($idCasa));
    }

    /**
     * Devuelve -1 si no edita correctamente
     * @access public
     * @return int 
     */
    function edit(Casa $objeto) {
        $sql = "update $this->tabla set precio = :precio, localidad = :localidad,"
                . "metros = :metros, numHabitaciones = :numHabitaciones "
                . ", direccion = :direccion where idCasa= :idCasa;";
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["localidad"] = $objeto->getLocalidad();
        $parametros["metros"] = $objeto->getMetros();
        $parametros["numHabitaciones"] = $objeto->getNumHabitaciones();
        $parametros["direccion"] = $objeto->getDireccion();
        $parametros["idCasa"] = $objeto->getIdCasa();
        $r = $this->bd->setConsulta($sql, $parametros);

        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas(); //0
    }

    /**
     * Devuelve -1 si no edita correctamente por la primary key antigua
     * @access public
     * @return int 
     */
    function editPK(Casa $objetoOriginal, Casa $objetoNuevo) {
        $sql = "update $this->tabla set precio = :precio, localidad = :localidad,"
                . "metros = :metros, numHabitaciones = :numHabitaciones"
                . ", direccion = :direccion where idCasa= :idCasapk;";
        $parametros["precio"] = $objetoNuevo->getPrecio();
        $parametros["localidad"] = $objetoNuevo->getLocalidad();
        $parametros["metros"] = $objetoNuevo->getMetros();
        $parametros["numHabitaciones"] = $objetoNuevo->getNumHabitaciones();
        $parametros["direccion"] = $objetoNuevo->getDireccion();
        $parametros["idCasa"] = $objetoNuevo->getIdCasa();
        $parametros["idpk"] = $objetoOriginal->getIdCasa();
        $r = $this->bd->setConsulta($sql, $parametros);

        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas(); //0
    }

    /**
     * Devuelve la casa buscada
     * @access public
     * @return Casa $casa 
     */
    function get($idCasa) {
        $sql = "select * from $this->tabla where idCasa= :idCasa";
        $parametros["idCasa"] = $idCasa;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $casa = new Casa();
            $casa->set($this->bd->getFila());
            return $casa;
        }
        return null;
    }

    /**
     * Devuelve -1 si no realiza la consulta corectamente
     * @access public
     * @return int 
     */
    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            return $this->bd->getFila();
        }
        return -1;
    }

    /**
     * Devuelve el numeo de paginas
     * @access public
     * @return int 
     */
    function getNumeroPaginas($rpp = Configuracion::RPP) {
        $lista = $this->count();
        return (ceil($lista[0] / $rpp) - 1);
    }

    /**
     * Devuelve un array con las casas
     * @access public
     * @return array $list
     */
    function getList($pagina = 0, $rpp = 10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio,$rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $casa = new Casa();
                $casa->set($fila);
                $list[] = $casa;
            }
        } else {
            return null;
        }
        return $list;
    }

    /**
     * Devuelve un select de html construido 
     * @access public
     * @return string $select
     */
    function selectHtml($idCasa, $name, $condicion, $parametros, $valorSelecctionado = "", $blanco = true, $orderby = "1") {
        $select = "<select  name='$name' id='$idCasa'>";
        if ($blanco) {
            $select.= "<option value='' />&nbsp $ </option>";
        }
        $lista = $this->getList($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getIdCasa() == $valorSelecctionado) {
                $selected = "selected";
            }

            $select = "<option $selected value='" . $objeto->getIdCasa() . "' >" . $objeto->getPrecio() . "," . $objeto->getLocalidad() .
                    $objeto->getMetros() . "," . $objeto->getNumHabitaciones() . "</option>";
        }

        $select.="</select>";
        return $select;
    }

    /**
     * Devuelve el nombre de la tabla 
     * @access public
     * @return string tabla
     */
    function getTabla() {
        return $this->tabla;
    }

}

?>
