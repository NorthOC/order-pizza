<?php
session_start();
$db = include("../db.php");

if(mysqli_num_rows($db->GetDriver($_SESSION['email'], $_SESSION['password'])) < 1){
    header("Location: ../isveziotojams.php");
    die();
};

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['order-id'])){
        $db->ChangeOrderStatusToCompleted($_POST['order-id']);
        $flash_msg = true;
        
    }
}

$driver_orders = $db->ListDriverOrders($_SESSION['driver-id']);


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
        <h1>Mano užsakymai</h1>
        <a href="./isveziotojams.php">laisvų užsakymų skydas</a>
    </header>

    <?php
        if(isset($flash_msg)){
            // patvirtina jeigu užsakymas pažymėtas sėkmingai

    ?>

    <p>Užsakymas sėkmingai buvo įvykdytas.</p>

    <?php 
        };
    ?>

    <table id="table" border="1">
        <thead>
            <tr>
                <th>Sąskaitos ID</th>
                <th>Adresas</th>
                <th>Telefono numeris</th>
                <th>Kaina</th>
                <th>Statusas</th>
            </tr>
        </thead>
        <tbody id="data-table-body">
        <?php
            if(mysqli_num_rows($driver_orders) > 0) {
                while($row = mysqli_fetch_assoc($driver_orders)){
            ?>
            <tr>
                <td>
                    <?php echo($row['saskaitos_id']);?>
                </td>
                <td>
                    <?php echo($row['adresas']);?>
                </td>
                <td>
                    <?php echo($row['telefonas']);?>
                </td>
                <td>
                    <?php echo($row['kaina_su_nuolaida']);?>
                </td>
                <td>
                    <form action="mano-uzsakymai.php" method="POST">
                        <input type="hidden" name="order-id" value="<?php echo($row['id']);?>">
                        <button type="submit">Pažymėti kaip atlikta</button>
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