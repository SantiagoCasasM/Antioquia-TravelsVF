<?php 
session_start();
include "conection.php";
if(!empty($_POST))
{
	$q1 = $con->query("insert into cart(client_email,created_at) value(\"$_POST[email]\",NOW())");
	if($q1)
	{
		$cart_id = $con->insert_id;
		foreach($_SESSION["cart"] as $c)
		{
			$q1 = $con->query("insert into cart_product(product_id,q,cart_id) value($c[product_id],$c[q],$cart_id)");
			//actualizar la existencia del producto (product_id)
			$q2 = $con->query("update product set exist = exist - $c[q] where id = $c[product_id]");
		}
		unset($_SESSION["cart"]);
	}
}
	print "<script>alert('Venta procesada exitosamente');window.location='../products.php';</script>";
?>