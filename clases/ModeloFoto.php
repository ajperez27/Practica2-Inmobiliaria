<?php

/**
 * Class ModeloFoto
 *
 * @version 1.01
 * @author Antonio Javier Pérez Medina
 * @license http://...
 * @copyright izvbycv
 * Esta clase gestiona las fotos con la base de datos.
 */
class ModeloFoto {

    private $bd;
    private $tabla = "foto";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
   /**
     * Devuelve -1 si no añade correctamente
     * @access public
     * @return int 
     */
    function add(Foto $objeto) {
        $sql = "insert into $this->tabla values (null, :idCasa, :url);";
        $parametros["idCasa"] = $objeto->getIdCasa();
        $parametros["url"] = $objeto->getUrl();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico();
    }

      /**
     * Devuelve -1 si no borra correctamente
     * @access public
     * @return int 
     */
    function delete(Foto $objeto) {
        $sql = "delete from $this->tabla where idFoto = :idFoto";
        $parametros["idFoto"] = $objeto->getIdFoto();
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
    function deletePorIdFoto($idFoto) {
        return $this->delete(new Foto($idFoto));
    }

        /**
     * Devuelve -1 si no edita correctamente
     * @access public
     * @return int 
     */
    function edit(Foto $objeto) {
        $sql = "update $this->tabla set url = :url, idCasa = :idCasa where idFoto = :idFoto;";
        $parametros["url"] = $objeto->getUrl();
        $parametros["idCasa"] = $objeto->getIdCasa();
        $parametros["idFoto"] = $objeto->getIdFoto();
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
    function editPK(Foto $objetoOriginal, Foto $objetoNuevo) {
        $sql = "update $this->tabla set url = :url where idFoto= :idFotopk;";
        $parametros["url"] = $objetoNuevo->getUrl();
        $parametros["idFoto"] = $objetoNuevo->getIdFoto();
        $parametros["idCasa"] = $objetoNuevo->getIdCasa();
        $parametros["idFotopk"] = $objetoOriginal->getIdFoto();
        $r = $this->bd->setConsulta($sql, $parametros);

        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas(); //0
    }

       /**
     * Devuelve la foto buscada
     * @access public
     * @return Foto $foto
     */
    function get($idFoto) {
        $sql = "select * from $this->tabla where idFoto= :idFoto";
        $parametros["idFoto"] = $idFoto;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $foto = new Foto();
            $foto->set($this->bd->getFila());
            return $foto;
        }
        return null;
    }

       /**
     * Devuelve un array con las FOTOS
     * @access public
     * @return array $list
     */
    function getFotoIdCasa($idCasa) {
        $sql = "select * from $this->tabla where idCasa= :idCasa";
        $parametros["idCasa"] = $idCasa;
        $r = $this->bd->setConsulta($sql, $parametros);
        $arrayFotos = array();
        if ($r) 
        {
            while ($fila = $this->bd->getFila()) 
            {
                $foto = new Foto();
                $foto->set($fila);
                $arrayFotos[] = $foto;
            }            
            return $arrayFotos;
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
            return $this->bd->getFila(0);
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
                $foto = new Foto();
                $foto->set($fila);
                $list[] = $foto;
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
    function selectHtml($idFoto, $name, $condicion, $parametros, $valorSeleccionado = "", $blanco = true, $orderby = "1") {
        $select = "<select  name='$name' id='$idFoto'>";
        if ($blanco) {
            $select.= "<option value='' />&nbsp $ </option>";
        }
        $lista = $this->getList($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getIdFoto() == $valorSeleccionado) {
                $selected = "selected";
            }

            $select = "<option $selected value='" . $objeto->getIdFoto() . "' >" . $objeto->getIdCasa() . "," . $objeto->getUrl() .
                    "</option>";
        }

        $select.="</select>";
        return $select;
    }

}

?>
