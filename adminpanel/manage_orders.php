<?php
    include("connection.php");
    error_reporting(0);

    $order_id=$_GET['rn'];
    $delquery1 = "DELETE FROM `userdetails` WHERE order_id = '$order_id'";
    $removeuser = mysqli_query($connect, $delquery1);

    if($removeuser)
    {
        $delquery2 = "DELETE FROM `userorders` WHERE order_id = '$order_id'";
        $removeorder = mysqli_query($connect, $delquery2);
        echo "<script>
            alert('Order Confirmed!');
            window.location.href='admin_panel.php';
        </script>";
    }
    else
    {
        echo "<script>
            alert('Order Confirmation Error.');
            window.location.href='admin_panel.php';
        </script>";
    }
?>