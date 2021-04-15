<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class DAO extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  // Insert general
  function insert_tabla($nombre_entidad,$datos,$generar_id = FALSE) {
    $this->db->insert($nombre_entidad,$datos);
    if ($generar_id) {
      return $this->db->insert_id();
    }
  }
  /***  Transacciones ***/
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
  /*** Fin Transacciones ***/

  /*** PersonasDAO ***/
  function listar_personas() {
    $query = $this->db->get('persona');
    return $query->result();
  }

  function registrar_persona($datos){
    $this->db->insert('persona', $datos);
  }
  
  function editar_persona($datos, $id) {
    $this->db->where('id', $id);
    $this->db->update('persona', $datos);
  }
  function borrar_persona($id) {
    $this->db->where('id', $id);
    $this->db->delete('persona');
  }

  function obtener_persona_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('persona');
    return $query->row();
  }

  /*** FIN PersonasDAO ***/

  /*** MedicosDAO ***/
  function listar_medicos() {
    $query = $this->db->get('medico');
    return $query->result();
  }

  function obtener_medico_id($id) {
    $this->db->where('id',$id);
    $query = $this->db->get('medico');
    return $query->row();
  }

  function editar_persona_medico($datos,$id){
    $this->db->where('id',$id);
    $this->db->update('persona',$datos);
    $this->db->where('id',$id);
    $this->db->update('medico',$datos);
  }

  function registrar_medico($datos){
    $this->db->insert('medico', $datos);
  }
  
  function editar_medico($datos, $id) {
    $this->db->where('id', $id);
    $this->db->update('medico', $datos);
  }

  function borrar_medico($id) {
    $this->db->where('id', $id);
    $this->db->delete('medico');
  }

  function listar_medico() {
    $query = $this->db->get('medico');
    return $query->result();
  }

  /** FIN MedicosDAO ***/

  /** PacientesDAO ***/
  function listar_pacientes() {
    $query = $this->db->get('paciente');
    return $query->result();
  }

  function obtener_paciente_id($id) {
    $this->db->where('id',$id);
    $query = $this->db->get('paciente');
    return $query->row();
  }

  function editar_persona_paciente($datos,$id){
    $this->db->where('id',$id);
    $this->db->update('persona',$datos);
    $this->db->where('id',$id);
    $this->db->update('paciente',$datos);
  }

  function registrar_paciente($datos){
    $this->db->insert('paciente', $datos);
  }
  
  function editar_paciente($datos, $id) {
    $this->db->where('id', $id);
    $this->db->update('paciente', $datos);
  }

  function borrar_paciente($id) {
    $this->db->where('id', $id);
    $this->db->delete('paciente');
  }

  function listar_paciente() {
    $query = $this->db->get('paciente');
    return $query->result();
  }

  /** FIN PacientesDAO ***/

  /** MedicoEspecialistaDAO ***/
  function registrar_medico_especialista($datos){
    $medico = $datos['medico'];
    foreach( $datos['especialidad]'] as $especialidad){
      $vals = array();
      $vals[] = $medico;
      $vals[] = $especialidad;
      $this->db->insert('medico_especialista', $vals);
    }
  }
  
  function editar_medico_especialista($datos, $id) {
    $this->db->where('id_medico', $id);
    $this->db->update('medico_especialista', $datos);
  }

  function borrar_medico_especialista($id) {
    $this->db->where('id_medico', $id);
    $this->db->delete('medico_especialista');
  }

  function borrar_medico_especialidad($id_medico, $id_especialidad) {
    $this->db->where('id_especialidad', $id_especialidad);
    $this->db->where('id_medico', $id_medico);
    $this->db->delete('medico_especialista');
  }

  function listar_medico_especialista() {
    $query = $this->db->get('medico_especialista');
    return $query->result();
  }

  function obtener_medico_especialidades_id($id_medico) {
    $this->db->where('id_medico', $id_medico);
    $query = $this->db->get('medico_especialista');
    return $query->result();
  }

  function obtener_medicos_especialista_id ($id_especialidad) {
    $this->db->where('id_especialidad', $id_especialidad);
    $query = $this->db->get('medico_especialista');
    return $query->result();
  }

  /** FIN MedicoEspecialistaDAO ***/

  /** EspecialidadMedicaDAO ***/

  function registrar_especialidad_medica($datos){
    $this->db->insert('especialidad_medica', $datos);
  }
  
  function editar_especialidad_medica($datos, $id) {
    $this->db->where('id', $id);
    $this->db->update('especialidad_medica', $datos);
  }

  function borrar_especialidad_medica($id) {
    $this->db->where('id', $id);
    $this->db->delete('especialidad_medica');
  }

  function listar_especialidad_medica() {
    $query = $this->db->get('especialidad_medica');
    return $query->result();
  }

  function obtener_especialidad_medica_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('especialidad_medica');
    return $query->row();
  }

  /** FIN EspecialidadMedicaDAO ***/
}
