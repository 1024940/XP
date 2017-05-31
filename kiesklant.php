<?php include 'onderdelen/classes.php';?>
<?php include 'onderdelen/session.php';?>
<?php
// $session->winkelwagen->printPizzas();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klantGevonden = false;
    // echo "ben terug op de server" . $_POST['email'] . ".<br>";
    $klanten = designkingDb::getKlantByEmail($_POST['email']);
    foreach ($klanten as $klant) {
        // echo $klant["naam"];
        $klantGevonden = true;
        $session->winkelwagen->klantID = $klant["ID_klant"];
    }
    if ($klantGevonden) {
        header('Location: kiesvestiging.php');
    }
    else {
        $foutboodschap = "klant komt niet voor";
    }
}
?>
<div id="sidebar" class="breed centreren">
    <h1>Aanmelden</h1>
    <p>Vul het e-mailadres in van het account waarmee je je wilt aanmelden.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="email">
        <br>
        <input value="Volgende" id="submit" type="submit"/>
    </form>
    <p>Heb je geen account? Registreer je <a href="nieuwklant.php">nu.</a></p>
</div>
