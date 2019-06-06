<?php
/*
* Agrega el producto a la variable de sesion de productos.
*/
session_start();
include "conection.php";
if(!empty($_POST))
{
	if(isset($_POST["product_id"]) && isset($_POST["q"]))
	{
		//validar que la cantidad (q) no supere a la existencia del product_id 
			$found = false;
			$products = $con->query("select * from product where id=$_POST[product_id] and exist >= $_POST[q]");
			if (mysqli_num_rows($products)>0)
			{
				// si es el primer producto simplemente lo agregamos
				if(empty($_SESSION["cart"])){
					$_SESSION["cart"]=array( array("product_id"=>$_POST["product_id"],"q"=> $_POST["q"]));
				}else{
					// a partir del segundo producto:
					$cart = $_SESSION["cart"];
					$repeated = false;
					// recorremos el carrito en busqueda de producto repetido
					foreach ($cart as $c) 
					{
						// si el producto esta repetido rompemos el ciclo
						if($c["product_id"]==$_POST["product_id"])
						{
							$repeated=true;
							break;
						}
					}
					// si el producto es repetido no hacemos nada, simplemente redirigimos
					if($repeated)
					{
						print "<script>alert('Error: Producto Repetido!');</script>";
					}else{
						// si el producto no esta repetido entonces lo agregamos a la variable cart y despues asignamos la variable cart a la variable de sesion
						array_push($cart, array("product_id"=>$_POST["product_id"],"q"=> $_POST["q"]));
						$_SESSION["cart"] = $cart;
					}
				}
				print "<script>window.location='../products.php';</script>";
			}
			
			//
			else
			{
				print "<script>alert('Error: La cantidad es superior a la existencia!');</script>";
				print "<script>window.location='../products.php';</script>";
			}
			//fin validación de la cantidad
	}
}

?>

