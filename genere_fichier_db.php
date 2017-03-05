<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK rel="stylesheet" type="text/css" href="style.css">
<title>Import des donn&eacute;es</title>
</head>

<body bgcolor="#000000" style="font-family:Arial, Helvetica, sans-serif;color:#FFFFFF">
<?php 
// Nombre de fichiers .db à générer
$NB_FICHIER =25;
// Mode de communication : 1-FILAIRE / 2-AERIENNE (SYNCHRO FILAIRE PARAM) / 3-AERIENNE / 4-AERIENNE AVEC POINTAGE AUTO (SYNCHRO FILAIRE PARAM) / 5-AERIENNE AVEC POINTAGE AUTO
$MODE_COM=3;
// url du serveur soap de communication sous la forme http://127.0.0.1/webservices
//$URL="http://192.168.1.252:8082/production/webservices";
$URL="https://rognac.kiosquefamille.fr/ws_android";
 
// HTACCESS - Nom de l'utilisateur
$HTA_USER="";
// HTACCESS - Mot de passe associé à l'utilisateur
$HTA_PWD="";

// Nom du fichier db qui sera généré
$NOM_FICHIER="pointage";
// Nom du fichier db qui sera utilisé comme modèle
$source = "modele.db";

// N° à partir duquel démarre la génération
$boucle = 1;

while ($boucle <= $NB_FICHIER) {

	$destination='rognac/'.$NOM_FICHIER . $boucle.'.db';

	copy($source, $destination); 

	$db = new PDO('sqlite:'.$destination);
	$db->query("UPDATE CONFIG SET CODEPDA=" . $boucle.", MODE=" . $MODE_COM . ", URL_SOAP='" . $URL . "', HTACCESS_USER='" . $HTA_USER . "', HTACCESS_PWD='" . $HTA_PWD . "'");
	$db = null;
	$boucle++;
}
?>
<form name="genere_fichier_db">
<?php
print "Fin de la génération des " . $NB_FICHIER . " fichiers dans le répertoire vierge";
?>
</form>
</body>
</html>