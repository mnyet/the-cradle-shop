<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(isset($_POST['add_to_cart']))
		{
			if(isset($_SESSION['cart']))
			{
				$myitems=array_column($_SESSION['cart'], 'name');
				if(in_array($_POST['name'], $myitems))
				{
					echo"<script>
						alert ('Item Has Already Added');
						window.location.href='index.php';
					</script>";
				}
				else
				{
					/* count products */
					$count = count($_SESSION['cart']);
					$_SESSION['cart'][$count] = array(
						"name" => $_POST['name'],
						"price" => $_POST['price'],
						"quantity" => 1);

					echo"<script>
							alert ('Item Added');
							window.location.href='index.php';
						</script>";
				}

			}

			else
			{
				/* count products */
				$_SESSION['cart'][0] = array(
					"name" => $_POST['name'],
					"price" => $_POST['price'],
					"quantity" => 1);

				echo"<script>
						alert ('Item Added');
						window.location.href='index.php';
					</script>";
			}
		}

		if(isset($_POST['remove_item']))
		{
			foreach($_SESSION['cart'] as $key => $value)
			{
				if($value['name']==$_POST['name'])
				{
					unset($_SESSION['cart'][$key]);
					$_SESSION['cart'] = array_values($_SESSION['cart']);
					echo"<script>
						alert('Item has been Removed.');
						window.location.href = 'mycart.php';
					</script>";
				}
			}
		}

		if(isset($_POST['mod_quantity']))
		{
			foreach($_SESSION['cart'] as $key => $value)
			{
				if($value['name']==$_POST['name'])
				{
					$_SESSION['cart'][$key]['quantity'] = $_POST['mod_quantity'];

					echo"<script>
						window.location.href = 'mycart.php';
					</script>";
				}
			}
		}
	}
?>