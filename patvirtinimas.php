<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"Užsakymo patvirtinimas"</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>

    <header>
        <h1>Sveiki atvyke į <?php echo "MB Pamaitink"; ?></h1>
    </header>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $db = include("db.php");
        $menu = $db->ListMenu();
        $menu_item_count = mysqli_num_rows($menu);
        $price = 0.00;
    ?>

    <table>
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
                $order_size = $_POST[$idx];
                $order_item_price = (float)$order_size * (float)$item_price;
                $price += $order_item_price;
                $idx+=1;

            ?>
        <tr>
            <td><?php ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
    <?php
            };
        };
        echo($price);
    };
    ?>
    </table>

    
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>

</body>
</html>