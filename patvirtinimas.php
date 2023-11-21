<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"Užsakymo patvirtinimas"</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table{
            border-collapse: collapse;
        }
        th,td,table{
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <header>
        <h1>Sveiki atvyke į <?php echo "MB Pamaitink"; ?></h1>
    </header>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $bought_items = array();
        $db = include("db.php");
        $menu = $db->ListMenu();
        $client_discount = 0;

        if(isset($_POST["loyalty_code"])){
            $loyalty_code = $_POST["loyalty_code"];
            $client_discount = $db->GetLoyalClientDiscount($loyalty_code);
        };

        $_SESSION['delivery_type'] = "pristatymas";
        if($_POST['address'] === ""){
            $_SESSION['delivery_type'] = "atsiemimas";
            $_POST['address'] = "Atsiėmimas vietoje (Šustausko g. 14)";
        }

        $menu_item_count = mysqli_num_rows($menu);
        $price = 0.00;
    ?>

    

    <table>
        <tr>
            <th>Adresas: </th>
            <td colspan="3"><?php echo($_POST["address"]); ?></td>
        </tr>
        <tr>
            <th>Telefono numeris: </th>
            <td colspan="3"><?php echo($_POST["phone"]); ?></td>
        </tr>
        <tr>
            <th>Pica</th>
            <th>Kiekis</th>
            <th>Vieneto kaina</th>
            <th>Galutinė kaina</th>
        </tr>

    <?php
        if(mysqli_num_rows($menu) > 0) {
            $idx = 1;
            while($row = mysqli_fetch_assoc($menu)){

                $item_price = $row["vieneto_kaina"];
                $item_name = $row["pavadinimas"];
                if(isset($_POST[$idx])){
                    $order_size = $_POST[$idx];
                    array_push($bought_items, $_POST[$idx]);
                }
                else{
                    array_push($bought_items, "0");
                    $idx+=1;
                    continue;
                };

                if((int)$order_size < 1){
                    $idx+=1;
                    continue;
                };

                $order_item_price = (float)$order_size * (float)$item_price;
                $price += $order_item_price;
                $idx+=1;

            ?>
        <tr>
            <td><?php echo($item_name);?></td>
            <td><?php echo($order_size);?></td>
            <td><?php echo(number_format($item_price,2));?></td>
            <td><?php echo(number_format($order_item_price,2));?></td>
        </tr>
        
    <?php
            };
        $final_price = $price - $price * ($client_discount/100);
        ?>
        <tr>
            <th colspan="3">Iš viso:</th>
            <th><?php echo(number_format($price,2));?></th>
        </tr>
        <tr>
            <th colspan="3">Lojalumo nuolaida:</th>
            <th><?php echo($client_discount."%");?></th>
        </tr>
        <tr>
            <th colspan="3">Galutinė kaina:</th>
            <th><?php echo(number_format($final_price,2));?></th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th><form action="uzsakymas_patvirtintas.php" method="POST"><button type="submit">Patvirtinti</button></form></th>
        </tr>
    <?php
        };
        //kintamieji kurie bus nusiūsti po patvirtinimo
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['loyalty_code'] = $loyalty_code;
        $_SESSION['discount'] = $discount;
        $_SESSION['price'] = $price;
        $_SESSION['final_price'] = $final_price;
        $_SESSION['bought_items'] = $bought_items;
    };
    ?>
    </table>

    
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>

</body>
</html>