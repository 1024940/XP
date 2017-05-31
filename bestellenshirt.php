<?php include 'onderdelen/classes.php';?>
<?php include 'onderdelen/session.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session->winkelwagen = new Winkelwagen();
    $bestellingOke = true;
    $geenshirts = true;
    for($teller = 0; $teller < count($_POST['shirt']); $teller++) {
        $soortShirt = $_POST['shirt'][$teller]["soortShirt"];
        $typeShirt = $_POST['shirt'][$teller]["typeShirt"];
        $aantalShirts = $_POST['shirt'][$teller]["aantalShirts"];
        $prijs = $_POST['shirt'][$teller]["prijs"];
        if ($soortShirt > 0 and $typeShirt > 0 and $aantalShirts > 0) {
            $shirt = new Pizza($soortShirt, $typeShirt, $aantalShirts, $prijs);
            $session->winkelwagen->addShirt($shirt);
            $geenshirts = false;
        }
        if (($typeShirt > 0 and empty($aantalShirts)) or ($aantalShirts > 0 and empty($typeShirt))) {
            $bestellingOke = false;
        }
    }
    if ($bestellingOke == true and $geenshirts == false) {
        //$session->winkelwagen->printPizzas();
        header('Location:kiesklant.php');
    }
    else {
        if ($bestellingOke == false) {
            $foutboodschap = "Onjuiste invoer. Kies voor iedere shirt die u wilt bestellen zowel soort als aantal.";
        }
        if ($geenshirts) {
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
                        <li><a href="bestellentshirt.php">T-Shirts</a></li>
                        <li><a href="bestellenshirt.php">Shirts</a></li>
                        <li><a href="bestellenpet.php">Petten</a></li>
                    </ul>
                </li>
                <li><a href="#">Winkelwagen</a></li>
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
        $soortshirts = designkingDb::getAllSoortenShirts();
        foreach ($soortshirts as $soortshirt) {
            echo "<div class='box1'>";
            echo "<div class='pizza'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<input type='hidden' name='shirt[$nummer][soortShirt]' value='" . $soortshirt["ID_soort_shirt"] . "'>";
            echo "<input type='hidden' name='shirt[$nummer][prijs]' value='" . $soortshirt["prijs"] . "'>";
            echo "<div class='col-md-6'><img class='left' src='assets/images/" . $soortshirt["image"] . "' width='690' height='400' /></div>";
            echo "<div class='col-md-6'><h2>" . $soortshirt["naam"] . " (&euro;" .  $soortshirt["prijs"] . ",-)</h2>";
            echo "<p class='pizzaOmschrijving'>" . $soortshirt["omschrijving"] . "</p>";
            //
            // type pizza
            //
            echo "<label>Soort shirt</label><br>";
            echo "<select name='shirt[$nummer][typeShirt]'>";
            $typeShirts = designkingDb::getAllTypeShirts();
            echo "<option value=''>Maak uw keuze</option>";
            foreach ($typeShirts as $typeShirt) {
                echo "<option value='" . $typeShirt["ID_type_pizza"] . "'>" . $typeShirt["omschrijving"] . "</option>";
            }
            echo "</select>";
            //
            // aantal piza
            //
            echo "<br><label>Aantal shirts</label><br>";
            echo "<select name='shirt[$nummer][aantalShirts]'>";
            $aantalShirts = array(1, 2, 3, 4, 5, 6, 7 , 8, 9, 10);
            echo "<option value=''>Maak uw keuze</option>";
            foreach ($aantalShirts as $aantalShirt) {
                echo "<option value='" . $aantalShirt . "'>" . $aantalShirt . "</option>";
            }
            echo "</select></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $nummer++;
        }
        ?>
        <input value="Bestel" id="submit" type="submit"/>

        <footer class="footer-distributed">
            <div class="footer-left">
                <img src="assets/images/logo.png" style="margin-left: -80px; margin-top: -80px;" height="300">
                <p class="footer-links" style="margin-top: -50px;">
                    <a href="#">Home</a>
                    ·
                    <a href="#">Bestellen</a>
                    ·
                    <a href="#">Over ons</a>
                    ·
                    <a href="#">Winkelwagen</a>
                    ·
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