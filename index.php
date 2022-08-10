<?php
    include ("header.php");

    //database credentials

    $servername = "#";
    $db_username = "#";
    $db_password = "#";
    $db_name = "#";

    //connecting to database
    $connect = mysqli_connect($servername, $db_username, $db_password, $db_name);
    if(mysqli_connect_error()){
        echo"Cannot connect to the Database.";
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>The Cradle Shop | Homepage</title>
        <link rel="stylesheet" href="./css/index.css" type="text/css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>
        <div class="mid">
            <div class="midheader">
                <img src="img/logo-whitebg.png">
                <div class="shopinfo">
                    <ul>
                        <li><h1>Welcome to The Cradle Shop!</h1></li>
                        <br>
                        <li>We make sure that our products are on High Quality and Affordable at the same time!</li>
                        <li>We offer clothes with trendy character prints that your kids will surely love.</li>
                        <li>For practical moms! You always get the best value for money in our shop.</li>
                        <li>Follow us on Shopee and stay updated with our new products!</li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="categories">
                <div class="cat">
                    <img src="img/homepage/promosale.png">
                </div>
                <div class="col"></div>
                <div class="cat">
                    <a href="https://shopee.ph/shop/153924985/search?shopCollection=1">
                    <img src="img/homepage/newarrival.PNG">
                    </a>
                </div>
                <div class="col"></div>
                <div class="cat">
                    <a href="https://shopee.ph/thecradleshop" target="_blank" rel="noopener noreferrer">
                    <img src="img/homepage/why wait shop now.png">
                    </a>
                </div>
            </div>
            <br>
            <br>
            <div class="productheader" id="products">
                <h1>Products</h1>
            </div>
            <div class="top-shop">
                <div class="left-shop">
                    <div class="product-grid">
                        <?php
                            $query = "SELECT * FROM items";
                            $result = mysqli_query($connect, $query);

                            while ($row = mysqli_fetch_array($result)) {?>

                                <div method="POST" action="manage_cart.php" class="product">
                                    <form method="POST" action="manage_cart.php">
                                        <img src="img/<?= $row['image']?>">
                                        <div class="product-info">
                                            <h5 style="height: 80px;"><?= $row['name']; ?></h5>
                                            <h4>₱<?= $row['price']; ?></h4>
                                        </div>
                                        <input type="hidden" name="name" value="<?= $row['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                        <div class="cartform">
                                            <a href="http://localhost/thecradleshop2/index.php#products">
                                                <input type="submit" name="add_to_cart" value="Add To Cart">
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="customerreview">
                <img src="img/customerfeedback.PNG">
            </div>
            <br>
        </div>
    </body>
</html>

<?php include ("footer.php"); ?>