<?php
$err = False;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $db = include("db.php");
    $driver = $db->GetDriver($_POST['email'], $_POST['password']);
    if(mysqli_num_rows($driver) > 0) {
        $row = mysqli_fetch_assoc($driver);
        session_start();
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['driver-id'] = $row['id'];
        header("Location: skydas/isveziotojams.php");
        die();
    }else{
        $err = True;
    };

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

    <form id="form" method="post" action="isveziotojams.php">
        <?php 
        if($err === True){
            echo "<p>Neteisingas el. paštas, arba slaptažodis. Bandykite dar kartą.</p>";
        }
        ?>
        <label for="email">El. paštas:</label><br>
        <input type="text" id="vardas" name="email"><br>
        <label for="password">Slaptažodis:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Prisijungti">

    </form>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>