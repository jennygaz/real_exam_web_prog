<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Carreras extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('CarrerasDAO');
  }
  function index(){
    $data['carreras'] = $this->CarrerasDAO->listar_carreras();
    $this->load->view('carreras/carreras_pagina', $data);
  }
  function registrar_carrera(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
    $this->form_validation->set_rules('keycode', 'Keycode', 'required|min_length[3]|max_length[30]');
    if ($this->form_validation->run()) {
      $datos = array(
        "nombre" => $this->input->post('nombre'),
        "keycode" => $this->input->post('keycode')
      );
      if ($this->input->post('clave')) {
        $existe_carrera = $this->CarrerasDAO->obtener_carrera_id($this->input->post('clave'));
        if ($existe_carrera) {
          $id = $this->input->post('clave');
          $this->CarrerasDAO->editar_carrera($datos, $id);
          $this->session->set_flashdata('mensaje', 'La modificación se realizó con éxito');
        } else {
          $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        }
      } else {
        $this->CarrerasDAO->registrar_carrera($datos);
        $this->session->set_flashdata('mensaje', 'Registro realizado correctamente');
      }
      redirect('carreras');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
      if ($this->input->post('clave')) {
        $id = $this->input->post('clave');
        redirect('carreras/ver_detalle?clave=' . $id);
      } else {
        redirect('carreras');
      }
    }
  }
  function ver_detalle(){
    if ($this->input->get('clave')) {
      $existe_carrera = $this->CarrerasDAO->obtener_carrera_id($this->input->get('clave'));
      if ($existe_carrera) {
        $data['carreras'] = $this->CarrerasDAO->listar_carreras();
        $data['carrera_seleccionado'] = $existe_carrera;
        $this->load->view('carreras/carreras_pagina', $data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('carreras');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('carreras');
    }
  }
  function borrar_carrera(){
    if ($this->input->get('clave')) {
      $existe_carrera = $this->CarrerasDAO->obtener_carrera_id($this->input->get('clave'));
      if ($existe_carrera) {
        $id = $this->input->get('clave');
        $this->CarrerasDAO->borrar_carrera($id);
        $this->session->set_flashdata('mensaje', 'Elemento borrado correctamente');
        redirect('carreras');
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('carreras');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('carreras');
    }
  }
}
