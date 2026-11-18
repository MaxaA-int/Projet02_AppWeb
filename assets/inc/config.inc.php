<?php
ini_set('display_errors', 1); //Permet de voir les erreurs PHP et le no de ligne concerné

// Verifier si l'exécution se fait sur le serveur de développement (local) ou celui de la production:
$blnLocal = (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) ? TRUE : FALSE;

// Selon l'environnement d'exécution (développement ou production)
$strBD = '26_rpni1_P2_maxime';
$strUser = '26_rpni1_P2_maxime';
$strPassword = '2435415*T1m';

if ($blnLocal) {
    $strHost = 'localhost;port=8889';
    error_reporting(E_ALL);

} else {
    $strHost = 'timunix3.cegep-ste-foy.qc.ca';
    error_reporting(E_ALL & ~E_NOTICE);
}

//Data Source Name pour l'objet PDO
$strDsn = 'mysql:dbname=' . $strBD . ';host=' . $strHost;

//Tentative de connexion
$pdoConnexion = new PDO($strDsn, $strUser, $strPassword);
//Changement d'encodage de l'ensemble des caractères pour UTF-8
$pdoConnexion->exec("SET CHARACTER SET utf8");
//Pour obtenir des rapports d'erreurs et d'exception avec errorInfo()
$pdoConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pdoConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

?>