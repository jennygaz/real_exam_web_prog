<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class CategoriasDAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function registrar_categoria($datos) {
    $this->db->insert('categorias', $datos);
  }
  function editar_categoria($datos,$id) {
    $this->db->where('id',$id);
    $this->db->update('categorias',$datos);
  }
  function borrar_categoria($id) {
    $this->db->where('id',$id);
    $this->db->delete('categorias');
  }
  function listar_categorias() {
    $query = $this->db->get('categorias');
    return $query->result();
  }
  function obtener_categoria_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('categorias');
    return $query->row();
  }
}
