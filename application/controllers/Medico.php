<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Medico extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('DAO');
  }

  function index(){
    $data['persona'] = $this->DAO->listar_personas();
    $data['medico'] = $this->DAO->listar_medicos();
    $data['especialidad'] = $this->DAO->listar_medico_especialista();
    $this->load->view('medico/medico_pagina',$data);
  }
  
  function registrar() {
    $this->DAO->iniciar_transaccion();
    $this->form_validation->set_rules('nombres', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('apellidos', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('fecha_nac', 'Fecha de Nacimiento', 'required');
    $this->form_validation->set_rules('fecha_ingreso', 'Fecha de Ingreso', 'required');
    $this->form_validation->set_rules('genero', 'Genero', 'required');
    $this->form_validation->set_rules('curp', 'Curp', 'required|min_length[18]|max_length[18]');
    $this->form_validation->set_rules('cedula_profesional', 'Cedula Profesional', 'required|min_length[15]|max_length[15]');
    $this->form_validation->set_rules('salario', 'salario', 'required');
    
    $datos_persona = array(
      "nombre" => $this->input->post('nombres'),
      "apellidos" => $this->input->post('apellidos'),
      "genero" => $this->input->post('genero'),
      "fecha_nac" => $this->input->post('fecha_nac'),
      "curp" => $this->input->post('curp')
    );
    $persona_id = $this->DAO->insert_tabla('persona',$datos_persona,TRUE);

    $datos_medico = array(
      "no_medico" => $this->input->post('medico'),
      "salario" => $this->input->post('salario'),
      "fecha_ingreso" => $this->input->post('fecha_ingreso'),
      "cedula_profesional" => $this->input->post('cedula_prof'),
      "persona_id" => $persona_id
    );

    $this->DAO->insert_tabla('medico',$datos_medico);

    $datos_especialidades = array(
      "id_medico" => $this->input->post('medico'),
      "id_especialidad" => $this->input->post('especialidad')
    );

    if( isset($datos_especialidades['id_especialidad']) ){
      $this->DAO->insert_tabla('medico_especialista', $datos_especialidades);
    }

    if ($this->DAO->validar_transaccion()) {
      redirect('medico');
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
        $data['medico'] = $this->DAO->listar_medicos();
        $data['especialidad'] = $this->DAO->obtener_medico_especialidades();
        $this->load->view('medico/medico_pagina',$data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('medico');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('medico');
    }
  }
}
