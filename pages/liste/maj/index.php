<?php

$niveau = "../../../";
$strCodeOperation = "";
$strCodeErreur = "00000";
$strMessageErreur = "";
$strEnteteH1 = "";

include($niveau . 'assets/inc/config.inc.php');

$intIdUtilisateur = isset($_GET['idUtilisateur']) ? (int)$_GET['idUtilisateur'] : 1;

switch (true) {
    case isset($_GET['btn_modifier']);
        $strCodeOperation = "modifier";
        $strEnteteH1 = "Modification d'une liste";
        break;
    case isset($_GET['btn_nouveau']);
        $strCodeOperation = "nouveau";
        $strEnteteH1 = "A";
        break;
    case isset($_GET['btn_ajouter']);
        $strCodeOperation = "ajouter";
        $strEnteteH1 = "Création d'une nouvelle liste";
        break;
    case isset($_GET['btn_supprimer']);
        $strCodeOperation = "supprimer";
        $strEnteteH1 = "Suppression de la liste";
        break;
    default:
        $strCodeOperation = "afficher";
        $strEnteteH1 = "Affichage de la liste";
}

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="<?php echo $niveau?>assets/img/favicon.svg">
    <title>AppWeb - Projet 02</title>

    <?php
    include($niveau . "assets/inc/fragments/head_links.php");
    include($niveau . "assets/inc/fragments/balises_script.php");
    ?>
</head>

<body>
<header>
    <?php
    include($niveau . "assets/inc/fragments/navigation.php");
    ?>
</header>

<main class="main" id="main">
    <div class="main__containeur">

        <h1><?php echo $strEnteteH1 ?></h1>

    </div>
</main>

<footer class="footer">

</footer>
</body>
