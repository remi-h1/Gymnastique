<?php

// auteur : Rémi Hillériteau

$action = $_REQUEST['action'];
switch($action)
{
	case 'afficherListeHebergement':
	{
		// $lesHebergements = $pdo->getLesHebergements();
		$lesHebergements=lesHebergemntsTrie($pdo);
		include("vues/v_voirHebergement.php");
		break;
	}

	case 'modifierHebergement':
	{
		if(!isset($_GET['id']) OR empty($_GET['id']))
			{
				header('location: ?uc=gererHebergementJuges&action=afficherListeHebergement');
				break;
			}
		else
		{
			$id=$_GET['id'];
		}

		$unHebergement=$pdo->getUnHebergement($id);
		$nom=$unHebergement['NOMHEB'];
		if($unHebergement['TYPE']=='p')
			$type='particulier';
		else
			$type='hotel';
		$nbChambre1=$unHebergement['NBCHAMBRE1PLACE'];
		$nbChambre2=$unHebergement['NBCHAMBRE2PLACES'];
		$tel=$unHebergement['TELHEB'];
		$adresse=$unHebergement['ADRESSE'];
		$cp=$unHebergement['CP'];
		$ville=$unHebergement['VILLE'];
		$mail=$unHebergement['MAIL'];

		// pour les vérifications des réservations
		$nbChambre1PReserve=$pdo->getReservation($id, 1);
		$nbChambre2PReserve=$pdo->getReservation($id, 2);

		$action='validerModifHebergement';
		$titreForm='Modifier hébergement';
		include("vues/v_creerHebergement.php");
		break;
	}

	case 'validerModifHebergement' :
	{
		$id=$_REQUEST['id'];
		$nom=$_REQUEST['nom'];
		$type=$_REQUEST['type'];
		$nbChambre1=$_REQUEST['chambre1'];
		$nbChambre2=$_REQUEST['chambre2'];
		$tel=$_REQUEST['tel'];
		$adresse=$_REQUEST['adresse'];
		$cp=$_REQUEST['cp'];
		$ville=$_REQUEST['ville'];
		$mail=$_REQUEST['mail'];
		$pdo->modifHebergement($id, $nom, $type, $nbChambre1, $nbChambre2, $tel, $adresse, $cp, $ville, $mail);
		header('location: ?uc=gererHebergementJuges&action=confimerModif');
		break;
	}

	case 'confimerModif' :
	{
		$message="L'hebergement a bien été modifié";
		include('vues/v_message.php');
		$lesHebergements = lesHebergemntsTrie($pdo);
		include("vues/v_voirHebergement.php");
		break;
	}



	case 'supprimerHebergement':
	{
		$id=$_REQUEST['id'];
		$pdo->supHebergement($id);
		header('location: ?uc=gererHebergementJuges&action=confirmerSuppression');
		break;
	}

	case 'confirmerSuppression' :
	{
		$message="L'hebergement a bien été supprimé";
		include('vues/v_message.php');
		$lesHebergements =lesHebergemntsTrie($pdo);
		include("vues/v_voirHebergement.php");
		break;
	}

	case 'nouvelHebergement':
	{
		$nom=""; $type=""; $nbChambre1=0; $nbChambre2=0; $tel=""; $adresse=""; $cp=""; $ville=""; $mail='';
		$action='validerNouvelHebergement';
		$titreForm='Nouvel hébergement';
		include("vues/v_creerHebergement.php");
		break;
	}

	case 'validerNouvelHebergement' :
	{
		$nom=$_REQUEST['nom'];
		$type=$_REQUEST['type'];
		$nbChambre1=$_REQUEST['chambre1'];
		$nbChambre2=$_REQUEST['chambre2'];
		$tel=$_REQUEST['tel'];
		$adresse=$_REQUEST['adresse'];
		$cp=$_REQUEST['cp'];
		$ville=$_REQUEST['ville'];
		$mail=$_REQUEST['mail'];
		$pdo->setHebergement($nom, $type, $nbChambre1, $nbChambre2, $tel, $adresse, $cp, $ville, $mail);
		header('location: ?uc=gererHebergementJuges&action=confimerEnregistrement');
		break;
	}

	case 'confimerEnregistrement':
	{
		$message="L'hebergement a bien été enregistré";
		include('vues/v_message.php');
		$lesHebergements =lesHebergemntsTrie($pdo);
		include("vues/v_voirHebergement.php");
		break;
	}
}

?>
