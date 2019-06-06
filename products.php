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
	<title>Productos</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="Estilos/estilosgenerales.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="Servicios">Servicios </h1>
			<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
			<br><br>
			<?php
			/*
			* Esta es la consulta para obtener todos los productos de la tabla product.
			*/
			$products = $con->query("select * from product");
			?>
			<table class="table table-bordered bordos_uno">
			<thead>
				<th><strong>Imagen</strong></th>
				<th><strong>Servicio</strong></th>
				<th><strong>Precio</strong></th>
				<th><strong>Existencia</strong></th>
				<th><strong>Cantidad a comprar</strong></th>
			</thead>
			<?php 
			/*
			* A partir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
			*/
			while($r=$products->fetch_object()):?>
			<tr>
				<td align="center"><img src='<?php echo $r->img;?>' width='50' height='50'></td>
				<td><?php echo $r->name;?></td>
				<td>$<?php echo number_format($r->price); ?></td>
				<td align="center"><?php echo $r->exist; ?></td>
				<td style="width:260px;">
				<?php
				$found = false;

				if(isset($_SESSION["cart"]))
					{ 
						foreach ($_SESSION["cart"] as $c) 
							{ 
								if($c["product_id"]==$r->id)
									{ 
										$found=true; 
										break; 
									}
							}
					}
				?>
				<?php if($found):?>
					<a href="cart.php" class="btn btn-info">Agregado</a>
				<?php else:?>
				<form class="form-inline" method="post" action="./php/addtocart.php">
				<input type="hidden" name="product_id" value="<?php echo $r->id; ?>">
				  <div class="form-group">
				    <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
				  </div>
				  <button type="submit" class="btn btn-success">Agregar al carrito</button>
				</form>	
				<?php endif; ?>
				</td>
			</tr>
			<?php endwhile; ?>
			</table>
			<a href="./cart.php" class="btn btn-warning carrito">Ver Carrito</a>
			<br><br><hr>
		</div>
</div><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
</body>
</html>