<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
            <a class="nav-link" href="<?=base_url('carreras');?>">Carreras</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?=site_url('universidades');?>">Universidades</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="<?=site_url('categorias');?>">Categorias de Producto</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?=site_url('productos');?>">Productos</a>
      </li>
          <li class="nav-item">
          <a class="nav-link " href="<?=site_url('departamentos');?>">Departamentos</a>
        </li>
            <li class="nav-item">
            <a class="nav-link active" href="<?=site_url('empleados');?>">Empleados</a>
          </li>
        </ul>
    </div>
	</nav>
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-12">
        <form action="<?=site_url('empleados/registrar'); ?>" method="post">
          <div class="row">
            <div class="col-4 form-group">
              <label for="nombres">Nombres:</label>
              <input type="text" class="form-control" name="nombres" value="<?=@$alumno_seleccionado->nombre; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nombres']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="apellidos">Apellidos:</label>
              <input type="text" class="form-control" name="apellidos" value="<?=@$alumno_seleccionado->apellidos; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="genero">G&eacute;nero:</label>
              <?php
                $generos = array(
                  array(
                    "nombre" => "Femenino",
                    "valor" => "F"
                  ),
                  array(
                    "nombre" => "Masculino",
                    "valor" => "M"
                  )
                );
              ?>
              <select name="genero" id="" class="form-control">
                <option value="" selected disabled>Selecciona una opcion</option>
                <?php foreach ($generos as $genero) { ?>
                  <option value="<?=$genero['valor']; ?>"><?= $genero['nombre']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-4 form-group">
              <label for="nacimiento">Fecha de Nacimiento:</label>
              <input type="date" class="form-control" name="fecha_nac" value="<?=@$alumno_seleccionado->fecha_nac; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nacimiento']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">Curp:</label>
              <input type="text" class="form-control" name="curp" value="<?=@$alumno_seleccionado->curp; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">Email:</label>
              <input type="text" class="form-control" name="email" value="<?=@$alumno_seleccionado->email; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">Telefono:</label>
              <input type="text" class="form-control" name="telefono" value="<?=@$alumno_seleccionado->telefono; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">No_Empleado:</label>
              <input type="text" class="form-control" name="empleado" value="<?=@$alumno_seleccionado->telefono; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">RFC:</label>
              <input type="text" class="form-control" name="rfc" value="<?=@$alumno_seleccionado->rfc; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">Salario:</label>
              <input type="text" class="form-control" name="salario" value="<?=@$alumno_seleccionado->salario; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="matricula">Fecha de Ingreso:</label>
              <input type="date" class="form-control" name="fecha_ingreso" value="<?=@$alumno_seleccionado->fecha_ingreso; ?>">
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['matricula']; ?></small>
            </div>
            <div class="col-4 form-group">
              <label for="grupo">Departamento:</label>
              <select name="departamentos" id="" class="form-control">
                <option value="" selected disabled>Selecciona una opcion</option>
                <?php foreach ($departamentos as $departamento) { ?>
                  <option value="<?=$departamento->id; ?>" <?=@$departamento_seleccionado->fk_departamento == $departamento->id ? 'selected' : '' ; ?> ><?= $departamento->nombre; ?></option>
                <?php } ?>
              </select>
              <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['departamentos']; ?></small>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
   </div>
	</div>
	<div class="container-fluid">
    <div class="row mt-2">
      <div class="col-12">
      <table class="table table-bordered table-striped" id="tb_alumnos">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Curp</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($personas as $persona) { ?>
            <tr>
              <td><?= $persona->nombre; ?></td>
              <td><?= $persona->apellidos; ?></td>
              <td><?= $persona->curp; ?></td>
              <td>
                <a href="<?=site_url('empleados/ver_detalle/'.$persona->id); ?>" class="btn btn-info">Ver detalle</a>
              </td>
            </tr>
          <?php }?>
        </tbody>
      </table>
      </div>
   </div>
	</div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  </body>
  <script>
    $(function() {
      $('#personas').DataTable();
    });
  </script>
</html>
