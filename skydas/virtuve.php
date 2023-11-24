<?php
require_once("../config.php");
session_start();
if ($_SESSION['secret'] !== SECRET_KEY){
    header("Location: ../virtuvei.php");
    die();
}

$db = include("../db.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['fragment-id'])){
        $db->CompleteOrderFragment($_POST['fragment-id']);
    }
}


$fragments = $db->ListIncompleteOrderFragments();
$menu = $db->ListMenu();
$json;
if(mysqli_num_rows($menu) > 0) {
    while($row = mysqli_fetch_assoc($menu)){
        $json[$row["id"]] = $row["pavadinimas"];
    };
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uzsakymu Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        #table {
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
        <h1>Virtuvės valdymo skydas</h1>
    </header>

    <table id="table" border="1">
        <thead>
            <tr>
                <th>Sąskaitos ID</th>
                <th>Uzsakymas</th>
                <th>Kiekis</th>
                <th>Statusas</th>
            </tr>
        </thead>
        <tbody id="data-table-body">
            <?php
            if(mysqli_num_rows($fragments) > 0) {
                while($row = mysqli_fetch_assoc($fragments)){
            ?>
            <tr>
                <td>
                    <?php echo($row['saskaitos_id']);?>
                </td>
                <td>
                    <?php echo($json[$row['produkto_id']]);?>
                </td>
                <td>
                    <?php echo($row['kiekis']);?>
                </td>
                <td>
                    <form action="virtuve.php" method="POST">
                        <input type="hidden" name="fragment-id" value="<?php echo($row['id']); ?>">
                    <button type="submit">Pažymėti kaip pagaminta</button>
                    </form>
                </td>
            </tr>
            <?php
                };
            };
            ?>
            <!-- Data will be dynamically added here -->
        </tbody>
    </table>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>