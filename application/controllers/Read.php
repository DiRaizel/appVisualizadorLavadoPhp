<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Read extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Visualizador');
    }

    //
    function traerIpVisualizador(){
        //
        $rsp = $this->Visualizador->traerIpVisualizador();
        //
        echo json_encode($rsp);
    }

    //
    function cargarListaVisualizadores(){
        //
        $rsp = $this->Visualizador->cargarListaVisualizadores();
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarPersonas() {
        //
        $rsp = $this->Visualizador->cargarPersonas();
        //
        echo json_encode($rsp);
    }
    
    //
    function consultarPersona() {
        //
        $rsp = $this->Visualizador->consultarPersona();
        //
        echo json_encode($rsp);
    }

    //
    function cargarConfig() {
        //
        $rsp = $this->Visualizador->cargarConfig();
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarVideos() {
        //
        $rsp = $this->Visualizador->cargarVideos();
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarMensajes() {
        //
        $rsp = $this->Visualizador->cargarMensajes();
        //
        echo json_encode($rsp);
    }

    //
    function fechaHora() {
        //
        date_default_timezone_set('America/Bogota');
        $fecha = date('d-m-Y');
        $numerodia = (int) date('w');
        $hora12 = date('g:i');
        $horat = date('A');
        //
        $dia = '';
        //
        if ($numerodia === 0) {
            //
            $dia = 'Domingo';
        } else if ($numerodia === 1) {
            //
            $dia = 'Lunes';
        } else if ($numerodia === 2) {
            //
            $dia = 'Martes';
        } else if ($numerodia === 3) {
            //
            $dia = 'Miercoles';
        } else if ($numerodia === 4) {
            //
            $dia = 'Jueves';
        } else if ($numerodia === 5) {
            //
            $dia = 'Viernes';
        } else if ($numerodia === 6) {
            //
            $dia = 'Sabado';
        }
        //
        echo json_encode(array(
            'fecha' => $dia . ' ' . $fecha,
            'hora' => $hora12 . ' ' . $horat
        ));
    }
    
}
