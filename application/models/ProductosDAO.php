<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProductosDAO extends CI_Model {
  function __construct(){
    parent::__construct();
  }
  function listar_productos(){
    $sql = "select p.*,c.nombre from productos as p,categorias as c WHERE c.id =  p.fk_categoria";
    $query = $this->db->query($sql);
    return $query->result();
  }
  function obtener_producto_id($id){
    $this->db->where('codigo_barras',$id);
    $query = $this->db->get('productos');
    return $query->row();
  }
  function resgistrar_producto($datos){
    $this->db->insert('productos', $datos);
  }
  function borrar_producto($id) {
    $this->db->where('codigo_barras',$id);
    $this->db->delete('productos');
  }
  function editar_producto($datos,$id) {
    $this->db->where('codigo_barras',$id);
    $this->db->update('productos',$datos);
  }
 }
