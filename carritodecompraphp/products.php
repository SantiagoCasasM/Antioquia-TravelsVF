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
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Productos</h1>
			<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
			<br><br>
			<?php
			/*
			* Esta es la consulta para obtener todos los productos de la tabla product.
			*/
			$products = $con->query("select * from product");
			?>
			<table class="table table-bordered">
			<thead>
				<th>Imagen</th>
				<th>Producto</th>
				<th>Precio</th>
				<th>Existencia</th>
				<th>Cantidad a comprar</th>
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
				  <button type="submit" class="btn btn-primary">Agregar al carrito</button>
				</form>	
				<?php endif; ?>
				</td>
			</tr>
			<?php endwhile; ?>
			</table>
			<br><br><hr>
		</div>
	</div>
</div>
</body>
</html>