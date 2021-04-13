<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class CarrerasDAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function registrar_carrera($datos) {
    $this->db->insert('carreras', $datos);
  }
  function editar_carrera($datos,$id) {
    $this->db->where('id',$id);
    $this->db->update('carreras',$datos);
  }
  function borrar_carrera($id) {
    $this->db->where('id',$id);
    $this->db->delete('carreras');
  }
  function listar_carreras() {
    $query = $this->db->get('carreras');
    return $query->result();
  }
  function obtener_carrera_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('carreras');
    return $query->row();
  }
}
