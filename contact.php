
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
<div class="container-fluid ">
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
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="container BGGray">
                <div class="row">
                    <form action="testmail.php" method="post">
                        <p class="col-md-12">Name: <input class="form-control" type="text" name="Naam"><br></p>
                        <p class="col-md-12">E-mail: <input class="form-control" type="text" name="Email"><br></p>
                        <p class="col-md-12">Bericht:<textarea class="form-control" name="Bericht" rows="10" cols="30"></textarea></p>
                        <input class="btn col-md-4 col-md-offset-4" type="submit">
                </div>
            </div>
    </div>
    <footer class="footer-distributed">
        <div class="footer-left">
            <img src="assets/images/logo.png" style="margin-left: -80px; margin-top: -80px;" height="300">
            <p class="footer-links" style="margin-top: -50px;">
                <a href="index.php">Home</a>
                ·
                <a href="#">Bestellen</a>
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
                Wij bieden u een uitgebreid assortiment voor uiteenlopende doeleinden en hebben altijd een passende
                oplossing.
            </p>
        </div>
    </footer>
</div>
</body>
</html>