<?php
// affichage du numéro de téléphone (avec espace tout les 2 chiffres)
// auteur : Rémi Hillériteau
function tel($str) {
    if(strlen($str) == 10) {
    $res = substr($str, 0, 2) .'&nbsp;';
    $res .= substr($str, 2, 2) .'&nbsp;';
    $res .= substr($str, 4, 2) .'&nbsp;';
    $res .= substr($str, 6, 2) .'&nbsp;';
    $res .= substr($str, 8, 2) .'&nbsp;';
    return $res;
    }
}

// permet de créer des critères de recherche et de trie 
// et de faire l'appel à la requête pour récupérer les hébergements
// auteur : Rémi Hillériteau
function lesHebergemntsTrie($pdo)
{
	// initalisation des variables
	if(isset($_REQUEST['r']) AND !empty($_REQUEST['r']))
		$r=$_REQUEST['r'];
	else
		$r='';
	if(isset($_REQUEST['o']) AND !empty($_REQUEST['o']))
		$o=$_REQUEST['o'];
	else
		$o='ASC';
	if(isset($_REQUEST['t']) AND !empty($_REQUEST['t']))
		$t=$_REQUEST['t'];
	else
		$t='NOMHEB';

	$lesHebergements = $pdo->getLesHebergements($r, $o, $t);

	return $lesHebergements;
}

// lien de trie de la liste d'hébergement
// auteur : Rémi Hillériteau
function trieListeHebergement($champ)
{
	if(isset($_REQUEST['t']) AND isset($_REQUEST['o']) AND $_REQUEST['t']==$champ)
	{
		if($_REQUEST['o']=='ASC')
			$affichageOrdre='DESC';
		else
			$affichageOrdre='ASC';
	}
	else
		$affichageOrdre='ASC';

	$adresse='?uc=gererHebergementJuges&action=afficherListeHebergement&t=' . $champ . '&o=' . $affichageOrdre;

	if(isset($_REQUEST['r']))
		$adresse.="&r=" . $_REQUEST['r'];

	$lien = " onclick='document.location.href=\"" . $adresse . "\";' ";

	return $lien;
}

?>
