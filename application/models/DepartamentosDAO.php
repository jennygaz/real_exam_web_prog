<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class DepartamentosDAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function registrar_departamento($datos) {
    $this->db->insert('departamentos', $datos);
  }
  function editar_departamento($datos,$id) {
    $this->db->where('id',$id);
    $this->db->update('departamentos',$datos);
  }
  function borrar_departamento($id) {
    $this->db->where('id',$id);
    $this->db->delete('departamentos');
  }
  function listar_departamentos() {
    $query = $this->db->get('departamentos');
    return $query->result();
  }
  function obtener_departamento_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('departamentos');
    return $query->row();
  }
}
