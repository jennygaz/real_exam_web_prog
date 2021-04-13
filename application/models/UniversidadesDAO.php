<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class UniversidadesDAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function registrar_universidad($datos) {
    $this->db->insert('universidades', $datos);
  }
  function editar_universidad($datos,$id) {
    $this->db->where('id',$id);
    $this->db->update('universidades',$datos);
  }
  function borrar_universidad($id) {
    $this->db->where('id',$id);
    $this->db->delete('universidades');
  }
  function listar_universidades() {
    $query = $this->db->get('universidades');
    return $query->result();
  }
  function obtener_universidad_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('universidades');
    return $query->row();
  }
}
