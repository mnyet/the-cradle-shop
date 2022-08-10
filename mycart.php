<?php
    include ("header.php");
?>
<!DOCTYPE html>

<html>
	<head>
		<title>The Cradle Shop | Cart</title>
		<link rel="stylesheet" href="./css/mycart.css" type="text/css">
		<style type="text/css">
			button{
				background-color: #FC6A03;
				width: 100px;
				height: 25px;
				border: 0;
				border-radius: 10px;
			}
		</style>
	</head>

	<body>
		<div class="mid">
			<div class="cart_table">
				<div class="ctable">
					<table>
						<thead>
							<colgroup>
								<col style="width: 2000px;">
							</colgroup>
						</thead>

						<tbody>

							<tr style="background-color: #A5816E">
								<td><h3>Product Name</h3></td>
								<td><h3>Price</h3></td>
								<td><h3>Quantity</h3></td>
								<td><h3>Total (₱)</h3></td>
								<td><h3>&nbsp;</h3></td>
							</tr>

							<?php
								if (isset($_SESSION['cart']))
								{
									foreach($_SESSION['cart'] as $key => $value)
									{
										echo"
											<tr>
												<td>$value[name]</td>
												<td>₱$value[price]<input type = 'hidden' class = 'prodprice' value = '$value[price]'></td>
												<td>
													<form action = 'manage_cart.php' method = 'POST'>
														<input class = 'prodquantity' type = 'number' name = 'mod_quantity' onchange = 'this.form.submit();' value = '$value[quantity]' min = '1' max = '10'>
														<input type = 'hidden' name = 'name' value = '$value[name]'>
													</form>
												</td>
												<td class = 'prodtotal'></td>
												<td>
													<form action = 'manage_cart.php' method = 'POST'>
														<button name = 'remove_item'>REMOVE</button>
														<input type = 'hidden' name = 'name' value = '$value[name]'>
													</form>
												</td>
											</tr>
											";
									}
								}
							?>
						</tbody>
					</table> 

					<div class="checkout">
						<h1>Checkout (₱)</h1>
						<div class="orderform">
							<h2>Total: </h2>
							<br>
							<h3 id="grandtotal"></h3>
							<br>
							<form action="purchase.php" method="POST">
								<h4>First Name</h4>
								<input type="text" name="firstname" pattern="^[A-Za-z]+$" oninvalid="setCustomValidity('Please enter on alphabets only. ')" required>
								<br>
								<h4>Last Name</h4>
								<input type="text" name="lastname" pattern="^[A-Za-z]+$" oninvalid="setCustomValidity('Please enter on alphabets only. ')" required>
								<br>
								<h4>Address</h4>
								<input type="text" name="address" required>
								<br>
								<h4>Contact No.</h4>
								<input type="number" name="contactnumber" style="width: 70%; height: 30px; text-align: left; padding-left: 10px" required>
								<br>
								<br>
								<em">"We only accept cash on delivery only!"</em>
								<br>
								<button style="margin-top: 20px;" name="purchase">Confirm Order</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var gt=0;
			var prodprice=document.getElementsByClassName('prodprice');
			var prodquantity=document.getElementsByClassName('prodquantity');
			var prodtotal=document.getElementsByClassName('prodtotal');
			var grandtotal=document.getElementById('grandtotal')

			function subTotal()

			{
				gt=0;
				for(i=0;i<prodprice.length;i++)
				{
					prodtotal[i].innerText=(prodprice[i].value)*(prodquantity[i].value);
					gt = gt + (prodprice[i].value)*(prodquantity[i].value);
				}
				grandtotal.innerText=gt;
			}
			subTotal();
		</script>
	</body>
</html>
<?php include ("footer.php"); ?>