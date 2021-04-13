<?php #No es necesario cerrar el php
defined('BASEPATH') or exit('No direct script access allowed');
class Categorias extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('CategoriasDAO');
  }
  function index(){
    $data['categorias'] = $this->CategoriasDAO->listar_categorias();
    $this->load->view('categorias/categorias_pagina', $data);
  }
  function registrar_categoria(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
    $this->form_validation->set_rules('descripcion', 'Descripcion', 'required|min_length[3]|max_length[255]');
    if ($this->form_validation->run()) {
      $datos = array(
        "nombre" => $this->input->post('nombre'),
        "descripcion" => $this->input->post('descripcion')
      );
      if ($this->input->post('clave')) {
        $existe_categoria = $this->CategoriasDAO->obtener_categoria_id($this->input->post('clave'));
        if ($existe_categoria) {
          $id = $this->input->post('clave');
          $this->CategoriasDAO->editar_categoria($datos, $id);
          $this->session->set_flashdata('mensaje', 'La modificación se realizó con éxito');
        } else {
          $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        }
      } else {
        $this->CategoriasDAO->registrar_categoria($datos);
        $this->session->set_flashdata('mensaje', 'Registro realizado correctamente');
      }
      redirect('categorias');
    } else {
      $this->session->set_flashdata('errores', $this->form_validation->error_array());
      if ($this->input->post('clave')) {
        $id = $this->input->post('clave');
        redirect('categorias/ver_detalle?clave=' . $id);
      } else {
        redirect('categorias');
      }
    }
  }
  function ver_detalle(){
    if ($this->input->get('clave')) {
      $existe_categoria = $this->CategoriasDAO->obtener_categoria_id($this->input->get('clave'));
      if ($existe_categoria) {
        $data['categorias'] = $this->CategoriasDAO->listar_categorias();
        $data['categoria_seleccionado'] = $existe_categoria;
        $this->load->view('categorias/categorias_pagina', $data);
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('categorias');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('categorias');
    }
  }
  function borrar_categoria(){
    if ($this->input->get('clave')) {
      $existe_categoria = $this->CategoriasDAO->obtener_categoria_id($this->input->get('clave'));
      if ($existe_categoria) {
        $id = $this->input->get('clave');
        $this->CategoriasDAO->borrar_categoria($id);
        $this->session->set_flashdata('mensaje', 'Borrado Correctamente');
        redirect('categorias');
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('categorias');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('categorias');
    }
  }
}
