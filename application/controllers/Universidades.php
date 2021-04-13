<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Universidades extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('UniversidadesDAO');
  }
  function index(){
    $data['universidades'] = $this->UniversidadesDAO->listar_universidades();
    $this->load->view('universidades/universidades_pagina', $data);
  }
  function registrar_universidad(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('direccion', 'Direccion', 'required|min_length[3]|max_length[255]');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('telefono', 'Telefono', 'required');
    if ($this->form_validation->run()) {
      $datos = array(
        "nombre" => $this->input->post('nombre'),
        "direccion" => $this->input->post('direccion'),
        "email" => $this->input->post('email'),
        "telefono" => $this->input->post('telefono')
      );
      if ($this->input->post('clave')) {
        $existe_universidad = $this->UniversidadesDAO->obtener_universidad_id($this->input->post('clave'));
        if ($existe_universidad) {
          $id = $this->input->post('clave');
          $this->UniversidadesDAO->editar_universidad($datos, $id);
          $this->session->set_flashdata('mensaje', 'Modificacion realizada correctamente');
        } else {
          $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        }
      } else {
        $this->UniversidadesDAO->registrar_universidad($datos);
        $this->session->set_flashdata('mensaje', 'Registro realizado correctamente');
      }
      redirect('universidades');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
      if ($this->input->post('clave')) {
        $id = $this->input->post('clave');
        redirect('universidades/ver_detalle?clave=' . $id);
      } else {
        redirect('universidades');
      }
    }
  }
  function ver_detalle(){
    if ($this->input->get('clave')) {
      $existe_universidad = $this->UniversidadesDAO->obtener_universidad_id($this->input->get('clave'));
      if ($existe_universidad) {
        $data['universidades'] = $this->UniversidadesDAO->listar_universidades();
        $data['universidad_seleccionado'] = $existe_universidad;
        $this->load->view('universidades/universidades_pagina', $data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('universidades');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('universidades');
    }
  }
  function borrar_universidad(){
    if ($this->input->get('clave')) {
      $existe_universidad = $this->UniversidadesDAO->obtener_universidad_id($this->input->get('clave'));
      if ($existe_universidad) {
        $id = $this->input->get('clave');
        $this->UniversidadesDAO->borrar_universidad($id);
        $this->session->set_flashdata('mensaje', 'Elemento borrado exitosamente');
        redirect('universidades');
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('universidades');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('universidadesv');
    }
  }
}
