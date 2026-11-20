<?php

$niveau = "";

include($niveau . 'assets/inc/config.inc.php');

$intIdUtilisateur = isset($_GET['idUtilisateur']) ? (int)$_GET['idUtilisateur'] : 1;

/* Requete pour l'utilisateur */
$strRequete = "SELECT *
                FROM t_utilisateur
                WHERE id_utilisateur = :id_utilisateur";

$pdosResultat = $pdoConnexion->prepare($strRequete);
$pdosResultat->bindValue(':id_utilisateur', $intIdUtilisateur);
$pdosResultat->execute();
$arrUtilisateurs = $pdosResultat->fetch(PDO::FETCH_ASSOC);
$pdosResultat->closeCursor();

/* Requete des listes de l'utilisateur */
$strRequete = "SELECT t_liste.*, t_couleur.nom_couleur_fr
                FROM t_liste
                INNER JOIN t_couleur ON t_liste.id_couleur = t_couleur.id_couleur
                WHERE id_utilisateur = :id_utilisateur";

$pdosResultat = $pdoConnexion->prepare($strRequete);
$pdosResultat->bindValue(':id_utilisateur', $intIdUtilisateur);
$pdosResultat->execute();
$arrListes = $pdosResultat->fetchAll(PDO::FETCH_ASSOC);
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
    <?php
    include($niveau . "assets/inc/fragments/navigation.php");
    ?>
</header>

<main class="main">
    <div class="main__containeur">

        <h1>Bienvenue <?php echo $arrUtilisateurs['prenom']?> !</h1>

        <div class="liste__haut flex">
            <h2>Vos liste :</h2>
            <form action="pages/liste/maj/index.php" method="get">
                <button class="btn-principal" type="submit">Créer une nouvelle liste</button>
            </form>
        </div>

        
    </div>
</main>

<footer class="footer">

</footer>
</body>
