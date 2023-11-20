<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MB "Pamaitink"</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>

    <header>
        <h1>Sveiki atvyke į <?php echo "MB Pamaitink"; ?></h1>
    </header>

    <form  id= "form" action="uzsakymas.php" method="post">
        <h2>Picos pasirinkimas</h2>

        <label>
            <input type="checkbox" name="pizza" value="margarita" checked>
            4 suriu pica
        </label>

        <label for="quantity">Kiekis:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br>
        <label>
            <input type="checkbox" name="pizza" value="margarita" checked>
            Havaju pica
        </label>

        <label for="quantity">Kiekis:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br>

        <input type="submit" value="Uzsisakyti">
    </form>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>

</body>
</html>