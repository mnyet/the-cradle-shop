<?php
	session_start();
	//database credentials

    $servername = "#";
    $db_username = "#";
    $db_password = "#";
    $db_name = "#";

    //connecting to database

    $connect = mysqli_connect($servername, $db_username, $db_password, $db_name);

	if(mysqli_connect_error())
	{
		echo"<script>
			alert('Cannot Connect to the Database.');
			window.location.href='mycart.php';
		</script>";
		exit();
	}

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(isset($_POST['purchase']))
		{
			$query1 = "INSERT INTO `userdetails`(`firstname`, `lastname`, `address`, `contactnumber`) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[address]','$_POST[contactnumber]')";
			if(mysqli_query($connect, $query1))
			{
				$order_id = mysqli_insert_id($connect);
				$query2 = "INSERT INTO `userorders`(`order_id`, `itemname`, `price`, `quantity`) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($connect, $query2);

				if($stmt)
				{
					mysqli_stmt_bind_param($stmt, "isii", $order_id, $itemname, $price, $quantity);
					foreach($_SESSION['cart'] as $key => $value)
					{
						$itemname = $value['name'];
						$price = $value['price'];
						$quantity = $value['quantity'];
						mysqli_stmt_execute($stmt);
					}
					unset($_SESSION['cart']);

					echo"<script>
						alert('Order Placed.');
						window.location.href='mycart.php';
					</script>";
				}

				else
				{
					echo"<script>
						alert('SQL Query Prepare Error.');
						window.location.href='mycart.php';
					</script>";
				}
			}
			else
			{
				echo"<script>
					alert('Cannot Connect to the Database.');
					window.location.href='mycart.php';
				</script>";
			}
		}
	}
?>