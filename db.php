<?php

// GRAŽINA DUOMENŲ BAZĖS KLASĘ
// Kaip naudoti faile:
/* 
$db = include("db.php");
$menu = $db->ListMenu();

if(mysqli_num_rows($menu) > 0) {
    while($row = mysqli_fetch_assoc($menu)){
        echo($row['pavadinimas']);
        echo("<br>");
    }
}; 
*/

require_once("config.php");

$con=mysqli_connect(DB_HOST,DB_USER, DB_PWD, DB_NAME) or die("neina prisijungti prie DB. Galimos problemos: kredencialai, vpn, internetas");

class Db
{
    private $con;

    public function __construct( $con )  {
        $this->con = $con;
    }
    public function ListMenu() {
        // Gražina visus objektus iš meniu lentelės kuriais prekiaujame
        $result=mysqli_query($this->con, "SELECT * FROM produktas WHERE prekiaujame=1");
        return $result;
    }
    public function ListFreeOrders(){
        //Gražina visus nebaigtus užsakymų objektus, kurie priklauso išvežiotojams
        $result=mysqli_query($this->con,"SELECT * FROM uzsakymas WHERE statusas='vykdomas' AND pristatymo_budas='vezimas'");
        return $result;
    }
    public function ChangeOrderStatusToCompleted($order_id){
        //Pakeičia užsakymo statusą, į užbaigtą
        $success = False;
        $result=mysqli_query($this->con,"UPDATE uzsakymas SET statusas='ivykdytas' WHERE id=`$order_id`");
        $success = True;
        return $success;
    }
    public function AddDriverToOrder($order_id, $driver_id){
        //Priskiria vairuotoją prie užsakymo
        $success = False;
        $result=mysqli_query($this->con,"UPDATE uzsakymas SET isveziotojo_id=`$driver_id` WHERE id=`$order_id`");
        $success = True;
        return $success;
    }

    public function ListDrivers(){
        //Gražina visus vairuotojus
        $result=mysqli_query($this->con,"SELECT * FROM uzsakymas WHERE statusas='vykdoma' AND pristatymo_budas='pristatymas'");
        return $result;
    }

    public function CreateOrderFragment($order_recognition_id, $menu_item_id, $amount_ordered){
        $success = False;
        //Sukuria pardavimą, už kiekvieną užsakytą prekei iš meniu, kurie po to sudarys užsakymą
        $result=mysqli_query($this->con,"INSERT INTO pardavimas (saskaitos_id, produkto_id, kiekis)
        VALUES (`$order_recognition_id`, `$menu_item_id`, `$amount_ordered`)");
        $success = True;
        return $success;
    }
    public function ListOrderFragments($order_recognition_id){
        //Gražina užsakymo pardavimų objektus pagal sąskaitos id
        $result=mysqli_query($this->con, "SELECT * FROM pardavimas WHERE saskaitos_id=`$order_recognition_id`");
        return $result;
    }
    public function CreateLoyalClient($form){
        //sukuria klientą su lojalumo kodu
        $success = False;
        $vardas = $form['fname'];
        $pavarde = $form['lname'];
        $tel_nr = $form['pnumber'];
        $el_pastas = $form['email'];
        $adresas = $form['address'];

        $kliento_kodas = substr($vardas,0,3) . substr($pavarde,0,3) . substr($tel_nr,-3,3);

        $result=mysqli_query($this->con,"INSERT INTO lojalumo_klientas (kliento_kodas, vardas, pavarde, numeris, el_pastas, adresas, uzsakymu_kiekis)
                                        VALUES (`$kliento_kodas`, `$vardas`, `$pavarde`, `$tel_nr`, `$el_pastas`, `$adresas`, 0)");
        $success = True;
        return $success;
    }

    public function GetLoyalClient($client_id){
        //Gražina lojalumo klientą
        $result=mysqli_query($this->con,"SELECT * FROM lojalumo_klientas WHERE kliento_kodas=`$client_id` LIMIT 1");
        return $result;
    }
    public function CreateOrder($pardavimo_sask_id, $form) {
        // Sukuria užsakymą
        $success = False;

        $lojalumo_kodas = $form['loyalty_code'];
        $pristatymo_budas = $form['delivery_type'];
        $adresas = $form['address'];

        $kaina = $this->CalculatePrice($pardavimo_sask_id);
        $nuolaidos_procentai = intval($this->GetLoyalClient($lojalumo_kodas)->fetch_assoc()['taikoma_nuolaida']);
        $kaina_su_nuolaida = $kaina * ((100 - $nuolaidos_procentai) / 100);

        $result=mysqli_query($this->con,"INSERT INTO uzsakymas (saskaitos_id, lojalumo_kodas, pristatymo_budas, mokejimo_budas, kaina_be_nuolaidos, kaina_su_nuolaida, adresas)
                                        VALUES (`$pardavimo_sask_id`, `$lojalumo_kodas`, `$pristatymo_budas`, `$kaina`, `$kaina_su_nuolaida`, `$adresas`)");
        
        $success = True;
        return $success;
    }

    private function CalculatePrice($pardavimo_sask_id){
        // paskaičiuoja užsakymo kainą iš pardavimų fragmentų
        $pardavimai = $this->ListOrderFragments($pardavimo_sask_id);
        $total_price = 0.00;
        if(mysqli_num_rows($pardavimai) > 0) {
            while($row = mysqli_fetch_assoc($pardavimai)){
                $sum += floatval($row["kaina"]);
            }
        }
        return $total_price;
    }

}

return new Db($con);

?>