<?php
    require("connection.php");
?>
<html>
    <head>
        <title>The Cradle Shop | Admin Panel Login</title>
        <link rel="stylesheet" type="text/css" href="admin_login.css">
    </head>
    <body>
        <div class="top">
            <img src="banner-main2.png">
        </div>
        <div class="mid">
            <div class="loginform">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <h2 style="padding-top: 35px; padding-bottom: 30px">The Cradle Shop Admin Panel Login</h2>
                    <h4>Admin Username: </h4>
                    <br>
                    <input type="text" name="admin_name">
                    <br>
                    <br>
                    <h4>Admin Password: </h4>
                    <br>
                    <input type="password" name="admin_password">
                    <br>
                    <button type="submit" name="login">Login</button>
                </form>
                <form action="../index.php">
                    <button style="width: 130px;">Back To Homepage</button>
                </form>
            </div>
        </div>

        <?php

            function input_filter($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(isset($_POST['login']))
            {
                #filters user input
                $admin_name = input_filter($_POST['admin_name']);
                $admin_password = input_filter($_POST['admin_password']);

                #escapes used characters
                $admin_name = mysqli_real_escape_string($connect, $admin_name);
                $admin_password = mysqli_real_escape_string($connect, $admin_password);

                #executes the query
                $query = "SELECT * FROM `admin_creds` WHERE `admin_name` = ? AND `admin_password` = ?";
                
                if($stmt = mysqli_prepare($connect, $query))
                {
                    mysqli_stmt_bind_param($stmt, "ss", $admin_name, $admin_password);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt)==1)
                    {
                        session_start();
                        $_SESSION['adminlogin_id'] = $admin_name; #captures the username for the session
                        header("location: admin_panel.php");
                    }
                    else
                    {
                        echo"<script>alert('Invalid Admin Username or Password.')</script>";
                    }
                    
                    mysqli_stmt_close($stmt);
                }

                else{
                    echo"<script>alert('Invalid Admin Username or Password.')</script>";
                }

            }
        ?>
    </body>
</html>
