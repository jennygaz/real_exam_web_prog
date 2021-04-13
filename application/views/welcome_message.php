<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Almacen</title>
  </head>
  <body>	
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="#">Sw17</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <!--<li class="nav-item">
		        <a class="nav-link" href="<?=base_url('welcome/calificaciones');?>">Calificaciones</a>
		      </li>-->
		    </ul>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row mt-3 justify-content-center">
			<div class="col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card"> <!--Aqui se puede cambiar el color-->
					<div class="card-header">
						<h3 class="card-tittle">
							Marcas
						</h3>
					</div>
					<form action="<?=site_url('welcome/registrar_marca'); ?>" method="post">
						<div class="card-body">
							<div class="row">
								<div class="col-12 form-group">
									<label for="nombre_marca">Nombre:</label>
									<input type="text" name="nombre_marca" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<input type="submit" value="Enviar" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Estatus</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($lista_marcas as $i ) { ?>
							<tr>
								<td><?= $i->nombre_marcas ?></td>
								<td><?= $i->estatus_marcas ?></td>
								<td></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>		
		</div>
	</div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


