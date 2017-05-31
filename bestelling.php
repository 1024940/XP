<?php include 'onderdelen/classes.php';?>
<?php include 'onderdelen/session.php';?>
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
<?php include 'onderdelen/header.php';?>
<div id="sidebar" class="breed">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <h3>Uw gegevens</h3>
    <?php
    $klanten = SopranosDb::getKlantByID($session->winkelwagen->klantID);
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
        foreach ($session->winkelwagen->pizzas as $pizza) {
            echo "<tr>";
            echo "<td>";
            $soortenpizzas = SopranosDb::getSoortByID($pizza->soortID);
            foreach ($soortenpizzas as $soortenpizza) {
                echo $soortenpizza["naam"];
            }
            echo "</td>";
            echo "<td>";
            $typepizzas = SopranosDb::getTypeByID($pizza->typeID);
            foreach ($typepizzas as $typepizza) {
                echo $typepizza["omschrijving"];
            }
            echo "</td>";
            echo "<td>";
            echo  $pizza->aantal;
            echo "</td>";
            echo "<td class='prijs'>";
            $pizzaPrijs = $pizza->berekenTotaalPrijs();
            $totaalPrijs = $totaalPrijs + $pizzaPrijs;
            echo number_format($pizzaPrijs, 2);
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

    <h3>Uw vestiging</h3>
    <?php
    $vestigingen = SopranosDb::getVestigingByID($session->winkelwagen->vestigingID);
    foreach ($vestigingen as $vestiging) {
        echo "<label class=\"vasteBreedte\">Vestiging</label>Sopranos pizza " . $vestiging["naam"] . "<br>";
    }
    ?>
    <br>
    <input value="Bestel" class="rechts" id="submit" type="submit"/>
    </form>
</div>
<?php include 'onderdelen/footer.php';?>
