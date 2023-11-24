<?php
session_start();
$db = include("../db.php");

if(mysqli_num_rows($db->GetDriver($_SESSION['email'], $_SESSION['password'])) < 1){
    header("Location: ../isveziotojams.php");
    die();
};

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['order-id'])){
        $db->AddDriverToOrder($_POST['order-id'], $_SESSION['driver-id']);
        $flash_msg = True;
    }
}

//Pull up orders
//Asign to orders
$free_orders = $db->ListFreeOrders();


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
        <h1>Laisvi užsakymai</h1>
        <a href="./mano-uzsakymai.php">mano užsakymų skydas</a>
    </header>

    <?php
        if(isset($flash_msg)){
            // patvirtina jeigu užsakymas atžymėtas sėkmingai

    ?>

    <p>Užsakymas sėkmingai buvo pridėdas. Galite jį peržiūrėti <a href="mano-uzsakymai.php">čia</a>.</p>

    <?php 
        };
    ?>

    <table id="table" border="1">
        <thead>
            <tr>
                <th>Sąskaitos ID</th>
                <th>Adresas</th>
                <th>Kaina</th>
                <th>Statusas</th>
            </tr>
        </thead>
        <tbody id="data-table-body">
        <?php
            if(mysqli_num_rows($free_orders) > 0) {
                while($row = mysqli_fetch_assoc($free_orders)){
            ?>
            <tr>
                <td>
                    <?php echo($row['saskaitos_id']);?>
                </td>
                <td>
                    <?php echo($row['adresas']);?>
                </td>
                <td>
                    <?php echo($row['kaina_su_nuolaida']);?>
                </td>
                <td>
                    <form action="isveziotojams.php" method="POST">
                        <input type="hidden" name="order-id" value="<?php echo($row['id']);?>">
                        <button type="submit">Atsižymėti</button>
                    </form>
                </td>
            </tr>
            <?php
                };
            };
            ?>
        </tbody>
    </table>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>