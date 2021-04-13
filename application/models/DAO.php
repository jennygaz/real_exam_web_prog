<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class DAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function insert_tabla($nombre_entidad,$datos,$generar_id = FALSE) {
    $this->db->insert($nombre_entidad,$datos);
    if ($generar_id) {
      return $this->db->insert_id();
    }
  }
  function iniciar_transaccion() {
    $this->db->trans_begin();
  }
  function validar_transaccion() {
    if ($this->db->trans_status()) {
      $this->db->trans_commit();
      return true;
    } else {
      $this->db->trans_rollback();
      return false;
    }
  }
  function listar_personas() {
    $query = $this->db->get('personas');
    return $query->result();
  }
  function listar_empleados() {
    $query = $this->db->get('empleados');
    return $query->result();
  }
  function obtener_persona_id($id) {
    $this->db->where('id',$id);
    $query = $this->db->get('personas');
    return $query->row();
  }
  function obtener_empleado_id($id) {
    $this->db->where('id',$id);
    $query = $this->db->get('empleados');
    return $query->row();
  }
  function editar_persona_empleado($datos,$id){
    $this->db->where('id',$id);
    $this->db->update('personas',$datos);
    $this->db->where('id',$id);
    $this->db->update('empleados',$datos);
  }
}
