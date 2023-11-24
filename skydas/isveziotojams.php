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
        <h1>Delivery Driver Dashboard</h1>
    </header>

    <h1 id="data">Data Table</h1>

    <table id="table" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Uzsakymas</th>
                <th>Statusas</th>
            </tr>
        </thead>
        <tbody id="data-table-body">
            <!-- Data will be dynamically added here -->
        </tbody>
    </table>
    <footer>
        &copy; <?php echo date("Y"); ?> My Website. All rights reserved.
    </footer>
</body>
</html>