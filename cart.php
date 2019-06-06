<?php
/*
* Este archivo muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="Estilos/estilosgenerales.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Carrito</h1>
			<a href="./products.php" class="btn btn-default">Productos</a>
			<br><br>
			<?php
			/*
			* Esta es la consulta para obtener todos los productos de la base de datos.
			*/
			$products = $con->query("select * from product");
			if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
			?>
			<table class="table table-bordered bordes">
			<thead>
				<th>Cantidad</th>
				<th>Producto</th>
				<th>Precio Unitario</th>
				<th>Total</th>
				<th></th>
			</thead>
			<?php 
			/*
			* A partir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
			*/
			foreach($_SESSION["cart"] as $c):
			$products = $con->query("select * from product where id=$c[product_id]");
			$r = $products->fetch_object();
				?>
			<tr>
			<th><?php echo $c["q"];?></th>
				<td><?php echo $r->name;?></td>
				<td>$ <?php echo number_format($r->price); ?></td>
				<td>$ <?php echo number_format($c["q"]*$r->price); ?></td>
				<td style="width:260px;">
				<?php
				$found = false;
				foreach ($_SESSION["cart"] as $c) 
				{
				 if($c["product_id"]==$r->id)
				 	{ 
				 		$found=true; 
				 		break; 
				 	}
				}
				?>
					<a href="php/delfromcart.php?id=<?php echo $c["product_id"];?>" class="btn btn-danger">Eliminar</a>
				</td>
			</tr>
			<?php endforeach; ?>
			</table>

			<form class="form-horizontal" method="post" action="./php/process.php">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Email del cliente</label>
			    <div class="col-sm-5">
			      <input type="email" name="email" required class="form-control" id="inputEmail3" placeholder="Email del cliente">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Procesar Venta</button>
			    </div>
			  </div>
			</form>


			<?php else:?>
				<p class="alert alert-warning">El carrito está vacío.</p>
			<?php endif;?>
			<br><br><hr>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>