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
    function cargarPersonas() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        $query = $this->db->query("select per_id, per_nombre, per_estado from "
                . "personas_temp WHERE vis_id = $visualizador and emp_id = $empresa");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'idPer' => $row->per_id,
                    'nombre' => $row->per_nombre,
                    'estado' => $row->per_estado
                ));
            }
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

    //
    function consultarPersona() {
        //
        $idPer = $this->input->post("idPer");
        //
        $query = $this->db->query("select per_id, per_nombre, per_estado from "
                . "personas_temp WHERE per_id = $idPer");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'idPer' => $row->per_id,
                    'nombre' => $row->per_nombre,
                    'estado' => $row->per_estado
                ));
                //
                if ($row->per_estado === '1') {
                    //
                    $this->db->delete('personas_temp', array('per_id' => $row->per_id));
                }
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
                . "CambioTv, VolumenVoz, IpVisualizador, id, imagen from "
                . "configtv where estado = $visualizador and emp_id = $empresa");
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
                    'id' => $row->id,
                    'imagen' => $row->imagen
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

    //
    function cargarMensajes() {
        //
        $visualizador = $this->input->post("visualizador");
        $empresa = $this->input->post("empresa");
        //
        date_default_timezone_set('America/Bogota');
        $hora = date('G:i');
        $hora2s = strtotime('+1 minute', strtotime($hora));
        $hora2 = date('G:i', $hora2s);
        //
        $query = $this->db->query("select men_mensaje from mensajes_temp where "
                . "vis_id = $visualizador and emp_id = $empresa and men_hora "
                . "BETWEEN '$hora' AND '$hora2'");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'mensaje' => $row->men_mensaje
                ));
            }
            //
            $query = $this->db->query("delete from mensajes_temp where vis_id ="
                    . " $visualizador and emp_id = $empresa and men_hora "
                    . "BETWEEN '$hora' AND '$hora2'");
            //
            return $datos;
        } else {
            //
            return 2;
        }
    }

}
