<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Departamentos extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('DepartamentosDAO');
  }
  function index(){
    $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
    $this->load->view('departamentos/departamentos_pagina', $data);
  }
  function registrar_departamento(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
    $this->form_validation->set_rules('clave', 'clave', 'required|min_length[3]|max_length[30]');
    if ($this->form_validation->run()) {
      $datos = array(
        "nombre" => $this->input->post('nombre'),
        "clave" => $this->input->post('clave')
      );
      if ($this->input->post('clave')) {
        $existe_departamento = $this->DepartamentosDAO->obtener_departamento_id($this->input->post('clave'));
        if ($existe_departamento) {
          $id = $this->input->post('clave');
          $this->DepartamentosDAO->editar_departamento($datos, $id);
          $this->session->set_flashdata('mensaje', 'La modificación se realizó con éxito');
        } else {
          $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        }
      } else {
        $this->DepartamentosDAO->registrar_departamento($datos);
        $this->session->set_flashdata('mensaje', 'Registro realizado correctamente');
      }
      redirect('departamentos');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
      if ($this->input->post('clave')) {
        $id = $this->input->post('clave');
        redirect('departamentos/ver_detalle?clave=' . $id);
      } else {
        redirect('departamentos');
      }
    }
  }
  function ver_detalle(){
    if ($this->input->get('clave')) {
      $existe_departamento = $this->DepartamentosDAO->obtener_departamento_id($this->input->get('clave'));
      if ($existe_departamento) {
        $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
        $data['departamento_seleccionado'] = $existe_departamento;
        $this->load->view('departamentos/departamentos_pagina', $data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('departamentos');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('departamentos');
    }
  }
  function borrar_departamento(){
    if ($this->input->get('clave')) {
      $existe_departamento = $this->DepartamentosDAO->obtener_departamento_id($this->input->get('clave'));
      if ($existe_departamento) {
        $id = $this->input->get('clave');
        $this->DepartamentosDAO->borrar_departamento($id);
        $this->session->set_flashdata('mensaje', 'Borrado Correctamente');
        redirect('departamentos');
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('departamentos');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('departamentos');
    }
  }
}
