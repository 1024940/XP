
<html>
<head>
<title>Bestelling</title>
</head>
<body>
<?php
$to = "designkingsbv@gmail.com";
$subject = "Form";
$txt = "naam: " . $_POST["Naam"] . "\n".
"email: ".$_POST["Email"]. "\n"
.$_POST["Bericht"];
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
?>

<p>De mail is verzonden</p>


</body>
</html>