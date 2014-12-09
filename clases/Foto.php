<?php

/**
 * ClassFoto
 *
 * @version 1.01
 * @author Antonio Javier Pérez Medina
 * @license http://...
 * @copyright izvbycv
 * Esta clase contien los atributos y metodos de las Fotos
 */
class Foto {

    private $idCasa;
    private $idFoto;
    private $url;

    function __construct($idFoto = null, $idCasa = null, $url = "") {
        $this->idCasa = $idCasa;
        $this->idFoto = $idFoto;
        $this->url = $url;
    }

    /**
     * Asigna los datos de las fotos
     * @access public
     * @param array $datos int $inicio 
     */
    function set($datos, $inicio = 0) {
        $this->idCasa = $datos[0 + $inicio];
        $this->idFoto = $datos[1 + $inicio];
        $this->url = $datos[2 + $inicio];
    }

    /**
     * Devuelve la id de la casa
     * @access public
     * @return int idCasa
     */
    function getIdCasa() {
        return $this->idCasa;
    }

    /**
     * Devuelve la id de la foto
     * @access public
     * @return int idFoto
     */
    function getIdFoto() {
        return $this->idFoto;
    }

      /**
     * Devuelve la url de la foto
     * @access public
     * @return string idFoto
     */
    function getUrl() {
        return $this->url;
    }

    /**
     * Asigna la id de la casa 
     * @access public
     * @param int $idCasa 
     */
    function setIdCasa($idCasa) {
        $this->idCasa = $idCasa;
    }

    /**
     * Asigna la id de la foto 
     * @access public
     * @param int $idFoto 
     */
    function setIdFoto($idFoto) {
        $this->idFoto = $idFoto;
    }

    /**
     * Asigna la url de la foto 
     * @access public
     * @param int $url 
     */
    function setUrl($url) {
        $this->url = $url;
    }

}
