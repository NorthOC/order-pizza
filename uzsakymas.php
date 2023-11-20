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
    </style>
</head>
<body>

    <header>
        <h1>Sveiki atvyke į <?php echo "MB Pamaitink"; ?></h1>
    </header>
    <div id="form">
    <form  id="form">
        <h2>Picos pasirinkimas</h2>

        <label>
            <input type="checkbox" name="pizza" value="suriu" checked>
            4 suriu pica
        </label>

        <label for="quantity">Kiekis:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br>
        <label>
            <input type="checkbox" name="pizza" value="havaju" checked>
            Havaju pica
        </label>
        
        <label for="quantity">Kiekis:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br>
        <a href="patvirtinimas.php">
        <button type="submit" value="Uzsisakyti">Uzsisakyti</button>
        </a>
    </form>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>
