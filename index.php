<?php

$niveau = "";

include($niveau . 'assets/inc/config.inc.php');

$strRequete = 'SELECT * FROM t_couleur';

$pdosResultat = $pdoConnexion->prepare($strRequete);
$pdosResultat->execute();
$arrCouleurs = $pdosResultat->fetchAll();

$pdosResultat->closeCursor();

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title>Accueil - AppWeb</title>

    <?php
    include($niveau . "assets/inc/fragments/head_links.php");
    include($niveau . "assets/inc/fragments/balises_script.php");
    ?>
</head>

<body>
<header>

</header>
<main>

</main>
<footer>

</footer>
</body>
