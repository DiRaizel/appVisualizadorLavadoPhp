<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visualizador extends CI_Model {

    //
    function traerIpVisualizador() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select IpVisualizador from configtv where estado = $visualizador and emp_id = $empresa");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $datosTemp = array(
                    'ipVisualizador' => $row->IpVisualizador
                );
                //
                array_push($datos, $datosTemp);
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }
    
    //
    function cargarListaVisualizadores() {
        //
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select estado from configtv where emp_id = $empresa");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, $row->estado);
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

    //
    function cargarTurno() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select IdTv, NombrePaciente, Modulo, "
                . "Servicio, Turno, Descripcion, Estado from tv where IdTv = "
                . "(select MIN(IdTv) from tv WHERE Estado = $visualizador and emp_id = $empresa)");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $tipo = '';
                //
                if ($row->NombrePaciente === '') {
                    //
                    $nombre = $row->Turno;
                    $tipo = 'TURNO';
                } else {
                    //
                    $nombre = $row->NombrePaciente;
                    $tipo = 'PACIENTE';
                }
                //
                $datosTemp = array(
                    'idtv' => $row->IdTv,
                    'nombrePaciente' => $row->NombrePaciente,
                    'modulo' => $row->Modulo,
                    'servicio' => $row->Servicio,
                    'turno' => $row->Turno,
                    'descripcion' => $row->Descripcion,
                    'estado' => $row->Estado,
                    'nombre' => $nombre,
                    'tipo' => $tipo
                );
                //
                array_push($datos, $datosTemp);
                //
                $this->db->delete('tv', array('IdTv' => $row->IdTv));
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

    //
    function cargarConfig() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select mensaje, TamanoLetra, nombreLogo, "
                . "CambioTv, VolumenVoz, IpVisualizador, id from configtv"
                . " where estado = $visualizador and emp_id = $empresa");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $datosTemp = array(
                    'mensaje' => $row->mensaje,
                    'tamanoLetra' => $row->TamanoLetra,
                    'nombrelogo' => $row->nombreLogo,
                    'cambioTv' => $row->CambioTv,
                    'volumenVoz' => $row->VolumenVoz,
                    'ipVisualizador' => $row->IpVisualizador,
                    'id' => $row->id
                );
                //
                array_push($datos, $datosTemp);
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

    //
    function cargarVideos() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select idvideo, nombrevideo, volumen from "
                . "videos where estado = $visualizador and emp_id = $empresa");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $datosTemp = array(
                    'idVideo' => $row->idvideo,
                    'nombreVideo' => $row->nombrevideo,
                    'volumen' => $row->volumen
                );
                //
                array_push($datos, $datosTemp);
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

}
