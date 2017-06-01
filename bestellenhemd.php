<?php include 'assets/classes/classeshemd.php';?>
<?php include 'assets/classes/session.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session->winkelwagen = new Winkelwagen();
    $bestellingOke = true;
    $geenhemds = true;
    for($teller = 0; $teller < count($_POST['hemd']); $teller++) {
        $soortHemd = $_POST['hemd'][$teller]["soortHemd"];
        $typeHemd = $_POST['hemd'][$teller]["typeHemd"];
        $aantalHemds = $_POST['hemd'][$teller]["aantalHemds"];
        $prijs = $_POST['hemd'][$teller]["prijs"];
        if ($soortHemd > 0 and $typeHemd > 0 and $aantalHemds > 0) {
            $shirt = new Pizza($soortHemd, $typeHemd, $aantalHemds, $prijs);
            $session->winkelwagen->addShirt($shirt);
            $geenhemds = false;
        }
        if (($typeHemd > 0 and empty($aantalHemds)) or ($aantalHemds > 0 and empty($typeHemd))) {
            $bestellingOke = false;
        }
    }
    if ($bestellingOke == true and $geenhemds == false) {
        //$session->winkelwagen->printPizzas();
        header('Location:kiesklant.php');
    }
    else {
        if ($bestellingOke == false) {
            $foutboodschap = "Onjuiste invoer. Kies voor iedere shirt die u wilt bestellen zowel soort als aantal.";
        }
        if ($geenhemds) {
            $foutboodschap = "U moet minimaal 1 shirt kiezen.";
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Design Kings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="assets/js/responsiveslides.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Design Kings</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bestellen
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="bestellenhemd.php">T-Shirts</a></li>
                        <li><a href="bestellenshirt.php">Shirts</a></li>
                        <li><a href="bestellenpet.php">Petten</a></li>
                        <li><a href="custom.html">Custom Design</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>
    <header>
        <img class="background" src="assets/images/background.png">
    </header>
    <div id="content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php
            $nummer = 0;
            //
            // Soorten pizza
            //
            $soorthemds = designkingDb::getAllSoortenHemd();
            foreach ($soorthemds as $soorthemd) {
                echo "<div class='box1'>";
                echo "<div class='pizza'>";
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<input type='hidden' name='hemd[$nummer][soortPet]' value='" . $soorthemd["ID_soort_hemd"] . "'>";
                echo "<input type='hidden' name='hemd[$nummer][prijs]' value='" . $soorthemd["prijs"] . "'>";
                echo "<div class='col-md-6'><img class='left' src='assets/images/" . $soorthemd["image"] . "' width='690' height='400' /></div>";
                echo "<div class='col-md-6'><h2>" . $soorthemd["naam"] . " (&euro;" .  $soorthemd["prijs"] . ",-)</h2>";
                echo "<p class='pizzaOmschrijving'>" . $soorthemd["omschrijving"] . "</p>";
                //
                // type pizza
                //
                echo "<label>Soort T-shirt</label><br>";
                echo "<select name='hemd[$nummer][typeHemd]'>";
                $typeHemds = designkingDb::getAllTypeHemd();
                echo "<option value=''>Maak uw keuze</option>";
                foreach ($typeHemds as $typeHemd) {
                    echo "<option value='" . $typeHemd["ID_type_hemd"] . "'>" . $typeHemd["omschrijving"] . "</option>";
                }
                echo "</select>";
                //
                // aantal piza
                //
                echo "<br><label>Aantal T-shirts</label><br>";
                echo "<select name='hemd[$nummer][aantalHemds]'>";
                $aantalHemds = array(1, 2, 3, 4, 5, 6, 7 , 8, 9, 10);
                echo "<option value=''>Maak uw keuze</option>";
                foreach ($aantalHemds as $aantalHemd) {
                    echo "<option value='" . $aantalHemd . "'>" . $aantalHemd . "</option>";
                }
                echo "</select></div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $nummer++;
            }
            ?>
            <a class="btn btn-primary" href="nieuwklant.php" role="button">Bestel</a>

            <footer class="footer-distributed">
                <div class="footer-left">
                    <img src="assets/images/logo.png" style="margin-left: -80px; margin-top: -80px;" height="300">
                    <p class="footer-links" style="margin-top: -50px;">
                        <a href="#">Home</a>
                        ·
                        <a href="#">Bestellen</a>
                        .
                        <a href="#">Contact</a>
                    </p>
                    <p class="footer-company-name">Ontworpen door Design Kings &copy; 2017</p>
                </div>
                <div class="footer-center">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>Bleiswijkseweg 37, 2712 PB Zoetermeer</span> Zoetermeer, Nederland</p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>070 445 7200</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:support@company.com">support@designkings.com</a></p>
                    </div>
                </div>
                <div class="footer-right">
                    <p class="footer-company-about">
                        <span>Over Design Kings</span>
                        Bent u op zoek naar een bedrijf die uw nieuwe werk- of promotiekleding kan leveren én bedrukken?
                        Wij bieden u een uitgebreid assortiment voor uiteenlopende doeleinden en hebben altijd een passende oplossing.
                    </p>
                </div>
            </footer>
</body>
</html>