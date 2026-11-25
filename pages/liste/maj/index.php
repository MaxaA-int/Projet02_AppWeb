<?php

$niveau = "../../../";
$strCodeOperation = "";
$strCodeErreur = "00000";
$strMessageErreur = "";
$strEnteteH1 = "";

include($niveau . 'assets/inc/config.inc.php');

$intIdUtilisateur = isset($_GET['idUtilisateur']) ? (int)$_GET['idUtilisateur'] : 1;
$intIdListe = isset($_GET['idListe']) ? (int)$_GET['idListe'] : 0;

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

/* Requête pour les couleurs */
$strRequete = "SELECT * 
                FROM t_couleur";
$pdosResultat = $pdoConnexion->prepare($strRequete);
$pdosResultat->execute();
$arrListeCouleurs = $pdosResultat->fetchAll();
$pdosResultat->closecursor();

/**
 * @param $p_couleur
 * @return false|string
 */
function simplifierTexte($p_couleur)
{
    $resultat = mb_strtolower($p_couleur, 'UTF-8');
    $transliterator = Transliterator::create('Any-latin; Latin-ASCII');

    return $transliterator->transliterate($resultat);
}

?>
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="<?php echo $niveau ?>assets/img/favicon.svg">
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

        <a href="<?php echo $niveau ?>" class="lien-retour">Retour à l'accueil</a>

        <h1><?php echo $strEnteteH1 ?></h1>

        <form action="<?php echo $niveau ?>index.php" method="get" class="form-maj-liste">

            <ul class="form__containeur flex">
                <li class="form__item">
                    <label for="nom_liste">Nom de la liste :</label>
                    <input type="text" name="nom_liste" id="nom_liste" value="">
                </li>
                <li class="form__item">
                    <label for="couleur_liste">Couleur de la liste :</label>

                    <ul class="liste__couleurs flex">
                        <?php foreach ($arrListeCouleurs as $couleur) { ?>
                            <li class="couleur__item">
                                <div class="fond-radio liste-<?php echo simplifierTexte($couleur['nom_couleur_fr']) ?>">
                                    <input type="radio"
                                           aria-label="Couleur <?php echo $couleur['nom_couleur_fr'] ?>"
                                           title="Couleur <?php echo $couleur['nom_couleur_fr'] ?>"
                                           class="liste-<?php echo simplifierTexte($couleur['nom_couleur_fr']) ?>"
                                           name="idCouleur" value="<?php echo $couleur['id_couleur'] ?>"
                                           id="couleur_<?php echo $couleur['id_couleur'] ?>">
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>

        </form>

    </div>
</main>

<footer class="footer">
    <?php include($niveau . "assets/inc/fragments/bas-de-page.php"); ?>
</footer>
</body>
