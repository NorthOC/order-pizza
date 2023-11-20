<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojalumo registracija</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
    <header>
        <h1>Lojalumo registracijos anketa</h1>
    </header>

    <form id="form">
        <label for="vardas">Vardas:</label><br>
        <input type="text" id="vardas" name="vardas"><br>
        <label for="pavarde">Pavardė:</label><br>
        <input type="text" id="pavarde" name="pavarde"><br>
        <label for="password">Slaptažodis:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password">Pakartoti Slaptažodį:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="numeris">Telefono numeris:</label><br>
        <input type="text" id="numeris" name="numeris"><br>
        <label for="gmail">elektroninis paštas:</label><br>
        <input type="text" id="gmail" name="gmail"><br>
        <label for="adresas">Adresas:</label><br>
        <input type="text" id="adresas" name="adresas"><br>
        <label for="sutikimas">Ar sutinkate su mūsų privatumo taisyklėm?</label><br>
        <input type="radio" id="taip" name="sutikimas" value="Taip">
        <label for="sutikimas">Taip</label><br>
        <input type="radio" id="ne" name="sutikimas" value="Ne">
        <label for="sutikimas">Ne</label><br>
        <input type="submit" value="Registruotis">
    </form>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>