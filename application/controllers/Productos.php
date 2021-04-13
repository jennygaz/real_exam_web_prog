<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ProductosDAO');
    $this->load->model('CategoriasDAO');
		$this->load->model('DAO');
	}
  function index(){
    $data['productos'] = $this->ProductosDAO->listar_productos();
    $data['categorias'] = $this->CategoriasDAO->listar_categorias();
    $this->load->view('productos/productos_pagina',$data);
  }
  function registrar(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[18]|max_length[18]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('precio_compra', 'Precio compra', 'required');
    $this->form_validation->set_rules('precio_venta', 'Precio venta', 'required');
    $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('categorias', 'Categorias', 'callback_validar_categoria');
		if($this->form_validation->run()){
			$datos = array(
        "id_producto"  => $this->input->post('id_producto'),
	      "nombre"  => $this->input->post('nombre'),
	      "precio_compra"  => $this->input->post('precio_compra'),
	      "precio_venta "  => $this->input->post('precio_venta'),
	      "descripcion "  => $this->input->post('descripcion'),
	      "fk_categoria"  => $this->input->post('categorias')
	    );
			$this->DAO->insert_tabla('productos',$datos);
	    $this->ProductosDAO->resgistrar_producto($datos);
			redirect('productos');
		}else{
			$this->session->set_flashdata('errores',$this->form_validation->error_array());
			redirect('productos');
		}
  }
	function ver_detalle($clave = null){
		if($clave){
			$producto_existe = $this->ProductosDAO->obtener_producto_id($clave);
			if($producto_existe){
				$data['producto_seleccionado'] = $producto_existe;
				$data['productos'] = $this->ProductosDAO->listar_productos();
		    $data['categorias'] = $this->CategoriasDAO->listar_categorias();
		    $this->load->view('productos/productos_pagina',$data);
			}else{
				$this->session->set_flashdata('mensaje','El elemento seleccionado no existe');
				redirect('productos');
			}
		}else{
			$this->session->set_flashdata('mensaje','Elemento no enviado');
			redirect('productos');
		}
	}
	function borrar_producto(){
    if ($this->input->get('clave')) {
      $existe_producto = $this->ProductosDAO->obtener_producto_id($this->input->get('clave'));
      if ($existe_producto) {
        $id = $this->input->get('clave');
        $this->ProductosDAO->borrar_producto($id);
        $this->session->set_flashdata('mensaje', 'Elemento borrado exitosamente');
        redirect('productos');
      } else {
        $this->session->set_flashdata('mensaje', 'El elemento seleccionado no existe');
        redirect('productos');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'Elemento no enviado');
      redirect('productos');
    }
  }
	function validar_categoria($value){
		if($value){
			$existe_categoria = $this->CategoriasDAO->obtener_categoria_id($value);
			if($existe_categoria){
				return TRUE;
			}else{
				$this->form_validation->set_message('validar_categoria', 'El campo {field} es requerido.');
				return FALSE;
			}
		}else{
			$this->form_validation->set_message('validar_categoria', 'El campo {field} es requerido.');
			return FALSE;
		}
	}
}
