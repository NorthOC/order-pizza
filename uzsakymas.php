<?php
session_start();
if(!isset($_SESSION['loyalty_code'])){
    $_SESSION['loyalty_code'] = '';
};
$db = include("db.php");
$menu = $db->ListMenu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MB "Pamaitink"</title>
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
    input[type="text"]{
        max-width: 100px;
    }
    input[type='number']{
        max-width: 50px;
    }
    </style>
</head>
<body>

    <header>
        <h1>Sveiki atvyke į <?php echo "MB Pamaitink"; ?></h1>
    </header>
    <div id="form">
    <form  id="form" method="POST" action="patvirtinimas.php">
        <h2>Picos pasirinkimas</h2>

        <?php
            if(mysqli_num_rows($menu) > 0) {
                while($row = mysqli_fetch_assoc($menu)){
        ?>

        <label for="quantity"><?php echo($row['pavadinimas']);?></label>
        <input type="number" id="quantity" name="<?php echo($row['id']);?>" min="0" max="100" value="0"><br>

        <?php
                }
            };
        ?>
        <label for="address">Pristatymo adresas (palikite tusčią, jeigu atvažiuosite patys):</label>
        <input type="text" name="address"><br>
        <label for="phone" required>Telefono numeris:</label>
        <input type="text" name="phone" required><br>
        <label for="loyalty_code">Lojalumo kodas:</label>
        <input type="text" name="loyalty_code" maxlength="10" value='<?php echo($_SESSION['loyalty_code']);?>'><br>
        <button type="submit" value="Uzsisakyti">Uzsisakyti</button>
    </form>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>
