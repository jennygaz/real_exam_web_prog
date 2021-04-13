<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Empleados extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('DepartamentosDAO');
    $this->load->model('DAO');
  }
  function index(){
    $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
    $data['personas'] = $this->DAO->listar_personas();
    $data['empleados'] = $this->DAO->listar_empleados();
    $this->load->view('empleados/empleados_pagina',$data);
  }
  function registrar() {
    $this->DAO->iniciar_transaccion();
    $this->form_validation->set_rules('nombres', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('apellidos', 'Nombre', 'required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('fecha_nac', 'Fecha de Nacimiento', 'required');
    $this->form_validation->set_rules('genero', 'Genero', 'required');
    $this->form_validation->set_rules('curp', 'Curp', 'required|min_length[18]|max_length[18]');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('telefono', 'Telefono', 'required');
    $datos_persona = array(
      "nombre" => $this->input->post('nombres'),
      "apellidos" => $this->input->post('apellidos'),
      "genero" => $this->input->post('genero'),
      "fecha_nac" => $this->input->post('fecha_nac'),
      "curp" => $this->input->post('curp'),
      "email" => $this->input->post('email'),
      "telefono" => $this->input->post('telefono')
    );
    $persona_id = $this->DAO->insert_tabla('personas',$datos_persona,TRUE);
    $datos_empleado = array(
      "no_empleado" => $this->input->post('empleado'),
      "rfc" => $this->input->post('rfc'),
      "salario" => $this->input->post('salario'),
      "fecha_ingreso" => $this->input->post('fecha_ingreso'),
      "fk_persona" => $persona_id,
      "fk_departamento" => $this->input->post('departamentos')
    );
    $this->DAO->insert_tabla('empleados',$datos_empleado);
    if ($this->DAO->validar_transaccion()) {
      redirect('empleados');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
    }
  }
  function ver_detalle($clave = null) {
    if ($clave) {
      $persona_existe = $this->DAO->obtener_persona_id($clave);
      if ($persona_existe) {
        $data['persona_seleccionada'] = $persona_existe;
        $data['personas'] = $this->DAO->listar_personas();
        $data['empleados'] = $this->DAO->listar_empleados();
        $this->load->view('empleados/empleados_pagina',$data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('empleados');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('empleados');
    }
  }
}
