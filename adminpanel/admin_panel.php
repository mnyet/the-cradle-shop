<?php
    require("connection.php");
    session_start();
    session_regenerate_id(true);

    if(!isset($_SESSION['adminlogin_id']))
    {
        header("location: admin_login.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<title>The Cradle Shop | Admin Panel</title>
        <link rel="stylesheet" href="admin_panel.css">
        <style type="text/css">
		button{
			background-color: #FC6A03;
			width: 70px;
			height: 35px;
			border: 0;
			border-radius: 10px;
		}
	    </style>
    </head>
    <body>
        <div class="top">
        <img src="banner-main2.png">
        </div>
        <div class="mid">
            <div class="topbanner">
                <div class="header">
                    <h1>Welcome! <?php echo $_SESSION['adminlogin_id'] ?></h1>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <button type="submit" name="logout" style="position: relative; left: 30%;">Log Out</button>
                    </form>
                </div>
            </div>
            <div class="orderlist">
                <div class="orderrow">
                    <table>
                        <col style="width: 1px;">
                        <thead>
                            <tr bgcolor = "#5F4A3F">
                                <th style="padding:20px 20px 20px 20px;" scope="col">Action</th>
                                <th style="padding:0 30px 0 30px;" scope="col">First Name</th>
                                <th style="padding:0 30px 0 30px;" scope="col">Last Name</th>
                                <th style="padding:0 30px 0 30px;" scope="col">Phone Number</th>
                                <th style="padding:0 40px 0 40px;" scope="col">Address</th>
                                <th style="padding:0 100px 0 100px;" scope="col">Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM `userdetails`";
                                $user_result = mysqli_query($connect, $query);
                                while($user_fetch=mysqli_fetch_assoc($user_result)){
                                    echo"
                                        <tr bgcolor='#5F4A3F'>
                                        <td><a href = 'manage_orders.php?rn=$user_fetch[order_id]'><button>Order Received</button></a></td>
                                        <td>$user_fetch[firstname]</td>
                                        <td>$user_fetch[lastname]</td>
                                        <td>$user_fetch[contactnumber]</td>
                                        <td>$user_fetch[address]</td>
                                        <td>
                                            <table class = 'prodlist'>
                                            <thead>
                                                <tr>
                                                    <th style='padding:20px 150px 20px 150px;' scope='col'>Item Name</th>
                                                    <th style='padding:0 40px 0 40px;' scope='col'>Price</th>
                                                    <th style='padding:0 30px 0 30px;' scope='col'>Quantity</th>
                                                </tr>
                                            </thead>
                                        </td>
                                        </tr>
                                        <tbody>
                                        ";
                                    
                                            $order_query = "SELECT * FROM `userorders` WHERE order_id = $user_fetch[order_id]";
                                            $order_result = mysqli_query($connect, $order_query);
                                            while($order_fetch=mysqli_fetch_assoc($order_result))
                                            {
                                                echo" 
                                                    <tr>
                                                        <td style='padding:20px 0px 20px 20px;'>$order_fetch[itemname]</td>
                                                        <td>$order_fetch[price]</td>
                                                        <td>$order_fetch[quantity]</td>
                                                    </tr>
                                                ";
                                            }
                                    echo"
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['logout']))
            {
                session_destroy();
                header("location: admin_login.php");
            }
        ?>
    </body>
</html>