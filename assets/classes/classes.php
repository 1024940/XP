<?php
/**
 *   Class that handles all communication with the database
 */
class designkingDb
{
    const servername = "localhost";
    const username = "root";
    const password = "";
    const dbname = "designking";

    /**
     *    Method for fetching all the soorten pizza's
     *
     * @return   array
     **/
    public static function getAllSoortenshirt()
    {
        $sql = "SELECT `ID_soort_shirt`, `naam`, `omschrijving`, `image`, `prijs` FROM `soort_shirt`";
        return designkingDb::getFromdesignkingDb($sql);
    }

    public static function getSoortByID($ID_soort_shirt)
    {
        $sql = "SELECT `ID_soort_pizza`, `naam`, `omschrijving`, `image`, `prijs` FROM `soort_shirt` WHERE `ID_soort_shirt ` = " . $ID_soort_shirt . " ";
        return designkingDb::getFromdesignkingDb($sql);

    }
    /**
     *    Method for fetching all the type pizza's
     *
     *    @return   array
     **/
    public static function getAllTypeshirt() {
        $sql = "SELECT `ID_type_shirt`, `omschrijving` FROM `type_shirt`";
        return designkingDb::getFromdesignkingDb($sql);
    }

    public static function getTypeByID($ID_type_shirt){
        $sql = "SELECT `ID_type_shirt`, `omschrijving` FROM `type_shirt` WHERE `ID_type_shirt` = " . $ID_type_shirt . " ";
        return designkingDb::getFromdesignkingDb($sql);
    }

    /**
     *    Method for getting a customer by e-mail address
     *
     *    @param    email     email address of a customer
     *    @return   array
     **/
    public static function getKlantByEmail($email) {
        $sql = "SELECT `ID_klant`, `naam`, `email`, `adres`, `telefoonnummer` FROM `klant` WHERE email = '" . $$email . "' ";
        return designkingDb::getFromdesignkingDb($sql);
    }

    public static function getKlantByID($ID_klant) {
        $sql = "SELECT `ID_klant`, `naam`, `email`, `adres`, `telefoonnummer` FROM `klant` WHERE ID_klant = " . $ID_klant . " ";
        return designkingDb::getFromdesignkingDb($sql);
    }

    /**
     *    General method for getting information from the database
     *
     *    @param    sql     sql statement for fetching the data
     *    @return   array
     **/
    private static function getFromdesignkingDb($sql) {
        $result = array();

        try {
            $conn = self::getConnection();
            $result = $conn->query($sql);
            $conn = null;
        }
        catch (PDOexception $e) {
            echo "Error is: " . $e-> etmessage();
        }
        return $result;
    }

    public static function getConnection() {
        try {
            $conn = new PDO("mysql:host=" . designkingDb::servername . ";dbname=" . designkingDb::dbname, designkingDb::username, designkingDb::password);
            return $conn;
        }
        catch (PDOexception $e) {
            echo "Error is: " . $e->etmessage();
        }
    }

    public static function slaBestellingOp($conn, $klantID) {
        $conn->exec("insert into bestelling(ref_klant) values (" . $klantID . ")");
        return $conn->lastInsertId();
    }

    public static function slaShirtOp($conn, $aantal, $bestellingID, $soortShirtID, $typeShirtID) {
        $conn->exec("insert into shirt(aantal, ref_bestelling, ref_soort_shirt, ref_type_shirt) values (" . $aantal . "," . $bestellingID . "," . $soortShirtID . "," . $typeShirtID . ")");
        return $conn->lastInsertId();
    }

    public static function slaKlantOp($naam, $email, $adres, $telefoonnummer) {
        try {
            $conn = designkingDb::getConnection();
            $conn->beginTransaction();
            // Sla de klant op
            $conn->exec("insert into klant(naam, email, adres, telefoonnummer) values ('" . $naam . "','" . $email . "','" . $adres . "','" . $telefoonnummer . "')");
            $klantID = $conn->lastInsertId();
            $conn->commit();
            $conn = null;
            return $klantID;
        }
        catch (Exception $e) {
            $conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

}

/**
 *   Placeholder for storing all data related to a pizza
 */
class Pizza {
    public $soortID;
    public $typeID;
    public $aantal;
    public $prijs;

    /**
     *    Constructor for the pizza class
     *
     *    @param    soortID     id of the pizza kind in the datebase
     *    @param    typeID      id of the pizza size in the database
     *    @param    aantal      number of pizza of this kind that will be ordered
     *    @return   void
     **/
    public function __construct($soortID, $typeID, $aantal, $prijs){
        $this->soortID = $soortID;
        $this->typeID = $typeID;
        $this->aantal = $aantal;
        $this->prijs = $prijs;
    }

    public function berekenTotaalPrijs() {
        $result = 0;
        $even = true;
        for ($teller = 0; $teller < $this->aantal; $teller++) {
            if ($even) {
                $result = $result + $this->prijs;
            }
            else {
                $result = $result + $this->prijs/2;
            }
            $even = !$even;
        }
        return $result;
    }
}

/**
 *   Placeholder for storing all data related to a pizza order
 */
class Winkelwagen {
    public $klantID;
    public $shirts = array();

    /**
     *    Add's a pizza to the list of pizza's
     *
     *    @param    Pizza
     *    @return   void
     **/
    public function addShirt($shirt){
        array_push($this->shirts, $shirt);
    }


    /**
     *    Prints all the data of a order
     *
     *    @return   void
     **/
    public function printShirts() {
        foreach ($this->shirts as $shirt) {
            echo "soort = " . $shirt->soortID . "; type = " . $shirt->typeID . "; aantal = " . $shirt->aantal . ";<br>";
        }
        if (isset($this->klantID)) {
            echo "Dit klant is nummer:" . $this->klantID . "<br>";
        }
    }
    public function saveToDatabase() {
        try {
            $conn = designkingDb::getConnection();
            $conn->beginTransaction();
            // Sla de bestelling op
            $bestellingID = designkingDb::slaBestellingOp($conn, $this->klantID);
            // Sla alle pizzas op
            foreach ($this->shirts as $shirt) {
                designkingDb::slaShirtOp($conn, $shirt->aantal, $bestellingID, $shirt->soortID, $shirt->typeID);
            }
            $conn->commit();
            $conn = null;
        }
        catch (Exception $e) {
            $conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }


}
?>