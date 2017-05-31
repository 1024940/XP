<?php include 'onderdelen/classes.php';?>
<?php include 'onderdelen/session.php';?>
<?php
// $session->winkelwagen->printPizzas();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "ben terug op de server" . $_POST['vestigingen'] . ".";
    if ($_POST['vestigingen'] > 0) {
        $session->winkelwagen->vestigingID = $_POST['vestigingen'];
        header('Location: bestelling.php');
    }
    else {
        $foutboodschap = "Ingave onjuist. Kies uw vestiging.";
    }

}
?>
<?php include 'onderdelen/header.php';?>
<div id="sidebar" class="breed centreren">
    <h1>Kies</h1>
    <p>Kies de dichtstbijzijnde vestiging.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <select name="vestigingen">
            <?php
            $vestigingen = SopranosDb::getAllVestigingen();
            echo "<option value=''>Maak uw keuze</option>";
            foreach ($vestigingen as $vestiging) {
                echo "<option value='" . $vestiging["ID_vestiging"] . "'>" . $vestiging["naam"] . "</option>";
            }
            ?>
        </select>
        <br>
        <input value="Volgende" id="submit" type="submit"/>
    </form>
</div>
<?php include 'onderdelen/footer.php';?>
