<?php

/**
 * Class Casa
 *
 * @version 1.01
 * @author Antonio Javier Pérez Medina
 * @license http://...
 * @copyright izvbycv
 * Esta clase contiene los atributos y metodos de las Casas
 */
class Casa {

    private $idCasa;
    private $precio;
    private $localidad;
    private $metros;
    private $numHabitaciones;
    private $direccion;

    function __construct($idCasa = null, $precio = 0, $localidad = "", $metros = 0, $numHabitaciones = 0, $direccion = "") {
        $this->idCasa = $idCasa;
        $this->precio = $precio;
        $this->localidad = $localidad;
        $this->metros = $metros;
        $this->numHabitaciones = $numHabitaciones;
        $this->direccion = $direccion;
    }

    /**
     * Asigna los atributos de la casa
     * @access public
     * @param string $datos, int $inicio 
     */
    function set($datos, $inicio = 0) {
        $this->idCasa = $datos[0 + $inicio];
        $this->precio = $datos[1 + $inicio];
        $this->localidad = $datos[2 + $inicio];
        $this->metros = $datos[3 + $inicio];
        $this->numHabitaciones = $datos[4 + $inicio];
        $this->direccion = $datos[5 + $inicio];
    }

    /**
     * Devuelve el id
     * @access public
     * @return int idCass
     */
    function getIdCasa() {
        return $this->idCasa;
    }

    /**
     * Devuelve el precio
     * @access public
     * @return string precio
     */
    function getPrecio() {
        return $this->precio;
    }

    /**
     * Devuelve el localidad
     * @access public
     * @return string localidad
     */
    function getLocalidad() {
        return $this->localidad;
    }

    /**
     * Devuelve el metros
     * @access public
     * @return int metros
     */
    function getMetros() {
        return $this->metros;
    }

    /**
     * Devuelve el numHabitaciones
     * @access public
     * @return int numHabitaciones
     */
    function getNumHabitaciones() {
        return $this->numHabitaciones;
    }

    /**
     * Asigna el id de la casa
     * @access public
     * @param int $idCasa
     */
    function setIdCasa($idCasa) {
        $this->idCasa = $idCasa;
    }

    /**
     * Asigna el precio de la casa
     * @access public
     * @param int $precio
     */
    function setPrecio($precio) {
        $this->precio = $precio;
    }

    /**
     * Asigna la localidad de la casa
     * @access public
     * @param string $localidad
     */
    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    /**
     * Asigna los metros de la casa
     * @access public
     * @param int $metros
     */
    function setMetros($metros) {
        $this->metros = $metros;
    }

    /**
     * Asigna las habitaciones de la casa
     * @access public
     * @param int $numHabitaciones
     */
    function setNumHabitaciones($numHabitaciones) {
        $this->numHabitaciones = $numHabitaciones;
    }

    /**
     * Devuelve el direccion
     * @access public
     * @return string direccion
     */
    function getDireccion() {
        return $this->direccion;
    }

    /**
     * Asigna la direccion de la casa
     * @access public
     * @param string $direccion
     */
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

}

?>
