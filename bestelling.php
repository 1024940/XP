<?php include 'assets/classes/classes.php';?>
<?php include 'assets/classes/session.php';?>
<?php
// $session->winkelwagen->printPizzas();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sla de bestelling op
    $session->winkelwagen->saveToDatabase();
    // email vestiging en klant
    $session->winkelwagen->mailToVestigingAndKlant();
    unset($session->winkelwagen);
    header('Location: Bedankt.php');
}
?>
<div id="sidebar" class="breed">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <h3>Uw gegevens</h3>
    <?php
    $klanten = designkingDb::getKlantByID($session->winkelwagen->klantID);
    foreach ($klanten as $klant) {
        echo "<label class=\"vasteBreedte\">Naam</label>" . $klant["naam"] . "<br>";
        echo "<label class=\"vasteBreedte\">Adres</label>" . $klant["adres"] . "<br>";
        echo "<label class=\"vasteBreedte\">Telefoon</label>" . $klant["telefoonnummer"] . "<br>";
    }
    ?>
    <br>

    <h3>Uw bestelling</h3>
    <table class="bestelling">
        <tr>
            <th style="width: 30%"><label>Naam</label></th>
            <th style="width: 30%"><label>Soort</label></th>
            <th style="width: 30%"><label>Aantal</label></th>
            <th class="prijs"><label>Totaal prijs</label></th>
        </tr>
        <?php
        $totaalPrijs = 0;
        foreach ($session->winkelwagen->shirts as $shirt) {
            echo "<tr>";
            echo "<td>";
            $soortenshirts = designkingDb::getSoortByID($shirt->soortID);
            foreach ($soortenshirts as $soortenshirt) {
                echo $soortenshirt["naam"];
            }
            echo "</td>";
            echo "<td>";
            $typeshirts = designkingDb::getTypeByID($shirt->typeID);
            foreach ($typeshirts as $typeshirt) {
                echo $typeshirt["omschrijving"];
            }
            echo "</td>";
            echo "<td>";
            echo  $shirt->aantal;
            echo "</td>";
            echo "<td class='prijs'>";
            $shirtPrijs = $shirt->berekenTotaalPrijs();
            $totaalPrijs = $totaalPrijs + $shirtPrijs;
            echo number_format($shirtPrijs, 2);
            echo "</td>";
            echo "</tr>";
        }
        ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="prijs totaalPrijs"><?php echo number_format($totaalPrijs, 2) ?></td>
            </tr>
    </table>
    <br>

    <br>
        <a class="btn btn-primary" href="betalen.html" role="button">Afrekenen</a>
    </form>
</div>
