<?php
$err = False;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    require_once("config.php");

    if ($_POST['secret'] == SECRET_KEY){
        session_start();
        $_SESSION['secret'] = SECRET_KEY;
        header("Location: skydas/virtuve.php");
        die();
    } else {
        $err = True;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
    <header>
        <h1>Prisijungimas</h1>
    </header>

    <form id="form" method="post" action="administracijai.php">
        <?php 
        if($err === True){
            echo "<p>Neteisingas kodas. Bandykite dar kartą.</p>";
        }
        ?>
        <label for="password">SECRET:</label><br>
        <input type="password" id="password" name="secret"><br>
        <br>
        <input type="submit" value="Prisijungti">

    </form>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>