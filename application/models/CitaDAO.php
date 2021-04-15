<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CitaDAO extends CI_MODEL {
  function __construct(){
    parent::__construct();
  }
  function registrar_cita($datos){
    $this->db->insert('cita', $datos);
  }
  
  function editar_cita($datos, $id) {
    $this->db->where('id', $id);
    $this->db->update('cita', $datos);
  }

  function borrar_cita($id) {
    $this->db->where('id', $id);
    $this->db->delete('cita');
  }

  function listar_cita() {
    $query = $this->db->get('cita');
    return $query->result();
  }

  function obtener_cita_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('cita');
    return $query->row();
  }
}