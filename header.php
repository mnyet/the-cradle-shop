<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/index.css" type="text/css">
        </style>
    </head>
    <body>
        <div id="top"></div>
        <div class="top">
                <div class="mainbanner">
                    <img src="img/banner-main2.png">
                </div>

                <div class="navigation">
                    <ul>
                        <?php
                            $count = 0;
                            if(isset($_SESSION['cart']))
                            {
                                $count = count($_SESSION['cart']);
                            }
                        ?>
                        <li>
                            <form action="index.php">
                                <button class="homebutton">
                                    Home
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="index.php#products">
                                <button class="productsbutton">
                                    Products
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="contact.php">
                                <button class="contactbutton">
                                    Contact
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="about.php">
                                <button class="aboutbutton">
                                    About Us
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="mycart.php">
                                <button style="background-color: #FC6A03;">
                                    Cart (<?php echo $count; ?>)
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
    </body>
</html>