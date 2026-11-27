<?php

$niveau = "../../../";
$strCodeOperation = "";
$strCodeErreur = "00000";
$strMessageErreur = "";
$strEnteteH1 = "";
$strTexteBoutonValider = "";

include($niveau . 'assets/inc/config.inc.php');

$intIdUtilisateur = isset($_GET['idUtilisateur']) ? (int)$_GET['idUtilisateur'] : 1;
$intIdListe = isset($_GET['idListe']) ? (int)$_GET['idListe'] : 0;

switch (true) {
    case isset($_GET['btn_modifier']);
        $strCodeOperation = "modifier";
        break;
    case isset($_GET['btn_nouveau']);
        $strCodeOperation = "nouveau";
        $strEnteteH1 = "A";
        break;
    case isset($_GET['btn_ajouter']);
        $strCodeOperation = "ajouter";
        break;
    case isset($_GET['btn_supprimer']);
        $strCodeOperation = "supprimer";
        $strEnteteH1 = "Suppression de la liste";
        break;
    default:
        $strCodeOperation = "afficher";
        $strEnteteH1 = "Affichage de la liste";
}

$arrListe = array();

/* SI NOUVELLE LISTE - BOUTON CRÉER UNE NOUVELLE LISTE */
if ($strCodeOperation === "ajouter") {
    $arrListe['id_liste'] = $intIdListe;
    $arrListe['nom_liste'] = "";
    $arrListe['id_couleur'] = 0;
    $arrListe['id_utilisateur'] = $intIdUtilisateur;
    $strEnteteH1 = "Création d'une nouvelle liste";
    $strTexteBoutonValider = "Créer la liste";
}

/* MODIFICATION D'UNE LISTE - BOUTON ÉDITER */
if ($strCodeOperation === "afficher") {
    /* Requête pour obtenir les info de la liste */
    $strRequete = "SELECT *
                FROM t_liste 
                WHERE id_liste = :idListe";

    $pdosResultat = $pdoConnexion->prepare($strRequete);
    $pdosResultat->bindValue(':idListe', $intIdListe);
    $pdosResultat->execute();
    $arrListe = $pdosResultat->fetch(PDO::FETCH_ASSOC);
    $pdosResultat->closecursor();
    $strEnteteH1 = "Modification de la liste $arrListe[nom_liste]";
    $strTexteBoutonValider = "Enregistrer les modifications";
}

/* CONDITIONS ET REQUETES POUR VALIDER ET METTRE À JOUR */
if ($strCodeOperation === "modifier" || $strCodeOperation === "ajouter" || $strCodeOperation === "supprimer") {
    $arrListe['id_liste'] = $_GET['idListe'];
    $arrListe['nom_liste'] = $_GET['nom_liste'];
    $arrListe['id_couleur'] = $_GET['idCouleur'];
    $arrListe['id_utilisateur'] = $_GET['idUtilisateur'];
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

/**
 * @param $valeurRadio
 * @param $nomRadio
 * @return string
 */
function ecrireChecked($valeurRadio, $nomRadio)
{
    $strCocher = "";
    global $arrListe;
    if ((int)$valeurRadio == $arrListe[$nomRadio]) {
        $strCocher = 'checked="checked"';
    }
    return $strCocher;
}

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

        <?php
        echo "<p>Message d'erreur : $strMessageErreur</p>";
        echo "<p>Code d'erreur : $strCodeErreur</p>";
        echo "<p>Code d'opération : $strCodeOperation</p> <br>";
        ?>

        <a href="<?php echo $niveau ?>" class="lien-retour">Retour à l'accueil</a>

        <h1><?php echo $strEnteteH1 ?></h1>

        <form action="index.php" method="get" class="form-maj-liste">
            <input type="hidden" name="idUtilisateur" value="<?php echo $intIdUtilisateur ?>">
            <input type="hidden" name="idListe" value="<?php echo $intIdListe ?>">

            <ul class="form__containeur flex">
                <li class="form__item">
                    <label for="nom_liste">Nom de la liste :</label>
                    <input type="text" name="nom_liste" id="nom_liste" value="<?php echo $arrListe['nom_liste'] ?>">
                </li>
                <li class="form__item">
                    <p class="couleur-liste__label">Couleur de la liste :</p>

                    <ul class="liste__couleurs flex">
                        <?php foreach ($arrListeCouleurs as $couleur) { ?>
                            <li class="couleur__item">
                                <input type="radio"
                                        <?php echo ecrireChecked("$couleur[id_couleur]", "id_couleur") ?>
                                       aria-label="Couleur <?php echo $couleur['nom_couleur_fr'] ?>"
                                       title="Couleur <?php echo $couleur['nom_couleur_fr'] ?>"
                                       class="visually-hidden liste-<?php echo simplifierTexte($couleur['nom_couleur_fr']) ?>"
                                       name="idCouleur" value="<?php echo $couleur['id_couleur'] ?>"
                                       id="couleur_<?php echo $couleur['id_couleur'] ?>">
                                <label for="couleur_<?php echo $couleur['id_couleur'] ?>"
                                       class="fond-radio liste-<?php echo simplifierTexte($couleur['nom_couleur_fr']) ?>">
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="form__item form__item--controle flex">
                    <input type="submit" class="btn-secondaire" name="btn_annuler" value="Annuler">
                    <input type="submit" class="btn-principal" name="btn_modifier"
                           value="<?php echo $strTexteBoutonValider ?>">
                </li>
            </ul>

        </form>

    </div>
</main>

<footer class="footer">
    <?php include($niveau . "assets/inc/fragments/bas-de-page.php"); ?>
</footer>
</body>
