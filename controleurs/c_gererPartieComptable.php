<?php

// auteur : Rémi Hillériteau

$action = $_REQUEST['action'];
switch($action)
{
	case 'afficherPartieCompta':
	{
		if(isset($_REQUEST['asso']) AND !empty($_REQUEST['asso']))
			$uneAsso=$pdo->getUneAssociation($_REQUEST['asso']);
		else
			$uneAsso=$pdo->getPremierAssociation();

		$idAsso=$uneAsso['NUMEROASSO'];
		$montantInscriptionEquipe=$uneAsso['MONTANTINSCRIPTIONEQUIPE'];
		$acompte=$uneAsso['ACOMPTE'];
		$acompteRecu=$uneAsso['ACOMPTERECU'];
		$factureAcompte=$uneAsso['FACTUREACOMPTE'];
		$modeReglement=$uneAsso['MODEREGLEMENT'];
		$reglementSolde=$uneAsso['REGLEMENTSOLDE'];
		$ouvertureCompte=$uneAsso['OUVERTURECOMPTE'];

		$lesAssociations= $pdo->getNomsAssociations();
		include("vues/v_afficherPartieCompta.php");
		break;
	}

	case 'modifierCompta' :
	{
		$idAsso=$_REQUEST['idAsso'];
		$acompte=$_REQUEST['acompte'];
		$acompteRecu=$_REQUEST['acompteRecu'];
		$factureAcompte=$_REQUEST['factureAcompte'];
		$modeReglement=$_REQUEST['modeReglement'];
		$reglementSolde=$_REQUEST['soldeAsso'];
		$ouvertureCompte=$_REQUEST['ouvertureCompteAsso'];

		$pdo->modifierAssociationCompta($idAsso, $acompte, $acompteRecu, $factureAcompte, $modeReglement, $reglementSolde, $ouvertureCompte);
		header('location: ?uc=gererPartieComptable&action=afficherPartieCompta&asso=' . $idAsso);
	}

}

?>