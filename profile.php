<?php
        session_start();

    if(!isset($_SESSION["email"]))
        {
            header("Location: index.php");
            exit();
        }



?>

    <html>

    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>

        <div class="form">
            <p>Welcome
                <?php  // echo $_SESSION['email'] ?>!</p>
            <a href="logout.php">Logout</a>
        </div>
    </body>

    </html>
