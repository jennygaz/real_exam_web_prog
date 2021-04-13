<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
        <a class="nav-link" href="<?=base_url('carreras');?>">Carreras</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="<?=site_url('universidades');?>">Universidades</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?=site_url('categorias');?>">Categorias de producto</a>
    </li>
    <li class="nav-item">
    <a class="nav-link " href="<?=site_url('productos');?>">Productos</a>
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
		<div class="row mt-3 justify-content-center">
			<div class="col-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_universidades">
          Nueva Universidad
        </button>
			</div>
		</div>
	</div>
  <?php if($this->session->flashdata('mensaje')){ ?>
  <div class="row mt-2 justify-content-center">
    <div class="col-8">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?= $this->session->flashdata('mensaje'); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
   <?php } ?>
   <div class="container-fluid">
      <div class="row mt-2">
         <div class="col-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Email</th>
                <th>Telefono</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($universidades as $iuniversidad) {?>
              <tr>
                <td><a href="<?=site_url('universidades/ver_detalle?clave=').$iuniversidad->id; ?>" class="list-group-item list-group-item-action"><?= $iuniversidad->id; ?></a></td>
                <td><a href="<?=site_url('universidades/ver_detalle?clave=').$iuniversidad->id; ?>" class="list-group-item list-group-item-action"><?= $iuniversidad->nombre; ?></a></td>
                <td><a href="<?=site_url('universidades/ver_detalle?clave=').$iuniversidad->id; ?>" class="list-group-item list-group-item-action"><?= $iuniversidad->direccion; ?></a></td>
                <td><a href="<?=site_url('universidades/ver_detalle?clave=').$iuniversidad->id; ?>" class="list-group-item list-group-item-action"><?= $iuniversidad->email; ?></a></td>
                <td><a href="<?=site_url('universidades/ver_detalle?clave=').$iuniversidad->id; ?>" class="list-group-item list-group-item-action"><?= $iuniversidad->telefono; ?></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
   <div class="modal fade" id="modal_universidades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Universidades</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="<?=site_url('universidades/registrar_universidad'); ?>" method="post">
            <input type="hidden" name="clave" value="<?=@$universidad_seleccionado->id; ?>">
            <div class="modal-body">
               <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?=@$universidad_seleccionado->nombre; ?>">
                    <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nombre']; ?></small><br>
                    <label for="">Direccion:</label>
                    <input type="text" class="form-control" name="direccion" value="<?=@$universidad_seleccionado->direccion; ?>">
                    <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['direccion']; ?></small>
                    <label for="">Email:</label>
                    <input type="text" class="form-control" name="email" value="<?=@$universidad_seleccionado->email; ?>">
                    <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['email']; ?></small><br>
                    <label for="">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?=@$universidad_seleccionado->telefono; ?>">
                    <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['telefono']; ?></small>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
            <?php if (@$universidad_seleccionado) { ?>
            <a href="<?=site_url('universidades/borrar_universidad?clave='.$universidad_seleccionado->id) ?>" class="btn btn-danger">Borrar</a>
            <?php } ?>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
         </div>
      </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  <script>
   $(function(){
      <?php if ($this->session->flashdata('errores')) { ?>
         $('#modal_universidades').modal('show');
      <?php } ?>
      <?php if (@$universidad_seleccionado) { ?>
         $('#modal_universidades').modal('show');
      <?php } ?>
      $('#modal_universidades').on('hidden.bs.modal', function (e) {
         window.location.href = "<?=site_url('universidades'); ?>"
      })
   });
  </script>
</html>
