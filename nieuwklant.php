<?php include 'onderdelen/classes.php';?>
<?php include 'onderdelen/session.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strlen($_POST['naam']) > 0 and strlen($_POST['email']) > 0 and strlen($_POST['adres']) > 0 and strlen($_POST['telefoonnummer']) > 0) {
        $klantID = SopranosDb::slaKlantOp($_POST['naam'], $_POST['email'], $_POST['adres'], $_POST['telefoonnummer']);
        $session->winkelwagen->klantID = $klantID;
        header('Location: kiesvestiging.php');
    }
    else {
        $foutboodschap = "Vul alle velden in";
    }
}
?>
<?php include 'onderdelen/header.php';?>
<div id="sidebar" class="breed centreren">
    <h1>Nieuwe klant</h1>
    <br>
    <h3>Uw gegevens</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Naam</label><br>
            <input type="text" name="naam"><br>
        <label>E-mail</label><br>
        <input type="text" name="email"><br>
        <label>Adres</label><br>
        <input type="text" name="adres"><br>
        <label>Telefoonnummer</label><br>
        <input type="text" name="telefoonnummer"><br>
        <br>
        <input value="Registreer" id="submit" type="submit"/>
    </form>
</div>
<?php include 'onderdelen/footer.php';?>
