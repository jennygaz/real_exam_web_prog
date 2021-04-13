<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <title>Examen Luis Enrique</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <a class="navbar-brand" href="#>"><img src="https://freepikpsd.com/wp-content/uploads/2019/10/home-icons-for-website-png-1-Transparent-Images.png" width="50" height="50" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?=base_url('carreras');?>">Carreras</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="<?=site_url('universidades');?>">Universidades</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?=site_url('categorias');?>">Categorias de producto</a>
      </li>
      <li class="nav-item">
      <a class="nav-link active" href="<?=site_url('productos');?>">Productos</a>
    </li>
        <li class="nav-item">
        <a class="nav-link " href="<?=site_url('departamentos');?>">Departamentos</a>
      </li>
          <li class="nav-item">
          <a class="nav-link" href="<?=site_url('empleados');?>">Empleados</a>
        </li>
      </ul>
  </div>
  	</nav>
<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-12">
      <form action="<?=site_url('productos/registrar');?>" method="post">
        <div class="row">
          <div class="col-4 form-group">
            <label for="matricula">Codigo De Barras:</label>
            <input type="text" class="form-control" name="id_producto" value="<?=@$producto_seleccionado->codigo_barras;?>">
            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula'];?></small>
          </div>
          <div class="col-4 form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?=@$producto_seleccionado->nombre;?>">
            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula'];?></small>
          </div>
          <div class="col-4 form-group">
            <label for="precio_compra">Precio Compra:</label>
            <input type="text" class="form-control" name="precio_compra" value="<?=@$producto_seleccionado->precio_compra;?>">
          </div>
          <div class="col-4 form-group">
            <label for="precio_venta">Precio Venta:</label>
            <input type="text" class="form-control" name="precio_venta" value="<?=@$producto_seleccionado->precio_venta;?>">
          </div>
          <div class="col-4 form-group">
            <label for="descripcion">Descripcion:</label>
            <input type="text" class="form-control" name="descripcion" value="<?=@$producto_seleccionado->descripcion;?>">
          </div>
          <div class="col-4 form-group">
            <label for="categorias">Categoria:</label>
            <select class="form-control" name="categorias">
              <option value="" selected disabled>Selecciona una</option>
              <?php foreach ($categorias as $categoria){ ?>
                <option value="<?=$categoria->id;?>" <?=@$producto_seleccionado->fk_categoria  == $categoria->id ? 'selected': '';?> ><?=$categoria->nombre;?></option>
              <?php } ?>
            </select>
            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['categorias'];?></small>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" name="button">Guardar</button>
        <?php if (@$producto_seleccionado) { ?>
        <a href="<?=site_url('productos/borrar_producto?clave='.$producto_seleccionado->codigo_barras) ?>" class="btn btn-danger">Borrar</a>
        <?php } ?>
      </form>
    </div>
  </div>
<div class="row mt-5">
  <div class="col-12">
    <table class="table table-bordered table-striped" id="table_alumnos">
      <thead>
        <tr>
          <th>Codigo De Barras</th>
          <th>Nombre</th>
          <th>Precio Compra</th>
          <th>Precio Venta</th>
          <th>Descripcion</th>
          <th></th>
        </tr>
      </thead>
    <tbody>
      <?php foreach ($productos as $producto){ ?>
        <tr>
          <td><?=$producto->codigo_barras;?></td>
          <td><?=$producto->nombre;?></td>
          <td><?=$producto->precio_compra;?></td>
          <td><?=$producto->precio_venta;?></td>
          <td><?=$producto->descripcion;?></td>
          <td>
           <a href="<?=site_url('productos/ver_detalle/'.$producto->codigo_barras);?>" class="btn btn-info">Ver Detalle</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    </table>
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  </body>
  <script>
  $(function(){
    $('#productos').DataTable();
 });
  </script>
</html>
