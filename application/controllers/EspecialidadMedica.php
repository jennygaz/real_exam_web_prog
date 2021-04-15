<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Especialidad_Medica extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('DAO');
  }
  function index(){
    $data['persona'] = $this->DAO->listar_personas();
    $data['especialidad_medica'] = $this->DAO->listar_especialidad_medica();
    $this->load->view('especialidad_medica/especialidad_medica_pagina',$data);
  }
  function registrar() {
    $this->DAO->iniciar_transaccion();
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('descripcion', 'Descripcion', 'required|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('clave', 'Clave', 'required|min_length[3]|max_length[8]');

    $datos_especialidad_medica = array(
      "no_especialidad_medica" => $this->input->post('especialidad_medica'),
      "clave" => $this->input->post('clave'),
      "nombre" => $this->input->post('nombre'),
      "descripcion" => $this->input->post('descripcion')
    );

    $this->DAO->insert_tabla('especialidad_medica',$datos_especialidad_medica);
    if ($this->DAO->validar_transaccion()) {
      redirect('especialidad_medica');
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
        $data['especialidad_medica'] = $this->DAO->listar_especialidad_medicas();
        $this->load->view('especialidad_medica/especialidad_medica_pagina',$data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('especialidad_medica');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('especialidad_medica');
    }
  }
}
