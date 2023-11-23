<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojalumo registracija</title>
    <link rel="stylesheet" href="style.css">
    <style>
    form {
    text-align: center;
    padding: 10px;
    background-color: #73aeee;
    color: white;
    position: center;
    top: 100;
    width: 100%;
}
    </style>
</head>
<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] === "GET"){
    ?>
    <header>
        <h1>Lojalumo registracijos anketa</h1>
    </header>

    <form id="form" method="POST" action="lojalumas.php">
        <label for="fname">Vardas:</label><br>
        <input type="text" id="vardas" name="fname"><br>
        <label for="lname">Pavardė:</label><br>
        <input type="text" id="pavarde" name="lname"><br>
        <label for="number">Telefono numeris:</label><br>
        <input type="text" id="numeris" name="number"><br>
        <label for="email">elektroninis paštas:</label><br>
        <input type="text" id="gmail" name="email"><br>
        <label for="address">Adresas:</label><br>
        <input type="text" id="address" name="address"><br>
        <input type="submit" value="Registruotis">
    </form>
    <?php
    }else{
        $success = true;
        $db = include("db.php");

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['address'];

        $loyalty_code = strtoupper(substr($fname, 0, 3).substr($lname, 0, 3).substr($number, -3, 3));

        $client = $db->GetLoyalClientByEmail($email);

        if (mysqli_num_rows($client) > 0) {
            $success = false;
        }

        $res = $db->CreateLoyalClient($loyalty_code, $fname, $lname, $number, $email, $address);
    ?>

    <?php
    if($res === false || $success === false){
        //jeigu fail
    ?>

    <header>
        <h1>Nepavyko užsiregistruoti.</h1>
    </header>

    <p>Šis el. paštas (<?php echo($email); ?>) jau priklauso kitam lojalumo klientui.</p>

    <?php } else{; 
    session_start();
    $_SESSION['loyalty_code'] = $loyalty_code;
    //jeigu success
    ?>
    <header>
        <h1>Registracija sėkminga!</h1>
    </header>

    <p>Ačiū, kad prisijungėte prie mūsų! Jūsų lojalumo kodas yra <b><?php echo($loyalty_code); ?></b></p>
    <p>Lojalumo kodas suteikia galimybę užsisakyti picas su nuolaida. <a href="uzsakymas.php">Užsisakykite dabar!</a>
    </p>

    <?php }; ?>


    <?php }; ?>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>