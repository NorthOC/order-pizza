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

    <form id="form" method="post" action="dashboard.php">
        <label for="vardas">Vardas:</label><br>
        <input type="text" id="vardas" name="vardas"><br>
        <label for="password">Slaptažodis:</label><br>
        <input type="password" id="password" name="password"><br>
        <div></div><br>
        <input type="submit" value="Prisijungti">

    </form>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>