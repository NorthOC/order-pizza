<?php

// GRAŽINA DUOMENŲ BAZĖS KLASĘ
// Kaip naudoti faile:
// $db = include("db.php");
// $result = $db->readMenu();

// REZULTATŲ FOR EACH LOOP:
/* 
if(mysqli_num_rows($menu) > 0) {
    while($row = mysqli_fetch_assoc($menu)){
        echo($row['pavadinimas']);
        echo("<br>");
    }
}; 
*/

require_once("config.php");

$con=mysqli_connect(DB_HOST,DB_USER, DB_PWD, DB_NAME) or die("neina prisijungti prie DB. Galimos problemos: kredencialai, vpn, internetas");

class DoSomeStuff
{
    private $con;

    // Create instance with connection
    public function __construct( $con )  {
        // Store connection in instance for later use
        $this->con = $con;
    }
    public function readMenu() {
        // Run query using stored database connection
        $result=mysqli_query($this->con, "SELECT * FROM produktas");
        return $result;
    }

}

return new DoSomeStuff($con);

?>