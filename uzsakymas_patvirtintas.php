<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET"){
    header("Location: index.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $db = include("db.php");
    $most_recent_order = $db->MostRecentOrderFragment();
    $menu = $db->ListMenu();


    $sask_id = (int)(mysqli_fetch_assoc($most_recent_order)["saskaitos_id"]) + 1;

    $address = $_SESSION['address'];
    $phone = $_SESSION['phone'];
    $loyalty_code = $_SESSION['loyalty_code'];
    $discount = $_SESSION['discount'];
    $price = $_SESSION['price'];
    $final_price = $_SESSION['final_price'];
    $bought_items = $_SESSION['bought_items'];
    $delivery_type = $_SESSION['delivery_type'];

    if(mysqli_num_rows($menu) > 0) {
        $idx = 0;
        while($row = mysqli_fetch_assoc($menu)){
            if ($bought_items[$idx] > 0) {
                $db->CreateOrderFragment($sask_id, $row['id'], $bought_items[$idx]);
            };
            $idx++;
        };
    };

    $order_created = $db->CreateOrder($sask_id, $delivery_type, $address, $loyalty_code, $phone);

};
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
        <h1>Patvirtinimas</h1>
    </header>

    <?php
    if($order_created){
    ?>

    <p>Užsakymas sėkmingas! <a href="./index.php">Grįžti į pagrindinį puslapį.</a></p>

    <?php
    }
    else {
    ?>

    <p>Užsakymas nepavyko... <a href="./index.php">Grįžti į pagrindinį puslapį.</a></p>

    <?php }; ?>

    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>