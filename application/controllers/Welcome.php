<?php #No es necesario cerrar el php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('carrerasDAO');
	}
	public function index() {
		$data['lista_carreras'] = $this->carrerasDAO->listar_carreras();
		$this->load->view('./carreras/carreras_pagina', $data);
	}
}
