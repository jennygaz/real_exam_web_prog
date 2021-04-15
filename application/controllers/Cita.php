<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Cita extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('CitaDAO');
    $this->load->model('DAO');
  }

  function index(){
    $data['persona'] = $this->DAO->listar_personas();
    $data['paciente'] = $this->DAO->listar_pacientes();
    $data['medico'] = $this->DAO->listar_medicos();
    $data['especialidad_medica'] = $this->DAO->listar_especialidades_medica();
    $this->load->view('cita/cita_pagina',$data);
  }

  function registrar() {
    $this->DAO->iniciar_transaccion();
    $this->form_validation->set_rules('hora_inicio', 'Hora Inicio', 'required');
    $this->form_validation->set_rules('hora_fin', 'Hora Fin', 'required');
    $this->form_validation->set_rules('fecha_cita', 'Fecha Cita', 'required');
    $this->form_validation->set_rules('id_paciente', 'ID Paciente', 'required');
    $this->form_validation->set_rules('id_medico', 'ID Medico', 'required');

    $datos_cita = array(
      "hora_inicio" => $this->input->post('hora_inicio'),
      "hora_fin" => $this->input->post('hora_fin'),
      "fecha_cita" => $this->input->post('fecha_cita'),
      "id_paciente" => $this->input->post('id_paciente'),
      "id_medico" => $this->input->post('id_medico')
    );

    $this->DAO->insert_tabla('cita',$datos_cita);
    if ($this->DAO->validar_transaccion()) {
      redirect('cita');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
    }
  }
  function ver_detalle($clave = null) {
    if ($clave) {
      $persona_existe = $this->DAO->obtener_persona_id($clave);
      if ($persona_existe) {
        $data['persona_seleccionada'] = $persona_existe;
        $data['persona'] = $this->DAO->listar_personas();
        $data['cita'] = $this->CitaDAO->listar_citas();
        $this->load->view('cita/cita_pagina',$data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('cita');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('cita');
    }
  }
}
