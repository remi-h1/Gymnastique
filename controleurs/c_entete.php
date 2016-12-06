<?php
// en tête
// auteur : Rémi Hillériteau

if(isset($_REQUEST['uc']) AND !empty($_REQUEST['uc']))
    $titre=$_REQUEST['uc'];
else
    $titre="accueil";
switch($uc)
{
    case 'accueil' : $titre='Accueil';
    break;

    case 'gererHebergementJuges' : $titre='Gestion des hébergements pour les juges';
    break;

    case 'gererJuges' : $titre='Gestion des juges';
    break;

    case 'nombreParticipants' : $titre='Gestion des participants';
    break;

    case 'gererPartieComptable' : $titre='Gérer la partie comptable';
    break;

    case 'gererCommissionRestauration' : $titre='Commission restauration';
    break;

    case 'clubChoisirPrestation' : $titre='choisir les prestation des juges';
    break;

    case 'erreur404' : $titre='erreur 404';
    break;

    default : header('location: index.php?uc=erreur404');
    break;
}

include('vues/v_entete.php');
?>
