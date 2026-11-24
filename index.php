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
$arrUtilisateur = $pdosResultat->fetch(PDO::FETCH_ASSOC);
$pdosResultat->closeCursor();

/* Requete des listes de l'utilisateur */
$strRequete = "SELECT t_liste.*, t_couleur.nom_couleur_fr, COUNT(t_item.id_item) AS nb_items
                FROM t_liste
                INNER JOIN t_couleur ON t_liste.id_couleur = t_couleur.id_couleur
                LEFT JOIN t_item ON t_liste.id_liste = t_item.id_liste
                WHERE id_utilisateur = :id_utilisateur
                GROUP BY t_liste.id_liste, t_couleur.nom_couleur_fr";

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
    <link rel="icon" type="image/x-icon" href="<?php echo $niveau ?>assets/img/favicon.svg">
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

<main class="main" id="main">
    <div class="main__containeur">

        <h1>Bienvenue <?php echo $arrUtilisateur['prenom'] ?> !</h1>

        <div class="liste__haut flex">
            <h2>Vos liste :</h2>
            <form action="pages/liste/maj/index.php" method="get">
                <button class="btn-principal" type="submit" name="btn_ajouter" value="ajouter">Créer une nouvelle
                    liste
                </button>
            </form>
        </div>

        <div class="liste__containeur">

            <ul class="flex">

                <?php
                foreach ($arrListes as $liste) { ?>

                    <li class="liste__item">
                        <p class="gros-texte item__titre"><?php echo $liste['nom_liste'] ?></p>
                        <div class="item__contenu flex">
                            <p><?php echo $liste['nb_items']?> items</p>
                            <div class="item__controle flex">
                                <input type="button">
                                <input type="button">
                            </div>
                        </div>
                    </li>

                <?php } ?>

            </ul>

        </div>
    </div>
</main>

<footer class="footer">
<?php include($niveau . "assets/inc/fragments/bas-de-page.php") ?>
</footer>
</body>
