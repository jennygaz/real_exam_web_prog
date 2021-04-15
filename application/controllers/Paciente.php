<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Paciente extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('DAO');
  }
  function index(){
    $data['persona'] = $this->DAO->listar_personas();
    $data['paciente'] = $this->DAO->listar_pacientes();
    $this->load->view('paciente/paciente_pagina',$data);
  }
  function registrar() {
    $this->DAO->iniciar_transaccion();
    $this->form_validation->set_rules('nombres', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('apellidos', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('fecha_nac', 'Fecha de Nacimiento', 'required');
    $this->form_validation->set_rules('fecha_ingreso', 'Fecha de Ingreso', 'required');
    $this->form_validation->set_rules('genero', 'Genero', 'required');
    $this->form_validation->set_rules('curp', 'Curp', 'required|min_length[18]|max_length[18]');
    $this->form_validation->set_rules('apoyo_externo', 'Apoyo Externo', 'required');
    $this->form_validation->set_rules('padecimiento_inicial', 'Padecimiento Inicial', 'required|min_length[3]');
    
    $datos_persona = array(
      "nombre" => $this->input->post('nombres'),
      "apellidos" => $this->input->post('apellidos'),
      "genero" => $this->input->post('genero'),
      "fecha_nac" => $this->input->post('fecha_nac'),
      "curp" => $this->input->post('curp')
    );
    $persona_id = $this->DAO->insert_tabla('persona',$datos_persona,TRUE);
    // string al azar, en realidad deberia generarse diferente y de forma unica
    $folio_expediente = substr(md5(rand()), 0, 7);

    $datos_paciente = array(
      "no_paciente" => $this->input->post('paciente'),
      "folio_expediente" => $folio_expediente,
      "salario" => $this->input->post('salario'),
      "fecha_ingreso" => $this->input->post('fecha_ingreso'),
      "apoyo_externo" => $this->input->post('apoyo_externo'),
      "padecimiento_inicial" => $this->input->post('padecimiento_inicial'),
      "persona_id" => $persona_id
    );

    $this->DAO->insert_tabla('paciente',$datos_paciente);
    if ($this->DAO->validar_transaccion()) {
      redirect('paciente');
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
        $data['paciente'] = $this->DAO->listar_pacientes();
        $this->load->view('paciente/paciente_pagina',$data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('paciente');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('paciente');
    }
  }
}
